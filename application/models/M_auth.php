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

	public function login($username, $password, $remember)
	{
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($user) {
			if ($user['is_active'] == 1) {
				if (password_verify($password, $user['password_user'])) {
					$data = [
						'id_user'    => $user['id_user'],
						'nickname'   => $user['nickname'],
						'username'   => $user['username'],
						'name_user'  => $user['name_user'],
						'role_user'  => $user['role_user'],
						'is_login' 	 => TRUE,
					];
					$this->session->set_userdata($data);

					if (isset($remember)) {
						setcookie('_secure-3ID', $user['id_user'], time() + 3600);
						setcookie('_secure-1US', hash('sha256', $user['username']), time() + 3600);
					}

					$this->session->set_flashdata('success', 'Login Berhasil');
					helper_log("login", "Login");
					redirect('Welcome');

				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Invalid</strong> Username dan Password salah.</span>
					</div>
			 		</div>');
					redirect('Auth');
				}
			} elseif ($user['is_active'] == 2) {
				$this->session->set_flashdata('message',
				'<div class="alert alert-warning" role="alert">
				<div class="alert-body d-flex align-items-center">
					<i data-feather="info" class="me-50"></i>
					<span><strong>Suspend</strong> Username terblokir.</span>
				</div>
				</div>');
				redirect('Auth');
			} else {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Invalid</strong> Username sudah tidak aktif.</span>
					</div></div>
				');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><div class="alert-body"><strong>Invalid</strong> Username tidak terdaftar.</div></div>');
			redirect('Auth');
		}
	}

	public function cek_cookie($id, $key)
	{
		$user = $this->db->get_where('users', ['id_user' => $id])->row_array();
		if ($key === hash('sha256', $user['username'])) {
			$this->session->userdata('is_login') == true;
		}
	}

	public function cek_login()
	{
		if (!$this->session->userdata('username') == true) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Expired</strong> Silahkan login terlebih dahulu.</span>
					</div></div>');
			redirect('Auth');
		}
	}
}