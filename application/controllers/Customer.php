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

            echo json_encode(array('status' => 200, 'message' => 'Successfully saved'));
        }
    }

    public function index()
    {
        $customers = $this->customer_model->customer_list();
        $data = array();

        foreach ($customers as $customer) {

            $action = '<button id="' . $customer->id . '" class="btn btn-success btn-circle btn-sm edit-customer">
                        <i class="fas fa-user-edit"></i>
                    </button>';

            $action .= '&nbsp;<button id="' . $customer->id . '" class="btn btn-primary btn-circle btn-sm customer-transaction">
                        <i class="fas fa-coins"></i>
                    </button>';

            $sub_array = array();
            $sub_array[] = $customer->firstname;
            $sub_array[] = $customer->middlename;
            $sub_array[] = $customer->lastname;
            $sub_array[] = $customer->suffix;
            $sub_array[] = ($customer->status == 1) ? '<span class="badge badge-success">active</span>' : '<span class="badge badge-danger">inactive</span>';
            $sub_array[] = '<button id="' . $customer->id . '" class="view-account btn btn-info btn-sm btn-block">View Account</button>';
            $sub_array[] = $action;
            $data[] = $sub_array;
        }

        echo json_encode(array("data" => $data));
    }

    public function show($id)
    {
        $data['request'] = $this->input->post('view', TRUE);

        $data['customer'] = $this->customer_model->customer_details($id);
        $data['customer_banks'] = $this->customer_model->customer_banks($id);
        $data['banks'] = $this->customer_model->banks();

        $this->load->view('body/modal_response', $data);
    }

    public function update_customer()
    {
        $data = $this->input->post(NULL, TRUE);

        $this->db->trans_start();
        $this->customer_model->update_customer($data);
        $this->customer_model->update_customer_bank($data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {

            echo json_encode(array('status' => 404, 'message' => 'Opps! Something went wrong'));
        } else {

            echo json_encode(array('status' => 200, 'message' => 'Successfully updated'));
        }
    }
}
