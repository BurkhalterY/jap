<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Exploration extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('category_model', 'word_category_model'));
	}

	public function index($category = NULL) {
		$data = ['title' => $this->lang->line('title_list')];
		$data['categories'] = $this->category_model->order_by('order_by')->get_many_by('fk_parent_cat', $category);
		
		$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
		$data = array_merge($data, $this->word_category_model->getWordsWithType($category, $logged_in));
		$this->display_view('exploration/index', $data);
	}
}
