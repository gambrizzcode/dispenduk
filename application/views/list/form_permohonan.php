<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Pengisian Permohonan Layanan <?php echo $params; ?>
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Isi secara lengkap dan benar
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_list/save_mohon"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">

						<div class=form-group>
							<label class="col-sm-3 control-label">Nomor Induk Kependudukan (NIK)</label>
							<div class=col-sm-5>
								<input type="hidden"name="nik" value="<?php echo $_SESSION['login']['nik']; ?>">
								<input type="text" class="form-control input-sm" value="<?php echo $_SESSION['login']['nik']; ?>" disabled="disabled">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Nama Lengkap</label>
							<div class=col-sm-5>
								<input type="hidden"name="nama" value="<?php echo $_SESSION['login']['nama']; ?>">
								<input type="text" class="form-control input-sm"value="<?php echo $_SESSION['login']['nama']; ?>" disabled="disabled">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Jenis Layanan</label>
							<div class=col-sm-5>
								<select class="form-control input-sm" name="jenis" id="jenis" required="required">
									<!-- <option value="">--- Pilih Jenis Layanan ---</option> -->
									<?php if($params == "lahir"){ ?>
										<option value="Permohonan Pembuatan Akte Kelahiran">Permohonan Pembuatan Akte Kelahiran</option>
									<?php }else{} ?>
									<?php if($params == "mati"){ ?>
										<option value="Permohonan Pembuatan Akta Kematian">Permohonan Pembuatan Akta Kematian</option>
									<?php }else{} ?>
									<?php if($params == "ktpbaru"){ ?>
										<option value="Registasi KTP Baru">Registasi KTP Baru</option>
									<?php }else{} ?>
									<?php if($params == "ktprusak"){ ?>
										<option value="Pengajuan KTP El Rusak">Pengajuan KTP El Rusak</option>
									<?php }else{} ?>
									<?php if($params == "rekamktp"){ ?>
										<option value="Permohonan Pencetakan Surat Keterangan Perekaman KTP">Permohonan Pencetakan Surat Keterangan Perekaman KTP</option>
									<?php }else{} ?>
									<?php if($params == "kkbaru"){ ?>
										<option value="Permohonan Pencetakan KK Baru">Permohonan Pencetakan KK Baru</option>
									<?php }else{} ?>
									<?php if($params == "kkhilang"){ ?>
										<option value="Permohonan Pencetakan KK Hilang/Rusak">Permohonan Pencetakan KK Hilang/Rusak</option>
									<?php }else{} ?>
									<?php if($params == "kia"){ ?>
										<option value="Permohonan Pembuatan/Pencetakan KIA">Permohonan Pembuatan/Pencetakan KIA</option>
									<?php }else{} ?>
									<?php if($params == "pindah"){ ?>
										<option value="Permohonan Pelaporan Pindah Datang">Permohonan Pelaporan Pindah Datang</option>
									<?php }else{} ?>
									<?php if($params == "p_online"){ ?>
										<option value="Pengaduan Online">Pengaduan Online</option>
									<?php }else{} ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" name="Simpan" class="btn btn-flat btn-lg btn-primary"><i class="fa fa-save"></i> AJUKAN</button> 
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<a href="<?php echo site_url("c_list"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
							</div>
						</div>

					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>