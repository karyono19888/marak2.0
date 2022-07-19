<?php
defined('BASEPATH') or exit('No direct script access allowed');


class OrderRequest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_laporanMarketing', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Order Request | Marak 2.0';
		$this->load->view('OrderRequest/v_index', $data);
	}
}
