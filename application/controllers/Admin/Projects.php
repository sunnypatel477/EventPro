<?php 
defined('BASEPATH') OR exit('No direct script access allowed');




class Projects extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('project_model');

        //check user is logged in or not
        if ($this->session->userdata('role') != 1  || $this->session->userdata('logged_in') != true) {
            redirect('/');
        }
    }

    public function index()
    {
        $data['title'] = 'Admin | Projects';
        $data['content'] = 'Projects';
        $data['nav'] = 'projects';

        //get ceo list
        $data['ceo_list'] = $this->project_model->get_ceo_list();

        //get project status
        $data['project_status'] = $this->project_model->get_project_status();


        $this->template->rander('admin/projects', $data);
    }



}