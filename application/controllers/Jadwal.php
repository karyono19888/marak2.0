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
		$data['title'] 			= 'Jadwal Kunjungan | Marak 2.0';
		$data['total'] 			= $this->record->totalRencanaKunjungan();
		$data['totalplan'] 		= $this->record->totalPlanning();
		$data['totalvisited'] 	= $this->record->totalVisited();
		$data['totalnotvisit'] 	= $this->record->totalNotVisited();
		$data['jadwal'] 			= $this->record->dataJadwalKunjungan();
		$this->load->view('Jadwal/v_index', $data);
	}

	public function TableJadwal()
	{
		$start_date 		= $this->input->post('start_date');
		$end_date   		= $this->input->post('end_date');
		$nama_marketing   = $this->input->post('nama_marketing');


		if ($start_date == "" && $end_date == "" && $nama_marketing == "") {
			$table = $this->record->dataJadwalKunjungan();
			$label = "Search & Filter";
		} else if ($nama_marketing == "") {
			$table 		= $this->record->dataJadwalrangeTanggal($start_date, $end_date);
			$tgl_awal  	= date('d-m-Y', strtotime($start_date));
			$tgl_akhir 	= date('d-m-Y', strtotime($end_date));
			$label     	= 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
		} else {
			$getNamaMarketing = $this->record->getNamaMarketing($nama_marketing);
			$table 		= $this->record->dataJadwalrangeTanggaldanMarketing($start_date, $end_date, $nama_marketing);
			$tgl_awal  	= date('d-m-Y', strtotime($start_date));
			$tgl_akhir 	= date('d-m-Y', strtotime($end_date));
			$label     	= 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir . '<br>Marketing : ' . $getNamaMarketing['name_user'];
		}

		$data['jadwal'] = $table;
		$data['label']  = $label;
		$this->load->view('Jadwal/v_table_jadwal', $data);
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
		$instansi_id 			= $this->input->post('instansi');
		$m_visit_id 			= $this->input->post('m_visit_id');
		$m_visit_history_id 	= $this->input->post('m_visit_history_id');
		$date_visit 			= $this->input->post('date_visit');
		$time 					= $this->input->post('time');
		$type_alamat 			= $this->input->post('type_alamat');
		$type_act 				= $this->input->post('type_act');
		$acara 					= $this->input->post('acara');

		echo $this->record->TambahJadwalUpdate($instansi_id, $m_visit_id, $m_visit_history_id, $date_visit, $time, $type_alamat, $type_act, $acara);
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

	public function NamaMarketing()
	{
		$searchTerm = $this->input->post('searchTerm');
		$response   = $this->record->NamaMarketing($searchTerm);
		echo json_encode($response);
	}

	public function ViewNotVisited()
	{
		$id = $this->input->post('id');
		echo $this->record->ViewNotVisited($id);
	}

	public function ResultSimpan()
	{
		$id_jadwal  = $this->input->post('id_jadwal');
		$notvisited = $this->input->post('notvisited');

		echo $this->record->ResultSimpan($id_jadwal, $notvisited);
	}

	public function tambahBaruKunjungan($id_jadwal)
	{
		$data['title'] = 'Tambah Kunjungan | Marak 2.0';
		$data['data'] = $this->record->dataTambahBaruKunjungan($id_jadwal);
		$this->load->view('Jadwal/v_tambah_kunjungan_save', $data);
	}

	public function SimpanKunjungan()
	{
		$id_jadwal 					= $this->input->post('id_jadwal');
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

		echo $this->record->SimpanKunjungan($id_jadwal, $m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $peserta_nama, $peserta_jabatan, $peserta_phone, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long);
	}
}
