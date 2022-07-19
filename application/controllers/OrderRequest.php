<?php
defined('BASEPATH') or exit('No direct script access allowed');


class OrderRequest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_orderRequest', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Order Request | Marak 2.0';
		$this->load->view('OrderRequest/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['title'] = 'Order Request | Marak 2.0';
		$this->load->view('OrderRequest/v_table', $data);
	}

	public function ShowPilihTableData()
	{
		$data['visit'] 			= $this->record->dataVisitAll();
		$this->load->view('OrderRequest/v_pilih_table_req_order', $data);
	}

	public function getDataShowRequest()
	{
		$id = $this->input->post('id');
		$data['data'] = $this->record->DataKunjunganrequest($id);
		$data['org']  = $this->record->DataOrganisasi();
		$this->load->view('OrderRequest/v_tambah_req_order', $data);
	}
}
