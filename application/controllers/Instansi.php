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
		$data['title'] = 'Dashboard | Marak';
		$this->load->view('Instansi/v_index', $data);
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

	public function get_autocompleteInstansi()
	{
		$insntansi_nama = $this->input->get_post('instansi_nama');
		if ($insntansi_nama) {
			$result = $this->record->search_nama_instansi($insntansi_nama);
			if (count($result) > 0) {
				foreach ($result as $row)
					$arr_result[] = array(
						'instansi_nama' => $row->instansi_nama,
					);
				echo json_encode($arr_result);
			}
		}
	}
}
