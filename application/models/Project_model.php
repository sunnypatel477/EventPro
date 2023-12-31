<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model
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
     * get_team_leaders_by_ceo function.
     * 
     * @access public
     * @param mixed $ceo_id
     * @return bool true on success, false on failure
     */
    public function get_team_leaders_by_ceo($ceo_id)
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('added_by', $ceo_id);
        $this->db->where('role', TEAM_LEADER_ROLE);
        $query = $this->db->get();
        return $query->result_array();
    }



    /** 
     * get_team_members_by_ceo function.
     * 
     * 
     * @access public
     * @param mixed $ceo_id
     * @return bool true on success, false on failure
     */
    public function get_team_members_by_ceo($ceo_id)
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('added_by', $ceo_id);
        $this->db->where('role', TEAM_MEMBER_ROLE);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * add_project function.
     * 
     * @access public
     * @param mixed $data
     * @return bool true on success, false on failure
     */
    public function add_project($data)
    {

        $this->db->insert('project', $data);
        return $this->db->affected_rows();
    }

    /**
     * add_project_team function.
     * 
     * @access public
     * @param mixed $data
     * @return bool true on success, false on failure
     */
    public function add_project_team($data)
    {

        $this->db->insert('project_team', $data);
        return $this->db->affected_rows();
    }

    /**
     * get_project_by_ceo function.
     * 
     * @access public
     * @param mixed $ceo_id
     * @return bool true on success, false on failure
     */
    public function get_project_by_ceo($ceo_id)
    {

        $this->db->select('project.*, GROUP_CONCAT(DISTINCT user.first_name) as team_leaders, GROUP_CONCAT(user1.first_name) as team_members, project_status.status_name');
        $this->db->from('project');
        $this->db->join('project_team', 'project_team.project_id = project.id');
        $this->db->join('project_status', 'project_status.id = project.status');
        $this->db->join('user', 'user.id = project_team.team_leader');
        $this->db->join('user as user1', 'user1.id = project_team.team_member');
        // where Condition
        if ($this->session->userdata('role') ==  CEO_ROLE) {
            $this->db->where('project.added_by', $ceo_id);
        }
        $this->db->where('project.is_delete', 0);
        $this->db->group_by('project.id'); // Group by project ID to get one row per project
        $this->db->group_by('project_team.project_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * get_ceo_list function.
     *
     * @access public
     * @return bool true on success, false on failure
     */
    public function get_ceo_list()
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role', CEO_ROLE);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * get_project_status function.
     * 
     * @access public
     *
     * @return bool true on success, false on failure
     */
    public function get_project_status()
    {

        $this->db->select('*');
        $this->db->from('project_status');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_team_members()
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role', TEAM_MEMBER_ROLE);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_team_leaders()
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role', TEAM_LEADER_ROLE);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_project($project_id)
    {
        if ($project_id > 0) {
            $data = array('is_delete' => 1);
            $this->db->where('id', $project_id);
            $this->db->update('project', $data);
            return true;
        }
        return false;
    }
    
    /**
	 * check_project function.
	 * 
	 * @access public
	 * @param mixed $project
	 * @return bool true on success, false on failure
	 */
	public function check_project($project)
	{

		$this->db->select('*');
		$this->db->from('project');
		$this->db->where('project_name', $project);
        $this->db->where('is_delete', 0);
		$query = $this->db->get();
		return $query->row_array();
	}
}
