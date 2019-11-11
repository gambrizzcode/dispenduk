<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Form Update Status Permohonan 
					<?php
					$jenis_permohonan = array(
						'lahir'		=> 'Permohonan Pembuatan Akte Kelahiran',
						'mati'		=> 'Permohonan Pembuatan Akte kematian',
						'ktpbaru'	=> 'Registrasi KTP Baru',
						'ktprusak'	=> 'Pengajuan KTP-El Rusak',
						'rekamktp' 	=> 'Permohonan Pencetakan Surat Keterangan Perekaman KTP',
						'kkbaru'	=> 'Permohonan Pencetakan KK Baru',
						'kkrusak'	=> 'Permohonan Pencetakan KK Hilang/Rusak',
						'kia'		=> 'Permohonan Pembuatan/Pencetakan KIA',
						'pindah'	=> 'Permohonan Pelaporan Pindah Datang',
						'p_online'	=> 'Pengaduan Online'
					);
					$yoman_permohonan = array(
						'lahir'		=> 'Akte Kelahiran',
						'mati'		=> 'Akte kematian',
						'ktpbaru'	=> 'KTP-El Baru',
						'ktprusak'	=> 'KTP-El Rusak',
						'rekamktp' 	=> 'Ket. Perekaman KTP',
						'kkbaru'	=> 'KK Baru',
						'kkrusak'	=> 'KK Hilang/Rusak',
						'kia'		=> 'Pencetakan KIA',
						'pindah'	=> 'Lapor Pindah Datang',
						'p_online'	=> 'Pengaduan Online'
					);
					$kembali_permohonan = array(
						'lahir'		=> 'C_lahir',
						'mati'		=> 'C_mati',
						'ktpbaru'	=> 'C_ktpbaru',
						'ktprusak'	=> 'C_ktprusak',
						'rekamktp' 	=> 'C_rekamktp',
						'kkbaru'	=> 'C_kkbaru',
						'kkrusak'	=> 'C_kkrusak',
						'kia'		=> 'C_kia',
						'pindah'	=> 'C_pindah',
						'p_online'	=> 'C_aduan'
					);
					echo $jenis_permohonan[$dari];
				?>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form enctype="multipart/form-data" action="<?php echo site_url("c_list/save_status"); ?>" class="form-horizontal" role="form" accept="" method="POST" autocomplete="off">

						<input type="hidden" name="id_reg" value="<?php echo $id_reg; ?>">
						<input type="hidden" name="dari" value="<?php echo $dari; ?>">
						<input type="hidden" name="emailp" value="<?php echo $emailp; ?>">

						<div class=form-group>
							<label class="col-sm-3 control-label">ID Register</label>
							<div class=col-sm-5>
								<label class="control-label"><?php echo $id_reg ?></label>
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Status</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="status" id="status" required="required">
							</div>
						</div>

						<div class=form-group>
							<label class="col-sm-3 control-label">Keterangan</label>
							<div class=col-sm-5>
								<input type="text" class="form-control input-sm" name="ket" id="ket" required="required">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" name="Simpan" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-save"></i> UPDATE</button> 
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="reset" class="btn btn-flat btn-xs btn-default"><i class="fa fa-refresh"></i> Reset Kolom </button>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<a href="<?php echo site_url("c_list/status_permohonan/".$id_reg."/".$dari); ?>" class="btn btn-flat btn-warning btn-xs"><i class="fa fa-arrow-left"></i> Kembali </a>
							</div>
						</div>

					</form>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>