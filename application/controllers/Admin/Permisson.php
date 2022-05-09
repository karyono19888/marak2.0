<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permisson extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_administrator', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Permisson';
		$this->load->view('Admin/v_permisson', $data);
	}
}
