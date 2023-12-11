<?php
defined('BASEPATH') or exit('No direct script access allowed');




class Projects extends CI_Controller
{

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

        $data['team_members'] = $this->project_model->get_team_members();

        $data['team_leaders'] = $this->project_model->get_team_leaders();

        $this->template->rander('admin/projects', $data);
    }

    //get_team_leader
    public function get_team_leader()
    {
        $ceo_id = $this->input->post('ceo_id');
        $team_leaders = $this->project_model->get_team_leaders_by_ceo($ceo_id);
        echo json_encode($team_leaders);
    }

    //get_team_member
    public function get_team_member()
    {
        $ceo_id = $this->input->post('ceo_id');
        $team_members = $this->project_model->get_team_members_by_ceo($ceo_id);
        echo json_encode($team_members);
    }

    //admin_add_project
    public function add_project()
    {
        $this->form_validation->set_rules('project_name', 'Project Name', 'required');
        $this->form_validation->set_rules('team_leader[]', 'Team Leader', 'required');
        $this->form_validation->set_rules('team_member[]', 'Team Member', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => FALSE, 'message' => validation_errors()]);
        } else {

            $data = array(
                'project_name' => $this->input->post('project_name'),
                'start_date' => $this->input->post('start_date'),
                'status' => $this->input->post('project_status'),
                'added_by' => $this->session->userdata('id'),
                'date_created' => date('Y-m-d H:i:s'),
            );

            $result = $this->project_model->add_project($data);
            if ($result) {
                $team_leader = $this->input->post('team_leader');
                $team_member = $this->input->post('team_member');
                $project_id = $this->db->insert_id();
                
                //insert full team member
                foreach ($team_leader as $key => $value) {
                    foreach ($team_member[$key] as $key1 => $value1) {
                      $team_data = array(
                        'project_id' => $project_id,
                        'team_leader' => $value,
                        'team_member' => $value1,
                        'added_by' => $this->session->userdata('id'),
                        'date_created' => date('Y-m-d H:i:s'),
                      );
                        $this->project_model->add_project_team($team_data);
                    }
                }
                echo json_encode(['status' => TRUE, 'message' => 'Project added successfully.']);
            } else {
                echo json_encode(['status' => FALSE, 'message' => 'Project not added successfully.']);
            }
        }
    }

    //list_table
    public function list_table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $list_table = $this->project_model->get_project_by_ceo($this->session->userdata('id'));

            $data = array();
            if (!empty($list_table)) {
                foreach ($list_table as $key => $value) {

                    $data[] = array(
                        'sr_no' => $key + 1,
                        'project_name' => $value['project_name'],
                        'start_date' => $value['start_date'],
                        'team_leader' => $value['team_leaders'],
                        'team_member' => $value['team_members'],
                        'action' => ' <a href="javascript:void(0);" class="btn btn-sm btn-danger delete_project" data-id="' . $value['id'] . '" ><i class="fa fa-trash"></i></a>',
                    );
                }
            }

            $output = array(
                "data" => $data
            );

            echo json_encode($output);
            exit;
        }
    }
    public function delete_project()
    {
        $project_id = $this->input->post('id');

        if ($project_id) {
            $this->project_model->delete_project($project_id);
            $response['status'] = 1;
            $response['message'] = 'Project data Deleted successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'project data not deleted';
        }

        echo json_encode($response);
        exit;
    }
    
    public function check_project()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $project_name = $this->input->post('project_name');
            $result = $this->project_model->check_project($project_name);
            if ($result) {
                echo json_encode(FALSE);
            } else {
                echo json_encode(TRUE);
            }
        }
    }
}
