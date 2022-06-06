<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_tools extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function index()
	{
		$this->db->join('m_organisasi', 'org_id=tools_owner', 'left');
		return $this->db->get('m_tools');
	}

	public function getOwner($searchTerm = "")
	{
		$this->db->select('*');
		$this->db->where("org_nama like '%" . $searchTerm . "%' ");
		$this->db->order_by('org_id', 'asc');
		$fetched_records = $this->db->get('m_organisasi');
		$datowner = $fetched_records->result_array();
		$data = array();
		foreach ($datowner as $a) {
			$data[] = array(
				"id"   => $a['org_id'],
				"text" => $a['org_nama']
			);
		}
		return $data;
	}

	public function UploadTools($new_data)
	{
		$this->db->trans_start();
		$this->db->insert('m_tools', $new_data);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}

	public function EditUploadTools($new_data, $tools_id)
	{
		$this->db->trans_start();
		$this->db->set('tools_id');
		$this->db->where('tools_id', $tools_id);
		$this->db->update('m_tools', $new_data);

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}

	public function DataTools($id)
	{
		$this->db->join('m_organisasi', 'org_id=tools_owner', 'left');
		return $this->db->get_where('m_tools', ['tools_id' => $id])->row_array();
	}

	public function Delete($id)
	{
		$this->db->trans_start();
		$old_file = $this->db->get_where('m_tools', ['tools_id' => $id])->row_array();
		unlink(FCPATH . '/assets/tools/' . $old_file['tools_upload']);
		$this->db->delete('m_tools', array('tools_id' => $id));
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return json_encode(array('success' => false, 'msg' => 'Hapus Tools Gagal!'));
		} else {
			return json_encode(array('success' => true, 'msg' => 'Hapus Tools Berhasil!'));
		}
	}

}
