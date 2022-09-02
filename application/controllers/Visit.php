<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Visit extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_visit', 'record');
		$this->load->model('M_auth', 'Auth');
		$this->Auth->cek_login();
	}

	public function index()
	{
		$data['title'] 			= 'Data Kunjungan | Marak 2.0';
		$data['totalkunjungan'] = $this->record->TotalKunjungan();
		$data['totalprospek'] 	= $this->record->TotalKunjunganProspek();
		$data['totalprognosa'] 	= $this->record->TotalKunjunganPrognosa();
		$data['totalclosepo'] 	= $this->record->TotalKunjunganClose();
		$data['visit'] 			= $this->record->dataVisitAll();
		$this->load->view('Visit/v_index', $data);
	}

	public function Tambah()
	{
		$data['title'] = 'Tambah Kunjungan | Marak 2.0';
		$this->load->view('Visit/v_tambah', $data);
	}

	public function TambahKunjungan()
	{
		$m_visit_prov 				= $this->input->post('m_visit_prov');
		$m_visit_kab 				= $this->input->post('m_visit_kab');
		$m_visit_instansi 		= $this->input->post('m_visit_instansi');
		$m_visit_agenda 			= $this->input->post('m_visit_agenda');
		$m_visit_jam_mulai 		= $this->input->post('m_visit_jam_mulai');
		$m_visit_jam_selesai 	= $this->input->post('m_visit_jam_selesai');
		$m_visit_tgl 				= $this->input->post('m_visit_tgl');
		$peserta_nama 				= $this->input->post('peserta_nama');
		$peserta_jabatan 			= $this->input->post('peserta_jabatan');
		$peserta_phone 			= $this->input->post('peserta_phone');
		$m_visit_note 				= $this->input->post('m_visit_note');
		$m_visit_anggaran_BUMN 	= $this->input->post('m_visit_anggaran_BUMN');
		$m_visit_prospek 			= $this->input->post('m_visit_prospek');
		$m_visit_prognosa 		= $this->input->post('m_visit_prognosa');
		$m_visit_estimasi_order = $this->input->post('m_visit_estimasi_order');
		$m_visit_estimasi_tahun = $this->input->post('m_visit_estimasi_tahun');
		$m_visit_status 			= $this->input->post('m_visit_status');
		$m_visit_koor_lat 		= $this->input->post('m_visit_koor_lat');
		$m_visit_koor_long 		= $this->input->post('m_visit_koor_long');

		echo $this->record->TambahKunjungan($m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $peserta_nama, $peserta_jabatan, $peserta_phone, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long);
	}

	public function Delete()
	{
		$id = $this->input->post('id');
		echo $this->record->Delete($id);
	}

	public function Preview($m_visit_history_id)
	{
		$data['title'] 	= 'Preview Kunjungan | Marak 2.0';
		$data['data'] 		= $this->record->PreviewdataVisit($m_visit_history_id);
		$data['peserta'] 	= $this->record->PreviewdataPeserta($m_visit_history_id);
		$this->load->view('Visit/v_preview', $data);
	}

	public function Edit($m_visit_history_id)
	{
		$data['title'] 	= 'Edit Kunjungan | Marak 2.0';
		$data['data'] 		= $this->record->PreviewdataVisit($m_visit_history_id);
		$data['peserta'] 	= $this->record->PreviewdataPeserta($m_visit_history_id);
		$this->load->view('Visit/v_edit', $data);
	}

	public function TambahPeserta()
	{
		$m_visit_id 			= $this->input->post('m_visit_id');
		$m_visit_history_id 	= $this->input->post('m_visit_history_id');
		$m_visit_user_id 		= $this->input->post('m_visit_user_id');
		$peserta_nama 			= $this->input->post('peserta_nama');
		$peserta_jabatan 		= $this->input->post('peserta_jabatan');
		$peserta_phone 		= $this->input->post('peserta_phone');

		echo $this->record->TambahPeserta($m_visit_id, $m_visit_history_id, $m_visit_user_id, $peserta_nama, $peserta_jabatan, $peserta_phone);
	}

	public function DeletePeserta()
	{
		$id = $this->input->post('id');
		echo $this->record->DeletePeserta($id);
	}

	public function ViewPeserta()
	{
		$id = $this->input->post('id');
		echo $this->record->ViewPeserta($id);
	}

	public function EditPeserta()
	{
		$id_peserta 			= $this->input->post('id_peserta');
		$m_visit_id 			= $this->input->post('m_visit_id');
		$m_visit_history_id 	= $this->input->post('m_visit_history_id');
		$m_visit_user_id 		= $this->input->post('m_visit_user_id');
		$peserta_nama 			= $this->input->post('peserta_nama');
		$peserta_jabatan 		= $this->input->post('peserta_jabatan');
		$peserta_phone 		= $this->input->post('peserta_phone');

		echo $this->record->EditPeserta($id_peserta, $m_visit_id, $m_visit_history_id, $m_visit_user_id, $peserta_nama, $peserta_jabatan, $peserta_phone);
	}

	public function EditKunjungan()
	{
		$visit 						= $this->input->post('visit');
		$history 					= $this->input->post('history');
		$m_visit_prov 				= $this->input->post('m_visit_prov');
		$m_visit_kab 				= $this->input->post('m_visit_kab');
		$m_visit_instansi 		= $this->input->post('m_visit_instansi');
		$m_visit_agenda 			= $this->input->post('m_visit_agenda');
		$m_visit_jam_mulai 		= $this->input->post('m_visit_jam_mulai');
		$m_visit_jam_selesai 	= $this->input->post('m_visit_jam_selesai');
		$m_visit_tgl 				= $this->input->post('m_visit_tgl');
		$m_visit_note 				= $this->input->post('m_visit_note');
		$m_visit_anggaran_BUMN 	= $this->input->post('m_visit_anggaran_BUMN');
		$m_visit_prospek 			= $this->input->post('m_visit_prospek');
		$m_visit_prognosa 		= $this->input->post('m_visit_prognosa');
		$m_visit_estimasi_order = $this->input->post('m_visit_estimasi_order');
		$m_visit_estimasi_tahun = $this->input->post('m_visit_estimasi_tahun');
		$m_visit_status 			= $this->input->post('m_visit_status');
		$m_visit_koor_lat 		= $this->input->post('m_visit_koor_lat');
		$m_visit_koor_long 		= $this->input->post('m_visit_koor_long');

		echo $this->record->EditKunjungan($visit, $history, $m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long);
	}

	public function ViewUpdate($m_visit_id)
	{
		$data['title'] 	= 'Update Kunjungan | Marak 2.0';
		$id = $this->db->get_where('m_visit', ['m_visit_id' => $m_visit_id])->row_array();
		$data['data'] 		= $this->record->PreviewdataUpdateVisit($id['m_visit_history_id']);
		$data['peserta'] 	= $this->record->PreviewdataUpdatePeserta($id['m_visit_history_id']);
		$data['history'] 	= $this->record->PreviewdataHistory($m_visit_id);
		$this->load->view('Visit/v_update', $data);
	}

	public function ViewModalHistoryKunjungan()
	{
		$id = $this->input->post('id');
		echo $this->record->ViewModalHistoryKunjungan($id);
	}

	public function viewPesertaTable()
	{
		$id = $this->input->post('pesertaId');
		echo $this->record->viewPesertaTable($id);
	}

	public function UpdateKunjungan()
	{
		$id 							= $this->input->post('id');
		$id_history 				= $this->input->post('id_history');
		$m_visit_prov 				= $this->input->post('m_visit_prov');
		$m_visit_kab 				= $this->input->post('m_visit_kab');
		$m_visit_instansi 		= $this->input->post('m_visit_instansi');
		$m_visit_agenda 			= $this->input->post('m_visit_agenda');
		$m_visit_jam_mulai 		= $this->input->post('m_visit_jam_mulai');
		$m_visit_jam_selesai 	= $this->input->post('m_visit_jam_selesai');
		$m_visit_tgl 				= $this->input->post('m_visit_tgl');
		$peserta_nama 				= $this->input->post('peserta_nama');
		$peserta_jabatan 			= $this->input->post('peserta_jabatan');
		$peserta_phone 			= $this->input->post('peserta_phone');
		$m_visit_note 				= $this->input->post('m_visit_note');
		$m_visit_anggaran_BUMN 	= $this->input->post('m_visit_anggaran_BUMN');
		$m_visit_prospek 			= $this->input->post('m_visit_prospek');
		$m_visit_prognosa 		= $this->input->post('m_visit_prognosa');
		$m_visit_estimasi_order = $this->input->post('m_visit_estimasi_order');
		$m_visit_estimasi_tahun = $this->input->post('m_visit_estimasi_tahun');
		$m_visit_status 			= $this->input->post('m_visit_status');
		$m_visit_koor_lat 		= $this->input->post('m_visit_koor_lat');
		$m_visit_koor_long 		= $this->input->post('m_visit_koor_long');

		echo $this->record->UpdateKunjungan($id, $id_history, $m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $peserta_nama, $peserta_jabatan, $peserta_phone, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long);
	}
}
