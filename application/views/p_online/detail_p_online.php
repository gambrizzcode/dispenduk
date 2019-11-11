<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Data Awal Pengaduan Online / Help Desk
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
								<label class="col-sm-4 control-label">Subjek Pengaduan</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $subjek; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Uraian / Keterangan</label>
								<div class=col-sm-5>
									<textarea disabled="disabled" style="background-color: white;border: none;color: black"><?php echo $uraian; ?></textarea>
									<!-- <label class="control-label"></label> -->
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Waktu</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo date('H:i:s d-m-Y',strtotime($waktu)); ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Bukti 1</label>
								<div class=col-sm-5>
									<?php if ($bukti1 == "" || $bukti1 == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$bukti1; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Bukti 2</label>
								<div class=col-sm-5>
									<?php if ($bukti2 == "" || $bukti2 == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$bukti2; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Bukti 3</label>
								<div class=col-sm-5>
									<?php if ($bukti3 == "" || $bukti3 == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$bukti3; ?>">
									<?php } ?>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<a href="<?php echo site_url("c_p_online/cetak_p_online/".$id_reg); ?>" target="_blank" class="btn btn-flat btn-danger btn-lg"><i class="fa fa-print"></i> Cetak </a>
									<?php
									if ($_SESSION['login']['role'] == "ADMIN") { ?>
										<a href="<?php echo site_url("c_p_online/grid_p_online"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
									<?php }elseif ($_SESSION['login']['role'] == "USER") { ?>
										<a href="<?php echo site_url("c_p_online/front_p_online"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
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