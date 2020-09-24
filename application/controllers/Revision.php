<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Revision extends MY_Controller {

	protected $access_level = ACCESS_LVL_USER;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('word_model', 'kana_model', 'kanji_model', 'vocabulary_model', 'kdlt_model', 'alphabet_model'));
	}

	public function index() {
		$data = ['title' => $this->lang->line('title_revision_2')];
		$this->display_view('revision/index', $data);
	}

	public function revision() {
		foreach ($_SESSION['modes'] as $group) {
			if(count($group) == 0){
				redirect(base_url('selection/modes'));
			}
		}
		if(count($_SESSION['to_train']) == 0){
			redirect(base_url('selection'));
		} else {
			$word = $this->word_model->get(array_rand($_SESSION['to_train']));
			$data['mode'] = $_SESSION['modes'][$word->fk_word_type][array_rand($_SESSION['modes'][$word->fk_word_type])];
			switch ($data['mode']) {
				case REVISION_KANA_TO_ROMAJI_MULTIPLE_CHOICE:
					$data['kana'] = $this->kana_model->get_by('fk_word', $word->id);
					$data['multiple_choice'] = $this->kana_model->order_by('RAND()')->limit(4)->get_many_by(['fk_word' => array_keys($_SESSION['to_train']), 'id != '.$data['kana']->id]);
					$data['multiple_choice'][] = $data['kana'];
					shuffle($data['multiple_choice']);
					$this->display_view('revision/kana/kana_to_romaji_multiple_choice', $data);
					break;
				case REVISION_ROMAJI_TO_KANA_MULTIPLE_CHOICE:
					$data['kana'] = $this->kana_model->get_by('fk_word', $word->id);
					$data['multiple_choice'] = $this->kana_model->order_by('RAND()')->limit(4)->get_many_by(['fk_word' => array_keys($_SESSION['to_train']), 'id != '.$data['kana']->id]);
					$data['multiple_choice'][] = $data['kana'];
					shuffle($data['multiple_choice']);
					$this->display_view('revision/kana/romaji_to_kana_multiple_choice', $data);
					break;
				case REVISION_KANA_TO_ROMAJI_WRITE:
					$data['kana'] = $this->kana_model->get_by('fk_word', $word->id);
					$this->display_view('revision/kana/kana_to_romaji_write', $data);
					break;
				case REVISION_ROMAJI_TO_KANA_TRACE:
					$data['kana'] = $this->kana_model->get_by('fk_word', $word->id);
					$this->display_view('revision/kana/romaji_to_kana_trace', $data);
					break;
				case REVISION_KANJI_TO_MEANING_MULTIPLE_CHOICE:
					$data['kanji'] = $this->kanji_model->get_by('fk_word', $word->id);
					$data['multiple_choice'] = $this->kanji_model->order_by('RAND()')->limit(4)->get_many_by(['fk_word' => array_keys($_SESSION['to_train']), 'id != '.$data['kanji']->id]);
					$data['multiple_choice'][] = $data['kanji'];
					shuffle($data['multiple_choice']);
					$this->display_view('revision/kanji/kanji_to_meaning_multiple_choice', $data);
					break;
				case REVISION_MEANING_TO_KANJI_MULTIPLE_CHOICE:
					$data['kanji'] = $this->kanji_model->get_by('fk_word', $word->id);
					$data['multiple_choice'] = $this->kanji_model->order_by('RAND()')->limit(4)->get_many_by(['fk_word' => array_keys($_SESSION['to_train']), 'id != '.$data['kanji']->id]);
					$data['multiple_choice'][] = $data['kanji'];
					shuffle($data['multiple_choice']);
					$this->display_view('revision/kanji/meaning_to_kanji_multiple_choice', $data);
					break;
				case REVISION_KANJI_TO_MEANING_WRITE:
					$data['kanji'] = $this->kanji_model->get_by('fk_word', $word->id);
					$this->display_view('revision/kanji/kanji_to_meaning_write', $data);
					break;
				case REVISION_MEANING_TO_KANJI_TRACE:
					$data['kanji'] = $this->kanji_model->get_by('fk_word', $word->id);
					$this->display_view('revision/kanji/meaning_to_kanji_trace', $data);
					break;
				case REVISION_TRANSLATION_TO_JAPANESE_MULTIPLE_CHOICE:
					break;
				case REVISION_JAPANESE_TO_TRANSLATION_MULTIPLE_CHOICE:
					break;
				case REVISION_TRANSLATION_TO_JAPANESE_ROMAJI_WRITE:
					break;
				case REVISION_TRANSLATION_TO_JAPANESE_TRACE:
					break;
				case REVISION_JAPANESE_TO_TRANSLATION_WRITE:
					break;
			}
		}
	}

	public function validate($mode, $word) {
		switch ($mode) {
			case REVISION_KANA_TO_ROMAJI_MULTIPLE_CHOICE:
				$data['kana'] = $this->kana_model->get_by('fk_word', $word);
				$data['answer'] = urldecode($_GET['answer']);
				$data['correct'] = $data['kana']->romaji == $data['answer'];
				$this->display_view('revision/kana/kana_to_romaji_multiple_choice_validate', $data);
				break;
			case REVISION_ROMAJI_TO_KANA_MULTIPLE_CHOICE:
				$data['kana'] = $this->kana_model->get_by('fk_word', $word);
				$data['answer'] = urldecode($_GET['answer']);
				$data['correct'] = $data['kana']->kana == $data['answer'];
				$this->display_view('revision/kana/romaji_to_kana_multiple_choice_validate', $data);
				break;
			case REVISION_KANA_TO_ROMAJI_WRITE:
				$data['kana'] = $this->kana_model->get_by('fk_word', $word);
				$data['answer'] = $_POST['answer'];

				$your_answer = $data['answer'];
				$official_answer_1 = $data['kana']->romaji;
				$official_answer_2 = $data['kana']->romaji;
				if(strpos($your_answer, '(') === false){
					$your_answer = preg_replace('/\(.*\)/', '', $your_answer);
					$official_answer_1 = preg_replace('/\(.*\)/', '', $official_answer_1);
					$official_answer_2 = preg_replace('/[\(\)]/', '', $official_answer_2);
				}
				$data['correct'] = strtolower($your_answer) == strtolower($official_answer_1)
								|| strtolower($your_answer) == strtolower($official_answer_2);

				$this->display_view('revision/kana/kana_to_romaji_write_validate', $data);
				break;
			case REVISION_ROMAJI_TO_KANA_TRACE:
				$data['kana'] = $this->kana_model->get_by('fk_word', $word);
				$data['base64'] = $_POST['image'];
				$this->display_view('revision/kana/romaji_to_kana_trace_validate', $data);
				break;
			case REVISION_KANJI_TO_MEANING_MULTIPLE_CHOICE:
				$data['kanji'] = $this->kanji_model->get_by('fk_word', $word);
				$data['answer'] = urldecode($_GET['answer']);
				$data['correct'] = $data['kanji']->meaning == $data['answer'];
				$this->display_view('revision/kanji/kanji_to_meaning_multiple_choice_validate', $data);
				break;
			case REVISION_MEANING_TO_KANJI_MULTIPLE_CHOICE:
				$data['kanji'] = $this->kanji_model->get_by('fk_word', $word);
				$data['answer'] = urldecode($_GET['answer']);
				$data['correct'] = $data['kanji']->kanji == $data['answer'];
				$this->display_view('revision/kanji/meaning_to_kanji_multiple_choice_validate', $data);
				break;
			case REVISION_KANJI_TO_MEANING_WRITE:
				$data['kanji'] = $this->kanji_model->get_by('fk_word', $word);
				$data['answer'] = $_POST['answer'];
				$data['correct'] = false;
				foreach (explode(',', $data['kanji']->meaning) as $m) {
					if(strtolower(trim($m)) == strtolower($data['answer'])){
						$data['correct'] = true;
					}
				}
				$this->display_view('revision/kanji/kanji_to_meaning_write_validate', $data);
				break;
			case REVISION_MEANING_TO_KANJI_TRACE:
				$data['kanji'] = $this->kanji_model->get_by('fk_word', $word);
				$data['base64'] = $_POST['image'];
				$this->display_view('revision/kanji/meaning_to_kanji_trace_validate', $data);
				break;
			case REVISION_TRANSLATION_TO_JAPANESE_MULTIPLE_CHOICE:
				break;
			case REVISION_JAPANESE_TO_TRANSLATION_MULTIPLE_CHOICE:
				break;
			case REVISION_TRANSLATION_TO_JAPANESE_ROMAJI_WRITE:
				break;
			case REVISION_TRANSLATION_TO_JAPANESE_TRACE:
				break;
			case REVISION_JAPANESE_TO_TRANSLATION_WRITE:
				break;
		}
	}

	public function trace() {
		$data = ['title' => $this->lang->line('write_kanjis')];
		if(count($_SESSION['to_train']) > 0){
			$data['word'] = $this->word_model->get(array_rand($_SESSION['to_train']));
			$this->display_view('revision/trace', $data);
		} else {
			redirect(base_url('selection'));
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
		if(count($_SESSION['to_train']) > 0){
			$data['kanji'] = $this->kanji_model->get(array_rand($_SESSION['to_train']));
			$this->display_view('revision/translate', $data);
		} else {
			redirect(base_url('selection'));
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
}
