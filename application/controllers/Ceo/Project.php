<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load project model
        $this->load->model('project_model');
    }


    public function index()
    {
        $data['title'] = 'CEO | Project';
        $data['content'] = 'Project';
        $data['nav'] = 'projects';

        //get team leder list
        $data['team_leaders'] = $this->project_model->get_team_leaders_by_ceo($this->session->userdata('id'));
        //get team members list
        $data['team_members'] = $this->project_model->get_team_members_by_ceo($this->session->userdata('id'));

        $data['status'] = $this->project_model->get_project_status($this->session->userdata('id'));

        $this->template->rander('ceo/project', $data);
    }


    //add_project
    public function add_project()
    {
        $this->form_validation->set_rules('project_name', 'Project Name', 'required');
        $this->form_validation->set_rules('team_leader[]', 'Team Leader', 'required');
        $this->form_validation->set_rules('team_member[]', 'Team Member', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => FALSE, 'message' => validation_errors()]);
        } else {
            echo '<pre>';
            print_r($this->input->post());
            die;

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
                //insert team leader
                foreach ($team_leader as $key => $value) {
                    $team_leader_data = array(
                        'project_id' => $project_id,
                        'team_leader_id' => $value,
                    );
                    $this->project_model->add_team_leader($team_leader_data);
                }
                //insert team member
                foreach ($team_member as $key => $value) {
                    $team_member_data = array(
                        'project_id' => $project_id,
                        'team_member_id' => $value,
                    );
                    $this->project_model->add_team_member($team_member_data);
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
                        'status' => $value['status_name'],
                        'action' => ' <a href="javascript:void(0);" data-id="' . $value['id'] . '" class="btn btn-sm btn-danger delete_project"><i class="fa fa-trash"></i></a>',
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
