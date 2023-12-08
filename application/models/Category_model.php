<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
    // Category Insert
    public function insert_data($data)
    {
        if (!empty($data)) {
            if ($data['hid'] != '' && $data['hid'] != 0) {
                $id =  $data['hid'];
                unset($data['hid']);
                $this->db->where('id', $id);
                $this->db->update('category', $data);
                return true;
            } else {
                unset($data['hid']);
                $this->db->insert('category', $data);
                return true;
            }
        } else {
            return false;
        }
    }
    // Category Get List
    public function get_category_list()
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category.is_delete', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_category_by_id($category_id)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id', $category_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Category Delete
    public function delete_category($category_id)
    {
        if ($category_id > 0) {
            $data = array('is_delete' => 1);
            $this->db->where('id', $category_id);
            $this->db->update('category', $data);
            return true;
        }
        return false;
    }
}
