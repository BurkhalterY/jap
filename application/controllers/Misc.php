<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Misc extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->about();
	}

	public function about() {
		$data = ['title' => $this->lang->line('title_about')];
		$this->display_view('misc/about', $data);
	}
}
