<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TargetMarketing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_target_marketing', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title']    	= 'Target Marketing | Marak 2.0';
		$data['total']    	= $this->record->TotalUsers();
		$data['target']   	= $this->record->TotalTarget();
		$data['wilayah']  	= $this->record->TotalWilayah();
		$data['targetNol']  	= $this->record->UserTargetNol();
		$this->load->view('Target/v_targetmarketing', $data);
	}

	public function TableData()
	{
		$data['data'] 			= $this->record->getTableData();
		$this->load->view('Target/v_table_target_marketing', $data);
	}

	public function showTambahData()
	{
		$data['title'] 			= 'Target Marketing | Marak 2.0';
		$this->load->view('Target/v_create_target_marketing', $data);
	}

	public function showUserMarketing()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->showUserMarketing($searchTerm);
		echo json_encode($response);
	}

	public function getProvinsi()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->getProvinsi($searchTerm);
		echo json_encode($response);
	}

	public function SimpanTargetMarketing()
	{
		$marketing 	= $this->input->post('marketing');
		$target 		= $this->input->post('target');
		$tahun 		= $this->input->post('tahun');
		$provinsi 	= $this->input->post('provinsi');

		echo $this->record->SimpanTargetMarketing($marketing, $target, $tahun, $provinsi);
	}

	public function ViewEditTarget()
	{
		$id = $this->input->post('id');
		$data['data'] = $this->record->ViewEditTarget($id);
		$this->load->view('Target/v_edit_target_marketing', $data);
	}

	public function EditTargetMarketing()
	{
		$marketing 	= $this->input->post('marketing');
		$target 		= $this->input->post('target');
		$tahun 		= $this->input->post('tahun');
		$provinsi 	= $this->input->post('provinsi');

		echo $this->record->EditTargetMarketing($marketing, $target, $tahun, $provinsi);
	}

	public function Delete()
	{
		$id = $this->input->post('id');
		echo $this->record->Delete($id);
	}
}
