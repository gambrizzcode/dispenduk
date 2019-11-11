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
						<h3 align="center">Pengaduan Online / Help Desk</h3>
					</p>
					<hr>
					<table class="table table-condensed">
						<tr>
							<td align="center">ID Register : <?php echo $id_reg; ?></td>
						</tr>
						<tr>
							<td align="center">Nomor Induk Kependudukan (NIK) : <?php echo $nik; ?></td>
						</tr>
						<tr>
							<td align="center">Nama : <?php echo $nama; ?></td>
						</tr>
						<tr>
							<td align="center">Subjek : <?php echo $subjek; ?></td>
						</tr>
						<tr>
							<td align="center">Uraian : <?php echo $uraian; ?></td>
						</tr>
						<tr>
							<td align="center">Waktu : <?php echo date('H:i:s d-m-Y',strtotime($waktu)); ?></td>
						</tr>
						<tr>
							<td align="center">Bukti 1</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($bukti1 == "" || $bukti1 == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$bukti1; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">Bukti 2</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($bukti2 == "" || $bukti2 == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$bukti2; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">Bukti 3</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($bukti3 == "" || $bukti3 == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$bukti3; ?>">
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
