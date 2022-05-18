<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function check_access($role_id, $id_menu)
{
	$ci = &get_instance();

	$ci->db->where('role_id', $role_id);
	$ci->db->where('menu_id', $id_menu);
	$result = $ci->db->get('user_access_menu');

	if ($result->num_rows() > 0) {
		return "checked";
	}
}
