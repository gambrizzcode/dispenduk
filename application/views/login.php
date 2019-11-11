<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login - Dispenduk Capil Jember</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-rtl.min.css" />
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">Layanan</span>
									<span class="white" id="id-text2">Online</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; DISPENDUK CAPIL Kab. Jember</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												<b>MASUK</b>
											</h4>

											<div class="space-6"></div>

											<form method="POST" action="<?php echo base_url(); ?>index.php/C_login/do_login">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Email / NIK" name="email_nik" required="required" autocomplete="off" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Kata Sandi" name="thepassword" required="required" autocomplete="off" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Masuk</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													Lupa Password ?
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													Registrasi disini
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div>
								</div>

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Dapatkan Kata Sandi Anda
											</h4>

											<div class="space-6"></div>
											<p>Masukkan Email</p>

											<?php //echo validation_errors(); ?>
											<?php //echo form_open('C_login/lupa'); ?>
											<form method="POST" action="<?php echo base_url(); ?>index.php/C_login/lupa">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Email" name="email_lupa" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Kirim</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Kembali ke Login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div>
								</div>

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												Registrasi 
											</h4>

											<div class="space-6"></div>
											<p> Masukkan Data Diri Anda: </p>

											<form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/C_login/do_upload">
												<!-- <input type="hidden" name="id"> -->
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Nama" name="nama" required="required" />
															<i class="ace-icon fa fa-edit"></i>
														</span>
													</label>

													<!-- <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="No KK" name="nkk" required="required" />
															<i class="ace-icon fa fa-file"></i>
														</span>
													</label> -->

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="NIK" name="nik" required="required" />
															<i class="ace-icon fa fa-credit-card"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Email" name="email" required="required" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Kata Sandi" name="password" required="required" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" name="confirm" required="required" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Nomor HP" name="hp1" required="required" />
															<i class="ace-icon fa fa-phone"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<label>Scan / Foto KK</label>&nbsp;<i class="fa fa-arrow-down"></i>
															<input type="file" class="form-control" name="scan_kk" required="required">
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<label>Scan / Foto KTP</label>&nbsp;<i class="fa fa-arrow-down"></i>
															<input type="file" class="form-control" name="scan_ktp" required="required">
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="submit" class="width-65 pull-right btn btn-sm btn-success">
															<span class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Kembali Ke Login
											</a>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<script src="jquery/external/jquery/jquery.js"></script>
		<script src="mybootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>
		<script type="text/javascript">
			$("input[name='password']").keyup(function() {
				var password = $(this).val().length;
				if (password < 8) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='password']").keydown(function() {
				var password = $(this).val().length;
				if (password < 8) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='password']").focusout(function() {
				var password = $(this).val().length;
				if (password < 8) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='confirm']").keyup(function() {
				var confirm = $(this).val();
				var password = $("input[name='password']").val();
				if (confirm != password) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='confirm']").keydown(function() {
				var confirm = $(this).val();
				var password = $("input[name='password']").val();
				if (confirm != password) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='confirm']").focusout(function() {
				var confirm = $(this).val();
				var password = $("input[name='password']").val();
				if (confirm != password) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
		</script>
	</body>
</html>
