<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_profile extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function myprofile()
	{
		$this->db->select('*');
		$this->db->join('user_role', 'role_id=role_user', 'left');
		$this->db->where('username', $this->session->userdata('username'));
		return $this->db->get('users')->row();
	}

	public function UpdateAccount($id_user, $name_user, $email_user, $phone, $address)
	{
		$this->db->trans_start();
		$this->db->where('id_user', $id_user);
		$this->db->update('users', array(
			'name_user'  => $name_user,
			'email_user' => $email_user,
			'phone' 		 => $phone,
			'address' 	 => $address,
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Invalid</strong> Data Account Gagal disimpan.</span>
					</div>
			 		</div>');
			redirect('Profile');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="check" class="me-50"></i>
						<span><strong>Success</strong> Account berhasil diperbaharui.</span>
					</div>
			 		</div>');
			redirect('Profile');
		}
	}
}
