<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Pengaduan Online / Help Desk
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_p_online/do_upload"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
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

							<div class="form-group">
								<label class="col-sm-4 control-label">Subjek Pengaduan</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="subjek" required="required" value="<?php echo $subjek; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Uraian / Keterangan</label>
								<div class=col-sm-5>
									<textarea class="form-control" name="uraian" required="required" value="<?php echo $uraian; ?>"><?php echo $uraian; ?></textarea>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Bukti 1</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="bukti1" value="<?php echo $bukti1; ?>">
									<?php
									if ($bukti1 == "" || $bukti1 == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$bukti1; ?>" target="_blank"><?php echo base_url().$bukti1; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Bukti 2</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="bukti2" value="<?php echo $bukti2; ?>">
									<?php
									if ($bukti2 == "" || $bukti2 == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$bukti2; ?>" target="_blank"><?php echo base_url().$bukti2; ?></a></label>
									<?php } ?>
								</div>
							</div>

							<div class=form-group>
								<label class="col-sm-4 control-label">Bukti 3</label>
								<div class=col-sm-5>
									<input type="file" class="form-control input-sm" name="bukti3" value="<?php echo $bukti3; ?>">
									<?php
									if ($bukti3 == "" || $bukti3 == "img/") { ?>
										<b style="color:red">Tidak Ada File</b>
									<?php }else{ ?>
										<br>
										<label>File Anda Sebelumnya : <a href="<?php echo base_url().$bukti3; ?>" target="_blank"><?php echo base_url().$bukti3; ?></a></label>
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
									<a href="<?php echo site_url("c_p_online/front_p_online"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
								</div>
							</div>

					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>