<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Data Administrasi
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_lahir/print_administrasi"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div class=form-group>
							<div class="form-group">
								<label class="col-sm-4 control-label">ID Registrasi</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $id_reg; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">No Handphone</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $no_hp; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Surat Kelahiran Dari Dokter / Bidan / Penolong</label>
								<div class=col-sm-5>
									<?php if ($surat_kelahiran == "" || $surat_kelahiran == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$surat_kelahiran; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Fotocopy KTP Saksi</label>
								<div class=col-sm-5>
									<?php if ($ktp_saksi == "" || $ktp_saksi == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$ktp_saksi; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Kartu Keluarga Orang Tua</label>
								<div class=col-sm-5>
									<?php if ($kk_ortu == "" || $kk_ortu == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$kk_ortu; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">KTP Orang Tua</label>
								<div class=col-sm-5>
									<?php if ($ktp_ortu == "" || $ktp_ortu == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$ktp_ortu; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Kutipan Akta Nikah Orang Tua</label>
								<div class=col-sm-5>
									<?php if ($akta_nikah == "" || $akta_nikah == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$akta_nikah; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">SPTJM Kebenaran Data Kelahiran</label>
								<div class=col-sm-5>
									<?php if ($sptjm_lahir == "" || $sptjm_lahir == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$sptjm_lahir; ?>">
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">SPTJM Kebenaran Sebagai Pasangan Suami-Istri</label>
								<div class=col-sm-5>
									<?php if ($sptjm_pasangan == "" || $sptjm_pasangan == "img/") { ?>
										<b style="color: red">Tidak Ada File</b>
									 <?php }else{ ?>
										<img style="max-height: 240px" src="<?php echo base_url().$sptjm_pasangan; ?>">
									<?php } ?>
								</div>
							</div>

								

							<hr>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<a href="<?php echo site_url("c_lahir/cetak_administrasi/".$id_reg); ?>" target="_blank" class="btn btn-flat btn-danger btn-lg"><i class="fa fa-print"></i> Cetak </a>
									<?php
									if ($_SESSION['login']['role'] == "ADMIN") { ?>
										<a href="<?php echo site_url("c_lahir/detail_lahir/".$id_reg); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
									<?php }elseif ($_SESSION['login']['role'] == "USER") { ?>
										<a href="<?php echo site_url("c_lahir/front_lahir"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
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