<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Data Bayi
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_lahir/update_bayi"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
							<input type="hidden" name="id_reg" id="id_reg" value="<?php echo $id_reg; ?>">

							<div class="form-group">
								<label class="col-sm-3 control-label">NIK Bayi (Boleh Dikosongi)</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nik_bayi" id="nik_bayi" value="<?php echo $nik_bayi; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Bayi</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nama" id="nama" required="required" value="<?php echo $nama; ?>">
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

							<div class="form-group">
								<label class="col-sm-3 control-label">Tempat Dilahirkan</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="tempat_dilahirkan" id="tempat_dilahirkan" required="required" placeholder="(Rumah sakit/Rumah Bersalin, Puskesmas, Rumah, Lainnya)" value="<?php echo $tempat_dilahirkan; ?>">
								</div>
							</div>

							<div class="form-group">
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

							<div class="form-group">
								<label class="col-sm-3 control-label">Waktu</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="waktu" id="waktu" required="required" value="<?php echo $waktu; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Jenis Kelahiran</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="jenis_lahir" id="jenis_lahir" placeholder="(Tunggal, Kembar 2, Kembar 3, Lainnya)" required="required" value="<?php echo $jenis_lahir; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Kelahiran Ke</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="lahir_ke" id="lahir_ke" required="required" value="<?php echo $lahir_ke; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Penolong</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="penolong" id="penolong" required="required" value="<?php echo $penolong; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Berat (KG)</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="berat" id="berat" required="required" value="<?php echo $berat; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Panjang (CM)</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="panjang" id="panjang" required="required" value="<?php echo $panjang; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Nomor Kartu Keluarga</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nkk" id="nkk" required="required" value="<?php echo $nkk; ?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">Nama Kepala Keluarga</label>
								<div class=col-sm-5>
									<input type="text" class="form-control input-sm" name="nama_kk" id="nama_kk" required="required" value="<?php echo $nama_kk; ?>">
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