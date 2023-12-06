<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

        //check user is logged in or not
        if ($this->session->userdata('role') != 1  || $this->session->userdata('logged_in') != true) {
            redirect('/');
        }
    }

    public function index()
    {
        $data['title'] = 'Admin | Users';
        $data['content'] = 'Users';
        $data['nav'] = 'users';

        //add header and footer file
        $this->load->view('template/header', $data);
        $this->load->view('admin/user');
        $this->load->view('template/footer');
    }

    //check mail is unique or not
    public function check_email()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $email = $this->input->post('email');
            $result = $this->user_model->check_email($email);
            if ($result) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }

    //add user
    public function add_user()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[50]|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('role', 'Role', 'trim|required');
   

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(['status' => FALSE, 'message' => validation_errors()]);
            } else {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'email'      => $this->input->post('email'),
                    'role'    => $this->input->post('role'),
                    'password' => password_hash('123456', PASSWORD_DEFAULT),
                    'added_by' => $this->session->userdata('id'),
                    'date_created' => date('Y-m-d H:i:s')
                );

                $result = $this->user_model->add_user($data);
                if ($result) {

                    $this->load->library('email');
                    $reset_token = bin2hex(random_bytes(32));
                    $this->user_model->save_token($this->input->post('email'), $reset_token);
                    $this->email->from('mapatel90@gmail.com', 'Event Pro');
                    $this->email->to($this->input->post('email'));
                    $this->email->subject('Please Enter Your Password Here');
                    $this->email->message('Please click the following link to set your password: ' . base_url('admin/users/reset_password/' . $reset_token));

                    if($this->email->send()){
                        echo json_encode(['status' => TRUE, 'message' => 'User added successfully.']);
                    } else {
                        echo json_encode(['status' => FALSE, 'message' => 'Failed to add user.']);
                    }
                } else {
                    echo json_encode(['status' => FALSE, 'message' => 'Failed to add user.']);
                }
            }
        }
    }


    //list_table
    public function list_table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
     
            $list_table = $this->user_model->list_table();
            $data = array();
            if (!empty($list_table)) {
                foreach ($list_table as $key => $value) {

                    if($value->role_name == 'ceo'){
                        $role = 'CEO';
                    } elseif($value->role_name == 'team_leader'){
                        $role = 'Team Leader';
                    } elseif($value->role_name == 'team_member'){
                        $role = 'Team Member';
                    } elseif($value->role_name == 'admin'){
                        $role = 'Admin';
                    }
                    // <a href="javascript:void(0);"  data-id="'.$value->id.'" class="btn btn-sm btn-primary edit_user"><i class="fa fa-edit"></i></a>

                    $data[] = array(
                        'sr_no' => $key + 1,
                        'user_name' => $value->first_name . ' ' . $value->last_name,
                        'email' => $value->email,
                        'role' => $role,
                        'action' => ' <a href="javascript:void(0);" data-id="'.$value->id.'" class="btn btn-sm btn-danger delete_user"><i class="fa fa-trash"></i></a>',
                    );
                }
            }
    
            $output = array(
                "data" => $data
            );
            echo json_encode($output);
        }
    }

    //delete_user
    public function delete_user()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $id = $this->input->post('user_id');
            $result = $this->user_model->delete_user($id);
            if ($result) {
                echo json_encode(['status' => TRUE, 'message' => 'User deleted successfully.']);
            } else {
                echo json_encode(['status' => FALSE, 'message' => 'Failed to delete user.']);
            }
        }
    }

    //edit_user
    // public function edit_user()
    // {
    //     if (!$this->input->is_ajax_request()) {
    //         exit('No direct script access allowed');
    //     } else {
    //         $id = $this->input->post('user_id');
    //         $result = $this->user_model->edit_user($id);
    //         if ($result) {
    //             echo json_encode(['status' => TRUE, 'message' => 'User data found.', 'data' => $result]);
    //         } else {
    //             echo json_encode(['status' => FALSE, 'message' => 'Failed to find user data.']);
    //         }
    //     }
    // }
}