<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_organisasi extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function index()
	{
		$this->db->order_by('org_id', 'desc');
		$data = $this->db->get('m_organisasi');
		return $data;
	}

	public function totalOrganisasi()
	{
		$query = $this->db->get('m_organisasi');
		return $query->num_rows();
	}

	public function TambahOrganisasi($org_nama, $org_email, $org_phone, $org_alamat, $wilayah, $provinsi, $kabupaten, $kecamatan)
	{
		$this->db->select('org_nama');
		$this->db->where('org_nama', $org_nama);
		$query  = $this->db->get('m_organisasi');
		$row = $query->num_rows();
		if ($row > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Organisasi gagal, Nama Organisasi sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('m_organisasi', array(
				'org_nama'  	=> ucwords($org_nama),
				'org_alamat'  	=> $org_alamat,
				'org_phone'  	=> $org_phone,
				'org_email'  	=> $org_email,
				'org_wil'  		=> $wilayah,
				'org_prov'  	=> $provinsi,
				'org_kab'  		=> $kabupaten,
				'org_kec'  		=> $kecamatan,
				'org_status'  	=> 1,
				'created_at' 	=> time()
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Tambah Orgnasasi gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Tambah Organisasi berhasil!'));
			}
		}
	}

	public function dataEdit($id)
	{
		$this->db->join('m_wilayah', 'wilayah_id=org_wil', 'left');
		$this->db->join('m_provinsi', 'id_prov=org_prov', 'left');
		$this->db->join('m_kabupaten', 'id_kab=org_kab', 'left');
		$this->db->join('m_kecamatan', 'id_kec=org_kec', 'left');
		return $this->db->get_where('m_organisasi', ['org_id' => $id])->row_array();
	}

	public function UpdateOrganisasi($org_id, $org_nama, $org_email, $org_phone, $org_alamat, $wilayah, $provinsi, $kabupaten, $kecamatan)
	{
		$this->db->trans_start();
		$this->db->where('org_id', $org_id);
		$this->db->update('m_organisasi', array(
			'org_nama'  	=> ucwords($org_nama),
			'org_alamat'  	=> $org_alamat,
			'org_phone'  	=> $org_phone,
			'org_email'  	=> $org_email,
			'org_wil'  		=> $wilayah,
			'org_prov'  	=> $provinsi,
			'org_kab'  		=> $kabupaten,
			'org_kec'  		=> $kecamatan,
			'org_status'  	=> 1,
			'updated_at' 	=> time()
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
		$this->db->delete('m_organisasi', array('org_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Organisasi Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Organisasi Berhasil!'));
		}
	}
}
