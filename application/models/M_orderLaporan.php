<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_orderLaporan extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function UserMarketing($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('is_active', 1);
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

	public function getDataShowSummaryOrderTanggal($start, $end)
	{
		$this->db->select("*");
		$this->db->where('t_order_tgl >=', date('Y-m-d', strtotime($start)));
		$this->db->where('t_order_tgl <=', date('Y-m-d', strtotime($end)));
		$this->db->join('m_visit', 'm_visit_id=t_order_visit_id', 'left');
		$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
		$this->db->join('users', 't_order_agent=id_user', 'left');
		$this->db->order_by('t_order_tgl', 'desc');
		return $this->db->get('t_order_po');
	}

	public function getDataShowSummaryOrderMarketing($start, $end, $user)
	{
		$this->db->select("*");
		$this->db->where('t_order_tgl >=', date('Y-m-d', strtotime($start)));
		$this->db->where('t_order_tgl <=', date('Y-m-d', strtotime($end)));
		$this->db->where('t_order_agent', $user);
		$this->db->join('m_visit', 'm_visit_id=t_order_visit_id', 'left');
		$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
		$this->db->join('users', 't_order_agent=id_user', 'left');
		$this->db->order_by('t_order_tgl', 'desc');
		return $this->db->get('t_order_po');
	}

	public function getDownloadDataLaporanOrderAllMarketing($start, $end)
	{
		$this->db->select("*");
		$this->db->where('t_order_tgl >=', date('Y-m-d', strtotime($start)));
		$this->db->where('t_order_tgl <=', date('Y-m-d', strtotime($end)));
		$this->db->join('m_visit', 'm_visit_id=t_order_visit_id', 'left');
		$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
		$this->db->join('users', 't_order_agent=id_user', 'left');
		$this->db->order_by('t_order_tgl', 'desc');
		return $this->db->get('t_order_po')->result();
	}

	public function getDownloadDataLaporanOrderUserMarketing($start, $end, $user)
	{
		$this->db->select("*");
		$this->db->where('t_order_tgl >=', date('Y-m-d', strtotime($start)));
		$this->db->where('t_order_tgl <=', date('Y-m-d', strtotime($end)));
		$this->db->where('t_order_agent', $user);
		$this->db->join('m_visit', 'm_visit_id=t_order_visit_id', 'left');
		$this->db->join('m_instansi', 'm_visit_instansi=instansi_id', 'left');
		$this->db->join('users', 't_order_agent=id_user', 'left');
		$this->db->order_by('t_order_tgl', 'desc');
		return $this->db->get('t_order_po')->result();
	}
}