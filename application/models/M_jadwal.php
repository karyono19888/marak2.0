<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_jadwal extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function dataJadwalKunjungan()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(date_visit)', date('Y'));
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$this->db->order_by('date_visit', 'desc');
			$query = $this->db->get('m_jadwal_kunjungan');
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(date_visit)', date('Y'));
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$this->db->order_by('date_visit', 'desc');
			$query = $this->db->get('m_jadwal_kunjungan');
		}
		return $query;
	}

	public function dataVisitAll()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		}

		return $query;
	}

	public function DataKunjunganUpdate($id)
	{
		$this->db->where('m_visit_id', $id);
		$this->db->join('users', 'id_user=m_visit_user_id', 'left');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->order_by('m_visit_tgl', 'desc');
		$query = $this->db->get('m_visit');
		return $query->row_array();
	}

	public function TambahJadwalBaru($instansi_id, $date_visit, $time, $type_alamat, $type_act, $acara)
	{
		$this->db->trans_start();
		$this->db->insert('m_jadwal_kunjungan', array(
			'user_id'  		=> $this->session->userdata('id_user'),
			'type_act'  	=> $type_act,
			'type_alamat'  => $type_alamat,
			'instansi'  	=> $instansi_id,
			'date_visit'   => $date_visit,
			'time'       	=> $time,
			'acara'       	=> $acara,
			'status'       => "Planning",
			'created_at' 	=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Jadwal Gagal!'));
		} else {
			helper_log("add", "Tambah Jadwal Baru");
			return json_encode(array('success' => true, 'msg' => 'Tambah Jadwal Berhasil!'));
		}
	}

	public function TambahJadwalUpdate($instansi_id, $m_visit_id, $m_visit_history_id, $date_visit, $time, $type_alamat, $type_act, $acara)
	{
		$this->db->trans_start();
		$this->db->insert('m_jadwal_kunjungan', array(
			'user_id'  		=> $this->session->userdata('id_user'),
			'visit_id'		=> $m_visit_id,
			'vis_his_id'	=> $m_visit_history_id,
			'type_act'  	=> $type_act,
			'type_alamat'  => $type_alamat,
			'instansi'  	=> $instansi_id,
			'date_visit'   => $date_visit,
			'time'       	=> $time,
			'acara'       	=> $acara,
			'status'       => "Planning",
			'new_or_update' => 1,
			'created_at' 	=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Jadwal Gagal!'));
		} else {
			helper_log("add", "Tambah Jadwal Update");
			return json_encode(array('success' => true, 'msg' => 'Tambah Jadwal Berhasil!'));
		}
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_jadwal_kunjungan', array('id_jadwal' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Jadwal Gagal!'));
		} else {
			helper_log("delete", "Hapus Jadwal id : $id");
			return json_encode(array('success' => true, 'msg' => 'Hapus Jadwal Berhasil!'));
		}
	}

	public function EditJadwal($id)
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('id_jadwal', $id);
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$query = $this->db->get('m_jadwal_kunjungan');
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->where('id_jadwal', $id);
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$query = $this->db->get('m_jadwal_kunjungan');
		}
		return $query->row_array();
	}

	public function DataEditKunjunganBaru($id)
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('id_jadwal', $id);
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
			$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
			$query = $this->db->get('m_jadwal_kunjungan');
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->where('id_jadwal', $id);
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$query = $this->db->get('m_jadwal_kunjungan');
		}
		return $query->row_array();
	}

	public function UpdateJadwalBaru($id_jadwal, $instansi_id, $date_visit, $time, $type_alamat, $type_act, $acara)
	{
		$this->db->trans_start();
		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->update('m_jadwal_kunjungan', array(
			'user_id'  		=> $this->session->userdata('id_user'),
			'type_act'  	=> $type_act,
			'type_alamat'  => $type_alamat,
			'instansi'  	=> $instansi_id,
			'date_visit'   => $date_visit,
			'time'       	=> $time,
			'acara'       	=> $acara,
			'status'       => "Planning",
			'updated_at' 	=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update Jadwal Gagal!'));
		} else {
			helper_log("edit", "Edit Jadwal Baru id: $id_jadwal");
			return json_encode(array('success' => true, 'msg' => 'Update Jadwal Berhasil!'));
		}
	}

	public function DataEditKunjunganUpdate($id)
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('id_jadwal', $id);
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
			$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
			$query = $this->db->get('m_jadwal_kunjungan');
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->where('id_jadwal', $id);
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$query = $this->db->get('m_jadwal_kunjungan');
		}
		return $query->row_array();
	}

	public function UpdateJadwalUpdate($id_jadwal, $m_visit_id, $instansi_id, $date_visit, $time, $type_alamat, $type_act, $acara)
	{
		$this->db->trans_start();
		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->update('m_jadwal_kunjungan', array(
			'user_id'  		=> $this->session->userdata('id_user'),
			'visit_id'		=> $m_visit_id,
			'type_act'  	=> $type_act,
			'type_alamat'  => $type_alamat,
			'instansi'  	=> $instansi_id,
			'date_visit'   => $date_visit,
			'time'       	=> $time,
			'acara'       	=> $acara,
			'status'       => "Planning",
			'new_or_update' => 1,
			'updated_at' 	=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update Jadwal Gagal!'));
		} else {
			helper_log("edit", "Edit Jadwal Baru id: $id_jadwal");
			return json_encode(array('success' => true, 'msg' => 'Update Jadwal Berhasil!'));
		}
	}

	public function dataJadwalrangeTanggal($start_date, $end_date)
	{
		$this->db->where("date_visit BETWEEN '$start_date' AND '$end_date'");
		$this->db->join('users', 'id_user=user_id', 'left');
		$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
		return $this->db->get('m_jadwal_kunjungan');
	}

	public function NamaMarketing($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('role_user', 2);
		$this->db->where("name_user like '%" . $searchTerm . "%' ");
		$this->db->order_by('id_user', 'asc');
		$fetched_records = $this->db->get('users');
		$datauser = $fetched_records->result_array();
		$data = array();
		foreach ($datauser as $user) {
			$data[] = array(
				"id"   => $user['id_user'],
				"text" => $user['name_user']
			);
		}
		return $data;
	}

	public function getNamaMarketing($nama_marketing)
	{
		return $this->db->get_where('users', ['id_user' => $nama_marketing])->row_array();
	}

	public function dataJadwalrangeTanggaldanMarketing($start_date, $end_date, $nama_marketing)
	{
		$this->db->where("date_visit BETWEEN '$start_date' AND '$end_date'");
		$this->db->like('user_id', $nama_marketing);
		$this->db->join('users', 'id_user=user_id', 'left');
		$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
		return $this->db->get('m_jadwal_kunjungan');
	}

	public function totalRencanaKunjungan()
	{
		if ($this->session->userdata('role_user') == 1) {
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		}
	}

	public function totalPlanning()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('status', 'Planning');
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->where('status', 'Planning');
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		}
	}

	public function totalVisited()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('status', 'Visited');
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->where('status', 'Visited');
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		}
	}

	public function totalNotVisited()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('status', 'Not Visited');
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->where('status', 'Not Visited');
			$query = $this->db->get('m_jadwal_kunjungan');
			return $query->num_rows();
		}
	}

	public function ViewNotVisited($id)
	{
		$this->db->select('*');
		$this->db->join('m_instansi', 'instansi_id=instansi', 'left');
		$this->db->join('m_visit', 'm_visit_id=visit_id', 'left');
		$this->db->where('id_jadwal', $id);
		$query  = $this->db->get('m_jadwal_kunjungan');
		if ($query) {
			$row = $query->row();
			return json_encode(array('success'         	=> true,
				'id_jadwal'       	=> $row->id_jadwal,
				'instansi_nama'   	=> $row->instansi_nama,
				'm_visit_note'   		=> strip_tags($row->m_visit_note),
				'result_not_visited' => strip_tags($row->result_not_visited),
			));
		} else {
			return json_encode(array('success' => false, 'msg' => 'Data tidak ditemukan!'));
		}
	}

	public function ResultSimpan($id_jadwal, $notvisited)
	{
		$this->db->trans_start();
		$this->db->where('id_jadwal', $id_jadwal);
		$data = [
			'user_id'  					=> $this->session->userdata('id_user'),
			'result_not_visited'  	=> $notvisited,
			'status'       			=> "Not Visited",
			'updated_at' 				=> time()
		];
		$this->db->update('m_jadwal_kunjungan', $data);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Updated Result Gagal!'));
		} else {
			helper_log("edit", "Updated Result id: $id_jadwal");
			return json_encode(array('success' => true, 'msg' => 'Updated Result Success!'));
		}
	}

	public function dataTambahBaruKunjungan($id_jadwal)
	{
		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->where('YEAR(date_visit)', date('Y'));
		$this->db->from('m_jadwal_kunjungan as a');
		$this->db->join('m_instansi', 'instansi_id=instansi', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->join('users', 'user_id=id_user', 'left');
		return $this->db->get()->row_array();
	}

	public function SimpanKunjungan($id_jadwal, $m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $peserta_nama, $peserta_jabatan, $peserta_phone, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long)
	{
		date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
		$now1 = date('Y-m-d', strtotime($m_visit_tgl));
		$ref_date = strtotime($now1);
		$week_of_year = date('W', $ref_date);
		$now = date('Y-m-d H:i:s');
		$this->db->trans_start();
		$data = [
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => $m_visit_agenda,
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Add'
		];
		$this->db->insert('m_visit', $data);
		$id_visit = $this->db->insert_id();

		$data2 = [
			'm_visit_id'           	 => $id_visit,
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => $m_visit_agenda,
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Add'
		];
		$this->db->insert('m_visit_history', $data2);
		$id_visit_history = $this->db->insert_id();

		$this->db->insert('m_visit_group', array(
			'history'   => $id_visit_history,
			'visit'  			=> $id_visit,
		));

		$result = array();
		foreach ($peserta_nama as $key => $val) {
			$result[] = array(
				'peserta_nama'  	=> $peserta_nama[$key],
				'peserta_jabatan' => $peserta_jabatan[$key],
				'peserta_phone'   => $peserta_phone[$key],
				'id_users'      	=> $this->session->userdata('id_user'),
				'id_visit'      	=> $id_visit,
				'id_visit_history' => $id_visit_history,
				'created_at'    	=> time(),
			);
		}
		$this->db->insert_batch('m_visit_peserta', $result);

		$this->db->where('m_visit_id', $id_visit);
		$dataid = [
			'm_visit_history_id' => $id_visit_history,
		];
		$this->db->update('m_visit', $dataid);

		$datajadwal = [
			'visit_id'  			=> $id_visit,
			'vis_his_id'  			=> $id_visit_history,
			'status'  				=> 'Visited',
			'date_visit_done'  	=> $m_visit_tgl,
		];
		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->update('m_jadwal_kunjungan', $datajadwal);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Input data gagal!'));
		} else {
			helper_log("add", "Tambah Kunjungan Baru id jadwal: $id_jadwal");
			return json_encode(array('success' => true, 'msg' => 'Input data berhasil!'));
		}
	}

	public function PreviewdataUpdateVisit($m_visit_id)
	{
		$this->db->where('m_visit_history_id', $m_visit_id);
		$this->db->where('YEAR(m_visit_tgl)', date('Y'));
		$this->db->from('m_visit_history as a');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function PreviewdataUpdatePeserta($m_visit_history_id)
	{
		$this->db->where('id_visit_history', $m_visit_history_id);
		return $this->db->get('m_visit_peserta');
	}

	public function PreviewdataHistory($m_visit_id)
	{
		$this->db->where('m_visit_id', $m_visit_id);
		$this->db->where('YEAR(m_visit_tgl)', date('Y'));
		$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$this->db->order_by('m_visit_tgl', 'desc');
		return $this->db->get('m_visit_history');
	}

	public function UpdateSimpanKunjungan($id, $id_history, $m_visit_prov, $m_visit_kab, $m_visit_instansi, $m_visit_agenda, $m_visit_jam_mulai, $m_visit_jam_selesai, $m_visit_tgl, $peserta_nama, $peserta_jabatan, $peserta_phone, $m_visit_note, $m_visit_anggaran_BUMN, $m_visit_prospek, $m_visit_prognosa, $m_visit_estimasi_order, $m_visit_estimasi_tahun, $m_visit_status, $m_visit_koor_lat, $m_visit_koor_long)
	{
		date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
		$now1 = date('Y-m-d', strtotime($m_visit_tgl));
		$ref_date = strtotime($now1);
		$week_of_year = date('W', $ref_date);
		$now = date('Y-m-d H:i:s');

		$this->db->trans_start();
		$data = [
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => $m_visit_agenda,
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Update'
		];
		$this->db->where('m_visit_id', $id);
		$this->db->update('m_visit', $data);

		$data2 = [
			'm_visit_id'           	 => $id,
			'm_visit_prov'           => $m_visit_prov,
			'm_visit_kab'            => $m_visit_kab,
			'm_visit_instansi'       => $m_visit_instansi,
			'm_visit_agenda'         => $m_visit_agenda,
			'm_visit_jam_mulai'      => $m_visit_jam_mulai,
			'm_visit_jam_selesai'    => $m_visit_jam_selesai,
			'm_visit_tgl'            => $m_visit_tgl,
			'm_visit_week'           => $week_of_year,
			'm_visit_user_id'        => $this->session->userdata('id_user'),
			'm_visit_note'           => $m_visit_note,
			'm_visit_anggaran_BUMN'  => str_replace(",", "", $m_visit_anggaran_BUMN),
			'm_visit_prospek'        => str_replace(",", "", $m_visit_prospek),
			'm_visit_prognosa'       => str_replace(",", "", $m_visit_prognosa),
			'm_visit_estimasi_order' => $m_visit_estimasi_order,
			'm_visit_estimasi_tahun' => $m_visit_estimasi_tahun,
			'm_visit_status'         => $m_visit_status,
			'm_visit_koor_lat'       => str_replace(",", ".", $m_visit_koor_lat),
			'm_visit_koor_long'      => str_replace(",", ".", $m_visit_koor_long),
			'm_visit_date_created'   => $now,
			'm_visit_history'        => 'Update'
		];

		$this->db->insert('m_visit_history', $data2);
		$id_visit_history = $this->db->insert_id();

		$this->db->insert('m_visit_group', array(
			'history'   => $id_visit_history,
			'visit'  	=> $id,
		));

		$this->db->where('m_visit_id', $id);
		$dataid = [
			'm_visit_history_id' => $id_visit_history,
		];

		$this->db->update('m_visit', $dataid);

		$result = array();
		foreach ($peserta_nama as $key => $val) {
			$result[] = array(
				'peserta_nama'  	=> $peserta_nama[$key],
				'peserta_jabatan' => $peserta_jabatan[$key],
				'peserta_phone'   => $peserta_phone[$key],
				'id_users'      	=> $this->session->userdata('id_user'),
				'id_visit'      	=> $id,
				'id_visit_history' => $id_visit_history,
				'created_at'    	=> time(),
			);
		}
		$this->db->insert_batch('m_visit_peserta', $result);

		$datajadwal = [
			'done_visit_id'  			=> $id,
			'done_visit_history_id' => $id_visit_history,
			'status'  					=> 'Visited',
			'date_visit_done'  		=> $m_visit_tgl,
		];
		$this->db->where('vis_his_id', $id_history);
		$this->db->update('m_jadwal_kunjungan', $datajadwal);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update data gagal!'));
		} else {
			helper_log("add", "Tambah Kunjungan Update id instansi: $m_visit_instansi");
			return json_encode(array('success' => true, 'msg' => 'Update data berhasil!'));
		}
	}
}