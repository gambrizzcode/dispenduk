			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							ANMEDIACORP Jember &copy; 2018
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div>

		<!-- basic scripts -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- dataTable -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.button.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.select.min.js"></script>

		<!-- datepicker -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-timepicker.min.js"></script>
		<!-- <script src="<?php //echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script> -->

		<script type="text/javascript">

			$('#duatatuabel').DataTable({

				// 'bPaginate' : true,
				'lengthChange' : true,
				'lengthMenu' : [50,75,100],
				'info' : false,
				'sScrollX' : true

			});
		</script>

		<script type="text/javascript">
			$('.date-picker').datepicker({
				autoclose: true,
				todayHighlight: true
			})
			$("select[name='kecamatan']").click(function() {
				var kec = $(this).val();
	            $.ajax({
	            	url: '<?php echo base_url()."index.php/c_user/kec_ajax"; ?>',
	            	type: 'GET',
	            	data: "kec="+kec,
	            	success:function(data){
	            		$("select[name='kelurahan']").html(data);
	            	}
	            });
			});
		</script>
		<script type="text/javascript">
			$("input[name='password']").keyup(function() {
				var password = $(this).val().length;
				if (password < 8) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='password']").keydown(function() {
				var password = $(this).val().length;
				if (password < 8) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='password']").focusout(function() {
				var password = $(this).val().length;
				if (password < 8) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='confirm']").keyup(function() {
				var confirm = $(this).val();
				var password = $("input[name='password']").val();
				if (confirm != password) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='confirm']").keydown(function() {
				var confirm = $(this).val();
				var password = $("input[name='password']").val();
				if (confirm != password) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
			$("input[name='confirm']").focusout(function() {
				var confirm = $(this).val();
				var password = $("input[name='password']").val();
				if (confirm != password) {
					$(this).css('box-shadow', 'red 0px 0px 10px');
		            $(this).focus();
				}else{
					$(this).css('box-shadow', 'blue 0px 0px 2px');
				}
			});
		</script>


	</body>
</html>