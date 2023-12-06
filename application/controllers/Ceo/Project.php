<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'CEO | Project';
        $data['content'] = 'Project';
        $data['nav'] = 'project';

        //add header and footer file
        $this->load->view('template/header', $data);
        $this->load->view('ceo/project');
        $this->load->view('template/footer');
    }
}