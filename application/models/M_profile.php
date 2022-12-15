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

	public function TotalKunjungan()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$query = $this->db->get('m_visit_history');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$query = $this->db->get('m_visit_history');
			return $query->num_rows();
		}
	}

	public function TotalClose()
	{
		if ($this->session->userdata('role_user') == 1 || $this->session->userdata('role_user') == 22) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_po');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_po;
			} else {
				return 0;
			}
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_po');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_po;
			} else {
				return 0;
			}
		}
	}

	public function UpdateAccount($new_data, $id_user)
	{

		$this->db->trans_start();
		$this->db->where('id_user', $id_user);
		$this->db->update('users', $new_data);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}

	function get_user($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('users');
		return $query->row();
	}

	public function LogActivity()
	{
		if ($this->session->userdata('id_user') == 1) {
			$this->db->where('YEAR(log_time)', date('Y'));
			$this->db->join('users', 'id_user=log_user', 'left');
			$this->db->join('user_role', 'role_id=role_user', 'left');
			$this->db->order_by('log_id', 'desc');
			return $this->db->get('t_log');
		} else {
			$this->db->where('log_user', $this->session->userdata('id_user'));
			$this->db->where('YEAR(log_time)', date('Y'));
			$this->db->join('users', 'id_user=log_user', 'left');
			$this->db->join('user_role', 'role_id=role_user', 'left');
			$this->db->order_by('log_id', 'desc');
			return $this->db->get('t_log');
		}
	}

	public function ChangePassword($currentPassword, $newPassword, $confirmNewPassword)
	{
		$username = $this->session->userdata('username');
		$user = $this->get_user($username);

		if (!password_verify($currentPassword, $user->password_user)) {
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Invalid</strong> Password Lama salah.</span>
					</div>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>'
			);
			redirect('Profile');
		} else {
			if ($currentPassword == $newPassword) {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<div class="alert-body d-flex align-items-center">
							<i data-feather="info" class="me-50"></i>
							<span><strong>Invalid</strong> Password Baru tidak boleh sama dengan Password lama.</span>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>'
				);
				redirect('Profile');
			} elseif ($newPassword == $confirmNewPassword) {
				if (strlen($newPassword) >= 8) {
					$password_has = password_hash($newPassword, PASSWORD_DEFAULT);
					$this->db->set('password_user', $password_has);
					$this->db->where('username', $this->session->userdata('username'));
					$this->db->update('users');
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-success alert-dismissible fade show" role="alert">
							<div class="alert-body d-flex align-items-center">
								<i data-feather="check" class="me-50"></i>
								<span><strong>Success</strong> Password baru berhasil diperbaharui.</span>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>'
					);
					redirect('Profile');
				} else {
					$this->session->set_flashdata(
						'message',
						'<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<div class="alert-body d-flex align-items-center">
								<i data-feather="info" class="me-50"></i>
								<span><strong>Invalid</strong> Password baru terlalu pendek, Minimum 8 characters.</span>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>'
					);
					redirect('Profile');
				}
			} else {
				$this->session->set_flashdata(
					'message',
					'<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<div class="alert-body d-flex align-items-center">
							<i data-feather="info" class="me-50"></i>
							<span><strong>Invalid</strong> Konfirmasi password tidak sama.</span>
						</div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>'
				);
				redirect('Profile');
			}

		}
	}
}