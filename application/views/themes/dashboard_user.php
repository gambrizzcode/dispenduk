<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Dashboard User
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						overview &amp; stats
					</small>
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<?php
					$data_sess = $this->session->userdata('login');
					?>
					<center>
						<h2>Selamat Datang <b><?php echo $data_sess['nama']; ?>, di</b></h2>
						<h2>Aplikasi Layanan Online Dispenduk Capil Jember</h2>
						<br>
						<br>
						<img src="<?php echo base_url(); ?>img/SampulDashboardUser.jpg" style="max-width: 80%">
						<!-- jika ingin ganti gambar cukup rename gambarnya jadi seperti di atas. -->
					</center>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>