<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubMenu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_administrator', 'record');
	}

	public function index()
	{
		$data['title'] = 'SubMenu';
		$this->load->view('Admin/v_submenu', $data);
	}
}
