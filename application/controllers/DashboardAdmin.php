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
		$data['number'] = $this->record->number_weekly();
		$data['weekly'] = $this->record->weekly();
		$data['log'] 		= $this->record->LogActivity();
		$data['totalNewPo'] 					 = $this->record->TotalNewPo();
		$data['NewPoUser'] 					 = $this->record->NewPoUser();
		$data['totalClosebyAmmount'] 		 = $this->record->TotalClosebyAmmount();
		$data['totalClosebyecataloge'] 	 = $this->record->TotalClosebyecataloge();
		$data['totalClosebyNonecataloge'] = $this->record->TotalClosebyNonecataloge();
		$this->load->view('Dashboard/v_dashboardAdminMarketing', $data);
	}
}