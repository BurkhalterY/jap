<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Revision extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('category_model', 'serie_model', 'kanji_model'));
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
		$d = date('Ymd-His');
		$dir = FCPATH.'medias/tracings/'.date('Y-m');
		if(!is_dir($dir))
			mkdir($dir, 0777, true);

		$picture_name = $this->input->post('id').'_'.$d;
		$temp_name = $picture_name.'.png';
		$i = 0;
		while(is_file($dir.'/'.$temp_name)){
			$i++;
			$temp_name = $picture_name.'('.$i.').png';
		}
		file_put_contents($dir.'/'.$temp_name, base64_decode(explode('base64,', $_POST['image'])[1]));


		$dir = FCPATH.'medias/json/'.date('Y-m');
		if(!is_dir($dir))
			mkdir($dir, 0777, true);

		$json_filename = $this->input->post('id').'_'.$d;
		$json_temp_name = $json_filename.'.json';
		$i = 0;
		while(is_file($dir.'/'.$json_temp_name)){
			$i++;
			$json_temp_name = $json_filename.'('.$i.').json';
		}
		file_put_contents($dir.'/'.$json_temp_name, $_POST['json']);

		redirect('revision/validate_trace/'.$this->input->post('id').'/'.$d);
	}

	public function validate_trace($id, $date, $correct = null) {
		$data = ['title' => $this->lang->line('write_kanjis')];
		$data['kanji'] = $this->kanji_model->get($id);
		$data['tracing'] = date('Y-m').'/'.$id.'_'.$date.'.png';
		$data['route'] = $id.'/'.$date;
		
		if(is_null($correct)){
			$this->display_view('revision/validate_trace', $data);
		} else {
			if($correct == 1){
				unset($_SESSION['to_train'][$id]);
			}
			redirect('revision/trace');
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
		if(!is_null($correct) && $correct == 1){
			unset($_SESSION['to_train'][$id]);
		}
		redirect('revision/translate');
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
}
