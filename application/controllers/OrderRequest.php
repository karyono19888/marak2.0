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
		$data['total'] = $this->record->totalRequest();
		$data['new']   = $this->record->totalNewRequest();
		$data['close'] = $this->record->totalRequestClose();
		$this->load->view('OrderRequest/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['data'] = $this->record->DataTable();
		$this->load->view('OrderRequest/v_table', $data);
	}

	public function ShowPilihTableData()
	{
		$data['visit'] 			= $this->record->dataVisitAll();
		$this->load->view('OrderRequest/v_pilih_table_req_order', $data);
	}

	public function getDataShowRequest()
	{
		$id 			  = $this->input->post('id');
		$data['data'] = $this->record->DataKunjunganrequest($id);
		$data['org']  = $this->record->DataOrganisasi();
		$data['kode'] = $this->record->DataKodeRequest();
		$this->load->view('OrderRequest/v_tambah_req_order', $data);
	}

	public function TambahOrderRequest()
	{
		$t_req_kode 			= $this->input->post('t_req_kode');
		$t_req_visit 			= $this->input->post('t_req_visit');
		$t_req_history_visit = $this->input->post('t_req_history_visit');
		$t_req_perusahaan 	= $this->input->post('t_req_perusahaan');
		$t_req_kategori 		= $this->input->post('t_req_kategori');
		$t_req_konsumen 		= $this->input->post('t_req_konsumen');
		$t_req_phone 			= $this->input->post('t_req_phone');
		$t_req_alamat 			= $this->input->post('t_req_alamat');

		echo $this->record->TambahOrderRequest($t_req_kode, $t_req_visit, $t_req_history_visit, $t_req_perusahaan, $t_req_kategori, $t_req_konsumen, $t_req_phone, $t_req_alamat);
	}

	public function ShowDataEdit()
	{
		$id 			  = $this->input->post('id');
		$data['data'] = $this->record->getDataTableRequest($id);
		$data['org']  = $this->record->DataOrganisasi();
		$this->load->view('OrderRequest/v_edit_req_order', $data);
	}

	public function EditOrderRequest()
	{
		$t_req_kode 			= $this->input->post('t_req_kode');
		$t_req_tgl 				= $this->input->post('t_req_tgl');
		$t_req_user 			= $this->input->post('t_req_user');
		$t_req_visit 			= $this->input->post('t_req_visit');
		$t_req_history_visit = $this->input->post('t_req_history_visit');
		$t_req_perusahaan 	= $this->input->post('t_req_perusahaan');
		$t_req_kategori 		= $this->input->post('t_req_kategori');
		$t_req_konsumen 		= $this->input->post('t_req_konsumen');
		$t_req_phone 			= $this->input->post('t_req_phone');
		$t_req_alamat 			= $this->input->post('t_req_alamat');

		echo $this->record->EditOrderRequest($t_req_kode, $t_req_tgl, $t_req_user, $t_req_visit, $t_req_history_visit, $t_req_perusahaan, $t_req_kategori, $t_req_konsumen, $t_req_phone, $t_req_alamat);
	}

	public function DeleteRequest()
	{
		$id = $this->input->post('id');

		echo $this->record->DeleteRequest($id);
	}
}
