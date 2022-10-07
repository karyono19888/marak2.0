<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_marketing extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function TotalApbn()
	{
		if ($this->session->userdata('role_user') == 1 || $this->session->userdata('role_user') == 22) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_anggaran_BUMN');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_anggaran_BUMN;
			} else {
				return 0;
			}
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_anggaran_BUMN');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_anggaran_BUMN;
			} else {
				return 0;
			}
		}
	}

	public function TotalProspek()
	{
		if ($this->session->userdata('role_user') == 1 || $this->session->userdata('role_user') == 22) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_prospek');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_prospek;
			} else {
				return 0;
			}
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_prospek');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_prospek;
			} else {
				return 0;
			}
		}
	}

	public function TotalPrognosa()
	{
		if ($this->session->userdata('role_user') == 1 || $this->session->userdata('role_user') == 22) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_prognosa');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_prognosa;
			} else {
				return 0;
			}
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_prognosa');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_prognosa;
			} else {
				return 0;
			}
		}
	}

	public function TotalClose()
	{
		if ($this->session->userdata('role_user') == 1 || $this->session->userdata('role_user') == 22) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_po');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_po;
			} else {
				return 0;
			}
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->select_sum('m_visit_po');
			$query = $this->db->get('m_visit');
			if ($query->num_rows() > 0) {
				return $query->row()->m_visit_po;
			} else {
				return 0;
			}
		}
	}

	public function TotalTargetMarketing()
	{
		if ($this->session->userdata('role_user') == 1 || $this->session->userdata('role_user') == 22) {
			$this->db->where('m_target_thn', date('Y'));
			$this->db->select_sum('m_target_jml');
			$query = $this->db->get('m_target_marketing');
			if ($query->num_rows() > 0) {
				return $query->row()->m_target_jml;
			} else {
				return 0;
			}
		} else {
			$this->db->where('m_target_user', $this->session->userdata('id_user'));
			$this->db->where('m_target_thn', date('Y'));
			$this->db->select_sum('m_target_jml');
			$query = $this->db->get('m_target_marketing');
			if ($query->num_rows() > 0) {
				return $query->row()->m_target_jml;
			} else {
				return 0;
			}
		}
	}

	public function TotalKunjungan()
	{
		if ($this->session->userdata('role_user') == 1) {
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$query = $this->db->get('m_visit_history');
			return $query->num_rows();
		} else {
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$query = $this->db->get('m_visit_history');
			return $query->num_rows();
		}
	}

	public function number_weekly()
	{
		$this->db->where('tahun', date('Y'));
		$query  = $this->db->get('weekly');
		return $query;
	}

	public function weekly()
	{
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d');
		$ref_date = strtotime($now);
		$weekYear = date('W', $ref_date);
		$value = $weekYear - 4;

		$this->db->where('tahun', date('Y'));
		$query  = $this->db->get('weekly');
		return $query;
	}

	public function TargetGroupbyMkt()
	{
		$this->db->where('YEAR(tanggal)', date('Y'));
		$this->db->join('users', 'id_user=User_id', 'left');
		// $this->db->join('target_by_thn_mkt', 'id_user=a_user_id', 'left');
		$this->db->where('User_id', $this->session->userdata('id_user'));
		$this->db->where('status_user', 1);
		return $this->db->get('grafik_pencapaian');
	}

	public function DataVisitMap()
	{
		if ($this->session->userdata('role_user') == 1 || $this->session->userdata('role_user') == 22) {
			$this->db->select('*');
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->order_by('m_visit_tgl', 'DESC');
			$this->db->join('users', 'm_visit_user_id=id_user', 'left');
			$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
			$this->db->join('m_kabupaten', 'm_visit_kab=id_kab', 'left');
			$query  = $this->db->get('m_visit');
		} else {
			$this->db->select('*');
			$this->db->where('YEAR(m_visit_tgl)', date('Y'));
			$this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
			$this->db->order_by('m_visit_tgl', 'DESC');
			$this->db->join('users', 'm_visit_user_id=id_user', 'left');
			$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
			$this->db->join('m_kabupaten', 'm_visit_kab=id_kab', 'left');
			$query  = $this->db->get('m_visit');
		}
		return $query;
	}
}
