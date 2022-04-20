<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_menu', 'record');
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
		$data['title'] = 'Menu';
		$data['menu']  = $this->record->dataMenu();
		$this->load->view('Admin/v_menu', $data);
	}

	public function Tambah()
	{
		$menu_name = $this->input->post('menu_name');

		echo $this->record->TambahMenu($menu_name);
	}

	public function View()
	{
		$id = $this->input->post('id');

		echo $this->record->viewMenu($id);
	}

	public function Update()
	{
		$id_menu 	= $this->input->post('id_menu');
		$menu_name 	= $this->input->post('menu_name');

		echo $this->record->UpdateMenu($id_menu, $menu_name);
	}

	public function Delete()
	{
		$id = $this->input->post('id');

		echo $this->record->deleteMenu($id);
	}
}
