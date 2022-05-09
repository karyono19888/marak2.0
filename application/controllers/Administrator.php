<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_administrator', 'record');
		is_login();
	}

	public function index()
	{
		$data['title'] = 'Administration';
		$this->load->view('Admin/v_index', $data);
	}

}
