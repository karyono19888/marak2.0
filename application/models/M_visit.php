<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_visit extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
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

	public function TotalKunjungan()
	{
		if ($this->session->userdata('role_user') == 1) {
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		}
	}

	public function TotalKunjunganPrognosa()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('m_visit_status', 'Prognosa');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('m_visit_status', 'Prognosa');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		}
	}
	public function TotalKunjunganClose()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('m_visit_status', 'Close Po');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('m_visit_status', 'Close Po');
			$query = $this->db->get('m_visit');
			return $query->num_rows();
		}
	}
}
