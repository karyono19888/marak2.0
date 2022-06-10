<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_jadwal', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] = 'Jadwal Kunjungan | Marak 2.0';
		$data['jadwal'] = $this->record->dataJadwalKunjungan();
		$this->load->view('Jadwal/v_index', $data);
	}

	public function Tambah()
	{
		$data['title'] = 'Tambah Kunjungan | Marak 2.0';
		$this->load->view('Jadwal/v_tambah', $data);
	}

	public function TambahKunjunganBaru()
	{
		$this->load->view('Jadwal/v_tambah_kunjungan_baru');
	}

	public function TambahJadwalBaru()
	{
		$instansi_id 	= $this->input->post('instansi');
		$date_visit 	= $this->input->post('date_visit');
		$time 			= $this->input->post('time');
		$type_alamat 	= $this->input->post('type_alamat');
		$type_act 		= $this->input->post('type_act');
		$acara 			= $this->input->post('acara');

		echo $this->record->TambahJadwalBaru($instansi_id, $date_visit, $time, $type_alamat, $type_act, $acara);
	}

	public function TableKunjunganMarketing()
	{
		$data['visit'] = $this->record->dataVisitAll();
		$this->load->view('Jadwal/v_table_kunjungan', $data);
	}

	public function TambahKunjunganUpdate()
	{
		$id = $this->input->post('id');
		$data['data'] = $this->record->DataKunjunganUpdate($id);
		$this->load->view('Jadwal/v_tambah_kunjungan_updated', $data);
	}

	public function TambahJadwalUpdate()
	{
		$instansi_id 	= $this->input->post('instansi');
		$m_visit_id 	= $this->input->post('m_visit_id');
		$date_visit 	= $this->input->post('date_visit');
		$time 			= $this->input->post('time');
		$type_alamat 	= $this->input->post('type_alamat');
		$type_act 		= $this->input->post('type_act');
		$acara 			= $this->input->post('acara');

		echo $this->record->TambahJadwalUpdate($instansi_id, $m_visit_id, $date_visit, $time, $type_alamat, $type_act, $acara);
	}

	public function Delete()
	{
		$id = $this->input->post('id');

		echo $this->record->Delete($id);
	}

	public function Edit($id)
	{
		$data['title'] = 'Edit Kunjungan | Marak 2.0';
		$data['data'] = $this->record->EditJadwal($id);
		$this->load->view('Jadwal/v_edit', $data);
	}

	public function EditKunjunganBaru()
	{
		$id = $this->input->post('id');
		$data['data'] = $this->record->DataEditKunjunganBaru($id);
		$this->load->view('Jadwal/v_edit_kunjungan_baru', $data);
	}

	public function UpdateJadwalBaru()
	{
		$id_jadwal 		= $this->input->post('id_jadwal');
		$instansi_id 	= $this->input->post('instansi');
		$date_visit 	= $this->input->post('date_visit');
		$time 			= $this->input->post('time');
		$type_alamat 	= $this->input->post('type_alamat');
		$type_act 		= $this->input->post('type_act');
		$acara 			= $this->input->post('acara');

		echo $this->record->UpdateJadwalBaru($id_jadwal, $instansi_id, $date_visit, $time, $type_alamat, $type_act, $acara);
	}

	public function EditKunjunganUpdate()
	{
		$id = $this->input->post('id');
		$data['data'] = $this->record->DataEditKunjunganUpdate($id);
		$this->load->view('Jadwal/v_edit_kunjungan_update', $data);
	}

	public function UpdateJadwalUpdate()
	{
		$id_jadwal 		= $this->input->post('id_jadwal');
		$m_visit_id 	= $this->input->post('visit_id');
		$instansi_id 	= $this->input->post('instansi');
		$date_visit 	= $this->input->post('date_visit');
		$time 			= $this->input->post('time');
		$type_alamat 	= $this->input->post('type_alamat');
		$type_act 		= $this->input->post('type_act');
		$acara 			= $this->input->post('acara');

		echo $this->record->UpdateJadwalUpdate($id_jadwal, $m_visit_id, $instansi_id, $date_visit, $time, $type_alamat, $type_act, $acara);
	}
}
