<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends MY_Controller {

	protected $access_level = ACCESS_LVL_ADMIN;
	
	public function __construct() {
		parent::__construct();
		//$this->load->model(array('category_model', 'serie_model', 'kanji_model', 'note_model'));
	}

	public function index() {
		$data = ['title' => $this->lang->line('title_list')];
		$this->category_model->order_by('order_by');
		$data['categories'] = $this->category_model->get_all();
		$this->display_view('exploration/index', $data);
	}
}
