<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterTipe extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_masterTipe', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 		= 'Master Tipe | Marak 2.0';
		$data['totalItem'] 	= $this->record->totalItem();
		$data['aktif'] 		= $this->record->totalAktif();
		$data['tidakaktif'] 	= $this->record->totalTidakAktif();
		$this->load->view('MasterTipe/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['data'] 	= $this->record->DataTable();
		$this->load->view('MasterTipe/v_table', $data);
	}

	public function ShowTambahData()
	{
		$this->load->view('MasterTipe/v_showtambah');
	}

	public function TambahTipe()
	{
		$m_tipe_kode 		= $this->input->post('m_tipe_kode');
		$m_tipe_nama 		= $this->input->post('m_tipe_nama');
		$m_tipe_status 	= $this->input->post('m_tipe_status');
		$m_tipe_deskripsi = $this->input->post('m_tipe_deskripsi');

		echo $this->record->TambahTipe($m_tipe_kode, $m_tipe_nama, $m_tipe_status, $m_tipe_deskripsi);
	}

	public function ShowDataEdit()
	{
		$id = $this->input->post('id');
		$data['data'] 	= $this->record->ShowDataEdit($id);
		$this->load->view('MasterTipe/v_showedit', $data);
	}

	public function EditTipe()
	{
		$m_tipe_id 			= $this->input->post('m_tipe_id');
		$m_tipe_kode 		= $this->input->post('m_tipe_kode');
		$m_tipe_nama 		= $this->input->post('m_tipe_nama');
		$m_tipe_status 	= $this->input->post('m_tipe_status');
		$m_tipe_deskripsi = $this->input->post('m_tipe_deskripsi');

		echo $this->record->EditTipe($m_tipe_id, $m_tipe_kode, $m_tipe_nama, $m_tipe_status, $m_tipe_deskripsi);
	}

	public function DeleteTipe()
	{
		$id = $this->input->post('id');

		echo $this->record->DeleteTipe($id);
	}
}
