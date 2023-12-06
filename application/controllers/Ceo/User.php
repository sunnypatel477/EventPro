<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    public function index()
    {
        $data['title'] = 'CEO | Users';
        $data['content'] = 'Users';
        $data['nav'] = 'users';

        //add header and footer file
        $this->load->view('template/header', $data);
        $this->load->view('ceo/user');
        $this->load->view('template/footer');
    }
    public function add_user()
    {
        if ($this->input->post()) {

            $post_data = $this->input->post();

            $post_data['password'] = password_hash(123456, PASSWORD_DEFAULT);
            $post_data['date_created'] = date('Y-m-d');
            $user_id = $this->user_model->add_user($post_data);

            if ($user_id) {

                $this->load->library('email');

                $reset_token = bin2hex(random_bytes(32));
                $this->user_model->save_token($post_data['email'], $reset_token);
                $this->email->from('mojidaravivek23@gmail.com', 'Event pro');
                $this->email->to($post_data['email']);
                $this->email->subject('Please Enter Your Password Here');
                $this->email->message('Please click the following link to set your password: ' . base_url('ceo/user/reset_password/' . $reset_token));

                if ($this->email->send()) {
                    $response['status'] = 1;
                    $response['message'] = 'User added successfully. An email has been sent with login details.';
                } else {
                    $response['message'] = 'Error adding user. Email could not be sent.';
                }
            } else {
                $response['message'] = 'Error adding user';
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            die;
        }
    }
    public function reset_password($token)
    {
        $data = [];
        $data['title'] = 'Update Password';
        $data['token'] = $token;
        $data['content'] = 'Users';
        $data['nav'] = 'users';

        if ($this->input->post()) {
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            $reset_token = $this->input->post('token');

            $response = array();

            if ($new_password === $confirm_password) {
                if ($this->user_model->update_password($reset_token, $new_password)) {
                    $response['status'] = 1;
                    $response['message'] = 'Password Update Successfully';
                } else {
                    $response['status'] = 0;
                    $response['message'] = 'Error updating password.';
                }
            } else {
                $response['status'] = 0;
                $response['message'] = 'Passwords do not match.';
            }

            echo json_encode($response);
            return;
        }


        // $this->load->view('template/header', $data);
        $this->load->view('ceo/reset_password');
        // $this->load->view('template/footer');
    }
}
