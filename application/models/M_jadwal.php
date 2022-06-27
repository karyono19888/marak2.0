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
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
			$query = $this->db->get('m_jadwal_kunjungan');
		} else {
			$this->db->where('user_id', $this->session->userdata('id_user'));
			$this->db->join('users', 'id_user=user_id', 'left');
			$this->db->join('m_instansi as a', 'a.instansi_id=instansi', 'left');
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
			return json_encode(array('success' => true, 'msg' => 'Tambah Jadwal Berhasil!'));
		}
	}

	public function TambahJadwalUpdate($instansi_id, $m_visit_id, $date_visit, $time, $type_alamat, $type_act, $acara)
	{
		$this->db->trans_start();
		$this->db->insert('m_jadwal_kunjungan', array(
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
			'created_at' 	=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Jadwal Gagal!'));
		} else {
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
		$this->db->where('id_jadwal', $id);
		$query  = $this->db->get('m_jadwal_kunjungan');
		if ($query) {
			$row = $query->row();
			return json_encode(array(
				'success'         => true,
				'id_jadwal'       => $row->id_jadwal,
				'instansi_nama'   => $row->instansi_nama,
				'result_not_visited'   	=> $row->result_not_visited,
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
			return json_encode(array('success' => true, 'msg' => 'Updated Result Success!'));
		}
	}

}
