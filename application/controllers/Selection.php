<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Selection extends MY_Controller {

	protected $access_level = ACCESS_LVL_USER;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('category_model', 'word_category_model', 'note_model'));
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
}
