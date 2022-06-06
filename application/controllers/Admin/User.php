<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_user', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 			= 'User | Marak 2.0';
		$data['user']  			= $this->record->dataUsers();
		$data['totaluser']  		= $this->record->totalUser();
		$data['activeuser'] 		= $this->record->activeUser();
		$data['nonActiveuser'] 	= $this->record->nonActiveUser();
		$data['suspenduser'] 	= $this->record->suspendUser();
		$data['selectUserRole']	= $this->record->selectUserRole();
		$this->load->view('Admin/v_user', $data);
	}

	public function Tambah()
	{
		$role_user 		= $this->input->post('role_user');
		$name_user 		= $this->input->post('name_user');
		$username 		= $this->input->post('username');
		$password_user = $this->input->post('password_user');
		$is_active 		= $this->input->post('is_active');

		echo $this->record->Tambah($role_user, $name_user, $username, $password_user, $is_active);
	}

	public function View()
	{
		$id	= $this->input->post('id');

		echo $this->record->View($id);
	}

	public function Update()
	{
		$id_user 		= $this->input->post('id_user');
		$role_user 		= $this->input->post('role_user');
		$name_user 		= $this->input->post('name_user');
		$username 		= $this->input->post('username');
		$password_user = $this->input->post('password_user');
		$is_active 		= $this->input->post('is_active');

		echo $this->record->Update($id_user, $role_user, $name_user, $username, $password_user, $is_active);
	}

	public function Delete()
	{
		$id	= $this->input->post('id');

		echo $this->record->Delete($id);
	}
}
