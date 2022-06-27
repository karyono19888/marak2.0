<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_instansi', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 					= 'Instansi | Marak 2.0';
		$data['datainstansi'] 			= $this->record->index();
		$data['totalsemuapelanggan'] 	= $this->record->TotalSemuaPelanggan();
		$data['totalpemerintahan']		= $this->record->TotalPemerintahan();
		$data['totalswasta'] 			= $this->record->TotalSwasta();
		$data['totalperorangan'] 		= $this->record->TotalPerorangan();
		$this->load->view('Instansi/v_index', $data);
	}

	public function Tambah()
	{
		$data['title'] = 'Tambah Instansi | Marak';
		$this->load->view('Instansi/v_tambah_instansi', $data);
	}

	public function TambahInstansi()
	{
		$instansi_kategori 	= $this->input->post('instansi_kategori');
		$instansi_nama 		= $this->input->post('instansi_nama');
		$instansi_alamat 		= $this->input->post('instansi_alamat');
		$wilayah 				= $this->input->post('wilayah');
		$provinsi 				= $this->input->post('provinsi');
		$kabupaten 				= $this->input->post('kabupaten');

		echo $this->record->TambahInstansi($instansi_kategori, $instansi_nama, $instansi_alamat, $wilayah, $provinsi, $kabupaten);
	}

	public function Edit($id)
	{
		$data['title'] = 'Edit Instansi | Marak';
		$data['editinstansi'] = $this->record->editInstansi($id);
		$this->load->view('Instansi/v_edit_instansi', $data);
	}

	public function UpdateInstansi()
	{
		$instansi_id 			= $this->input->post('instansi_id');
		$instansi_kategori 	= $this->input->post('instansi_kategori');
		$instansi_nama 		= $this->input->post('instansi_nama');
		$instansi_alamat 		= $this->input->post('instansi_alamat');
		$wilayah 				= $this->input->post('wilayah');
		$provinsi 				= $this->input->post('provinsi');
		$kabupaten 				= $this->input->post('kabupaten');

		echo $this->record->UpdateInstansi($instansi_id, $instansi_kategori, $instansi_nama, $instansi_alamat, $wilayah, $provinsi, $kabupaten);
	}

	public function Delete()
	{
		$id = $this->input->post('id');
		echo $this->record->Delete($id);
	}


}
