<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_absensi extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function saveAbsensiMAsuk($nik, $image)
	{
		date_default_timezone_set('Asia/Jakarta');
		$clocknow 	= date("H:i:s");
		$today     	= date('Y-m-d');
		$image 		= str_replace('data:image/jpeg;base64,', '', $image);
		$image 		= base64_decode($image);
		$filename 	= 'absenMasuk_' . time() . '.png';

		$cekData = $this->db->get_where('m_absensi_karyawan', ['nik' => $nik])->row_array();
		if ($cekData) {
			if ($this->db->get_where('m_absensi_karyawan', ['tanggal' => $today, 'nik' => $nik])->row_array()) {
				$data = [
					'jam_masuk' => $clocknow
				];
				$this->db->where('tanggal', $today)->where('nik', $nik);
				$this->db->update('m_absensi_karyawan', $data);
				return json_encode(array('success' => false, 'msg' => 'Sudah Absen'));
			} else {
				$this->db->insert('m_absensi_karyawan', array(
					'nik'  		=> $nik,
					'image'     => $filename,
					'tanggal'   => $today,
					'jam_masuk'	=> $clocknow,
				));
				file_put_contents(FCPATH . '/uploads/' . $filename, $image);
				return json_encode(array('success' => true, 'msg' => 'Terimakasih!', 'image' => $filename));
			}
		} else {
			return json_encode(array('success' => false, 'msg' => 'Anda Belum Terdaftar!'));
		}
	}
}
