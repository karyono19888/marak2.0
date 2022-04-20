<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_marketing', 'record');
	}

	public function index()
	{
		$data['title'] = 'Dashboard | Marak';
		$this->load->view('Marketing/v_index', $data);
	}
}
