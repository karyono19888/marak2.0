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
		$this->db->join('users', 'id_user=m_instansi_user_id', 'left');
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
				'instansi_nama'      => ucwords($instansi_nama),
				'instansi_alamat'		=> ucwords($instansi_alamat),
				'instansi_wil' 		=> $wilayah,
				'instansi_prov'   	=> $provinsi,
				'instansi_kab' 		=> $kabupaten,
				'm_instansi_lok' 		=> 'Belum Penlok',
				'm_instansi_user_id' => $this->session->userdata('id_user'),
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Tambah Isntansi gagal!'));
			} else {
				helper_log("add", "Tambah Instansi $instansi_nama");
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
			'instansi_nama'      => ucwords($instansi_nama),
			'instansi_alamat'    => ucwords($instansi_alamat),
			'instansi_wil'      	=> $wilayah,
			'instansi_prov'      => $provinsi,
			'instansi_kab'       => $kabupaten,
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update Instansi gagal!'));
		} else {
			helper_log("edit", "Edit Instansi $instansi_nama");
			return json_encode(array('success' => true, 'msg' => 'Update Instansi berhasil!'));
		}
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$nama = $this->db->get_where('m_instansi', ['instansi_id' => $id])->row_array();
		$nama_instansi = $nama['instansi_nama'];
		$this->db->delete('m_instansi', array('instansi_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Instansi Gagal!'));
		} else {
			helper_log("delete", "Hapus Instansi '$nama_instansi");
			return json_encode(array('success' => true, 'msg' => 'Hapus Instansi Berhasil!'));
		}
	}

	public function searchinstansi()
	{
		return $this->db->get('m_instansi')->result();
	}

	public function TambahInstansiKunjungan($instansi_kategori, $instansi_nama, $instansi_alamat, $wilayah, $provinsi, $kabupaten)
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
				'instansi_nama'      => ucwords($instansi_nama),
				'instansi_alamat'		=> ucwords($instansi_alamat),
				'instansi_wil' 		=> $wilayah,
				'instansi_prov'   	=> $provinsi,
				'instansi_kab' 		=> $kabupaten,
				'm_instansi_lok' 		=> 'Belum Penlok',
				'm_instansi_user_id' 	=> $this->session->userdata('id_user'),
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Tambah Instansi gagal!'));
			} else {
				helper_log("add", "Tambah Instansi $instansi_nama");
				return json_encode(array('success' => true, 'msg' => 'Tambah Instansi berhasil!'));
			}
		}
	}
}