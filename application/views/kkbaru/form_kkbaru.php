<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Data Pengajuan KK Baru
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_kkbaru/do_upload"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
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
								<label class="col-sm-4 control-label">Nomor Kartu Keluarga</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="kk" required="required" value="<?php echo $kk; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">NIK Pemohon</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nik" required="required" value="<?php echo $nik; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Pemohon</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nama" required="required" value="<?php echo $nama; ?>">
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Surat Keterangan Dari Kecamatan</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="sk" value="<?php echo $sk; ?>">
									<?php
									if ($sk == "" || $sk == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$sk; ?>" target="_blank"><?php echo base_url().$sk; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Scan / Foto KTP Asli</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="ktp" value="<?php echo $ktp; ?>">
									<?php
									if ($ktp == "" || $ktp == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$ktp; ?>" target="_blank"><?php echo base_url().$ktp; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Form F101</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="f101" value="<?php echo $f101; ?>">
									<?php
									if ($f101 == "" || $f101 == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$f101; ?>" target="_blank"><?php echo base_url().$f101; ?></a></label>
									<?php } ?>
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
									<a href="<?php echo site_url("c_kkbaru/front_kkbaru"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
								</div>
							</div>

					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>