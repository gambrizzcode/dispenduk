<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Data Saksi 2
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_lahir/update_saksi2"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">

							<input type="hidden" name="id_reg" id="id_reg" value="<?php echo $id_reg; ?>">

							<div class="form-group">
								<label class="col-sm-3 control-label">NIK Saksi 2</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nik_saksi2" id="nik_saksi2" required="required" value="<?php echo $nik_saksi2; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Saksi 2</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nama" id="nama" required="required" value="<?php echo $nama; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Umur</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="umur" id="umur" required="required" value="<?php echo $umur; ?>">
								</div>
							</div>


							<div class=form-group>
								<label class="col-sm-3 control-label">Jenis Kelamin</label>
								<div class=col-sm-5>
									<select class="form-control input-sm" name="jk" id="jk" required="required">
										<option <?php if($jk == ""){echo "selected";}else{} ?> value="">--- Pilih Jenis Kelamin ---</option>
										<option <?php if($jk == "L"){echo "selected";}else{} ?> value="L">Laki - Laki</option>
										<option <?php if($jk == "P"){echo "selected";}else{} ?> value="P">Perempuan</option>
									</select>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-3 control-label">Tanggal Lahir</label>
								<div class=col-sm-5>
									<input type="text" class="form-control date-picker input-sm" id="id-date-picker-1" data-date-format="yyyy-mm-dd" name="tgl_lahir" id="tgl_lahir" required="required" value="<?php echo $tgl_lahir; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Pekerjaan</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="kerja" id="kerja" required="required" value="<?php echo $kerja; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Alamat</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="alamat" id="alamat" required="required" value="<?php echo $alamat; ?>">
								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-3 control-label">Rukun Tetangga (RT)</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="rt" id="rt" required="required" value="<?php echo $rt; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Rukun Warga (RW)</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="rw" id="rw" required="required" value="<?php echo $rw; ?>">
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-3 control-label">Kecamatan</label>
								<div class=col-sm-5>
									<select class="form-control input-sm" name="kecamatan" id="kecamatan" required="required">
										<option <?php if($kecamatan == ""){echo "selected";}else{} ?> value="">--- Pilih Kecamatan ---</option>
										<?php
										$datakec = $this->M_akun->query_all("SELECT * FROM kecamatan GROUP BY kec ORDER BY kec ASC");
										$fetchkec = $datakec->result();
										foreach ($fetchkec as $kec => $vec) { ?>
											<option <?php if($kecamatan == $vec->kec){echo "selected";}else{} ?> value="<?php echo $vec->kec; ?>"><?php echo $vec->kec; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-3 control-label">Desa / Kelurahan</label>
								<div class=col-sm-5>
									<select class="form-control input-sm" name="kelurahan" id="kelurahan" required="required">
										<option <?php if($kelurahan == ""){echo "selected";}else{} ?> value="">--- Pilih Kelurahan ---</option>
										<option <?php if($kelurahan == $kelurahan){echo "selected";}else{} ?> value="<?php echo $kelurahan; ?>"><?php echo $kelurahan; ?></option>
									</select>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-flat btn-danger btn-lg">
										<i class="fa fa-check-circle"></i>
										Submit Form
									</button>
									<button type="reset" class="btn btn-flat btn-lg btn-default">
										<i class="fa fa-refresh"></i>
										Reset Kolom
									</button>
									<a href="<?php echo site_url("c_lahir/front_lahir"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
									</div>
							</div>
							
					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>