<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_masterTipe extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function totalItem()
	{
		return $this->db->get('m_tipe')->num_rows();
	}

	public function totalAktif()
	{
		$this->db->where('m_tipe_status', "Aktif");
		return $this->db->get('m_tipe')->num_rows();
	}

	public function totalTidakAktif()
	{
		$this->db->where('m_tipe_status', "Tidak Aktif");
		return $this->db->get('m_tipe')->num_rows();
	}

	public function DataTable()
	{
		$this->db->order_by('m_tipe_id', 'desc');
		return $this->db->get('m_tipe');
	}

	public function TambahTipe($m_tipe_kode, $m_tipe_nama, $m_tipe_status, $m_tipe_deskripsi)
	{
		$nama = $this->db->get_where('m_tipe', ['m_tipe_nama' => $m_tipe_nama])->num_rows();
		$kode = $this->db->get_where('m_tipe', ['m_tipe_kode' => $m_tipe_kode])->num_rows();

		if ($nama > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Tipe Gagal, Nama Tipe sudah ada!'));
		} else if ($kode > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Tipe Gagal, Kode Tipe sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('m_tipe', array(
				'm_tipe_nama'       => ucwords($m_tipe_nama),
				'm_tipe_kode'       => strtoupper($m_tipe_kode),
				'm_tipe_status'     => $m_tipe_status,
				'm_tipe_deskripsi'  => $m_tipe_deskripsi,
				'created_at'     	  => time(),
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Tambah Tipe gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Tambah Tipe Baru Berhasil!'));
			}
		}
	}

	public function ShowDataEdit($id)
	{
		$this->db->where('m_tipe_id', $id);
		$this->db->order_by('m_tipe_id', 'desc');
		return $this->db->get('m_tipe')->row_array();
	}

	public function EditTipe($m_tipe_id, $m_tipe_kode, $m_tipe_nama, $m_tipe_status, $m_tipe_deskripsi)
	{
		$this->db->trans_start();
		$this->db->where('m_tipe_id', $m_tipe_id);
		$this->db->update('m_tipe', array(
			'm_tipe_nama'       => ucwords($m_tipe_nama),
			'm_tipe_kode'       => strtoupper($m_tipe_kode),
			'm_tipe_status'     => $m_tipe_status,
			'm_tipe_deskripsi'  => $m_tipe_deskripsi,
			'updated_at'     	 => time(),
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update Tipe Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Update Tipe Berhasil!'));
		}
	}

	public function DeleteTipe($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_tipe', array('m_tipe_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Tipe Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Tipe Berhasil!'));
		}
	}
}
