<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function dataUsers()
	{
		$this->db->join('user_role', 'role_id=role_user', 'left');
		$this->db->order_by('id_user', 'desc');
		$query = $this->db->get('users');
		return $query;
	}

	public function totalUser()
	{
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function activeUser()
	{
		$this->db->where('is_active', 1);
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function nonActiveUser()
	{
		$this->db->where('is_active', 0);
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function suspendUser()
	{
		$this->db->where('is_active', 2);
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function selectUserRole()
	{
		$this->db->where('role_id !=', 1);
		$query = $this->db->get('user_role');
		return $query;
	}

	public function Tambah($role_user, $name_user, $username, $password_user, $is_active)
	{
		$this->db->select('username');
		$this->db->where('username', $username);
		$query  = $this->db->get('users');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Input data gagal, username sudah ada!'));
		} else {
			if (strlen($password_user) <= 6) {
				return json_encode(array('success' => false, 'msg' => 'Gagal!, Password terlalu pendek, min 6 karakter!'));
			} else {
				$this->db->trans_start();
				$this->db->insert('users', array(
					'name_user'       => $name_user,
					'username'        => htmlspecialchars($username),
					'nickname'			=> substr($name_user, 0, 5),
					'image_user' 		=> 'https://ui-avatars.com/api/?name=' . $name_user . '',
					'password_user' 	=> password_hash($password_user, PASSWORD_DEFAULT),
					'role_user'   		=> $role_user,
					'is_active' 		=> $is_active,
					'created_at' 		=> time()
				));

				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
					return json_encode(array('success' => false, 'msg' => 'Input User gagal!'));
				} else {
					return json_encode(array('success' => true, 'msg' => 'Input User berhasil!'));
				}
			}
		}
	}

	public function View($id)
	{
		$this->db->select('*');
		$this->db->join('user_role', 'role_id=role_user', 'left');
		$this->db->where('id_user', $id);
		$query  = $this->db->get('users');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'         => true,
				'id_user'         => $row->id_user,
				'name_user'       => $row->name_user,
				'username'       	=> $row->username,
				'is_active'       => $row->is_active,
				'role_id'       	=> $row->role_id,
				'role_name'       => $row->role_name,
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function Update($id_user, $role_user, $name_user, $username, $password_user, $is_active)
	{
		if ($role_user == 1) {
			return json_encode(array('success' => false, 'msg' => 'Gagal!, Administrator tidak bisa di edit!'));
		} else {
			if ($password_user == "") {
				$this->db->trans_start();
				$this->db->where('id_user', $id_user);
				$this->db->update('users', array(
					'name_user'       => $name_user,
					'username'        => htmlspecialchars($username),
					'nickname'			=> substr($name_user, 0, 5),
					'image_user' 		=> 'https://ui-avatars.com/api/?name=' . $name_user . '',
					'role_user'   		=> $role_user,
					'is_active' 		=> $is_active,
					'updated_at' 		=> time()
				));

				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
					return json_encode(array('success' => false, 'msg' => 'Update User gagal!'));
				} else {
					return json_encode(array('success' => true, 'msg' => 'Update User berhasil!'));
				}
			} else {
				if (strlen($password_user) <= 6) {
					return json_encode(array('success' => false, 'msg' => 'Gagal!, Password terlalu pendek, min 6 karakter!'));
				} else {
					$this->db->trans_start();
					$this->db->where('id_user', $id_user);
					$this->db->update('users', array(
						'name_user'       => $name_user,
						'username'        => htmlspecialchars($username),
						'nickname'			=> substr($name_user, 0, 5),
						'image_user' 		=> 'https://ui-avatars.com/api/?name=' . $name_user . '',
						'password_user' 	=> password_hash($password_user, PASSWORD_DEFAULT),
						'role_user'   		=> $role_user,
						'is_active' 		=> $is_active,
						'updated_at' 		=> time()
					));

					$this->db->trans_complete();
					if ($this->db->trans_status() === FALSE) {
						return json_encode(array('success' => false, 'msg' => 'Update User gagal!'));
					} else {
						return json_encode(array('success' => true, 'msg' => 'Update User berhasil!'));
					}
				}
			}
		}
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$this->db->delete('users', array('id_user' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus User Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus User Berhasil!'));
		}
	}
}
