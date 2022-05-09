<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_profile extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function myprofile()
	{
		$this->db->select('*');
		$this->db->join('user_role', 'role_id=role_user', 'left');
		$this->db->where('username', $this->session->userdata('username'));
		return $this->db->get('users')->row();
	}
}
