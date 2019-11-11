<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Permohonan Pembuatan Akta Kelahiran
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div class=form-group>
							<div class="form-group">
								<label class="col-sm-4 control-label">ID Registrasi</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $id_reg; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Tanggal Register</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $tanggal; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">NIK Pemohon</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nik_pemohon; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Pemohon</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nama_pemohon; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Jenis Permohonan</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $jenis; ?></label>
								</div>
							</div>

							<?php
							$qdata_status = "SELECT * FROM permohonan INNER JOIN status ON permohonan.id_reg = status.id_reg WHERE permohonan.id_reg = '$id_reg' AND status.status <> '' ORDER BY status.tgl_status DESC";
							$Baris_status = $this->M_akun->q_data($qdata_status)->num_rows();
							if ($Baris_status >= 1) {
								$isi_status = $this->M_akun->q_data($qdata_status)->row();
							?>
							<div class="form-group">
								<label class="col-sm-4 control-label">Status</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $isi_status->status; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Keterangan</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $isi_status->ket; ?></label>
								</div>
							</div>
							<?php }else{} ?>

							<hr>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-offset-1 col-xs-11">
										<a href="<?php echo site_url("c_lahir/detail_bayi/".$id_reg); ?>" class="btn btn-flat btn-info btn-xs"><i class="fa fa-search"></i> Detail Bayi</a>
										<a href="<?php echo site_url("c_lahir/detail_bapak/".$id_reg); ?>" class="btn btn-flat btn-info btn-xs"><i class="fa fa-search"></i> Detail Bapak</a>
										<a href="<?php echo site_url("c_lahir/detail_ibu/".$id_reg); ?>" class="btn btn-flat btn-info btn-xs"><i class="fa fa-search"></i> Detail Ibuk</a>
										<a href="<?php echo site_url("c_lahir/detail_saksi1/".$id_reg); ?>" class="btn btn-flat btn-info btn-xs"><i class="fa fa-search"></i> Detail Saksi1</a>
										<a href="<?php echo site_url("c_lahir/detail_saksi2/".$id_reg); ?>" class="btn btn-flat btn-info btn-xs"><i class="fa fa-search"></i> Detail Saksi2</a>
										<a href="<?php echo site_url("c_lahir/detail_administrasi/".$id_reg); ?>" class="btn btn-flat btn-info btn-xs"><i class="fa fa-search"></i> Detail Administrasi</a>
									</div>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<a href="<?php echo site_url("c_lahir/cetak_lahir/".$id_reg); ?>" target="_blank" class="btn btn-flat btn-danger btn-lg"><i class="fa fa-print"></i> Cetak </a>
									<a href="<?php echo site_url("c_lahir/grid_lahir"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
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