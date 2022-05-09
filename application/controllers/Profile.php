<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_profile', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['profile'] 	= $this->record->myprofile();
		$data['title'] 	= 'Profile';
		$this->load->view('Profile/v_profile', $data);
	}

	public function Feed()
	{
		$this->load->view('Profile/v_feed');
	}
}
