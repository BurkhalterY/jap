<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Selection extends MY_Controller {

	protected $access_level = ACCESS_LVL_USER;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('category_model', 'word_category_model', 'note_model', 'mode_model'));
	}

	public function index() {
		$data = ['title' => $this->lang->line('title_choice_words')];
		$data['categories'] = $this->category_model->order_by('order_by')->get_many_by('fk_parent_cat', NULL);
		$this->display_view('selection/index', $data);
	}

	public function ajax_load($id) {
		$data['categories'] = $this->category_model->order_by('order_by')->get_many_by('fk_parent_cat', $id);
		$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
		foreach ($data['categories'] as $category) {
			$category->words = $this->word_category_model->getWordsWithType($category->id, $logged_in);
		}
		$this->load->view('selection/ajax_load', $data);
	}

	public function add_note() {
		$req = ['fk_user' => $_SESSION['user_id'], 'fk_word' => $this->input->post('word')];
		$note = $this->note_model->get_by($req);
		$req['note'] = $this->input->post('note');
		if(is_null($note)){
			$this->note_model->insert($req);
		} else {
			$this->note_model->update($note->id, $req);
		}
	}

	public function add_word_to_train($id, $active = null) {
		if(boolval($active)){
			$_SESSION['to_train'][$id] = true;
		} else if(isset($_SESSION['to_train'][$id])){
			unset($_SESSION['to_train'][$id]);
		}
	}

	public function add_category_to_train($id, $active = null) {
		$words = $this->word_category_model->get_many_by('fk_category', $id);
		foreach ($words as $word) {
			$this->add_word_to_train($word->fk_word, $active);
		}
	}

	public function add_srs_to_train($id) {
		$this->add_category_to_train($id, false);
		$words = $this->word_category_model->get_many_by('fk_category', $id);
		foreach ($words as $word) {
			$this->add_word_to_train($word->fk_word, !boolval($this->note_model->count_by("fk_user = ".$_SESSION['user_id']." AND fk_word = ".$word->id." AND next_revision > NOW()")));
		}
	}

	public function modes() {
		$data = ['title' => $this->lang->line('title_choice_modes')];

		$data['modes'] = $this->mode_model->with('word_type')->get_all();

		/*$data['groups'] = [
			'kana' => [
				'revision_kana_to_romaji_multiple_choice',
				'revision_romaji_to_kana_multiple_choice',
				'revision_kana_to_romaji_write',
				'revision_romaji_to_kana_trace'
			],
			'kanji' => [
				'revision_kanji_to_meaning_multiple_choice',
				'revision_meaning_to_kanji_multiple_choice',
				'revision_kanji_to_meaning_write',
				'revision_meaning_to_kanji_trace'
			],
			'voc' => [
				'revision_translation_to_japanese_multiple_choice',
				'revision_japanese_to_translation_multiple_choice',
				'revision_translation_to_japanese_romaji_write',
				'revision_translation_to_japanese_trace',
				'revision_japanese_to_translation_write'
			]
		];*/
		if(isset($_POST['modes'])){
			unset($_SESSION['modes']);
			foreach ($data['modes'] as $mode) {
				$_SESSION['modes'][$mode->fk_word_type] = [];
			}
			foreach ($_POST['modes'] as $mode => $type) {
				$_SESSION['modes'][$type][] = $mode;
			}
		}
		if(!isset($_SESSION['modes'])){
			foreach ($data['modes'] as $mode) {
				$_SESSION['modes'][$mode->fk_word_type] = [];
			}
		}
		foreach ($_SESSION['modes'] as $mode) {
			if(count($mode) == 0){
				$data['error'] = $this->lang->line('msg_error_modes');
				break;
			}
		}
		if(isset($_POST['submit']) && !isset($data['error'])){
			redirect('revision');
		} else {
			$this->display_view('selection/modes', $data);
		}
	}
}
