<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        if ($this->session->userdata('role') != 1  || $this->session->userdata('logged_in') != true) {
            redirect('/');
        }
    }

    public function index()
    {
        $data['title'] = 'Admin | Category';
        $data['content'] = 'Category';
        $data['nav'] = 'category';

        $this->template->rander('admin/category', $data);
    }

    public function add_category()
    {
        $data = [];
        $data['title'] = 'Add Category';

        if ($this->input->post()) {
            $response['status'] = 0;
            $post_data = $this->input->post();

            if ($this->Category_model->insert_data($post_data)) {
                $response['status'] = 1;
                $response['message'] = 'Category added successfully';
            } else {
                $response['message'] = 'Error adding category';
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            die;
        }
    }
    public function get_category_list()
    {
        $categories = $this->Category_model->get_category_list();

        $table_data = array();
        foreach ($categories as $key => $category) {
            $action = '<a href="javascript:void(0);" class="btn btn-sm btn-primary  edit-category" data-id="' . $category['id'] . '"><i class="fas fa-edit"></i></a> <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-category" data-id="' . $category['id'] . '" > <i class="fa fa-trash" aria-hidden="true"></i></a>';
            $table_data[] = array(
                'SrNo' => $key + 1,
                'Name' => $category['category_name'],
                'Color' => $category['category_color'],
                'action' => $action
            );
        }

        $response['data'] = $table_data;
        echo json_encode($response);
    }

    public function get_category_data()
    {
        $category_id = $this->input->post('id');

        if ($category_id) {

            $category_data = $this->Category_model->get_category_by_id($category_id);

            if ($category_data) {
                $response['status'] = 1;
                $response['message'] = 'Category data retrieved successfully';
                $response['data'] = $category_data;
            } else {
                $response['status'] = 0;
                $response['message'] = 'Error retrieving category data';
            }

            echo json_encode($response);
            die;
        }
    }
    public function delete_category()
    {
        $category_id = $this->input->post('category_id');

        if ($category_id) {
            $this->Category_model->delete_category($category_id);
            echo json_encode(['status' => 'success', 'message' => 'Category deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Category ID not provided']);
        }
    }
}
