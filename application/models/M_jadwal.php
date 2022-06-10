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
}
