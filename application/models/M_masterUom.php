<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_masterUom extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function totalItem()
	{
		return $this->db->get('m_uom')->num_rows();
	}

	public function totalAktif()
	{
		$this->db->where('m_uom_status', "Aktif");
		return $this->db->get('m_uom')->num_rows();
	}

	public function totalTidakAktif()
	{
		$this->db->where('m_uom_status', "Tidak Aktif");
		return $this->db->get('m_uom')->num_rows();
	}

	public function TambahUom($m_uom_nama, $m_uom_kode, $m_uom_symbol, $m_uom_deskripsi, $m_uom_status)
	{
		$nama = $this->db->get_where('m_uom', ['m_uom_nama' => $m_uom_nama])->num_rows();
		$kode = $this->db->get_where('m_uom', ['m_uom_kode' => $m_uom_kode])->num_rows();
		if ($nama > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Uom Gagal, Nama Uom sudah ada!'));
		} else if ($kode > 0) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Uom Gagal, Kode Uom sudah ada!'));
		} else {
			$this->db->trans_start();
			$this->db->insert('m_uom', array(
				'm_uom_nama'       => ucwords($m_uom_nama),
				'm_uom_kode'       => strtoupper($m_uom_kode),
				'm_uom_symbol'     => $m_uom_symbol,
				'm_uom_deskripsi'  => $m_uom_deskripsi,
				'm_uom_status'     => $m_uom_status,
				'created_at'     	 => time(),
			));

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return json_encode(array('success' => false, 'msg' => 'Tambah Uom gagal!'));
			} else {
				return json_encode(array('success' => true, 'msg' => 'Tambah Uom Baru Berhasil!'));
			}
		}
	}

	public function DataTable()
	{
		$this->db->order_by('m_uom_id', 'desc');
		return $this->db->get('m_uom');
	}

	public function ShowDataEdit($id)
	{
		$this->db->where('m_uom_id', $id);
		$this->db->order_by('m_uom_id', 'desc');
		return $this->db->get('m_uom')->row_array();
	}

	public function EditUom($m_uom_id, $m_uom_nama, $m_uom_kode, $m_uom_symbol, $m_uom_deskripsi, $m_uom_status)
	{
		$this->db->trans_start();
		$this->db->where('m_uom_id', $m_uom_id);
		$this->db->update('m_uom', array(
			'm_uom_nama'       => ucwords($m_uom_nama),
			'm_uom_kode'       => strtoupper($m_uom_kode),
			'm_uom_symbol'     => $m_uom_symbol,
			'm_uom_deskripsi'  => $m_uom_deskripsi,
			'm_uom_status'     => $m_uom_status,
			'updated_at'     	 => time(),
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Update Uom Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Update Uom Berhasil!'));
		}
	}

	public function UomDelete($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_uom', array('m_uom_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Uom Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Uom Berhasil!'));
		}
	}
}
