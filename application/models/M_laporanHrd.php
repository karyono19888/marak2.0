<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_laporanHrd extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function getDataShowKunjungan($start, $end)
	{
		$this->db->select("*");
		$this->db->where('m_visit_tgl >=', date('Y-m-d', strtotime($start)));
		$this->db->where('m_visit_tgl <=', date('Y-m-d', strtotime($end)));
		$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$this->db->order_by('m_visit_tgl', 'desc');
		return $this->db->get('m_visit_history');
	}

	public function getDownloadDataLaporanKunjunganMarketing($start, $end)
	{
		$this->db->select("*");
		$this->db->where('m_visit_tgl >=', date('Y-m-d', strtotime($start)));
		$this->db->where('m_visit_tgl <=', date('Y-m-d', strtotime($end)));
		$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$this->db->order_by('m_visit_tgl', 'desc');
		return $this->db->get('m_visit_history')->result();
	}

	public function getDataShowSummaryOrder($start, $end)
	{
		$this->db->select("*");
		$this->db->where('m_visit_tgl >=', date('Y-m-d', strtotime($start)));
		$this->db->where('m_visit_tgl <=', date('Y-m-d', strtotime($end)));
		$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
		$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
		$this->db->join('users', 'm_visit_user_id=id_user', 'left');
		$this->db->order_by('m_visit_tgl', 'desc');
		return $this->db->get('m_visit_history');
	}
}
