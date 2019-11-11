<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Data Pencetakan KIA
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_kia/do_upload"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div>
							<p>
								<i>
									Catatan : <br>
									Format File Harus <b>*.jpg / *.JPG / *.png / *.PNG</b><br>
									Ukuran File Harus Dibawah <b>2MB</b>
									Jika File sudah ada, biarkan kosong.<br>
									isi form jika ingin mengganti dengan file baru saja.
								</i>
							</p>
						</div>
						<br>
						<input type="hidden" name="id_reg" id="id_reg" value="<?php echo $id_reg; ?>">

							<div class="form-group">
								<label class="col-sm-4 control-label">NIK Anak</label>
								<div class=col-sm-5>
									<input type="text" placeholder="Boleh dilewati jika tidak ada" class="form-control input-sm" name="nik_anak" value="<?php echo $nik_anak; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Anak</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nama" required="required" value="<?php echo $nama; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Tempat Lahir</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="tempat_lahir" required="required" value="<?php echo $tempat_lahir; ?>">
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Tanggal Lahir</label>
								<div class=col-sm-5>
									<input type="text" class="form-control date-picker input-sm" id="id-date-picker-1" data-date-format="yyyy-mm-dd" name="tgl_lahir" required="required" value="<?php echo $tgl_lahir; ?>">
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Jenis Kelamin</label>
								<div class=col-sm-5>
									<select class="form-control input-sm" name="jk" id="jk" required="required">
										<option <?php if($jk == ""){echo "selected";}else{} ?> value="">--- Pilih Jenis Kelamin ---</option>
										<option <?php if($jk == "L"){echo "selected";}else{} ?> value="L">Laki - Laki</option>
										<option <?php if($jk == "P"){echo "selected";}else{} ?> value="P">Perempuan</option>
									</select>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Nomor KK</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nkk" required="required" value="<?php echo $nkk; ?>">
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Nama Kepala Keluarga</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" data-date-format="yyyy-mm-dd" name="nama_kk" required="required" value="<?php echo $nama_kk; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">No Akta Kelahiran</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="no_akta" required="required" value="<?php echo $no_akta; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Agama</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="agama" required="required" value="<?php echo $agama; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Kewarganegaraan</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="kewarganegaraan" required="required" value="<?php echo $kewarganegaraan; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Alamat</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="alamat" required="required" value="<?php echo $alamat; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Rt</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="rt" required="required" value="<?php echo $rt; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Rw</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="rw" required="required" value="<?php echo $rw; ?>">
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Kecamatan</label>
								<div class=col-sm-5>
									<select class="form-control input-sm" name="kecamatan" required="required">
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
								<label class="col-sm-4 control-label">Desa / Kelurahan</label>
								<div class=col-sm-5>
									<select class="form-control input-sm" name="kelurahan" required="required">
										<option <?php if($kelurahan == ""){echo "selected";}else{} ?> value="">--- Pilih Kelurahan ---</option>
										<option <?php if($kelurahan == $kelurahan){echo "selected";}else{} ?> value="<?php echo $kelurahan; ?>"><?php echo $kelurahan; ?></option>
									</select>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Scan / Foto Kartu Keluarga</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="upload_kk" value="<?php echo $upload_kk; ?>">
									<?php
									if ($upload_kk == "" || $upload_kk == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$upload_kk; ?>" target="_blank"><?php echo base_url().$upload_kk; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Scan / Foto Akta Kelahiran</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="upload_akta" value="<?php echo $upload_akta; ?>">
									<?php
									if ($upload_akta == "" || $upload_akta == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$upload_akta; ?>" target="_blank"><?php echo base_url().$upload_akta; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Scan / Foto KTP Orang Tua</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="ktp_ortu" value="<?php echo $ktp_ortu; ?>">
									<?php
									if ($ktp_ortu == "" || $ktp_ortu == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$ktp_ortu; ?>" target="_blank"><?php echo base_url().$ktp_ortu; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Pas Foto <b>*</b></label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="pas_foto" value="<?php echo $pas_foto; ?>">
									<?php
									if ($pas_foto == "" || $pas_foto == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$pas_foto; ?>" target="_blank"><?php echo base_url().$pas_foto; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-5">
									<b>*</b> Khusus Umur <b><i>5 - 17 Tahun</i></b>. <b><i>5 Tahun ke bawah</i></b> Tidak Wajib<br>
									Tahun Kelahiran Ganjil : Background Merah<br>
									Tahun Kelahiran Genap : Background Biru<br>
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
									<a href="<?php echo site_url("c_kia/front_kia"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
								</div>
							</div>

					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>