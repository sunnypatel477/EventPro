<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
         $data['title'] = 'Login';


		$this->load->view('login', $data);
	}

	//login function
	public function login()
	{
		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == false) {
				echo json_encode(['status' => false,'message' => 'Validation rules violated']);
			} else {
				// Set variables from the form
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$data = $this->user_model->resolve_user_login($email);
				if (password_verify($password, $data['password'])) {
					// User login OK
					$session_data = array(
						'id' => $data['id'],
						'username' => $data['username'],
						'first_name' => $data['first_name'],
						'role' => $data['role'],
						'last_name' => $data['last_name'],
						'logged_in' => true,
					);
					$this->session->set_userdata($session_data);

					$final = [
						'status' => true,
						'message' => 'Login success!'
					];
					echo json_encode($final);
				} else {
					$message = [
						'status' => false,
						'message' => 'Wrong email or password.'
					];
					echo json_encode($message);
				}
			}
		}
	}

	//logout function
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
