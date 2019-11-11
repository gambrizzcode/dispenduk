<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Status 
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
						'p_online'	=> 'C_p_online'
					);
					echo $jenis_permohonan[$dari];
					?>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<h3>ID Register : <?php echo $id_reg; ?></h3>
						<?php
						if ($_SESSION['login']['role'] == "ADMIN") { ?>
							<a class="btn btn-flat btn-info" href="<?php echo site_url('c_list'); ?>">
							<i class="fa fa-list"></i> Ke List Permohonan </a>
							<a class="btn btn-flat btn-info" href="<?php echo site_url($kembali_permohonan[$dari]); ?>">
							<i class="fa fa-mouse-pointer"></i> Ke Halaman <?php echo $yoman_permohonan[$dari]; ?> </a>
						<?php }else{ ?>
							<a class="btn btn-flat btn-info" href="<?php echo site_url($kembali_permohonan[$dari]); ?>">
							<i class="fa fa-angle-double-left"></i> Kembali </a>
						<?php } ?>
						&nbsp;&nbsp;
						<?php if ($_SESSION['login']['role'] == "ADMIN") { ?>
							<?php
							$qdata_status = "SELECT * FROM status WHERE id_reg = '$id_reg' AND status = 'END'";
							$Baris_status = $this->M_akun->q_data($qdata_status)->num_rows();
							if ($Baris_status == 1) {}else{
							?>
								<a class="btn btn-flat btn-success" href="<?php echo site_url("c_list/form_status/".$id_reg."/".$dari); ?>">
								<i class="fa fa-edit"></i> Update Status </a>
								<a class="btn btn-flat btn-danger" href="<?php echo site_url("c_list/end_status/".$id_reg."/".$dari); ?>">
								<i class="fa fa-check"></i> End </a>
							<?php
							}
							?>
						<?php }else{ ?>

						<?php } ?>
					</div>
					<hr>
					<!-- PAGE CONTENT BEGINS -->
					<div class="row">
						<?php
						$data_sess = $this->session->userdata('login');
						?>
						<table class="table table-striped table-hovered">
							<thead>
								<tr>
									<th align="center">Tanggal dan Waktu</th>
									<th align="center">Status</th>
									<th align="center">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($qdatastatus as $stts) { ?>
									<tr>
										<td><?php echo date('H:i:s - d-m-Y',strtotime($stts->tgl_status)); ?></td>
										<td><?php echo $stts->status; ?></td>
										<td><?php echo $stts->ket; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>