<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Permohonan Pembuatan Akta Kelahiran
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->				
					<div class="col-md-12">
						<div>
							<h2>
								<?php echo $this->session->flashdata('pesan'); ?>
							</h2>
						</div>
						<?php if ($ada == 0) { ?>
							<div class="row">
								<div class="col-md-12" align="center">
									<h5>Tekan tombol di bawah ini</h5>
									<h5>untuk melakukan pengajuan</h5>
									<h5>Permohonan Pembuatan Akta Kelahiran</h5>
									<br>
									<?php //foreach ($qdatauser as $usr) {
										// if ($usr->status) {
											
										// }
									?>

									<?php //} ?>
									<a class="btn btn-flat btn-success btn-lg" href="<?php echo site_url("c_list/form_mohon/lahir"); ?>">
									<i class="fa fa-plus-circle"></i> Tambah </a>
								</div>
							</div>
						<?php }else{ ?>
							<div class="row">
								<div class="col-md-12">
									<?php
									if ($ada == 110) { ?>
										<div align="center">
											<h5><b>Permohonan Anda Telah selesai</b></h5>
											<h5><b>Anda boleh mengajukan permohonan baru</b></h5>
											<br>
											<a class="btn btn-flat btn-success btn-lg" href="<?php echo site_url("c_list/form_mohon/lahir"); ?>">
											<i class="fa fa-plus-circle"></i> Tambah </a>
											<br>
											<hr>
											<br>
										</div>
									<?php }
									foreach ($qdatauser as $usr) { ?>
									<div class="row">
										<div class="col-md-8">
											ID Register Anda : <b><?php $id_reg = $usr->id_reg; echo $id_reg; ?></b><br>
											- Anda telah melakukan pengajuan awal<br>
											- Untuk melakukan pengajuan permohonan lebih lanjut silahkan lengkapi beberapa form berikut.<br>
											- Jika semua form dibawah ini belum terisi maka permohonan tidak dapat diajukan.<br>
										</div>
										<div class="col-md-4">
											<?php
											if ($usr->id_status == "") { ?>
												<a class="btn btn-flat btn-danger" onclick="return confirm('Yakin Finalisasi ?');" href="<?php echo site_url("c_list/finalisasi/".$usr->id_reg."/c_lahir"); ?>">
												<i class="fa fa-check"></i> Finalisasi </a>
											<?php }else{ ?>
												<a class="btn btn-flat btn-success" href="<?php echo site_url("c_list/status_permohonan/".$usr->id_reg."/lahir"); ?>">
												<i class="fa fa-exclamation"></i> Status </a>
											<?php } ?>
										</div>
									</div>
									<hr>
										
									<div align="center" class="row">
										<?php
										$qdata_permohonan = "SELECT * FROM permohonan WHERE id_reg = '$id_reg' AND id_status <> '' ";
										$Barispermohonan = $this->M_akun->q_data($qdata_permohonan)->num_rows();
										// $id_reg = $usr->id_reg;
										$qdata_bayi = "SELECT * FROM lahir_bayi WHERE id_reg = '$id_reg' AND nama <> ''";
										$BarisBayi = $this->M_akun->q_data($qdata_bayi)->num_rows();
										if ($BarisBayi == 1) { ?>
											<h4>Form Data Bayi Terisi</h4>
											<a class="btn btn-flat btn-warning btn-sm" href="<?php echo site_url("c_lahir/detail_bayi/".$usr->id_reg); ?>">
											<i class="fa fa-child"></i> Detail </a>
										<?php if ($Barispermohonan == 1) {}else{ ?>
											<a class="btn btn-flat btn-success btn-sm" href="<?php echo site_url("c_lahir/form_bayi/".$usr->id_reg); ?>">
											<i class="fa fa-child"></i> Edit </a>
										<?php } ?>
										<?php }else{ ?>
											<a class="btn btn-flat btn-primary" href="<?php echo site_url("c_lahir/form_bayi/".$usr->id_reg); ?>">
											<i class="fa fa-child"></i> Form Bayi </a>
										<?php } ?>

										<hr>

										<?php
										// $id_reg = $usr->id_reg;
										$qdata_bapak = "SELECT * FROM lahir_bapak WHERE id_reg = '$id_reg' AND nama <> ''";
										$BarisBapak = $this->M_akun->q_data($qdata_bapak)->num_rows();
										if ($BarisBapak == 1) { ?>
											<h4>Form Data Bapak Terisi</h4>
											<a class="btn btn-flat btn-warning btn-sm" href="<?php echo site_url("c_lahir/detail_bapak/".$usr->id_reg); ?>">
											<i class="fa fa-user-secret"></i> Detail </a>
										<?php if ($Barispermohonan == 1) {}else{ ?>
											<a class="btn btn-flat btn-success btn-sm" href="<?php echo site_url("c_lahir/form_bapak/".$usr->id_reg); ?>">
											<i class="fa fa-user-secret"></i> Edit </a>
										<?php } ?>
										<?php }else{ ?>
											<a class="btn btn-flat btn-primary" href="<?php echo site_url("c_lahir/form_bapak/".$usr->id_reg); ?>">
											<i class="fa fa-user-secret"></i> Form Bapak </a>
										<?php } ?>
										
										<hr>

										<?php
										// $id_reg = $usr->id_reg;
										$qdata_ibu = "SELECT * FROM lahir_ibu WHERE id_reg = '$id_reg' AND nama <> ''";
										$BarisIbu = $this->M_akun->q_data($qdata_ibu)->num_rows();
										if ($BarisIbu == 1) { ?>
											<h4>Form Data Ibu Terisi</h4>
											<a class="btn btn-flat btn-warning btn-sm" href="<?php echo site_url("c_lahir/detail_ibu/".$usr->id_reg); ?>">
											<i class="fa fa-female"></i> Detail </a>
										<?php if ($Barispermohonan == 1) {}else{ ?>
											<a class="btn btn-flat btn-success btn-sm" href="<?php echo site_url("c_lahir/form_ibu/".$usr->id_reg); ?>">
											<i class="fa fa-female"></i> Edit </a>
										<?php } ?>
										<?php }else{ ?>
											<a class="btn btn-flat btn-primary" href="<?php echo site_url("c_lahir/form_ibu/".$usr->id_reg); ?>">
											<i class="fa fa-female"></i> Form Ibu </a>
										<?php } ?>

										<hr>

										<?php
										// $id_reg = $usr->id_reg;
										$qdata_saksi1 = "SELECT * FROM lahir_saksi1 WHERE id_reg = '$id_reg' AND nama <> ''";
										$BarisSaksi1 = $this->M_akun->q_data($qdata_saksi1)->num_rows();
										if ($BarisSaksi1 == 1) { ?>
											<h4>Form Data Saksi 1 Terisi</h4>
											<a class="btn btn-flat btn-warning btn-sm" href="<?php echo site_url("c_lahir/detail_saksi1/".$usr->id_reg); ?>">
											<i class="fa fa-group"></i> Detail </a>
										<?php if ($Barispermohonan == 1) {}else{ ?>
											<a class="btn btn-flat btn-success btn-sm" href="<?php echo site_url("c_lahir/form_saksi1/".$usr->id_reg); ?>">
											<i class="fa fa-group"></i> Edit </a>
										<?php } ?>
										<?php }else{ ?>
											<a class="btn btn-flat btn-primary" href="<?php echo site_url("c_lahir/form_saksi1/".$usr->id_reg); ?>">
											<i class="fa fa-group"></i> Form Saksi 1 </a>
										<?php } ?>

										<hr>

										<?php
										// $id_reg = $usr->id_reg;
										$qdata_saksi2 = "SELECT * FROM lahir_saksi2 WHERE id_reg = '$id_reg' AND nama <> ''";
										$BarisSaksi2 = $this->M_akun->q_data($qdata_saksi2)->num_rows();
										if ($BarisSaksi2 == 1) { ?>
											<h4>Form Data Saksi 2 Terisi</h4>
											<a class="btn btn-flat btn-warning btn-sm" href="<?php echo site_url("c_lahir/detail_saksi2/".$usr->id_reg); ?>">
											<i class="fa fa-group"></i> Detail </a>
										<?php if ($Barispermohonan == 1) {}else{ ?>
											<a class="btn btn-flat btn-success btn-sm" href="<?php echo site_url("c_lahir/form_saksi2/".$usr->id_reg); ?>">
											<i class="fa fa-group"></i> Edit </a>
										<?php } ?>
										<?php }else{ ?>
											<a class="btn btn-flat btn-primary" href="<?php echo site_url("c_lahir/form_saksi2/".$usr->id_reg); ?>">
											<i class="fa fa-group"></i> Form Saksi 2 </a>
										<?php } ?>

										<hr>

										<?php
										// $id_reg = $usr->id_reg;
										$qdata_administrasi = "SELECT * FROM lahir_administrasi WHERE id_reg = '$id_reg' AND surat_kelahiran <> ''";
										$BarisAdministrasi = $this->M_akun->q_data($qdata_administrasi)->num_rows();
										if ($BarisAdministrasi == 1) { ?>
											<h4>Form Data Administrasi Terisi</h4>
											<a class="btn btn-flat btn-warning btn-sm" href="<?php echo site_url("c_lahir/detail_administrasi/".$usr->id_reg); ?>">
											<i class="fa fa-files-o"></i> Detail </a>
										<?php if ($Barispermohonan == 1) {}else{ ?>
											<a class="btn btn-flat btn-success btn-sm" href="<?php echo site_url("c_lahir/form_administrasi/".$usr->id_reg); ?>">
											<i class="fa fa-files-o"></i> Edit </a>
										<?php } ?>
										<?php }else{ ?>
											<a class="btn btn-flat btn-primary" href="<?php echo site_url("c_lahir/form_administrasi/".$usr->id_reg); ?>">
											<i class="fa fa-files-o"></i> Form Administrasi </a>
										<?php } ?>

										<hr>
										</div>
									<?php } ?>
									- Semua data di atas masih bisa diedit / diubah selama belum di <b>Finalisasi</b> oleh pemohon. <br>
									- Apabila pemohon merasa data yang dimasukkan telah benar dan sesuai, maka klik tombol <b>Finalisasi.</b><br>
									- Setelah diklik tombol <b>Finalisasi</b> maka <b>Status</b> Permohonan bisa dipantau dan diikuti perkembangannya dengan klik tombol <b>Status</b>.<br>
									- Perkembangan Status juga akan diberitahukan lewat email pemohon.<br>
								</div>
							</div>
						<?php } ?>
					</div>
					
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>