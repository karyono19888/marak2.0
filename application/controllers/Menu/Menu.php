<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
		$data['title'] 	 = 'Menu | Marak 2.0';
		$data['menu']  	 = $this->record->dataMenu();
		$data['mainmenu']  = $this->record->dataMainMenu();
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

		echo $this->record->view($id);
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

	public function TambahMainMenu()
	{
		$user_menu 	= $this->input->post('user_menu');
		$menu_nama 	= $this->input->post('menu_nama');
		$menu_url 	= $this->input->post('menu_url');
		$menu_icon 	= $this->input->post('menu_icon');
		$is_active 	= $this->input->post('is_active');

		echo $this->record->TambahMainMenu($user_menu, $menu_nama, $menu_url, $menu_icon, $is_active);
	}

	public function ViewMenu()
	{
		$id = $this->input->post('id');

		echo $this->record->viewMenu($id);
	}

	public function selectUserMenu()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->selectUserMenu($searchTerm);
		echo json_encode($response);
	}

	public function UpdateMainMenu()
	{
		$user_menu 	= $this->input->post('user_menu');
		$menu_nama 	= $this->input->post('menu_nama');
		$menu_url  	= $this->input->post('menu_url');
		$menu_icon 	= $this->input->post('menu_icon');
		$is_active 	= $this->input->post('is_active');
		$id 			= $this->input->post('id');

		echo $this->record->UpdateMainMenu($user_menu, $menu_nama, $menu_url, $menu_icon, $is_active, $id);
	}

	public function DeleteMainMenu()
	{
		$id = $this->input->post('id');

		echo $this->record->DeleteMainMenu($id);
	}
}
