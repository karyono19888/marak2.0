<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_administrator extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
	}
}
