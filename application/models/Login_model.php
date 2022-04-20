<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function check_user($data)
    {

        $query = $this->db->get_where('users', array('email' => $data['user-email'], 'role' => 'admin', 'status' => true));
        if ($query->num_rows() > 0) {

            return $query->row_array();
        }
    }
}
