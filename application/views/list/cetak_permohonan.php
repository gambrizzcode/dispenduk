<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>DISPENDUK CAPIL Jember</title>
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />		
	</head>
<script type="text/javascript">
	function prin() {
		window.print();
		// window.location("<?php //echo site_url('c_lahir'); ?>"); 
	}
</script>
<body onload="prin()" class="no-skin">
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<p>
						<h3 align="center">Data Permohonan</h3>
					</p>
					<hr>
					<table class="table table-condensed">
						<tr>
							<td align="right">ID Register</td>
							<td><?php echo $id_reg; ?></td>
						</tr>
						<tr>
							<td align="right">Nama Pemohon</td>
							<td><?php echo $nama_pemohon; ?></td>
						</tr>
						<tr>
							<td align="right">NIK Pemohon</td>
							<td><?php echo $nik_pemohon; ?></td>
						</tr>
						<tr>
							<td align="right">Tanggal Permohonan</td>
							<td><?php echo $tanggal; ?></td>
						</tr>
						<tr>
							<td align="right">Jenis Permohonan</td>
							<td><?php echo $jenis; ?></td>
						</tr>
						<tr>
							<td align="right">Status</td>
							<td>
								<?php
								$qdata_status = "SELECT * FROM permohonan INNER JOIN status ON permohonan.id_reg = status.id_reg WHERE permohonan.id_reg = '$id_reg' AND status.status <> '' ORDER BY status.tgl_status DESC";
								$Baris_status = $this->M_akun->q_data($qdata_status)->num_rows();
								if ($Baris_status >= 1) {
									$isi_status = $this->M_akun->q_data($qdata_status)->row();
									echo $isi_status->status;
								}else{}
								?>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>
