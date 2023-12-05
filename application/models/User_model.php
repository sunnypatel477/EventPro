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

	



	
	
}
