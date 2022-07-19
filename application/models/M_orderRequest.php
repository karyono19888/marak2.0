<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_orderRequest extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function dataVisitAll()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prognosa');
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_status', 'Prognosa');
			$this->db->join('users', 'id_user=m_visit_user_id', 'left');
			$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
			$this->db->order_by('m_visit_tgl', 'desc');
			$query = $this->db->get('m_visit');
		}

		return $query;
	}

	public function DataKunjunganrequest($id)
	{
		$this->db->where('m_visit_history_id', $id);
		$this->db->join('users', 'id_user=m_visit_user_id', 'left');
		$this->db->join('m_instansi', 'instansi_id=m_visit_instansi', 'left');
		$this->db->order_by('m_visit_history_id', 'desc');
		$query = $this->db->get('m_visit_history');
		return $query->row_array();
	}

	public function DataOrganisasi()
	{
		# code...
	}
}
