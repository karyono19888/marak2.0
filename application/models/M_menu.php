<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_menu extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function dataMenu()
	{
		$this->db->order_by('id_menu', 'desc');
		$query = $this->db->get('user_menu');
		return $query;
	}

	public function TambahMenu($menu_name)
	{
		$this->db->select('menu_name');
		$this->db->where('menu_name', $menu_name);
		$query  = $this->db->get('user_menu');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Input data gagal, Nama Menu sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('user_menu', array(
				'menu_name'         => $menu_name,
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Input Menu gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Input Menu berhasil!'));
			}
		}
	}

	public function view($id)
	{
		$this->db->select('*');
		$this->db->where('id_menu', $id);
		$query  = $this->db->get('user_menu');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'         => true,
				'id_menu'         => $row->id_menu,
				'menu_name'       => $row->menu_name
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function UpdateMenu($id_menu, $menu_name)
	{
		$this->db->select('menu_name');
		$this->db->where('menu_name', $menu_name);
		$query  = $this->db->get('user_menu');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Update data gagal, Nama Menu sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->where('id_menu', $id_menu);
			$this->db->update('user_menu', array(
				'menu_name'         => $menu_name,
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Update Menu gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Update Menu berhasil!'));
			}
		}
	}

	public function deleteMenu($id)
	{
		$this->db->trans_start();
		$this->db->delete('user_menu', array('id_menu' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus data gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus data berhasil!'));
		}
	}

	public function dataMainMenu()
	{
		$this->db->where('menu_parentId', 'NOT NULL');
		$this->db->join('user_menu', 'id_menu=menu_id', 'left');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('user_sub_menu');
		return $query;
	}

	public function TambahMainMenu($user_menu, $menu_nama, $menu_url, $menu_icon, $is_active)
	{
		$this->db->select('menu_nama');
		$this->db->where('menu_nama', $menu_nama);
		$query  = $this->db->get('user_sub_menu');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Input data gagal, Nama Menu sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('user_sub_menu', array(
				'menu_id'     => $user_menu,
				'menu_nama'   => $menu_nama,
				'menu_url'    => $menu_url,
				'menu_icon'   => $menu_icon,
				'is_active'   => $is_active,
			));
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Input menu gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Input Menu Berhasil!'));
			}
		}
	}

	public function viewMenu($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->join('user_menu', 'id_menu=menu_id', 'left');
		$query  = $this->db->get('user_sub_menu');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'        => true,
				'id'         	  => $row->id,
				'menu_nama'      => $row->menu_nama,
				'menu_url'       => $row->menu_url,
				'menu_icon'      => $row->menu_icon,
				'is_active'      => $row->is_active,
				'id_menu'		  => $row->id_menu,
				'menu_name'		  => $row->menu_name,
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function selectUserMenu($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where("menu_name like '%" . $searchTerm . "%' ");
		$this->db->order_by('id_menu', 'asc');
		$fetched_records = $this->db->get('user_menu');
		$dataMenu = $fetched_records->result_array();
		$data = array();
		foreach ($dataMenu as $m) {
			$data[] = array(
				"id"   => $m['id_menu'],
				"text" => $m['menu_name']
			);
		}
		return $data;
	}

	public function UpdateMainMenu($user_menu, $menu_nama, $menu_url, $menu_icon, $is_active, $id)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('user_sub_menu', array(
			'menu_id'     => $user_menu,
			'menu_nama'   => $menu_nama,
			'menu_url'    => $menu_url,
			'menu_icon'   => $menu_icon,
			'is_active'   => $is_active,
		));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Input menu gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Input Menu Berhasil!'));
		}
	}

	public function DeleteMainMenu($id)
	{
		$this->db->trans_start();
		$this->db->delete('user_sub_menu', array('id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus data gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus data berhasil!'));
		}
	}

	public function dataSubMenu()
	{
		$this->db->where('menu_parentId', 'Not Null');
		$this->db->order_by('id', 'asc');
		$query = $this->db->get('user_sub_menu');
		return $query;
	}

	// data submenu

	public function selectMainMenu($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('menu_parentId', 'NOT NULL');
		$this->db->where("menu_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('id', 'asc');
		$fetched_records = $this->db->get('user_sub_menu');
		$dataMenu = $fetched_records->result_array();
		$data = array();
		foreach ($dataMenu as $m) {
			$data[] = array(
				"id"   => $m['id'],
				"text" => $m['menu_nama']
			);
		}
		return $data;
	}

	public function TambahSubMenu($main_menu, $menu_nama, $menu_url, $menu_sub_icon, $is_active)
	{
		$this->db->select('menu_nama');
		$this->db->where('menu_nama', $menu_nama);
		$query  = $this->db->get('user_sub_menu');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Input data gagal, Nama Menu sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('user_sub_menu', array(
				'menu_parentId' 	=> $main_menu,
				'menu_nama'   		=> $menu_nama,
				'menu_url'    		=> $menu_url,
				'menu_sub_icon' 	=> $menu_sub_icon,
				'is_active'   		=> $is_active,
			));
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Input menu gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Input Menu Berhasil!'));
			}
		}
	}

	public function ViewEditSubMenu($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$query  = $this->db->get('user_sub_menu');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'        => true,
				'id'         	  => $row->id,
				'menu_nama'      => $row->menu_nama,
				'menu_url'       => $row->menu_url,
				'menu_sub_icon'  => $row->menu_sub_icon,
				'menu_sub_icon'  => $row->menu_icon,
				'is_active'      => $row->is_active,
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function UpdateSubMenu($menu_nama, $menu_url, $menu_sub_icon, $is_active, $id)
	{
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('user_sub_menu', array(
			'menu_nama'   	 => $menu_nama,
			'menu_url'    	 => $menu_url,
			'menu_sub_icon' => $menu_sub_icon,
			'is_active'   	 => $is_active,
		));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Input Submenu gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Input SubMenu Berhasil!'));
		}
	}
	public function DeleteSubMenu($id)
	{
		$this->db->trans_start();
		$this->db->delete('user_sub_menu', array('id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus data gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus data berhasil!'));
		}
	}
}
