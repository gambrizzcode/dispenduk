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
						<h4 align="center">Data Administrasi</h4>
					</p>
					<hr>
					<table class="table table-condensed">
						<tr>
							<td align="center">ID Register : <?php echo $id_reg; ?></td>
						</tr>
						<tr>
							<td align="center">Nomor Handphone : <?php echo $no_hp; ?></td>
						</tr>
						<tr>
							<td align="center">Surat Kelahiran Dari Dokter / Bidan / Penolong</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($surat_kelahiran == "" || $surat_kelahiran == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$surat_kelahiran; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">Fotocopy KTP Saksi</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($ktp_saksi == "" || $ktp_saksi == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$ktp_saksi; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">Kartu Keluarga Orang Tua</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($ktp_ortu == "" || $ktp_ortu == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$kk_ortu; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">KTP Orang Tua</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($ktp_ortu == "" || $ktp_ortu == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$ktp_ortu; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">Kutipan Akta Nikah Orang Tua</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($akta_nikah == "" || $akta_nikah == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$akta_nikah; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">SPTJM Kebenaran Data Kelahiran</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($sptjm_lahir == "" || $sptjm_lahir == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$sptjm_lahir; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="center">SPTJM Kebenaran Sebagai Pasangan Suami-Istri</td>
						</tr>
						<tr>
							<td align="center">
								<?php if ($sptjm_pasangan == "" || $sptjm_pasangan == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$sptjm_pasangan; ?>">
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
