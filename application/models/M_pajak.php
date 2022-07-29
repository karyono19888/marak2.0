<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pajak extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function totalItem()
	{
		return $this->db->get('m_pajak')->num_rows();
	}

	public function totalAktif()
	{
		$this->db->where('m_pajak_status', "Aktif");
		return $this->db->get('m_pajak')->num_rows();
	}

	public function totalTidakAktif()
	{
		$this->db->where('m_pajak_status', "Tidak Aktif");
		return $this->db->get('m_pajak')->num_rows();
	}

	public function DataTable()
	{
		$this->db->order_by('m_pajak_id', 'desc');
		return $this->db->get('m_pajak');
	}

	public function TambahPajak($m_pajak_nama, $m_pajak_nilai, $m_pajak_persen, $m_pajak_ket, $m_pajak_status)
	{
		$this->db->trans_start();
		$this->db->insert('m_pajak', array(
			'm_pajak_nama'    => strtoupper($m_pajak_nama),
			'm_pajak_nilai'   => $m_pajak_nilai,
			'm_pajak_persen'  => $m_pajak_persen,
			'm_pajak_ket'     => ucwords($m_pajak_ket),
			'm_pajak_status'  => $m_pajak_status,
			'created_at'     	=> time(),
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Tambah Pajak gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Tambah Pajak Baru Berhasil!'));
		}
	}

	public function EditPajak($m_pajak_id, $m_pajak_nama, $m_pajak_nilai, $m_pajak_persen, $m_pajak_ket, $m_pajak_status)
	{
		$this->db->trans_start();
		$this->db->where('m_pajak_id', $m_pajak_id);
		$this->db->update('m_pajak', array(
			'm_pajak_nama'    => strtoupper($m_pajak_nama),
			'm_pajak_nilai'   => $m_pajak_nilai,
			'm_pajak_persen'  => $m_pajak_persen,
			'm_pajak_ket'     => ucwords($m_pajak_ket),
			'm_pajak_status'  => $m_pajak_status,
			'created_at'     	=> time(),
		));

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Edit Pajak gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Edit Pajak Baru Berhasil!'));
		}
	}

	public function ShowDataEdit($id)
	{
		$this->db->where('m_pajak_id', $id);
		return $this->db->get('m_pajak')->row_array();
	}

	public function PajakDelete($id)
	{
		$this->db->trans_start();
		$this->db->delete('m_pajak', array('m_pajak_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Pajak Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Pajak Berhasil!'));
		}
	}
}
