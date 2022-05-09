<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_administrator', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Role';
		$this->load->view('Admin/v_roles', $data);
	}
}
