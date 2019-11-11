<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Data Bayi
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_lahir/print_bayi"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div class=form-group>
							<div class="form-group">
								<label class="col-sm-4 control-label">ID Registrasi</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $id_reg; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">NIK Bayi (Boleh Dikosongi)</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nik_bayi; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Bayi</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nama; ?></label>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Jenis Kelamin</label>
								<div class=col-sm-5>
									<label class="control-label"><?php if($jk == "L"){echo "Laki - Laki";}else{echo "Perempuan";} ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Tempat Dilahirkan</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $tempat_dilahirkan; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Tempat Lahir</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $tempat_lahir; ?></label>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Tanggal Lahir</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo date('d-m-Y',strtotime($tgl_lahir)); ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Waktu</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $waktu; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Jenis Kelahiran</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $jenis_lahir; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Kelahiran Ke</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $lahir_ke; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Penolong</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $penolong; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Berat (KG)</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $berat; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Panjang (CM)</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $panjang; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nomor Kartu Keluarga</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nkk; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Kepala Keluarga</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nama_kk; ?></label>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<a href="<?php echo site_url("c_lahir/cetak_bayi/".$id_reg); ?>" target="_blank" class="btn btn-flat btn-danger btn-lg"><i class="fa fa-print"></i> Cetak </a>
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