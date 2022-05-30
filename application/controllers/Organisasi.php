<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organisasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_organisasi', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 		= 'Organisasi | Marak';
		$data['organisasi'] 	= $this->record->index();
		$data['total'] 		= $this->record->totalOrganisasi();
		$this->load->view('Organisasi/v_index', $data);
	}

	public function Tambah()
	{
		$data['title'] = 'Tambah | Marak';
		$this->load->view('Organisasi/v_tambah_organisasi', $data);
	}

	public function TambahOrganisasi()
	{
		$org_nama 	= $this->input->post('org_nama');
		$org_email 	= $this->input->post('org_email');
		$org_phone 	= $this->input->post('org_phone');
		$org_alamat = $this->input->post('org_alamat');
		$wilayah 	= $this->input->post('wilayah');
		$provinsi 	= $this->input->post('provinsi');
		$kabupaten 	= $this->input->post('kabupaten');
		$kecamatan 	= $this->input->post('kecamatan');

		echo $this->record->TambahOrganisasi($org_nama, $org_email, $org_phone, $org_alamat, $wilayah, $provinsi, $kabupaten, $kecamatan);
	}

	public function Edit($id)
	{
		$data['title'] = 'Edit | Marak';
		$data['edit']  = $this->record->dataEdit($id);
		$this->load->view('Organisasi/v_edit_organisasi', $data);
	}

	public function UpdateOrganisasi()
	{
		$org_id 		= $this->input->post('org_id');
		$org_nama 	= $this->input->post('org_nama');
		$org_email 	= $this->input->post('org_email');
		$org_phone 	= $this->input->post('org_phone');
		$org_alamat = $this->input->post('org_alamat');
		$wilayah 	= $this->input->post('wilayah');
		$provinsi 	= $this->input->post('provinsi');
		$kabupaten 	= $this->input->post('kabupaten');
		$kecamatan 	= $this->input->post('kecamatan');

		echo $this->record->UpdateOrganisasi($org_id, $org_nama, $org_email, $org_phone, $org_alamat, $wilayah, $provinsi, $kabupaten, $kecamatan);
	}

	public function Delete()
	{
		$id = $this->input->post('id');
		echo $this->record->Delete($id);
	}
}
