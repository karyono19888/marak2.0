<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_wilayah', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	// Wilayah
	public function getdatawil()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->getwil($searchTerm);
		echo json_encode($response);
	}

	// Provinsi
	public function getdataprov($wilayah_id)
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->getprov($wilayah_id, $searchTerm);
		echo json_encode($response);
	}

	// Kabupaten
	public function getdatakab($id_prov)
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->getkab($id_prov, $searchTerm);
		echo json_encode($response);
	}

	// Kecamatan
	public function getdatakec($id_kab)
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->getkec($id_kab, $searchTerm);
		echo json_encode($response);
	}
}
