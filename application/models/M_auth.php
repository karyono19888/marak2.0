<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}

	public function registration($data)
	{
		$this->db->insert('users', $data);
	}
}
