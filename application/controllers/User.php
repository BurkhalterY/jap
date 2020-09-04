<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('user_model'));
	}

	public function index($id = -1, $page = 1) {
		redirect('user/login');
	}

	public function login() {
		$data = ['title' => $this->lang->line('title_login')];
		if(isset($_POST['btn_login'])){
			$this->form_validation->set_rules('username', $this->lang->line('field_username'), 'callback_cb_check_password['.$this->input->post('password').']');

			if($this->form_validation->run()){
				$user = $this->user_model->with('user_type')->get_by('username', $this->input->post('username'));
				$_SESSION['user_id'] = $user->id;
				$_SESSION['username'] = $user->username;
				$_SESSION['user_access'] = $user->user_type->level;
				$_SESSION['logged_in'] = true;
				redirect('revision');
			}
		}
		$this->display_view('user/login', $data);
	}

	public function cb_check_password($username, $password)
	{
		$this->form_validation->set_message('cb_check_password', $this->lang->line('msg_wrong_password'));
		$user = $this->user_model->get_by('username', $username);
		return !is_null($user) && password_verify($password, $user->password);
	}

	public function register() {
		$data = ['title' => $this->lang->line('title_register')];
		if(isset($_POST['btn_register'])){
			$this->form_validation->set_rules('username', $this->lang->line('field_username'), 'required|callback_cb_not_exists');
			$this->form_validation->set_rules('email', $this->lang->line('field_email'), 'valid_email');
			$this->form_validation->set_rules('password', $this->lang->line('field_password'), 'required|min_length[6]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('field_password_confirm'), 'required|matches[password]');

			if($this->form_validation->run()){
				$req = [
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'fk_user_type' => ACCESS_LVL_USER
				];
				$this->user_model->insert($req);

				$user = $this->user_model->with('user_type')->get_by('username', $this->input->post('username'));
				$_SESSION['user_id'] = $user->id;
				$_SESSION['username'] = $user->username;
				$_SESSION['user_access'] = $user->user_type->level;
				$_SESSION['logged_in'] = true;
				redirect('revision');
			}
		}
		$this->display_view('user/register', $data);
	}

	public function cb_not_exists($username){
		$this->form_validation->set_message('cb_not_exists', $this->lang->line('msg_username_already_exists'));
		return $this->user_model->count_by('username', $username) == 0;
	}

	public function logout() {
		session_destroy();
		redirect('user/login');
	}
}
