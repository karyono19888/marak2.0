<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_dashboardAdmin', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Dashboard Order | Marak 2.0';
		$this->load->view('Dashboard/v_dashboardAdminMarketing', $data);
	}
}
