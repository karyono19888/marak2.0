<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tools extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_tools', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Tools | Marak 2.0';
		$data['data']	= $this->record->index();
		$this->load->view('Tools/v_index', $data);
	}

	public function Tambah()
	{
		$data['title'] = 'Tambah | Marak';

		$this->form_validation->set_rules('tools_owner', 'Document Owner', 'required|trim');
		$this->form_validation->set_rules('tools_role', 'Role File', 'required|trim');
		$this->form_validation->set_rules('tools_type', 'Type File', 'required|trim');
		$this->form_validation->set_rules('tools_nama', 'Nama File', 'required|trim');


		if ($this->form_validation->run() ==  false) {
			$this->load->view('Tools/v_tambah_tools', $data);
		} else {
			$tools_owner = $this->input->post('tools_owner');
			$tools_role = $this->input->post('tools_role');
			$tools_type = $this->input->post('tools_type');
			$tools_nama = $this->input->post('tools_nama');

			$filename = $_FILES['tools_upload']['name'];

			$fileName = hash('MD5', $filename);
			$config['upload_path']          = FCPATH . '/assets/tools/';
			$config['allowed_types']        = 'pdf';
			$config['file_name']            = $fileName;
			$config['max_size']             = 2048; // 2MB

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('tools_upload')) {
				$this->session->set_flashdata('message', '
				<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Oopss!</strong> Upload tools gagal.</span>
					</div></div>
				');
				redirect(site_url('Tools'));
			} else {

				$new_data = [
					'tools_owner' 	=> $tools_owner,
					'tools_role' 	=> $tools_role,
					'tools_type' 	=> $tools_type,
					'tools_nama' 	=> ucwords($tools_nama),
					'tools_upload' => $this->upload->data('file_name'),
					'tools_status' => 1,
					'created_at'   => time(),
				];

				if ($this->record->UploadTools($new_data)) {
					$this->upload->data();
					$this->session->set_flashdata('message', '
					<div class="alert alert-success" role="alert">
						<div class="alert-body d-flex align-items-center">
							<i data-feather="info" class="me-50"></i>
							<span><strong>Success!</strong> Upload tools berhasil.</span>
						</div></div>
					');
					redirect('Tools');
				} else {
					$this->session->set_flashdata('message', '
				<div class="alert alert-danger" role="alert">
				<div class="alert-body d-flex align-items-center">
					<i data-feather="info" class="me-50"></i>
					<span><strong>Gagal!</strong> Upload tools gagal.</span>
				</div></div>
			');
					redirect(site_url('Tools'));
				}
			}
		}
	}

	public function dataOwner()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->getOwner($searchTerm);
		echo json_encode($response);
	}

	public function Edit($id)
	{
		$data['title'] = 'Edit | Marak';
		$data['data'] = $this->record->DataTools($id);

		$this->form_validation->set_rules('tools_owner', 'Document Owner', 'required|trim');
		$this->form_validation->set_rules('tools_role', 'Role File', 'required|trim');
		$this->form_validation->set_rules('tools_type', 'Type File', 'required|trim');
		$this->form_validation->set_rules('tools_nama', 'Nama File', 'required|trim');


		if ($this->form_validation->run() ==  false) {
			$this->load->view('Tools/v_edit_tools', $data);
		} else {
			$tools_owner 	= $this->input->post('tools_owner');
			$tools_role 	= $this->input->post('tools_role');
			$tools_type 	= $this->input->post('tools_type');
			$tools_nama 	= $this->input->post('tools_nama');
			$tools_id 		= $this->input->post('tools_id');

			$filename = $_FILES['tools_upload']['name'];

			$fileName = hash('MD5', $filename);
			$config['upload_path']          = FCPATH . '/assets/tools/';
			$config['allowed_types']        = 'pdf';
			$config['file_name']            = $fileName;
			$config['max_size']             = 2048; // 2MB

			$this->load->library('upload', $config);
			if ($filename === "") {
				$new_data = [
					'tools_owner' 	=> $tools_owner,
					'tools_role' 	=> $tools_role,
					'tools_type' 	=> $tools_type,
					'tools_nama' 	=> ucwords($tools_nama),
					'tools_status' => 1,
					'updated_at'   => time()
				];

				if ($this->record->EditUploadTools($new_data, $tools_id)) {
					$this->session->set_flashdata('message', '
					<div class="alert alert-success" role="alert">
						<div class="alert-body d-flex align-items-center">
							<i data-feather="info" class="me-50"></i>
							<span><strong>Success!</strong> Upload tools berhasil.</span>
						</div></div>
					');
					redirect('Tools');
				} else {
					$this->session->set_flashdata('message', '
				<div class="alert alert-danger" role="alert">
				<div class="alert-body d-flex align-items-center">
					<i data-feather="info" class="me-50"></i>
					<span><strong>Gagal!</strong> Upload tools gagal.</span>
				</div></div>');
					redirect(site_url('Tools'));
				}
			} else {
				if (!$this->upload->do_upload('tools_upload')) {
					$this->session->set_flashdata('message', '
					<div class="alert alert-danger" role="alert">
						<div class="alert-body d-flex align-items-center">
							<i data-feather="info" class="me-50"></i>
							<span><strong>Oopss!</strong> Upload tools gagal.</span>
						</div></div>
					');
					redirect(site_url('Tools'));
				} else {

					$new_data = [
						'tools_owner' 	=> $tools_owner,
						'tools_role' 	=> $tools_role,
						'tools_type' 	=> $tools_type,
						'tools_nama' 	=> ucwords($tools_nama),
						'tools_upload' => $this->upload->data('file_name'),
						'tools_status' => 1,
						'updated_at'   => time()
					];

					if ($this->record->EditUploadTools($new_data, $tools_id)) {
						$old_file = $data['data']['tools_upload'];
						unlink(FCPATH . '/assets/tools/' . $old_file);
						$this->upload->data();
						$this->session->set_flashdata('message', '
							<div class="alert alert-success" role="alert">
								<div class="alert-body d-flex align-items-center">
									<i data-feather="info" class="me-50"></i>
									<span><strong>Success!</strong> Upload tools berhasil.</span>
								</div></div>
							');
						redirect('Tools');
					} else {
						$this->session->set_flashdata('message', '
						<div class="alert alert-danger" role="alert">
						<div class="alert-body d-flex align-items-center">
							<i data-feather="info" class="me-50"></i>
							<span><strong>Gagal!</strong> Upload tools gagal.</span>
						</div></div>');
						redirect(site_url('Tools'));
					}
				}
			}
		}
	}

	public function Delete()
	{
		$id = $this->input->post('id');
		echo $this->record->Delete($id);
	}
}
