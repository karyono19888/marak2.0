<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_auth', 'record');
	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			redirect('');
		};
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['title'] 			= 'Marak | Login';
			$this->load->view('Auth/v_login', $data);
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->record->login($username, $password);
		}
	}

	public function forgotpassword()
	{
		$data['title'] = 'Marak | Forgot Password';
		$this->load->view('Auth/v_forgotpassword', $data);
	}

	public function registration()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
			'is_unique' => 'Username sudah terdaftar',
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email_user]', [
			'is_unique' => 'Email sudah terdaftar',
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' 		=> 'Password tidak sama!',
			'min_length' 	=> 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password]', [
			'matches' 		=> 'Password tidak sama!',
		]);



		if ($this->form_validation->run() == false) {
			$data['title'] = 'Marak | Signup';
			$this->load->view('Auth/v_registration', $data);
		} else {

			$username  = $this->input->post('username', true);
			$email_user = $this->input->post('email', true);

			$data = [
				'username' 			=> htmlspecialchars($username),
				'email_user' 		=> htmlspecialchars($email_user),
				'image_user' 		=> 'https://ui-avatars.com/api/?name=' . $username . '',
				'password_user' 	=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_user'   		=> 2,
				'is_active' 		=> 1,
				'created_at' 		=> time()
			];

			$this->record->registration($data);
			$this->session->set_flashdata(
				'message',
				'<div class="alert alert-success" role="alert">
          <div class="alert-body"><strong>Berhasil!</strong> Akun Kamu berhasil terdaftar, silahkan cek email untuk aktivasi akun.</div>
			 </div>'
			);
			redirect('Auth');
		}
	}

	public function logout()
	{
		// $session_id = $this->db->get_where('ci_sessions', ['id' => $this->session->session_id]);
		$session_id = session_id();
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_user');
		$this->session->set_flashdata(
			'message',
			'<div class="alert alert-success mt-1 alert-validation-msg" role="alert">
			<div class="alert-body d-flex align-items-center">
				<i data-feather="check-circle" class="me-50"></i>
				<span><strong>Success</strong>. Kamu telah logout.</span>
			</div>
		</div>'
		);
		redirect('Auth');
		$this->db->delete('ci_sessions', ['id' => $session_id]);
	}
	public function pagenotfound()
	{
		$data['title'] = 'Marak | 404';
		$this->load->view('errors/error_404', $data);
	}

	public function Blocked()
	{
		$data['title'] = 'Marak | 404';
		$this->load->view('errors/blocked', $data);
	}

}
