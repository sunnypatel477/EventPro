<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
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

}