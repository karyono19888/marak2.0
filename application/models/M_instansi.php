<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_instansi extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function index()
	{
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$this->db->order_by('instansi_id', 'desc');
		$query = $this->db->get('m_instansi');
		return $query;
	}

	public function TotalSemuaPelanggan()
	{
		$query = $this->db->get('m_instansi');
		return $query->num_rows();
	}

	public function TotalPemerintahan()
	{
		$this->db->where('instansi_kategori', 'Pemerintahan');
		$query = $this->db->get('m_instansi');
		return $query->num_rows();
	}

	public function TotalSwasta()
	{
		$this->db->where('instansi_kategori', 'Swasta');
		$query = $this->db->get('m_instansi');
		return $query->num_rows();
	}

	public function TotalPerorangan()
	{
		$this->db->where('instansi_kategori', 'Perorangan');
		$query = $this->db->get('m_instansi');
		return $query->num_rows();
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


	public function TambahInstansi($instansi_kategori, $instansi_nama, $instansi_alamat, $wilayah, $provinsi, $kabupaten)
	{
		$this->db->select('instansi_nama');
		$this->db->where('instansi_nama', $instansi_nama);
		$query  = $this->db->get('m_instansi');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Instansi gagal, Nama Instansi sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('m_instansi', array(
				'instansi_kategori'  => $instansi_kategori,
				'instansi_nama'      => $instansi_nama,
				'instansi_alamat'		=> $instansi_alamat,
				'instansi_wil' 		=> $wilayah,
				'instansi_prov'   	=> $provinsi,
				'instansi_kab' 		=> $kabupaten,
				'instansi_lok' 		=> 'Belum Penlok',
				'instansi_user_id' 	=> $this->session->userdata('id_user'),
				'created_at' 			=> time()
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Tambah Isntansi gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Tambah Instansi berhasil!'));
			}
		}
	}

	public function editInstansi($id)
	{
		$this->db->join('m_wilayah', 'wilayah_id=instansi_wil', 'left');
		$this->db->join('m_provinsi', 'id_prov=instansi_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=instansi_kab', 'left');
		$instansi = $this->db->get_where('m_instansi', ['instansi_id' => $id])->row_array();
		return $instansi;
	}

	public function UpdateInstansi($instansi_id, $instansi_kategori, $instansi_nama, $instansi_alamat, $wilayah, $provinsi, $kabupaten)
	{
		$this->db->trans_start();
		$this->db->where('instansi_id', $instansi_id);
		$this->db->update('m_instansi', array(
			'instansi_kategori'  => $instansi_kategori,
			'instansi_nama'      => $instansi_nama,
			'instansi_alamat'    => $instansi_alamat,
			'instansi_wil'      	=> $wilayah,
			'instansi_prov'      => $provinsi,
			'instansi_kab'       => $kabupaten,
			'updated_at' 			=> time()
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update Instansi gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Update Instansi berhasil!'));
		}
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_instansi', array('instansi_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Instansi Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Instansi Berhasil!'));
		}
	}
}
