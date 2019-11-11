<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Data Administrasi
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_lahir/do_upload"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div>
							<p>
								<i style="color:red">
									Catatan : <br>
									Format File Harus <b>*.jpg / *.JPG / *.png / *.PNG</b><br>
									Ukuran File Harus Dibawah <b>1 MB = 1024 KB</b>
								</i>
							</p>
						</div>
						<input type="hidden" name="id_reg" id="id_reg" value="<?php echo $id_reg; ?>">

						<div class="form-group">
							<label class="col-sm-5 control-label">Nomor Handphone</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="no_hp" id="no_hp" value="<?php echo $no_hp; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-5 control-label">Surat Kelahiran Dari Dokter / Bidan / Penolong</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="surat_kelahiran" id="surat_kelahiran" required="required" value="<?php echo $surat_kelahiran; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-5 control-label">Fotocopy KTP Saksi</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="ktp_saksi" value="<?php echo $ktp_saksi; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-5 control-label">Kartu Keluarga Orang Tua</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="kk_ortu" value="<?php echo $kk_ortu; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-5 control-label">KTP Orang Tua</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="ktp_ortu" value="<?php echo $ktp_ortu; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-5 control-label">Kutipan Akta Nikah Orang Tua</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="akta_nikah" value="<?php echo $akta_nikah; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-5 control-label">SPTJM Kebenaran Data Kelahiran (Optional)</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="sptjm_lahir" value="<?php echo $sptjm_lahir; ?>">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-5 control-label">SPTJM Kebenaran Sebagai Pasangan Suami-Istri (Optional)</label>
							<div class=col-sm-5>
								<input type="file" class="form-control input-sm" name="sptjm_pasangan" value="<?php echo $sptjm_pasangan; ?>">
							</div>
						</div>

						<hr>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
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