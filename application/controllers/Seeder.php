<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seeder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->dbforge();
    }

    public function seed() {
        $this->seed_user_roles();
        $this->seed_user();
        // Call other seed methods here
    }

    private function seed_user_roles() {
        $data = array(
            array('role_name' => 'admin'),
            array('role_name' => 'ceo'),
            array('role_name' => 'team_leader'),
            array('role_name' => 'team_member'),
        );

        foreach ($data as $role) {
            $role_name = $role['role_name'];

            $existing_role = $this->db->get_where('user_role', array('role_name' => $role_name))->row();

            if (!$existing_role) {
                $this->db->insert('user_role', $role);
                echo "User role '{$role_name}' seeded successfully.\n";
            } else {
                echo "User role '{$role_name}' already exists.\n";
            }
        }
    }

    private function seed_user() {
        $data = array(
            array(
                'username' => 'admin',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@gmail.com',              
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => 1,
                'date_created' => date('Y-m-d H:i:s')
            )
        );

        foreach ($data as $user) {
            $email = $user['email'];

            $existing_user = $this->db->get_where('user', array('email' => $email))->row();

            if (!$existing_user) {
                $this->db->insert('user', $user);
                echo "User '{$email}' seeded successfully.\n";
            } else {
                echo "User '{$email}' already exists.\n";
            }
        }
    }


}
