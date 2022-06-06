<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_roles', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 	  = 'Roles | Marak 2.0';
		$data['role']  	  = $this->record->index();
		$data['tablerole']  = $this->record->tableRoles();
		$this->load->view('Admin/v_roles', $data);
	}

	public function Tambah()
	{
		$role_name 		= $this->input->post('role_name');

		echo $this->record->Tambah($role_name);
	}

	public function View()
	{
		$id = $this->input->post('id');
		echo $this->record->View($id);
	}

	public function Delete()
	{
		$id = $this->input->post('id');
		echo $this->record->Delete($id);
	}

	public function Update()
	{
		$role_id   = $this->input->post('role_id');
		$role_name = $this->input->post('role_name');

		echo $this->record->Update($role_id, $role_name);
	}

	public function UserAccess($role_id)
	{
		$data['title'] 	  = 'Role | User Access';
		$data['userMenu']   = $this->record->userMenu();
		$data['useraccess'] = $this->record->UserAccess($role_id);
		$this->load->view('Admin/v_useraccess', $data);
	}

	public function ChangeAccess()
	{
		$menuId	= $this->input->post('menuId');
		$roleId	= $this->input->post('roleId');

		echo $this->record->ChangeAccess($menuId, $roleId);
	}

}
