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
		$this->load->view('Auth/v_login');
	}

	public function forgotpassword()
	{
		$this->load->view('Auth/v_forgotpassword');
	}

	public function registration()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email_user]', [
			'is_unique' => 'Email sudah terdaftar',
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' 		=> 'Password tidak sama!',
			'min_length' 	=> 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password]');



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
}
