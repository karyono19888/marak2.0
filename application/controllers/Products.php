<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_product', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 			= 'Product | Marak 2.0';
		$data['total'] 			= $this->record->totalProduct();
		$data['totalEcataloge'] = $this->record->totalProductEcataloge();
		$data['totalNon'] 		= $this->record->totalProductNon();
		$this->load->view('Product/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['data'] =  $this->record->DataTable();
		$this->load->view('Product/v_table', $data);
	}

	public function ShowTambahData()
	{
		$this->load->view('Product/v_showtambah');
	}

	public function GetUom()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->GetUom($searchTerm);
		echo json_encode($response);
	}

	public function GetTipe()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->GetTipe($searchTerm);
		echo json_encode($response);
	}

	public function TambahProduk()
	{
		$m_prod_category 	= $this->input->post('m_prod_category');
		$m_prod_kode 		= $this->input->post('m_prod_kode');
		$m_prod_nama 		= $this->input->post('m_prod_nama');
		$m_prod_type 		= $this->input->post('m_prod_type');
		$m_prod_uom 		= $this->input->post('m_prod_uom');
		$m_prod_status 	= $this->input->post('m_prod_status');
		$m_prod_ket 		= $this->input->post('m_prod_ket');

		echo $this->record->TambahProduk($m_prod_category, $m_prod_kode, $m_prod_nama, $m_prod_type, $m_prod_uom, $m_prod_status, $m_prod_ket);
	}

	public function ShowDataEdit()
	{
		$id = $this->input->post('id');
		$data['data'] 	= $this->record->ShowDataEdit($id);
		$this->load->view('Product/v_showedit', $data);
	}

	public function EditProduk()
	{
		$m_prod_id 			= $this->input->post('m_prod_id');
		$m_prod_category 	= $this->input->post('m_prod_category');
		$m_prod_kode 		= $this->input->post('m_prod_kode');
		$m_prod_nama 		= $this->input->post('m_prod_nama');
		$m_prod_type 		= $this->input->post('m_prod_type');
		$m_prod_uom 		= $this->input->post('m_prod_uom');
		$m_prod_status 	= $this->input->post('m_prod_status');
		$m_prod_ket 		= $this->input->post('m_prod_ket');

		echo $this->record->EditProduk($m_prod_id, $m_prod_category, $m_prod_kode, $m_prod_nama, $m_prod_type, $m_prod_uom, $m_prod_status, $m_prod_ket);
	}

	public function ProductDelete()
	{
		$id = $this->input->post('id');

		echo $this->record->ProductDelete($id);
	}


}
