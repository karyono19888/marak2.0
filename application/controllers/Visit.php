<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_visit', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Kunjungan | Marak';
		$data['visit'] = $this->record->dataVisitAll();
		$this->load->view('Visit/v_index', $data);
	}

	public function Tambah()
	{
		$data['title'] = 'Tambah Kunjungan | Marak';
		$this->load->view('Visit/v_tambah', $data);
	}
}
