<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_profile', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 	= 'Profile | Marak 2.0';
		$data['profile'] 	= $this->record->myprofile();
		$this->load->view('Profile/v_profile', $data);
	}

	public function Feed()
	{
		$data['profile'] 	= $this->record->myprofile();
		$this->load->view('Profile/v_feed', $data);
	}

	public function Account()
	{
		$data['profile'] 	= $this->record->myprofile();
		$this->load->view('Profile/v_account', $data);
	}

	public function UpdateAccount()
	{
		$id_user 	= $this->input->post('id_user');
		$name_user 	= $this->input->post('name_user');
		$email_user = $this->input->post('email_user');
		$phone 		= $this->input->post('phone');
		$address 	= $this->input->post('address');

		echo $this->record->UpdateAccount($id_user, $name_user, $email_user, $phone, $address);
	}

	public function Security()
	{
		$data['profile'] 	= $this->record->myprofile();
		$this->load->view('Profile/v_changepassword', $data);
	}

	public function ChangePassowrd()
	{
		$currentPassword 		= $this->input->post('currentPassword');
		$newPassword 			= $this->input->post('newPassword');
		$confirmNewPassword 	= $this->input->post('confirmNewPassword');

		echo $this->record->ChangePassword($currentPassword, $newPassword, $confirmNewPassword);
	}
}
