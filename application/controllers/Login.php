<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function authentication()
    {

        $fetch = $this->input->post(NULL, TRUE);

        // password_hash($fetch['password'],PASSWORD_DEFAULT);
        $check_login = $this->login_model->check_user($fetch);
        if ($check_login) {

            if (password_verify($fetch['user-password'], $check_login['password'])) {

                $data = array(
                    'user_id'    => $check_login['id'],
                    'firstname'  => $check_login['firstname'],
                    'lastname'  => $check_login['lastname'],
                    'isUserLoggedIn' => TRUE
                );

                $this->session->set_userdata($data);
                if (isset($_SESSION['user_id'])) {

                    echo json_encode(array('status' => 200, 'message' => 'Successfully Login'));
                } else {

                    echo json_encode(array('status' => 404, 'message' => 'Opps! Something went wrong'));
                }
            } else {

                echo json_encode(array('status' => 404, 'message' => 'Incorrect Password!'));
            }
        } else {

            echo json_encode(array('status' => 404, 'message' => 'Opps! Something went wrong'));
        }
    }
}
