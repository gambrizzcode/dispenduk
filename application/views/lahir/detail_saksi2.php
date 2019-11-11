<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Data Saksi 2
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_lahir/print_saksi2"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div class=form-group>
							<div class="form-group">
								<label class="col-sm-4 control-label">ID Registrasi</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $id_reg; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">NIK Saksi 2</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nik_saksi2; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Saksi 2</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $nama; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Umur</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $umur; ?></label>
								</div>
							</div>


							<div class=form-group>
								<label class="col-sm-4 control-label">Jenis Kelamin</label>
								<div class=col-sm-5>
									<label class="control-label"><?php if($jk == "L"){echo "Laki - Laki";}else{echo "Perempuan";} ?></label>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Tanggal Lahir</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo date('d-m-Y',strtotime($tgl_lahir)); ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Pekerjaan</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $kerja; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Alamat</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $alamat; ?></label>
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-4 control-label">Rukun Tetangga (RT)</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $rt; ?></label>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Rukun Warga (RW)</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $rw; ?></label>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Kecamatan</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $kecamatan; ?></label>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Desa / Kelurahan</label>
								<div class=col-sm-5>
									<label class="control-label"><?php echo $kelurahan; ?></label>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<a href="<?php echo site_url("c_lahir/cetak_saksi2/".$id_reg); ?>" target="_blank" class="btn btn-flat btn-danger btn-lg"><i class="fa fa-print"></i> Cetak </a>
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