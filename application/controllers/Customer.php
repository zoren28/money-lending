<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (isset($_SESSION['user_id'])) {

            $this->load->model('customer_model');
        }
    }

    public function add_user()
    {
        $data['request'] = 'customer-form';
        $data['banks'] = $this->customer_model->banks();

        $this->load->view('body/modal_response', $data);
    }

    public function store()
    {
        $data = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $user_id = $this->customer_model->create_customer($data);
        $this->customer_model->create_customer_bank($data, $user_id);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {

            echo json_encode(array('status' => 404, 'message' => 'Opps! Something went wrong'));
        } else {

            echo json_encode(array('status' => 200, 'message' => 'Successfully login'));
        }
    }

    public function index()
    {
        $customers = $this->customer_model->customer_list();
        $data = array();

        foreach ($customers as $customer) {

            $action = '<button id="' . $customer->id . '" class="btn btn-info btn-circle btn-sm view">
                        <i class="fas fa-info-circle"></i>
                    </button>';

            $action .= '&nbsp;<button id="' . $customer->id . '" class="btn btn-warning btn-circle btn-sm edit">
                        <i class="fab fa-facebook-f"></i>
                    </button>';

            $sub_array = array();
            $sub_array[] = $customer->firstname;
            $sub_array[] = $customer->middlename;
            $sub_array[] = $customer->lastname;
            $sub_array[] = $customer->suffix;
            $sub_array[] = ($customer->status == 1) ? '<span class="badge badge-success">active</span>' : '<span class="badge badge-danger">inactive</span>';
            $sub_array[] = $action;
            $data[] = $sub_array;
        }

        echo json_encode(array("data" => $data));
    }

    public function show($id)
    {
        $data['action'] = $this->input->post('action', TRUE);
        $data['request'] = 'show-customer-form';
        $data['customer'] = $this->customer_model->customer_details($id);
        $data['customer_banks'] = $this->customer_model->customer_banks($id);
        $data['banks'] = $this->customer_model->banks();
        print_r($data);
        $this->load->view('body/modal_response', $data);
    }
}
