<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubMenu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_menu', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 	= 'SubMenu';
		$data['mainMenu'] = $this->record->dataSubMenu();
		$this->load->view('Admin/v_submenu', $data);
	}

	public function selectMainMenu()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->selectMainMenu($searchTerm);
		echo json_encode($response);
	}

	public function TambahSubMenu()
	{
		$main_menu 		= $this->input->post('main_menu');
		$menu_nama 		= $this->input->post('menu_nama');
		$menu_url 		= $this->input->post('menu_url');
		$menu_sub_icon = $this->input->post('menu_sub_icon');
		$is_active 		= $this->input->post('is_active');

		echo $this->record->TambahSubMenu($main_menu, $menu_nama, $menu_url, $menu_sub_icon, $is_active);
	}

	public function ViewEditSubMenu()
	{
		$id = $this->input->post('id');

		echo $this->record->ViewEditSubMenu($id);
	}

	public function UpdateSubMenu()
	{
		$id 				= $this->input->post('id');
		$menu_nama 		= $this->input->post('menu_nama');
		$menu_url  		= $this->input->post('menu_url');
		$menu_sub_icon = $this->input->post('menu_sub_icon');
		$is_active 		= $this->input->post('is_active');

		echo $this->record->UpdateSubMenu($menu_nama, $menu_url, $menu_sub_icon, $is_active, $id);
	}

	public function DeleteSubMenu()
	{
		$id = $this->input->post('id');

		echo $this->record->DeleteSubMenu($id);
	}

}
