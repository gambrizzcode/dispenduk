<div class="main-content">
	<div class="main-content-inner">
		<div class="page-content">
			<div class="page-header">
				<h1>
					Timeline Pengaduan Online
				</h1>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="row">
						<div>
							<h2>
								<?php echo $this->session->flashdata('pesan'); ?>
							</h2>
						</div>
					</div>
					<form enctype="multipart/form-data" action="<?php echo site_url("c_p_online/reply"); ?>" class="form-horizontal form-group col-xs-12 col-sm-10 col-sm-offset-1" role="form" accept="" method="POST" autocomplete="off">
						<div class="form-group">
							<b>Tulis Balasan</b><br><br>
							<div>
								<input type="hidden" name="id_reg" value="<?php echo $id_reg_utama; ?>">
								<textarea class="form-control" name="uraian_baru" required="required" placeholder="Ketik balasan di sini.."></textarea>
								<br>
								<button type="submit" class="btn btn-flat btn-danger btn-sm">
									<i class="fa fa-send"></i>
									Kirim Balasan
								</button>
									<button type="button" class="btn btn-flat btn-warning btn-sm" onclick="location='<?php echo site_url("c_p_online"); ?>'">
										<i class="fa fa-arrow-left"></i>
										Kembali
									</button>
							</div>
						</div>
					</form>

					<div id="timeline-2">
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-sm-offset-1">
								<hr style="border:black 1px solid;">
								<div class="timeline-container timeline-style2">
									<span class="timeline-label">
										<b>Tanggal dan Waktu</b>
									</span>
									<div class="timeline-items">

									<?php
									if ($ada == 0) {}else{
										foreach ($qdata1 as $key) {
									?>

										<div class="timeline-item clearfix">
											<div class="timeline-info">
												<span class="timeline-date"><?php echo date('d-m-Y H:i:s',strtotime($key->waktu_balasan)); ?></span>

												<i class="timeline-indicator btn btn-info no-hover"></i>
											</div>

											<div class="widget-box transparent">
												<div class="widget-body">
													<div class="widget-main no-padding">
														<span class="bigger-110">
															<?php
															if ($key->role_balasan == "ADMIN") { ?>
																<b class="red"><?php echo $key->role_balasan; ?></b>
															<?php }else{ ?>
																<b class="green"><?php echo $key->role_balasan; ?></b>
															<?php } ?>
															
															<?php echo $key->uraian_balasan; ?>
														</span>
													</div>
												</div>
											</div>
										</div>

									<?php
									}
									}
									?>


										<div class="timeline-item clearfix">
											<div class="timeline-info">
												<span class="timeline-date"><?php echo date('d-m-Y H:i:s',strtotime($waktu_utama)); ?></span>

												<i class="timeline-indicator btn btn-info no-hover"></i>
											</div>

											<div class="widget-box transparent">
												<div class="widget-body">
													<div class="widget-main no-padding"> <b class="purple">SUBJEK : </b> <?php echo $subjek; ?> </div>
												</div>
											</div>
										</div>
										
									</div><!-- /.timeline-items -->
								</div><!-- /.timeline-container -->

								
							</div>
						</div>
					</div>
					<!-- PAGE CONTENT ENDS -->
				</div>
			</div>
		</div>
	</div>
</div>