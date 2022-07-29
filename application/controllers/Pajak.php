<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pajak extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pajak', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 		= 'Master Pajak | Marak 2.0';
		$data['totalItem'] 	= $this->record->totalItem();
		$data['aktif'] 		= $this->record->totalAktif();
		$data['tidakaktif'] 	= $this->record->totalTidakAktif();
		$this->load->view('Pajak/v_index', $data);
	}

	public function ShowTableData()
	{
		$data['data'] 	= $this->record->DataTable();
		$this->load->view('Pajak/v_table', $data);
	}

	public function ShowTambahData()
	{
		$this->load->view('Pajak/v_showtambah');
	}

	public function TambahPajak()
	{
		$m_pajak_nama 		= $this->input->post('m_pajak_nama');
		$m_pajak_nilai 	= $this->input->post('m_pajak_nilai');
		$m_pajak_persen 	= $this->input->post('m_pajak_persen');
		$m_pajak_ket 		= $this->input->post('m_pajak_ket');
		$m_pajak_status 	= $this->input->post('m_pajak_status');

		echo $this->record->TambahPajak($m_pajak_nama, $m_pajak_nilai, $m_pajak_persen, $m_pajak_ket, $m_pajak_status);
	}

	public function EditPajak()
	{
		$m_pajak_id 		= $this->input->post('m_pajak_id');
		$m_pajak_nama 		= $this->input->post('m_pajak_nama');
		$m_pajak_nilai 	= $this->input->post('m_pajak_nilai');
		$m_pajak_persen 	= $this->input->post('m_pajak_persen');
		$m_pajak_ket 		= $this->input->post('m_pajak_ket');
		$m_pajak_status 	= $this->input->post('m_pajak_status');

		echo $this->record->EditPajak($m_pajak_id, $m_pajak_nama, $m_pajak_nilai, $m_pajak_persen, $m_pajak_ket, $m_pajak_status);
	}

	public function ShowDataEdit()
	{
		$id = $this->input->post('id');
		$data['data'] 	= $this->record->ShowDataEdit($id);
		$this->load->view('Pajak/v_showedit', $data);
	}

	public function PajakDelete()
	{
		$id = $this->input->post('id');

		echo $this->record->PajakDelete($id);
	}
}
