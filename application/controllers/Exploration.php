<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Exploration extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('category_model', 'serie_model', 'kanji_model', 'note_model'));
	}

	public function index() {
		$data = ['title' => $this->lang->line('title_list')];
		$this->category_model->order_by('order_by');
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('exploration/index', $data);
	}

	public function category($id) {
		$data['category'] = $this->category_model->get($id);
		$data['title'] = $data['category']->cat_name;
		$this->serie_model->order_by('order_by');
		$data['series'] = $this->serie_model->get_many_by('fk_category', $id);
		foreach ($data['series'] as $serie) {
			if($this->kanji_model->count_by('fk_serie', $serie->id) == 0){
				$serie->empty = true;
			}
		}
		$this->display_view('exploration/category', $data);
	}

	public function serie($id) {
		$data['serie'] = $this->serie_model->get($id);
		$data['title'] = $data['serie']->serie_name;
		$this->kanji_model->order_by('kanji_order');
		$data['kanjis'] = $this->kanji_model->get_many_by('fk_serie', $id);
		if ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
			foreach ($data['kanjis'] as $kanji) {
				$note = $this->note_model->get_by(['fk_user' => $_SESSION['user_id'], 'fk_kanji' => $kanji->id]);
				if(!is_null($note)){
					$kanji->note = $note->note;
				}
			}
		}
		$this->display_view('exploration/serie', $data);
	}
}
