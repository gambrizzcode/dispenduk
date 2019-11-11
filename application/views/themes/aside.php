<div class="main-container ace-save-state" id="main-container">
	<script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>

	<div id="sidebar" class="sidebar responsive ace-save-state">
		<script type="text/javascript">
			try{ace.settings.loadState('sidebar')}catch(e){}
		</script>

		<ul class="nav nav-list">
			<!--------------------------------------------------->
			<li class="active">
				<a href="<?php echo base_url(); ?>index.php/C_themes">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-tachometer"></i>
						<span class="menu-text" title="Dashboard Admin"> Dashboard </span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<?php
			$role = $_SESSION['login']['role'];
			if ($role == "ADMIN") { ?>
			<!--------------------------------------------------->
			<li class="active">
				<a href="<?php echo base_url(); ?>index.php/C_list/grid_list">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-file-text"></i>
						<span class="menu-text" title="List Permohonan"> List Permohonan </span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li class="active">
				<a href="<?php echo base_url(); ?>index.php/C_user/grid_user">
				<!-- <a href="<?php //echo site_url("c_user/grid_user"); ?>"> -->
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-group"></i>
						<span class="menu-text" title="Data User"> Data User </span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<?php } ?>
			<li class="active">
				<a href="<?php echo base_url(); ?>index.php/C_lahir">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-child"></i>
						<span class="menu-text">
							Akte Kelahiran
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li>
				<a href="#" class="dropdown-toggle">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-user-times"></i>
						<span class="menu-text">
							Akte Kematian
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li>
				<a href="#" class="dropdown-toggle">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-credit-card"></i>
						<span class="menu-text">
							KTP-El Baru
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li>
				<a href="#" class="dropdown-toggle">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-cc-amex"></i>
						<span class="menu-text">
							KTP-El Rusak
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li>
				<a href="#" class="dropdown-toggle">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-file-text"></i>
						<span class="menu-text">
							Ket. Perekaman KTP
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li class="active">
				<a href="<?php echo base_url(); ?>index.php/C_kkbaru">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-file-o"></i>
						<span class="menu-text">
							KK Baru
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li>
				<a href="#" class="dropdown-toggle">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-file-excel-o"></i>
						<span class="menu-text">
							KK Hilang/Rusak
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li class="active">
				<a href="<?php echo base_url(); ?>index.php/C_kia">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-newspaper-o"></i>
						<span class="menu-text">
							Pencetakan KIA
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li>
				<a href="#" class="dropdown-toggle">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-male"></i>
						<span class="menu-text">
							Lapor Pindah Datang
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
			<li class="active">
				<a href="<?php echo base_url(); ?>index.php/C_p_online">
					<!-- <marquee scrolldelay="400" behavior="alternate"> -->
						<i class="menu-icon fa fa-desktop"></i>
						<span class="menu-text">
							Pengaduan Online
						</span>
					<!-- </marquee> -->
				</a>
			</li>
			<!--------------------------------------------------->
		</ul><!-- /.nav-list -->

		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>
	</div>