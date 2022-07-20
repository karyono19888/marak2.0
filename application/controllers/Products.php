<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_product', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Management Product | Marak 2.0';
		$this->load->view('Product/v_index', $data);
	}

	public function ShowTableData()
	{
		$this->load->view('Product/v_table');
	}

	public function ShowTambahData()
	{
		$this->load->view('Product/v_showtambah');
	}


}
