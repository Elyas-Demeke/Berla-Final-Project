<body style="width:100%;">
    <div class="main-wrapper" >
        <div class="header">
			<div class="header-left">
				<a href="<?php echo base_url()?>" class="logo">
					<img src="<?php echo base_url('assets/img/logo.png')?>" width="35" height="35" alt=""> <span>Berla</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="<?php echo base_url($this->session->userdata('photo'))?>" width="36" alt="Admin">
							<span class="status online"></span>
						</span>
						<span><?php 

                        $fname = $this->session->userdata('fname');
                        $mname = $this->session->userdata('mname');
                        echo $fname. " " . $mname; ?></span>
                    </a>
					<div class="dropdown-menu">
						
						<a class="dropdown-item" href="<?php echo base_url('Employees/profile') ?>">My Profile</a>
						
						<a class="dropdown-item" href="<?php echo base_url('Auth/logout')?>">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
