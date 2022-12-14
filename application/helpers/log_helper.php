<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function helper_log($tipe = "", $str = "")
{
	$CI = &get_instance();

	if (strtolower($tipe) == "login") {
		$log_tipe = "Login";
	} elseif (strtolower($tipe) == "logout") {
		$log_tipe = 'Logout';
	} elseif (strtolower($tipe) == "add") {
		$log_tipe = 'Add';
	} elseif (strtolower($tipe) == "edit") {
		$log_tipe = 'Edit';
	} elseif (strtolower($tipe) == "delete") {
		$log_tipe = 'Delete';
	} elseif (strtolower($tipe) == "update") {
		$log_tipe = 'Update';
	} else {
		$log_tipe = 'Klik';
	}

	// paramter
	$param['log_user'] = $CI->session->userdata('id_user');
	$param['log_tipe'] = $log_tipe;
	$param['log_desc'] = $str;

	//load model log
	$CI->load->model('M_log');

	//save to database
	$CI->M_log->save_log($param);
}