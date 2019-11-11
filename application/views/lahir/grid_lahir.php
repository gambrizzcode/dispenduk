<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h4>
					Permohonan Pembuatan Akta Kelahiran
				</h4>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<!-- <form class="form-horizontal form-inline" role="form" method="post" action="">
						<div class="datatable-top">
							<div class="pull-left">
								<div class="dataTables_length" id="DataTables_Table_0_length" style="margin-left: 10px;">
									<div class="form-group">
										<div class="col-sm-12">
								
											<a class="btn btn-social btn-sm btn-facebook" href="<?php //echo site_url("c_list/form_mohon/lahir"); ?>">
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
									<th>No Registrasi</th>
									<th>Tgl Register</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>NIK Bayi</th>
									<th>Nama Bayi</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($qdatalahir as $kdt => $vdt) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $vdt->id_reg; ?></td>
										<td><?php echo date('d-m-Y',strtotime($vdt->tanggal)); ?></td>
										<td><?php echo $vdt->nik_pemohon; ?></td>
										<td><?php echo $vdt->nama_pemohon; ?></td>
										<td><?php echo $vdt->nik_bayi ?></td>
										<td><?php echo $vdt->nama; ?></td>
										<td><?php
										$qdata_status = "SELECT * FROM permohonan INNER JOIN status ON permohonan.id_reg = status.id_reg WHERE permohonan.id_reg = '$vdt->id_reg' AND status.status <> '' ORDER BY status.tgl_status DESC";
										$Baris_status = $this->M_akun->q_data($qdata_status)->num_rows();
										if ($Baris_status >= 1) {
											$isi_status = $this->M_akun->q_data($qdata_status)->row();
											echo $isi_status->status;
										}else{}
										?></td>
										<td>
											<div class="btn-group">
												<button class="btn btn-xs btn-success" title="Detail" onclick="location='<?php echo site_url("c_lahir/detail_lahir/".$vdt->id_reg); ?>'">
													<i class="ace-icon fa fa-search bigger-120"></i>
												</button>

												<!-- <button class="btn btn-xs btn-info" title="Edit" onclick="location='<?php //echo site_url("c_lahir/form_lahir/".$vdt->id_reg); ?>'">
													<i class="ace-icon fa fa-edit bigger-120"></i>
												</button> -->

												<button class="btn btn-xs btn-primary" title="Status" onclick="location='<?php echo site_url("c_list/status_permohonan/".$vdt->id_reg."/lahir"); ?>'">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>

												<button class="btn btn-xs btn-danger" title="Hapus" onclick="location='<?php echo site_url("c_lahir/delete_lahir/".$vdt->id_reg); ?>'">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
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