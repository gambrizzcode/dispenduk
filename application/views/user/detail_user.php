<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Detail Data User
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						ID : <?php echo $id_user; ?>
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<p align="right">
						<a href="<?php echo site_url("c_user/print_detail_user/".$id_user); ?>" target="_blank" class="btn btn-flat btn-primary"><i class="fa fa-print"></i> Cetak </a>
						<a href="<?php echo site_url("c_user/grid_user"); ?>" class="btn btn-flat btn-warning"><i class="fa fa-arrow-left"></i> Kembali </a>
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
									<img style="max-height: 240px" src="<?php echo base_url().$scan_kk; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="right">Foto / Scan KTP</td>
							<td>
								<?php if ($scan_ktp == "") { ?>
									<b style="color: red">Tidak Ada Scan / Foto KTP</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$scan_ktp; ?>">
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="right">Foto Profil</td>
							<td>
								<?php if ($foto_profil == "") { ?>
									<b style="color: red">Tidak Ada Foto Profil</b>
								 <?php }else{ ?>
									<img style="max-height: 240px" src="<?php echo base_url().$foto_profil; ?>">
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