<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo $Alert_Akun;
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h4>
					Data Permohonan Masuk
				</h4>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php
					$jenis_jenis = array(
						'Permohonan Pembuatan Akte Kelahiran'					=> 'lahir',
						'Permohonan Pembuatan akta kematian'					=> 'mati',
						'Registrasi KTP Baru'									=> 'ktpbaru',
						'Pengajuan KTP-El Rusak'								=> 'ktprusak',
						'Permohonan Pencetakan Surat Keterangan Perekaman KTP'	=> 'rekamktp',
						'Permohonan Pencetakan KK Baru'							=> 'kkbaru',
						'Permohonan Pencetakan KK Hilang/Rusak'					=> 'kkrusak',
						'Permohonan Pembuatan/Pencetakan KIA'					=> 'kia',
						'Permohonan Pelaporan Pindah Datang'					=> 'pindah',
						'Pengaduan Online'										=> 'p_online'
					);
					?>
					<!-- PAGE CONTENT BEGINS -->
					<!-- <form class="form-horizontal form-inline" role="form" method="post" action="">
						<div class="datatable-top">
							<div class="pull-left">
								<div class="dataTables_length" id="DataTables_Table_0_length" style="margin-left: 10px;">
									<div class="form-group">
										<div class="col-sm-12">
								
											<a class="btn btn-social btn-sm btn-facebook" href="<?php //echo site_url("c_list/form_mohon"); ?>">
												<i class="fa fa-plus-circle"></i> Tambah </a>
										</div>
								
									</div>
								</div>
							</div>
						</div>
					</form> -->
					<div class="col-md-12">
						<div>
							<h2>
								<?php echo $this->session->flashdata('pesan'); ?>
							</h2>
						</div>
						<div class="dataTables_borderWrap">
						<table id="duatatuabel" class="table table-condensed table-bordered table-striped table-hover table-responsive" style="width: 100%">
							<thead>
								<tr>
									<th>#</th>
									<th>ID Registrasi</th>
									<th>Tanggal</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Jenis Layanan</th>
									<th>Status</th>
									<th>Ket</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($qdatalist as $kdt => $vdt) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $vdt->id_reg; ?></td>
										<td><?php echo date('d-m-Y',strtotime($vdt->tanggal)); ?></td>
										<td><?php echo $vdt->nik_pemohon; ?></td>
										<td><?php echo $vdt->nama_pemohon; ?></td>
										<td><?php echo $vdt->jenis; ?></td>
										<?php
										$qdata_status = "SELECT * FROM permohonan INNER JOIN status ON permohonan.id_reg = status.id_reg WHERE permohonan.id_reg = '$vdt->id_reg' AND status.status <> '' ORDER BY status.tgl_status DESC";
										$Baris_status = $this->M_akun->q_data($qdata_status)->num_rows();
										if ($Baris_status >= 1) {
											$isi_status = $this->M_akun->q_data($qdata_status)->row();
											echo "<td>".$isi_status->status."</td>";
											echo "<td>".$isi_status->ket."</td>";
										}else{
											echo "<td></td>";
											echo "<td></td>";
										}
										?>
										<td>
											<div class="btn-group">
												<button class="btn btn-xs btn-success" title="DETAIL" onclick="location='<?php echo site_url("c_list/detail_list/".$vdt->id_reg); ?>'">
													<i class="ace-icon fa fa-search bigger-120"></i>
												</button>

												<button class="btn btn-xs btn-info" title="UBAH STATUS" onclick="location='<?php echo site_url("c_list/status_permohonan/".$vdt->id_reg."/".$jenis_jenis[$vdt->jenis]); ?>'">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						</div>
					</div>

					<!--Pagging--> 
					<?php echo $pagging; ?>
					<!--End Pagging--> 
					
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>