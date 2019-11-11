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
		// window.location("<?php //site_url('c_user'); ?>");
	}
</script>
<body onload="prin()" class="no-skin">
<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<p>
						<h3>Detail Data User ID : <?php echo $id_user; ?></h3>
					</p>
					<input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user; ?>">
					<table class="table table-condensed">
						<tr>
							<td align="right">Nama</td>
							<td><?php echo $nama; ?></td>
						</tr>
						<tr>
							<td align="right">Nomor Kartu Keluarga</td>
							<td><?php echo $nkk; ?></td>
						</tr>
						<tr>
							<td align="right">Nomor Induk Kependudukan</td>
							<td><?php echo $nik; ?></td>
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
							<td><?php if($jk == "L"){echo "Laki - Laki";}else{echo "Perempuan";} ?></td>
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
							<td align="right">Email</td>
							<td><?php echo $email; ?></td>
						</tr>
						<tr>
							<td align="right">Password</td>
							<td><b style="color: red">********</b></td>
						</tr>
						<tr>
							<td align="right">Nomor HP 1</td>
							<td><?php echo $hp1; ?></td>
						</tr>
						<tr>
							<td align="right">Nomor HP 2</td>
							<td><?php echo $hp2; ?></td>
						</tr>
						<tr>
							<td align="right">Foto / Scan KK</td>
							<td>
								<?php if ($scan_kk == "") { ?>
									<b style="color: red">Tidak Ada Scan / Foto KK</b>
								 <?php }else{ ?>
									<img style="max-height: 144px" src="<?php echo base_url().$scan_kk; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="right">Foto / Scan KTP</td>
							<td>
								<?php if ($scan_ktp == "") { ?>
									<b style="color: red">Tidak Ada Scan / Foto KTP</b>
								 <?php }else{ ?>
									<img style="max-height: 144px" src="<?php echo base_url().$scan_ktp; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="right">Foto Profil</td>
							<td>
								<?php if ($foto_profil == "") { ?>
									<b style="color: red">Tidak Ada Foto Profil</b>
								 <?php }else{ ?>
									<img style="max-height: 144px" src="<?php echo base_url().$foto_profil; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="right">Role</td>
							<td><?php echo $role; ?></td>
						</tr>
						<tr>
							<td align="right">Status</td>
							<td><?php if($status == "1"){echo "AKTIF";}else{echo "TIDAK AKTIF";} ?></td>
						</tr>
					</table>

					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</body>
