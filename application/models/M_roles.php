<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_roles extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function index()
	{
		$this->db->order_by('role_id', 'desc');
		$query  = $this->db->get('user_role');
		return $query;
	}

	public function tableRoles()
	{
		$this->db->join('user_role', 'role_id=role_user', 'left');
		$this->db->order_by('id_user');
		$query  = $this->db->get('users');
		return $query;
	}

	public function Tambah($role_name)
	{
		$this->db->select('role_name');
		$this->db->where('role_name', $role_name);
		$query  = $this->db->get('user_role');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Input data gagal, Role Name sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('user_role', array(
				'role_name'       => $role_name,
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Input User gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Input User berhasil!'));
			}
		}
	}

	public function View($id)
	{
		// $this->db->join('user_access_menu as a', 'a.role_id=role_id', 'left');
		$this->db->where('role_id', $id);
		$this->db->select('*');
		$query  = $this->db->get('user_role');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'         => true,
				'role_id'         => $row->role_id,
				'role_name'       => $row->role_name,
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$this->db->delete('user_role', array('role_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Roles Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Roles Berhasil!'));
		}
	}

	public function Update($role_id, $role_name)
	{
		$this->db->select('role_name');
		$this->db->where('role_name', $role_name);
		$query  = $this->db->get('user_role');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Update Role gagal, username sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->where('role_id', $role_id);
			$this->db->update('user_role', array(
				'role_name'       => $role_name,
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Update User gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Update User berhasil!'));
			}
		}
	}

	public function UserAccess($role_id)
	{
		$UserAccess = $this->db->get_where('user_role', ['role_id' => $role_id]);
		return $UserAccess->row_array();
	}

	public function userMenu()
	{
		$this->db->where('id_menu !=', 1);
		$query  = $this->db->get('user_menu');
		return $query;
	}

	public function ChangeAccess($menuId, $roleId)
	{
		$data = [
			'role_id' => $roleId,
			'menu_id' => $menuId,
		];
		$query  = $this->db->get_where('user_access_menu', $data);
		if ($query->num_rows() < 1) {
			$this->db->trans_start();
			$this->db->insert('user_access_menu', array(
				'role_id'       => $roleId,
				'menu_id'       => $menuId,
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Ubah Access gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Tambah Access berhasil!'));
			}
		} else {
			$this->db->trans_start();
			$this->db->delete('user_access_menu', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Ubah Access gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Hapus Access berhasil!'));
			}
		}
	}
}
