<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderMasuk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_order', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Dashboard | Marak';
		$this->load->view('Order/v_ordermasuk', $data);
	}
}
