<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Data KK Baru
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_kkbaru/cetak_bbaru"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div class=form-group>
							<div class="form-group">
								<label class="col-sm-4 control-label">ID Registrasi</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $id_reg; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nomor Kartu Keluarga</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $kk; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nomor Induk Kependudukan (NIK)</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nik; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nama; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Surat Keterangan Dari Kecamatan</label>
								<div class=col-sm-5>
									<?php if ($sk == "" || $sk == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$sk; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Scan / Foto KTP Asli</label>
								<div class=col-sm-5>
									<?php if ($ktp == "" || $ktp == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$ktp; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Form F101</label>
								<div class=col-sm-5>
									<?php if ($f101 == "" || $f101 == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$f101; ?>">
									<?php } ?>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<a href="<?php echo site_url("c_kkbaru/cetak_kkbaru/".$id_reg); ?>" target="_blank" class="btn btn-flat btn-danger btn-lg"><i class="fa fa-print"></i> Cetak </a>
									<?php
									if ($_SESSION['login']['role'] == "ADMIN") { ?>
										<a href="<?php echo site_url("c_kkbaru/grid_kkbaru"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
									<?php }elseif ($_SESSION['login']['role'] == "USER") { ?>
										<a href="<?php echo site_url("c_kkbaru/front_kkbaru"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
									<?php } ?>
									</div>
							</div>

						</div>
					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>