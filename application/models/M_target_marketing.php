<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_target_marketing extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function getTableData()
	{
		// $this->db->where('YEAR(m_target_thn)', date('Y'));
		$this->db->join('users', 'id_user=m_target_user', 'left');
		$this->db->order_by('m_target_id', 'desc');
		return $this->db->get('m_target_marketing');
	}

	public function showUserMarketing($searchTerm)
	{
		$this->db->select('*');
		$this->db->where('role_user', 2);
		$this->db->where("name_user like '%" . $searchTerm . "%' ");
		$this->db->order_by('id_user', 'asc');
		$fetched_records = $this->db->get('users');
		$datuser = $fetched_records->result_array();
		$data = array();
		foreach ($datuser as $user) {
			$data[] = array(
				"id"   => $user['id_user'],
				"text" => $user['name_user']
			);
		}
		return $data;
	}

	public function getProvinsi($searchTerm)
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

	public function SimpanTargetMarketing($marketing, $target, $tahun, $provinsi)
	{
		$this->db->trans_start();
		$this->db->insert('m_target_marketing', array(
			'm_target_user'   => $marketing,
			'm_target_jml'  	=> str_replace(",", "", $target),
			'm_target_thn'  	=> $tahun,
			'created_at'    	=> time(),
		));

		$result = array();
		foreach ($provinsi as $key => $val) {
			$result[] = array(
				'm_cover_prov_user'  => $marketing,
				'm_cover_prov_id' 	=> $provinsi[$key],
				'm_cover_prov_thn'   => $tahun,
				'created_at'    			=> time(),
			);
		}
		$this->db->insert_batch('m_area_cover_wilayah', $result);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Simpan data gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Simpan data berhasil!'));
		}
	}

	public function ViewEditTarget($id)
	{
		// $this->db->where('YEAR(m_target_thn)', date('Y'));
		$this->db->where('m_target_id', $id);
		$this->db->join('users', 'id_user=m_target_user', 'left');
		$this->db->order_by('m_target_id', 'desc');
		return $this->db->get('m_target_marketing')->row_array();
	}

	public function EditTargetMarketing($marketing, $target, $tahun, $provinsi)
	{
		$this->db->trans_start();
		$this->db->where('m_target_user', $marketing);
		$this->db->like('m_target_thn', $tahun);
		$this->db->update('m_target_marketing', array(
			'm_target_user'   => $marketing,
			'm_target_jml'  	=> str_replace(",", "", $target),
			'm_target_thn'  	=> $tahun,
			'created_at'    	=> time(),
		));
		// delete wilayah
		$this->db->delete('m_area_cover_wilayah', array('m_cover_prov_user' => $marketing, 'm_cover_prov_thn' => $tahun));

		$result = array();
		foreach ($provinsi as $key => $val) {
			$result[] = array(
				'm_cover_prov_user'  => $marketing,
				'm_cover_prov_id' 	=> $provinsi[$key],
				'm_cover_prov_thn'   => $tahun,
				'created_at'    			=> time(),
			);
		}
		$this->db->insert_batch('m_area_cover_wilayah', $result);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Edit data gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Edit data berhasil!'));
		}
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$data = $this->db->get_where('m_target_marketing', ['m_target_id' => $id])->row_array();

		$this->db->delete('m_target_marketing', array('m_target_id' => $id));
		$this->db->delete('m_area_cover_wilayah', array('m_cover_prov_user' => $data['m_target_user'], 'm_cover_prov_thn' => $data['m_target_thn']));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Peserta Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Peserta Berhasil!'));
		}
	}

	public function TotalUsers()
	{
		$this->db->where('m_target_thn', date('Y'));
		$query = $this->db->get('m_target_marketing');
		return $query->num_rows();
	}

	public function TotalTarget()
	{
		$this->db->where('m_target_thn', date('Y'));
		$this->db->select_sum('m_target_jml');
		$query = $this->db->get('m_target_marketing');
		if ($query->num_rows() > 0) {
			return $query->row()->m_target_jml;
		} else {
			return 0;
		}
	}

	public function TotalWilayah()
	{
		$this->db->where('m_cover_prov_thn', date('Y'));
		$query = $this->db->get('m_area_cover_wilayah');
		return $query->num_rows();
	}

	public function UserTargetNol()
	{
		$this->db->where('m_target_thn', date('Y'));
		$this->db->where('m_target_jml', 0);
		$query = $this->db->get('m_target_marketing');
		return $query->num_rows();
	}

}
