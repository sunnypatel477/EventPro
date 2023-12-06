<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class User_model extends CI_Model
{

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{

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

	public function add_user($data)
    {
        if (isset($data['id']) && $data['id'] > 0) {
            //  update user
            $id =  $data['id'];
            unset($data['id']);
            $this->db->where('id', $id);
            $this->db->update('user', $data);
            return true;
        } else {
            $this->db->insert('user', $data);
            $insert_id = $this->db->insert_id();
            if ($insert_id > 0) {
                return $insert_id; // Return the insert ID on success
            } else {
                return false; // Return false on error
            }
        }
    }

	// Save User Token
	public function save_token($email, $token)
	{
		$this->db->where('email', $email);
		$this->db->update('user', ['token' => $token]);
		return $this->db->affected_rows() > 0;
	}

	// User Update Password
    public function update_password($reset_token, $new_password)
    {
        $user = $this->db->get_where('user', array('token' => $reset_token))->row();
        if ($user) {
            $this->db->where('token', $reset_token);
            $this->db->update('user', array('password' => password_hash($new_password, PASSWORD_DEFAULT), 'token' => null));
            return true;
        } else {
            return false;
        }
    }
}
