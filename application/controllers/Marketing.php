<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_marketing', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 					= 'Dashboard Marketing | Marak 2.0';
		$data['totalApbn']  	   		= $this->record->TotalApbn();
		$data['totalProspek']  			= $this->record->TotalProspek();
		$data['totalPrognosa']  		= $this->record->TotalPrognosa();
		$data['totalClose']  			= $this->record->TotalClose();
		$data['totalTargetMarketing'] = $this->record->TotalTargetMarketing();
		$data['totalKunjungan'] 		= $this->record->TotalKunjungan();
		$data['number'] 		 		   = $this->record->number_weekly();
		$data['weekly']			 	   = $this->record->weekly();
		// $data['byMkt'] 		 	 		= $this->record->TargetGroupbyMkt();
		$data['map']			 			= $this->record->DataVisitMap();
		$this->load->view('Marketing/v_index', $data);
	}
}