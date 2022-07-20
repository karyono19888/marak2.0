<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterUom extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_masterUom', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 	= 'Master Uom | Marak 2.0';
		$this->load->view('MasterUom/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['data'] 	= $this->record->DataTable();
		$this->load->view('MasterUom/v_table', $data);
	}

	public function ShowTambahData()
	{
		$this->load->view('MasterUom/v_showtambah');
	}

	public function TambahUom()
	{
		$m_uom_nama 		= $this->input->post('m_uom_nama');
		$m_uom_kode 		= $this->input->post('m_uom_kode');
		$m_uom_symbol 		= $this->input->post('m_uom_symbol');
		$m_uom_deskripsi 	= $this->input->post('m_uom_deskripsi');
		$m_uom_status 		= $this->input->post('m_uom_status');

		echo $this->record->TambahUom($m_uom_nama, $m_uom_kode, $m_uom_symbol, $m_uom_deskripsi, $m_uom_status);
	}

	public function ShowDataEdit()
	{
		$id = $this->input->post('id');
		$data['data'] 	= $this->record->ShowDataEdit($id);
		$this->load->view('MasterUom/v_showedit', $data);
	}

	public function EditUom()
	{
		$m_uom_id 			= $this->input->post('m_uom_id');
		$m_uom_nama 		= $this->input->post('m_uom_nama');
		$m_uom_kode 		= $this->input->post('m_uom_kode');
		$m_uom_symbol 		= $this->input->post('m_uom_symbol');
		$m_uom_deskripsi 	= $this->input->post('m_uom_deskripsi');
		$m_uom_status 		= $this->input->post('m_uom_status');

		echo $this->record->EditUom($m_uom_id, $m_uom_nama, $m_uom_kode, $m_uom_symbol, $m_uom_deskripsi, $m_uom_status);
	}

	public function UomDelete()
	{
		$id = $this->input->post('id');

		echo $this->record->UomDelete($id);
	}
}
