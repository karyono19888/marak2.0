<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_faq', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'FAQ | Marak';
		$this->load->view('Faq/v_index', $data);
	}
}
