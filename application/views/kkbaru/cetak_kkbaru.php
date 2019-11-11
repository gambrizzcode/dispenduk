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
						<h3 align="center">Permohonan Pencetakan KK Baru</h3>
					</p>
					<hr>
					<table class="table table-condensed">
						<tr>
							<td align="center">ID Register : <?php echo $id_reg; ?></td>
						</tr>
						<tr>
							<td align="center">Nomor Kartu Keluarga : <?php echo $kk; ?></td>
						</tr>
						<tr>
							<td align="center">Nomor Induk Kependudukan (NIK) : <?php echo $nik; ?></td>
						</tr>
						<tr>
							<td align="center">Nama : <?php echo $nama; ?></td>
						</tr>
						<tr>
							<td align="center">Surat Keterangan Dari Kecamatan</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($sk == "" || $sk == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$sk; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">Scan / Foto KTP Asli</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($ktp == "" || $ktp == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$ktp; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">Form F101</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($f101 == "" || $f101 == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$f101; ?>">
								<?php } ?>
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
