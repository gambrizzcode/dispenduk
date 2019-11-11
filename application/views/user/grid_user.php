<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo $Alert_Akun;
?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h4>
					List Data User
				</h4>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form class="form-horizontal form-inline" role="form" method="post" action="">
						<div class="datatable-top">
							<div class="pull-left">
								<div class="dataTables_length" id="DataTables_Table_0_length" style="margin-left: 10px;">
									<div class="form-group">
										<div class="col-sm-12">
								
											<a class="btn btn-social btn-sm btn-facebook" href="<?php echo site_url("c_user/form_user"); ?>">
												<i class="fa fa-plus-circle"></i> Tambah </a>
										</div>
								
									</div>
								</div>
							</div>
						</div>
					</form>
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
									<th>NIK</th>
									<th>Tgl Register</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Kecamatan</th>
									<th>Jml Layanan</th>
									<th>Status</th>
									<th>Role</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($qdataakun as $kdt => $vdt) {
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $vdt->nik; ?></td>
										<td><?php echo date('d-m-Y',strtotime($vdt->tgl_register)); ?></td>
										<td><?php echo $vdt->nama; ?></td>
										<td><?php echo $vdt->alamat; ?></td>
										<td><?php echo $vdt->kecamatan; ?></td>
										<td>
											<?php
											$queryLayanan = "SELECT * FROM permohonan INNER JOIN user ON permohonan.nik_pemohon = user.nik WHERE user.nik = '$vdt->nik' ORDER BY permohonan.tanggal DESC";
											$barisLayanan = $this->M_akun->q_data($queryLayanan)->num_rows();
											if ($barisLayanan == 0) {
												echo "0";
											}else{
												echo $barisLayanan;
											}
											?>
										</td>
										<td><?php if($vdt->status == '1'){echo "<b>AKTIF</b>";}else{echo "TIDAK AKTIF";} ?></td>
										<td><?php echo $vdt->role; ?></td>
										<td>
											<div class="btn-group">
												<button class="btn btn-xs btn-success" title="Detail" onclick="location='<?php echo site_url("c_user/detail_user/".$vdt->id_user); ?>'">
													<i class="ace-icon fa fa-search bigger-120"></i>
												</button>

												<button class="btn btn-xs btn-info" title="Edit" onclick="location='<?php echo site_url("c_user/form_user/".$vdt->id_user); ?>'">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
												</button>

												<button class="btn btn-xs btn-danger" title="Hapus" onclick="location='<?php echo site_url("c_user/delete_user/".$vdt->id_user); ?>'">
													<i class="ace-icon fa fa-trash-o bigger-120"></i>
												</button>

												<?php
												if ($vdt->status == '0' || $vdt->status == 0 || $vdt->status == '') { ?>
												<button class="btn btn-xs btn-warning" title="Aktivasi" onclick="location='<?php echo site_url("c_user/aktivasi/".$vdt->id_user); ?>'">
													<i class="ace-icon fa fa-check bigger-120"></i>
												</button>
												<?php } ?>
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