<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_marketing', 'record');
		if (!$this->session->userdata['is_login'] == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Expired</strong> Session your login expired.</span>
					</div></div>');
			redirect('Auth');
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard | Marak';
		$this->load->view('Marketing/v_index', $data);
	}
}
