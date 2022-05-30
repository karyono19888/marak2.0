<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_wilayah extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}


	function getwil($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where("wilayah_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('wilayah_id', 'asc');
		$fetched_records = $this->db->get('m_wilayah');
		$datawil = $fetched_records->result_array();
		$data = array();
		foreach ($datawil as $wil) {
			$data[] = array(
				"id"   => $wil['wilayah_id'],
				"text" => $wil['wilayah_nama']
			);
		}
		return $data;
	}

	function getprov($wilayah_id, $searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('wilayah_id', $wilayah_id);
		$this->db->where("prov_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('id_prov', 'asc');
		$fetched_records = $this->db->get('m_provinsi');
		$dataprov = $fetched_records->result_array();
		$data = array();
		foreach ($dataprov as $prov) {
			$data[] = array(
				"id"   => $prov['id_prov'],
				"text" => $prov['prov_nama']
			);
		}
		return $data;
	}

	function getkab($id_prov, $searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('id_prov', $id_prov);
		$this->db->where("kab_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('id_kab', 'asc');
		$fetched_records = $this->db->get('m_kabupaten');
		$datakab = $fetched_records->result_array();

		$data = array();
		foreach ($datakab as $kab) {
			$data[] = array(
				"id"   => $kab['id_kab'],
				"text" => $kab['kab_nama']
			);
		}
		return $data;
	}

	function getkec($id_kab, $searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('id_kab', $id_kab);
		$this->db->where("nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('id_kec', 'asc');
		$fetched_records = $this->db->get('m_kecamatan');
		$datakec = $fetched_records->result_array();

		$data = array();
		foreach ($datakec as $kec) {
			$data[] = array(
				"id"   => $kec['id_kec'],
				"text" => $kec['nama']
			);
		}
		return $data;
	}
}
