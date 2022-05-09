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
		$data['title'] = 'Dashboard | Marak';
		$this->load->view('Visit/v_index', $data);
	}
}
