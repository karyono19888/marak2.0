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

	public function viewMenu($id)
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
}
