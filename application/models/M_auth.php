<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function registration($data)
	{
		$this->db->insert('users', $data);
	}

	public function login($username, $password)
	{
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password_user'])) {
					$data = [
						'username'   => $user['username'],
						'name_user'  => $user['name_user'],
						'role_user'  => $user['role_user'],
						'is_login' 	 => TRUE,
					];
					$this->session->set_userdata($data);
					if ($user['role_user'] == 1) {
						$this->session->set_flashdata('success', 'Login Sukses');
						redirect('Administrator');
					} else {
						$this->session->set_flashdata('success', 'Login Sukses');
						redirect('Marketing');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Invalid</strong> Password salah.</span>
					</div>
			 		</div>');
					redirect('Auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><div class="alert-body"><strong>Invalid</strong> Email belum diaktivasi.</div></div>');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><div class="alert-body"><strong>Invalid</strong> Username tidak terdaftar.</div></div>');
			redirect('Auth');
		}
	}
}
