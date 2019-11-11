<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Permohonan Pembuatan/Pencetakan KIA
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
									<h5>Permohonan Pembuatan/Pencetakan KIA</h5>
									<br>
									<?php //foreach ($qdatauser as $kkb) {
										// if ($kkb->status) {
											
										// }
									?>

									<?php //} ?>
									<a class="btn btn-flat btn-success btn-lg" href="<?php echo site_url("c_list/form_mohon/kia"); ?>">
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
											<a class="btn btn-flat btn-success btn-lg" href="<?php echo site_url("c_list/form_mohon/kia"); ?>">
											<i class="fa fa-plus-circle"></i> Tambah </a>
											<br>
											<hr>
											<br>
										</div>
									<?php }

									foreach ($qdatakia as $kkb) { ?>
									<div class="row">
										<div class="col-md-8">
											ID Register Anda : <b><?php $id_reg = $kkb->id_reg; echo $id_reg; ?></b><br>
											- Anda telah melakukan pengajuan awal<br>
											- Untuk melakukan pengajuan permohonan lebih lanjut silahkan lengkapi beberapa form berikut.<br>
											- Jika semua form dibawah ini belum terisi maka permohonan tidak dapat diajukan.<br>
										</div>
										<div class="col-md-4">
											<?php
											if ($kkb->id_status == "") { ?>
												<a class="btn btn-flat btn-danger" onclick="return confirm('Yakin Finalisasi ? ');" href="<?php echo site_url("c_list/finalisasi/".$kkb->id_reg."/c_kia"); ?>">
												<i class="fa fa-check"></i> Finalisasi </a>
											<?php }else{ ?>
												<a class="btn btn-flat btn-success" href="<?php echo site_url("c_list/status_permohonan/".$kkb->id_reg."/kia"); ?>">
												<i class="fa fa-exclamation"></i> Status </a>
											<?php } ?>
										</div>
									</div>
									<hr>
									<div align="center" class="row">
										<?php
										$qdata_permohonan = "SELECT * FROM permohonan WHERE id_reg = '$id_reg' AND id_status <> '' ";
										$Barispermohonan = $this->M_akun->q_data($qdata_permohonan)->num_rows();
										// $id_reg = $kkb->id_reg;
										$qdata_kia = "SELECT * FROM kia WHERE id_reg = '$id_reg' AND nama <> ''";
										$Bariskkb = $this->M_akun->q_data($qdata_kia)->num_rows();
										if ($Bariskkb == 1) { ?>
											<h4>Form Data Permohonan Terisi</h4>
											<a class="btn btn-flat btn-warning btn-sm" href="<?php echo site_url("c_kia/detail_kia/".$kkb->id_reg); ?>">
											<i class="fa fa-file-text-o"></i> Detail </a>
										<?php if ($Barispermohonan == 1) {}else{ ?>
											<a class="btn btn-flat btn-success btn-sm" href="<?php echo site_url("c_kia/form_kia/".$kkb->id_reg); ?>">
											<i class="fa fa-file-text-o"></i> Edit </a>
										<?php } ?>
										<?php }else{ ?>
											<a class="btn btn-flat btn-primary" href="<?php echo site_url("c_kia/form_kia/".$kkb->id_reg); ?>">
											<i class="fa fa-file-o"></i> Form Pengajuan </a>
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