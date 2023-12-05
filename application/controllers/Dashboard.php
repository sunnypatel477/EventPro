<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        //load model
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['content'] = 'Dashboard';
        

        //add header and footer file
        $this->load->view('template/header', $data);
        $this->load->view('dashboard');
        $this->load->view('template/footer');
    }

}