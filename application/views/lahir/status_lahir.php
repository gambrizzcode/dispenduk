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
					<div class="row">
						<a class="btn btn-flat btn-warning" href="<?php echo site_url("c_lahir"); ?>">
						<i class="fa fa-angle-double-left"></i> Kembali </a>
						&nbsp;&nbsp;
						<?php if ($_SESSION['login']['role'] == "ADMIN") { ?>
							<a class="btn btn-flat btn-success" href="<?php echo site_url("c_lahir"); ?>">
							<i class="fa fa-edit"></i> Update Status </a>
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
									<th align="center">#</th>
									<th align="center">Tanggal dan Waktu</th>
									<th align="center">Status</th>
									<th align="center">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach($qdatastatus as $stts) { ?>
									<tr>
										<td><?php echo $no++; ?></td>
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