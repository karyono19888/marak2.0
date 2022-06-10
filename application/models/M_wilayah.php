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


	// data jadwal kunjungan
	function Provinsi($searchTerm = "")
	{
		$this->db->select('*');
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

	function Kabupaten($id_prov, $searchTerm = "")
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

	function Instansi($id_kab, $searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('instansi_kab', $id_kab);
		$this->db->where("instansi_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('instansi_id', 'asc');
		$fetched_records = $this->db->get('m_instansi');
		$datakab = $fetched_records->result_array();

		$data = array();
		foreach ($datakab as $kab) {
			$data[] = array(
				"id"   => $kab['instansi_id'],
				"text" => $kab['instansi_nama']
			);
		}
		return $data;
	}

	// tambah data jadwal kunjungan update
	function Provinsi2($searchTerm = "")
	{
		$this->db->select('*');
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

	function Kabupaten2($id_prov, $searchTerm = "")
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

	function Instansi2($id_kab, $searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where('m_visit_kab', $id_kab);
		// $this->db->where('m_visit_user_id', $this->session->userdata('id_user'));
		$this->db->join('m_instansi as a', 'a.instansi_id=m_visit_instansi', 'left');
		// $this->db->where("instansi_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('visit_id', 'asc');
		$fetched_records = $this->db->get('m_visit');
		$datakab = $fetched_records->result_array();

		$data = array();
		foreach ($datakab as $kab) {
			$data[] = array(
				"id"   => $kab['m_visit_id'],
				"text" => $kab['instansi_nama']
			);
		}
		return $data;
	}
}
