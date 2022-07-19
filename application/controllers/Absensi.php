<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('M_absensi', 'record');
	}

	public function index()
	{
		$this->load->view('Absensi/v_index');
	}

	public function PilihAbsen()
	{
		$this->load->view('Absensi/v_selectAbsen');
	}

	public function ShowAbsenMasuk()
	{
		$this->load->view('Absensi/v_absensiMasuk');
	}

	public function ShowAbsenPulang()
	{
		$this->load->view('Absensi/v_absensiPulang');
	}

	public function saveAbsensiMAsuk()
	{

		$nik 			= $this->input->post('nik', true);
		$image 		= $this->input->post('image');

		echo $this->record->saveAbsensiMAsuk($nik, $image);
	}
}
