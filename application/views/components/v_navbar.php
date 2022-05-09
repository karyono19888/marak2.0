<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
	<div class="navbar-container d-flex content">
		<div class="bookmark-wrapper d-flex align-items-center">
			<ul class="nav navbar-nav d-xl-none">
				<li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li class="nav-item d-none d-lg-block">
					<div class="bookmark-input search-input">
						<div class="bookmark-input-icon"><i data-feather="search"></i></div>
						<input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
						<ul class="search-list search-list-bookmark"></ul>
					</div>
				</li>
			</ul>
		</div>
		<ul class="nav navbar-nav align-items-center ms-auto">
			<li class="nav-item dropdown dropdown-language">
				<a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-id"></i><span class="selected-language">Indonesia</span></a>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
					<a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a>
					<a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-id"></i> Indonesia</a>
				</div>
			</li>
			<li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
			<li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
				<div class="search-input">
					<div class="search-input-icon"><i data-feather="search"></i></div>
					<input class="form-control input" type="text" placeholder="Explore Marak..." tabindex="-1" data-search="search">
					<div class="search-input-close"><i data-feather="x"></i></div>
					<ul class="search-list search-list-main"></ul>
				</div>
			</li>
			<li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">5</span></a>
			</li>
			<li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<div class="user-nav d-sm-flex d-none">
						<span class="user-name fw-bolder"><?= $this->session->userdata('name_user'); ?></span>
						<?php
						$this->db->select('*');
						$this->db->join('user_role', 'role_id=role_user', 'left');
						$this->db->where('username', $this->session->userdata('username'));
						$user = $this->db->get('users');
						$role = $user->row();
						?>
						<span class="user-status"><?= $role->role_name; ?></span>
					</div>
					<span class="avatar">
						<img class="round" src="<?= $role->image_user; ?>" alt="avatar" height="40" width="40">
						<span class="avatar-status-online"></span>
					</span>
				</a>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
					<a class="dropdown-item" href="<?= base_url('Profile'); ?>"><i class="me-50" data-feather="user"></i> Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="page-account-settings-account.html"><i class="me-50" data-feather="settings"></i> Settings</a>
					<a class="dropdown-item" href="#"><i class="me-50" data-feather="help-circle"></i> FAQ</a>
					<a class="dropdown-item" href="#" onclick="Logout()"><i class="me-50" data-feather="power"></i> Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>