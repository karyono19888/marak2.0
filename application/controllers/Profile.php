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
		$data['total'] 	= $this->record->TotalKunjungan();
		$data['close'] 	= $this->record->TotalClose();
		$data['log'] 		= $this->record->LogActivity();
		$this->load->view('Profile/v_profile', $data);
	}


	public function Feed()
	{
		$data['profile'] 	= $this->record->myprofile();
		$data['total'] 	= $this->record->TotalKunjungan();
		$data['close'] 	= $this->record->TotalClose();
		$data['log'] 		= $this->record->LogActivity();
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

		$account_upload 	= $_FILES['account_upload']['name'];
		$fileName = hash('MD5', $account_upload);

		$config['upload_path']          = FCPATH . '/assets/image/profile/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['file_name']            = $fileName;
		$config['max_size']             = 2048; // 2MB

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('tools_upload')) {
			$new_data = [
				'name_user'  => $name_user,
				'email_user' => $email_user,
				'phone' 		 => $phone,
				'address' 	 => $address,
			];

			// var_dump($fileName);
			// die;

			if ($this->record->UpdateAccount($new_data, $id_user)) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-success" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Success!</strong> Ubah Profile Berhasil.</span>
					</div></div>
				');
				redirect('Profile');
			} else {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger" role="alert">
				<div class="alert-body d-flex align-items-center">
					<i data-feather="info" class="me-50"></i>
					<span><strong>Gagal!</strong> Ubah Profile Gagal.</span>
				</div></div>
			');
				redirect(site_url('Profile'));
			}
		} else {
			$new_data = [
				'name_user'  => $name_user,
				'email_user' => $email_user,
				'image_user' => $this->upload->data('file_name'),
				'phone' 		 => $phone,
				'address' 	 => $address,
			];

			var_dump($new_data);
			die;

			if ($this->record->UpdateAccount($new_data, $id_user)) {
				$this->upload->data();
				$this->session->set_flashdata('message', '
				<div class="alert alert-success" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Success!</strong> Ubah Data dan Foto Profile Berhasil.</span>
					</div></div>
				');
				redirect('Profile');
			} else {
				$this->session->set_flashdata('message', '
			<div class="alert alert-danger" role="alert">
			<div class="alert-body d-flex align-items-center">
				<i data-feather="info" class="me-50"></i>
				<span><strong>Gagal!</strong> Ubah Profile Gagal.</span>
			</div></div>
		');
				redirect(site_url('Profile'));
			}
		}

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