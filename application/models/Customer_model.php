<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public $date = '';

    function __construct()
    {
        parent::__construct();
        $this->date = date('Y-m-d H:i:s');
    }

    public function banks()
    {
        $query = $this->db->select('id, bank')
            ->get('banks');
        return $query->result();
    }

    public function create_customer($data)
    {
        $insert = array(
            'firstname' => ucwords(strtolower($data['firstname'])),
            'lastname' => ucwords(strtolower($data['lastname'])),
            'middlename' => ucwords(strtolower($data['middlename'])),
            'suffix' => $data['suffix'],
            'email' => $data['email'],
            'email_verified_at' => $this->date,
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'role' => 'customer',
            'created_at' => $this->date,
            'updated_at' => $this->date,
        );

        $this->db->insert('users', $insert);
        return $this->db->insert_id();
    }

    public function create_customer_bank($data, $user_id)
    {
        for ($i = 0; $i < count($data['chk_bank']); $i++) {

            $insert = array(
                'user_id' => $user_id,
                'bank_id' => $data['chk_bank'][$i],
                'account_no' => $data['account_no'][$i],
                'created_at' => $this->date,
                'updated_at' => $this->date
            );

            $this->db->insert('customer_banks', $insert);
        }
    }

    public function customer_list()
    {
        $query = $this->db->get_where('users', array('role' => 'customer'));
        return $query->result();
    }

    public function customer_details($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row();
    }

    public function customer_banks($id)
    {
        $query = $this->db->get_where('customer_banks', array('user_id' => $id));
        return $query->result();
    }
}
