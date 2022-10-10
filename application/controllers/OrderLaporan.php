<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderLaporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_orderLaporan', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Laporan | Marak 2.0';
		$this->load->view('OrderLaporan/v_index', $data);
	}
}
