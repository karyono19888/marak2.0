<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function is_login()
{
	$ci = &get_instance();

	if (!$ci->session->userdata('is_login')) {
		$ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					<div class="alert-body d-flex align-items-center">
						<i data-feather="info" class="me-50"></i>
						<span><strong>Expired</strong> Session your login expired.</span>
					</div></div>');
		redirect('Auth');
	} else {
		$role_id = $ci->session->userdata('role_user');

		$menu = $ci->uri->segment(1);

		$queryMenu = $ci->db->get_where('user_menu', ['menu_name' => $menu])->row_array();

		$menu_id = $queryMenu['id_menu'];

		$userAccess = $ci->db->get_where('user_access_menu', [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		]);


		if ($userAccess->num_rows() < 1) {
			redirect('Auth/Blocked');
		}
	}
}
