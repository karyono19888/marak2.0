<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_product extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function GetUom($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('m_uom_status', "Aktif");
		$this->db->where("m_uom_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('m_uom_id', 'asc');
		$fetched_records = $this->db->get('m_uom');
		$datauom = $fetched_records->result_array();
		$data = array();
		foreach ($datauom as $uom) {
			$data[] = array(
				"id"   => $uom['m_uom_id'],
				"text" => $uom['m_uom_nama']
			);
		}
		return $data;
	}
}
