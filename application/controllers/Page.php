<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if (isset($_SESSION['user_id'])) {
		}
	}

	public function menu($menu = 'dashboard', $submenu = 'dashboard')
	{
		if (!isset($_SESSION['user_id'])) {

			$this->load->view('template/login');
		} else {

			if (!file_exists(APPPATH . "views/body/$menu/$submenu.php")) {

				$data['menu']  = '404';
				$data['submenu']  = '';

				$this->load->view('template/header', $data);
				$this->load->view('template/menu');
				$this->load->view('body/show_404');
				$this->load->view('template/footer');
			} else {

				$data['menu']  = html_escape($menu);
				$data['submenu']  = html_escape($submenu);

				$this->load->view('template/header', $data);
				$this->load->view('template/menu');
				$this->load->view("body/$menu/$submenu");
				$this->load->view('template/footer');
			}
		}
	}
}
