<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
	<div class="navbar-header">
		<ul class="nav navbar-nav flex-row">
			<li class="nav-item me-auto">
				<a class="navbar-brand" href="#">
					<span class="brand-logo">
						<img src="<?= base_url('assets'); ?>/images/logo/logo.png" alt="logo-brand" width="200%">
					</span>
					<h2 class="brand-text">Marak</h2>
				</a>
			</li>
			<li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
		</ul>
	</div>
	<div class="shadow-bottom"></div>
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<?php
			$role_id = $this->session->userdata('role_user');
			$this->db->select('*');
			$this->db->where('role_id', $role_id);
			$this->db->join('user_menu', 'id_menu=menu_id', 'left');
			$this->db->order_by('menu_id', 'asc');
			$queryMenu  = $this->db->get('user_access_menu');
			?>
			<?php foreach ($queryMenu->result() as $m) : ?>
				<li class=" navigation-header">
					<span data-i18n="Apps &amp; Pages"><?= $m->menu_name; ?></span>
					<i data-feather="more-horizontal"></i>

					<?php
					$menu_id = $m->id_menu;
					$this->db->select('*');
					$this->db->where('menu_id', $menu_id)
						->where('is_active', 1);
					$this->db->join('user_menu', 'id_menu=menu_id', 'left');
					$mainMenu  = $this->db->get('user_sub_menu');
					?>

					<?php foreach ($mainMenu->result() as $sm) : ?>
						<?php
						$this->db->select('*');
						$this->db
							->where('menu_parentId', $sm->id)
							->where('is_active', 1);
						$this->db->join('user_menu', 'id_menu=menu_id', 'left');
						$subMenu  = $this->db->get('user_sub_menu');
						?>
						<?php if ($subMenu->num_rows() > 0) : ?>
				<li class=" nav-item <?= $this->uri->segment(2) == $sm->menu_nama ? 'has-sub sidebar-group-active open' : '' ?>">
					<a class="d-flex align-items-center" href="<?= base_url($sm->menu_url) ?>">
						<i data-feather="<?= $sm->menu_icon; ?>"></i>
						<span class="menu-title text-truncate"><?= $sm->menu_nama; ?></span>
					</a>
					<ul class="menu-content">
						<?php foreach ($subMenu->result() as $sub) : ?>
							<li class="<?= $this->uri->segment(2) == $sub->menu_nama ? 'active' : '' ?>">
								<a class="d-flex align-items-center" href="<?= base_url($sub->menu_url); ?>">
									<i data-feather="<?= $sub->menu_sub_icon; ?>"></i>
									<span class="menu-item text-truncate"><?= $sub->menu_nama; ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</li>
			<?php else : ?>
				<li class=" nav-item <?= $this->uri->segment(1) == $sm->menu_url ? 'active' : '' ?>">
					<a class="d-flex align-items-center" href="<?= base_url($sm->menu_url); ?>">
						<i data-feather="<?= $sm->menu_icon; ?>"></i>
						<span class="menu-title text-truncate" data-i18n="Typography"><?= $sm->menu_nama; ?></span>
					</a>
				</li>
			<?php endif; ?>

		<?php endforeach; ?>
	<?php endforeach; ?>
	</li>

	<li class=" navigation-header"><span data-i18n="Misc">APP</span><i data-feather="more-horizontal"></i>
	</li>
	<li class="nav-item"><a class="d-flex align-items-center" href="#" onclick="Logout()"><i data-feather="log-out"></i><span class="menu-title text-truncate">Logout</span></a>
	</li>
		</ul>
	</div>
</div>