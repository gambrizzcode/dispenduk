<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Data User
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_user/do_upload"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user; ?>">

						<div class=form-group>
							<label class="col-sm-3 control-label">Nama Lengkap</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="nama" id="nama" required="required" value="<?php echo $nama; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Nomor Kartu Keluarga</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="nkk" id="nkk" required="required" value="<?php echo $nkk; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Nomor Induk Kependudukan</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="nik" id="nik" required="required" value="<?php echo $nik; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Tempat Lahir</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="tempat_lahir" id="tempat_lahir" required="required" value="<?php echo $tempat_lahir; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Tanggal Lahir</label>
							<div class=col-sm-5>
								<input type="text" class="form-control date-picker input-sm" id="id-date-picker-1" data-date-format="yyyy-mm-dd" name="tgl_lahir" id="tgl_lahir" required="required" value="<?php echo $tgl_lahir; ?>">
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

						<div class=form-group>
							<label class="col-sm-3 control-label">Alamat</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="alamat" id="alamat" required="required" value="<?php echo $alamat; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Rukun Tetangga (RT)</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="rt" id="rt" required="required" value="<?php echo $rt; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Rukun Warga (RW)</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="rw" id="rw" required="required" value="<?php echo $rw; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Email</label>
							<div class=col-sm-5>
								<input type="email" class="form-control input-sm" name="email" id="email" required="required" value="<?php echo $email; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Password</label>
							<div class=col-sm-5>
								<input type="password" class="form-control input-sm" name="password" id="password" required="required" value="<?php echo $password; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Confirm Password</label>
							<div class=col-sm-5>
								<input type="password" class="form-control input-sm" name="confirm" id="confirm" required="required" value="<?php echo $confirm; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Nomor HP 1</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="hp1" id="hp1" required="required" value="<?php echo $hp1; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Nomor HP 2</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="hp2" id="hp2" value="<?php echo $hp2; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Foto / Scan KK</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="scan_kk" id="scan_kk" value="<?php echo $scan_kk; ?>">
								<br>
								<i><b style="color:red">*Batas Maksimal File adalah 1 MB = 1024 KB</b></i>
							</div>
							
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Foto / Scan KK terakhir kali</label>
							<div class="col-sm-5">
							<?php
							if ($scan_kk == "" || $scan_kk == "img/") { ?>
								<b style="color: red">Tidak Ada Scan / Foto KK</b>
							 <?php }else{ ?>
								<img style="max-height: 240px" src="<?php echo base_url().$scan_kk; ?>">
							<?php } ?>
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Foto / Scan KTP</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="scan_ktp" id="scan_ktp" value="<?php echo $scan_ktp; ?>">
								<br>
								<i><b style="color:red">*Batas Maksimal File adalah 1 MB = 1024 KB</b></i>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Foto / Scan KTP terakhir kali</label>
							<div class="col-sm-5">
							<?php
							if ($scan_ktp == "" || $scan_ktp == "img/") { ?>
								<b style="color: red">Tidak Ada Scan / Foto KTP</b>
							 <?php }else{ ?>
								<img style="max-height: 240px" src="<?php echo base_url().$scan_ktp; ?>">
							<?php } ?>
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Foto Profil</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="foto_profil" id="foto_profil" value="<?php echo $foto_profil; ?>">
								<br>
								<i><b style="color:red">*Batas Maksimal File adalah 1 MB = 1024 KB</b></i>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Foto Profil terakhir kali</label>
							<div class="col-sm-5">
							<?php
							if ($foto_profil == "" || $foto_profil == "img/") { ?>
								<b style="color: red">Tidak Ada Foto Profil</b>
							<?php }else{ ?>
								<img style="max-height: 240px" src="<?php echo base_url().$foto_profil; ?>">
							<?php } ?>
							</div>
						</div>

						<?php
						if ($_SESSION['login']['role'] == "USER") {}else{
						?>
						<div class=form-group>
							<label class="col-sm-3 control-label">Role</label>
							<div class=col-sm-5>
								<select class="form-control input-sm" name="role" id="role" required="required">
									<option <?php if($role == ""){echo "selected";}else{} ?> value="">--- Set Role User ---</option>
									<option <?php if($role == "ADMIN"){echo "selected";}else{} ?> value="ADMIN">ADMIN</option>
									<option <?php if($role == "USER"){echo "selected";}else{} ?> value="USER">USER</option>
								</select>
							</div>
						</div>

						<?php
						}
						?>

						<?php
						if ($_SESSION['login']['role'] == "USER") {}else{
						?>
						<div class=form-group>
							<label class="col-sm-3 control-label">Status</label>
							<div class=col-sm-5>
								<select class="form-control input-sm" name="status" id="status" required="required">
									<option <?php if($status == ""){echo "selected";}else{} ?> value="">--- Set Status User ---</option>
									<option <?php if($status == "1"){echo "selected";}else{} ?> value="1">AKTIF</option>
									<option <?php if($status == "0"){echo "selected";}else{} ?> value="0">NONAKTIF</option>
								</select>
							</div>
						</div>
						<?php
						}
						?>

						<input type="hidden" name="tgl_register" value="<?php echo date('Y-m-d'); ?>">

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" name="Simpan" class="btn btn-flat btn-lg btn-primary"><i class="fa fa-save"></i> Simpan Data</button> 
								<button type="reset" class="btn btn-flat btn-lg btn-default"><i class="fa fa-refresh"></i> Reset Kolom </button>
								<a href="<?php echo site_url("c_user/grid_user"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
							</div>
						</div>


					</form>

					
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>