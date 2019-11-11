<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Data Pencetakan KIA
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_kkbaru/cetak_bbaru"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">
						<div class="form-group">
							<label class="col-sm-4 control-label">ID Registrasi</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $id_reg; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">NIK Anak</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $nik_anak; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $nama; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Tempat Lahir</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $tempat_lahir; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Tanggal Lahir</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo date('d-m-Y',strtotime($tgl_lahir)); ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Jenis Kelamin</label>
							<div class=col-sm-5>
								<label class="control-label"><?php if($jk == "L"){echo "Laki - Laki";}elseif($jk == "P"){echo "Perempuan";} ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Nomor Kartu Keluarga</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $nkk; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama Kepala Keluarga</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $nama_kk; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Nomor Akta Kelahiran</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $no_akta; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Agama</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $agama; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Kewarganegaraan</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $kewarganegaraan; ?></label>
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
						<div class="form-group">
							<label class="col-sm-4 control-label">Kecamatan</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $kecamatan; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Kelurahan</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $kelurahan; ?></label>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Scan / Foto Kartu Keluarga</label>
							<div class=col-sm-5>
								<?php if ($upload_kk == "" || $upload_kk == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$upload_kk; ?>">
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Scan / Foto Akta Kelahiran</label>
							<div class=col-sm-5>
								<?php if ($upload_akta == "" || $upload_akta == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$upload_akta; ?>">
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Scan / Foto KTP Orang Tua</label>
							<div class=col-sm-5>
								<?php if ($ktp_ortu == "" || $ktp_ortu == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$ktp_ortu; ?>">
								<?php } ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Pas Foto</label>
							<div class=col-sm-5>
								<?php if ($pas_foto == "" || $pas_foto == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$pas_foto; ?>">
								<?php } ?>
							</div>
						</div>

						<hr>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<a href="<?php echo site_url("c_kia/cetak_kia/".$id_reg); ?>" target="_blank" class="btn btn-flat btn-danger btn-lg"><i class="fa fa-print"></i> Cetak </a>
								<?php
									if ($_SESSION['login']['role'] == "ADMIN") { ?>
										<a href="<?php echo site_url("c_kia/grid_kia"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
									<?php }elseif ($_SESSION['login']['role'] == "USER") { ?>
										<a href="<?php echo site_url("c_kia/front_kia"); ?>" class="btn btn-flat btn-warning btn-lg"><i class="fa fa-arrow-left"></i> Kembali </a>
									<?php } ?>
							</div>
						</div>
					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>