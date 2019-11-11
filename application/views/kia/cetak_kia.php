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
						<h3 align="center">Permohonan Pembuatan/Pencetakan KIA</h3>
					</p>
					<hr>
					<table class="table table-condensed">
						<tr>
							<td align="right">ID Register</td>
							<td><?php echo $id_reg; ?></td>
						</tr>
						<tr>
							<td align="right">NIK Anak</td>
							<td><?php echo $nik_anak; ?></td>
						</tr>
						<tr>
							<td align="right">Nama</td>
							<td><?php echo $nama; ?></td>
						</tr>
						<tr>
							<td align="right">Tempat Lahir</td>
							<td><?php echo $tempat_lahir; ?></td>
						</tr>
						<tr>
							<td align="right">Tanggal Lahir</td>
							<td><?php echo date('d-m-Y',strtotime($tgl_lahir)); ?></td>
						</tr>
						<tr>
							<td align="right">Jenis Kelamin</td>
							<td><?php if($jk == "L"){echo "Laki - Laki";}elseif($jk == "P"){echo "Perempuan";} ?></td>
						</tr>
						<tr>
							<td align="right">Nomor Kartu Keluarga</td>
							<td><?php echo $nkk; ?></td>
						</tr>
						<tr>
							<td align="right">Nama Kepala Keluarga</td>
							<td><?php echo $nama_kk; ?></td>
						</tr>
						<tr>
							<td align="right">No Akta Kelahiran</td>
							<td><?php echo $no_akta; ?></td>
						</tr>
						<tr>
							<td align="right">Agama</td>
							<td><?php echo $agama; ?></td>
						</tr>
						<tr>
							<td align="right">Kewarganegaraan</td>
							<td><?php echo $kewarganegaraan; ?></td>
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
							<td align="right">Kelurahan</td>
							<td><?php echo $kelurahan; ?></td>
						</tr>
						<tr>
							<td colspan="2" align="center">Scan / Foto Kartu Keluarga</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<?php if ($upload_kk == "" || $upload_kk == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$upload_kk; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">Scan / Foto Akta Kelahiran</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<?php if ($upload_akta == "" || $upload_akta == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$upload_akta; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">Scan / Foto KTP Orang Tua</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<?php if ($ktp_ortu == "" || $ktp_ortu == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$ktp_ortu; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">Pas Foto</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<?php if ($pas_foto == "" || $pas_foto == "img/") { ?>
									<b style="color: red">Tidak Ada File</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$pas_foto; ?>">
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
