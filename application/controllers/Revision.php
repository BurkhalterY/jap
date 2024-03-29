<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Revision extends MY_Controller {

	protected $access_level = ACCESS_LVL_USER;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('category_model', 'serie_model', 'kanji_model', 'tracing_model', 'answer_model', 'note_model'));
	}

	public function index() {
		$data = ['title' => $this->lang->line('title_revision')];
		$this->display_view('revision/index', $data);
	}

	public function selection() {
		$this->category_model->order_by('order_by');
		$data = ['title' => $this->lang->line('title_choice_words')];
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('revision/selection', $data);
	}

	public function selection_ajax($id) {
		$this->serie_model->order_by('order_by');
		$data['series'] = $this->serie_model->get_many_by('fk_category', $id);
		foreach ($data['series'] as $serie) {
			$this->kanji_model->order_by('kanji_order');
			$serie->kanjis = $this->kanji_model->get_many_by('fk_serie', $serie->id);
			foreach ($serie->kanjis as $kanji) {
				$kanji->srs = !boolval($this->note_model->count_by("fk_user = ".$_SESSION['user_id']." AND fk_kanji = ".$kanji->id." AND next_revision > NOW()"));
			}
		}
		$this->load->view('revision/selection_ajax', $data);
	}

	public function trace() {
		$data = ['title' => $this->lang->line('write_kanjis')];
		if(array_key_exists('to_train', $_SESSION) && count($_SESSION['to_train']) > 0){
			$data['kanji'] = $this->kanji_model->get(array_rand($_SESSION['to_train']));
			$this->display_view('revision/trace', $data);
		} else {
			redirect(base_url('revision/selection'));
		}
	}

	public function post_trace() {
		$dir = FCPATH.'medias/tracings/'.date('Y-m');
		if(!is_dir($dir)){
			mkdir($dir);
		}

		$picture_name = $this->input->post('id').'_'.date('Ymd-His');
		$temp_name = $picture_name.'.png';
		$i = 0;
		while(is_file($dir.'/'.$temp_name)){
			$i++;
			$temp_name = $picture_name.'('.$i.').png';
		}
		file_put_contents($dir.'/'.$temp_name, base64_decode(explode('base64,', $_POST['image'])[1]));


		$dir = FCPATH.'medias/json/'.date('Y-m');
		if(!is_dir($dir)){
			mkdir($dir);
		}

		$json_filename = $this->input->post('id').'_'.date('Ymd-His');
		$json_temp_name = $json_filename.'.json';
		$i = 0;
		while(is_file($dir.'/'.$json_temp_name)){
			$i++;
			$json_temp_name = $json_filename.'('.$i.').json';
		}
		file_put_contents($dir.'/'.$json_temp_name, $_POST['json']);


		$req = array(
			'fk_user' => $_SESSION['user_id'],
			'fk_kanji' => $this->input->post('id'),
			'image' => date('Y-m').'/'.$temp_name,
			'json' => date('Y-m').'/'.$json_temp_name
		);
		$id = $this->tracing_model->insert($req);
		redirect('revision/validate_trace/'.$id);
	}

	public function validate_trace($id, $correct = null) {
		$data = ['title' => $this->lang->line('write_kanjis')];
		$data['tracing'] = $this->tracing_model->with('kanji')->get($id);
		if ($data['tracing']->fk_user == $_SESSION['user_id']) {
			if(is_null($correct)){
				$this->display_view('revision/validate_trace', $data);
			} else {
				$this->tracing_model->update($id, ['correct' => $correct]);

				$req = ['fk_user' => $_SESSION['user_id'], 'fk_kanji' => $data['tracing']->kanji->id];
				$note = $this->note_model->get_by($req);
				if(is_null($note)){
					$req['level'] = $correct;
					$req['next_revision'] = date_format(date_create('tomorrow'), 'Y-m-d');
					$this->note_model->insert($req);
				} else {
					if(new DateTime($note->next_revision) < new DateTime()){
						$req['level'] = min($note->level * $correct + $correct, 5);
						$req['next_revision'] = date_format(date_create('+'.pow(2, $req['level']).' day'), 'Y-m-d');
						$this->note_model->update($note->id, $req);
					}
				}

				if($correct == 1){
					unset($_SESSION['to_train'][$data['tracing']->kanji->id]);
				}
				redirect('revision/trace');
			}
		} else {
			redirect('revision');
		}
	}

	public function translate() {
		$data = ['title' => $this->lang->line('translate')];
		if(array_key_exists('to_train', $_SESSION) && count($_SESSION['to_train']) > 0){
			$data['kanji'] = $this->kanji_model->get(array_rand($_SESSION['to_train']));
			$this->display_view('revision/translate', $data);
		} else {
			redirect(base_url('revision/selection'));
		}
	}

	public function validate_translate($id, $correct = null) {
		if(!is_null($correct) && isset($_GET['a'])){
			$req = [
				'fk_user' => $_SESSION['user_id'],
				'fk_kanji' => $id,
				'answer' => $_GET['a'],
				'correct' => $correct
			];
			$this->answer_model->insert($req);

			$req = ['fk_user' => $_SESSION['user_id'], 'fk_kanji' => $id];
			$note = $this->note_model->get_by($req);
			if(is_null($note)){
				$req['level'] = $correct;
				$req['next_revision'] = date_format(date_create('tomorrow'), 'Y-m-d');
				$this->note_model->insert($req);
			} else {
				if(new DateTime($note->next_revision) < new DateTime()){
					$req['level'] = min($note->level * $correct + $correct, 5);
					$req['next_revision'] = date_format(date_create('+'.pow(2, $req['level']).' day'), 'Y-m-d');
					$this->note_model->update($note->id, $req);
				}
			}

			if($correct == 1){
				unset($_SESSION['to_train'][$id]);
			}
		}
		redirect('revision/translate');
	}

	public function add_note() {
		$req = ['fk_user' => $_SESSION['user_id'], 'fk_kanji' => $this->input->post('kanji')];
		$note = $this->note_model->get_by($req);
		$req['note'] = $this->input->post('note');
		if(is_null($note)){
			$this->note_model->insert($req);
		} else {
			$this->note_model->update($note->id, $req);
		}
	}

	public function add_kanji_to_train($id, $active = null) {
		if(boolval($active)){
			$_SESSION['to_train'][$id] = true;
		} else if(isset($_SESSION['to_train'][$id])){
			unset($_SESSION['to_train'][$id]);
		}
	}

	public function add_serie_to_train($id, $active = null) {
		$kanjis = $this->kanji_model->get_many_by('fk_serie', $id);
		foreach ($kanjis as $kanji) {
			$this->add_kanji_to_train($kanji->id, $active);
		}
	}

	public function add_srs_to_train($id) {
		$this->add_serie_to_train($id, false);
		$kanjis = $this->kanji_model->get_many_by('fk_serie', $id);
		foreach ($kanjis as $kanji) {
			$this->add_kanji_to_train($kanji->id, !boolval($this->note_model->count_by("fk_user = ".$_SESSION['user_id']." AND fk_kanji = ".$kanji->id." AND next_revision > NOW()")));
		}
	}
}
