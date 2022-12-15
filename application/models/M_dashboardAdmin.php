<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboardAdmin extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
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

	public function TotalClosebyAmmount()
	{
		$this->db->where('YEAR(t_order_tgl)', date('Y'));
		$this->db->where('t_order_status', 'Close PO');
		$this->db->select_sum('t_order_grandtotal');
		$query = $this->db->get('t_order_po');
		if ($query->num_rows() > 0) {
			return $query->row()->t_order_grandtotal;
		} else {
			return 0;
		}
	}

	public function TotalClosebyecataloge()
	{
		$this->db->where('YEAR(t_order_tgl)', date('Y'));
		$this->db->where('t_order_status', 'Close PO');
		$this->db->where('t_order_kategori', 'E-Catalog');
		$this->db->select_sum('t_order_grandtotal');
		$query = $this->db->get('t_order_po');
		if ($query->num_rows() > 0) {
			return $query->row()->t_order_grandtotal;
		} else {
			return 0;
		}
	}

	public function TotalClosebyNonecataloge()
	{
		$this->db->where('YEAR(t_order_tgl)', date('Y'));
		$this->db->where('t_order_status', 'Close PO');
		$this->db->where('t_order_kategori', 'Non E-Catalog');
		$this->db->select_sum('t_order_grandtotal');
		$query = $this->db->get('t_order_po');
		if ($query->num_rows() > 0) {
			return $query->row()->t_order_grandtotal;
		} else {
			return 0;
		}
	}

	public function TotalNewPo()
	{
		$this->db->where('YEAR(t_req_tgl)', date('Y'));
		$this->db->where('t_req_status', 'Request');
		$query = $this->db->get('t_order_request');
		return $query->num_rows();
	}

	public function NewPoUser()
	{
		$this->db->join('users', 'id_user=t_req_user', 'left');
		$this->db->where('YEAR(t_req_tgl)', date('Y'));
		$this->db->where('t_req_status', 'Request');
		$this->db->group_by('t_req_user');
		return $this->db->get('t_order_request');
	}

	public function LogActivity()
	{
		$this->db->where('YEAR(log_time)', date('Y'));
		$this->db->join('users', 'id_user=log_user', 'left');
		$this->db->join('user_role', 'role_id=role_user', 'left');
		$this->db->order_by('log_id', 'desc');
		return $this->db->get('t_log');
	}
}