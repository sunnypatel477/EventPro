<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $email
	 * @return bool true on success, false on failure
	 */
	  public function resolve_user_login($email)
	  {
	  
		  $this->db->select('*');
		  $this->db->from('user');
		  $this->db->where('email', $email);
		  $query = $this->db->get();
		  return $query->row_array();
	  }


	  /**
	   * check_email function.
	   * 
	   * @access public
	   * @param mixed $email
	   * @return bool true on success, false on failure
	   */
	  public function check_email($email)
	  {
	  
		  $this->db->select('*');
		  $this->db->from('user');
		  $this->db->where('email', $email);
		  $query = $this->db->get();
		  return $query->row_array();
	  }

	  /**
	   * get_users_by_role function.
	   * 
	   * @access public
	   * @param mixed $role_id
	   * @return bool true on success, false on failure
	   */
	  public function get_users_by_role($role_id)
	  {
	  
		  $this->db->select('*');
		  $this->db->from('user');
		  $this->db->where('role', $role_id);
		  $query = $this->db->get();
		  return $query->result_array();
	  }

	
	  /**
	   * save_token function.
	   * 
	   * @access public
	   * @param mixed $email
	   * @param mixed $reset_token
	   * @return bool true on success, false on failure
	   */
	  public function save_token($email, $reset_token)
	  {
		  $this->db->where('email', $email);
		  $this->db->update('user', array('reset_token' => $reset_token));
		  return $this->db->affected_rows();
	  }

	  /**
	   * add_user function.
	   * 
	   * @access public
	   * @param mixed $data
	   * @return bool true on success, false on failure
	   */
	  public function add_user($data)
	  {
		  $this->db->insert('user', $data);
		  return $this->db->insert_id();
	  }

	  /**
	   * list_table function.
	   * 
	   * @access public
	   * @return bool true on success, false on failure
	   */
	  public function list_table()
	  {
		  $this->db->select('user.*, user_role.role_name');
		  $this->db->from('user');
		  //left join
		  $this->db->join('user_role', 'user.role = user_role.id', 'left');
          //where condition
		  $this->db->where('user.role !=', 1);
		  $query = $this->db->get();
		  return $query->result();
	  }

	  /**
	   * delete_user function.
	   * 
	   * @access public
	   * @param mixed $user_id
	   * @return bool true on success, false on failure
	   */
	  public function delete_user($user_id)
	  {
		  $this->db->where('id', $user_id);
		  $this->db->delete('user');
		  return $this->db->affected_rows();
	  }


	  /**
	   * edit_user function.
	   * 
	   * @access public
	   * @param mixed $user_id
	   * @return bool true on success, false on failure
	   */
	//   public function edit_user($user_id)
	//   {
	// 	  $this->db->select('*');
	// 	  $this->db->from('user');
	// 	  $this->db->where('id', $user_id);
	// 	  $query = $this->db->get();
	// 	  return $query->row();
	//   }
	

	



	
	
}
