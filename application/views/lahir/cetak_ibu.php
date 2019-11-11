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
						<h3 align="center">Permohonan Pembuatan Akta Kelahiran</h3>
						<h4 align="center">Data Ibu</h4>
					</p>
					<hr>
					<table class="table table-condensed">
						<tr>
							<td align="right">ID Register</td>
							<td><?php echo $id_reg; ?></td>
						</tr>
						<tr>
							<td align="right">Nama</td>
							<td><?php echo $nama; ?></td>
						</tr>
						<tr>
							<td align="right">NIK Ibu</td>
							<td><?php echo $nik_ibu; ?></td>
						</tr>
						<tr>
							<td align="right">Tanggal Lahir</td>
							<td><?php echo date('d-m-Y',strtotime($tgl_lahir)); ?></td>
						</tr>
						<tr>
							<td align="right">Pekerjaan</td>
							<td><?php echo $kerja; ?></td>
						</tr>
						<tr>
							<td align="right">Alamat</td>
							<td><?php echo $alamat; ?></td>
						</tr>
						<tr>
							<td align="right">Rukun Tetangga (RT)</td>
							<td><?php echo $rt; ?></td>
						</tr>
						<tr>
							<td align="right">Rukun Warga (RW)</td>
							<td><?php echo $rw; ?></td>
						</tr>
						<tr>
							<td align="right">Kecamatan</td>
							<td><?php echo $kecamatan; ?></td>
						</tr>
						<tr>
							<td align="right">Desa / Kelurahan</td>
							<td><?php echo $kelurahan; ?></td>
						</tr>
						<tr>
							<td align="right">Kewarganegaraan</td>
							<td><?php echo $kewarganegaraan; ?></td>
						</tr>
						<tr>
							<td align="right">Kebangsaan</td>
							<td><?php echo $kebangsaan; ?></td>
						</tr>
						<tr>
							<td align="right">Tanggal Kawin</td>
							<td><?php echo date('d-m-Y',strtotime($tgl_kawin)); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>
