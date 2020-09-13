<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Exploration extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('word_model', 'kana_model'));
	}

	public function index() {
		$data = ['title' => $this->lang->line('title_list')];
		$this->word_model->order_by('order_by');
		$data['categories'] = $this->word_model->get_all();
		$this->display_view('exploration/index', $data);
	}
}
