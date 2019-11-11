<!DOCTYPE html>
<html>
<head>
	<title>Redirect</title>
</head>
<body onload="langsung()">
	<form method="POST" name="form_redirect" action="<?php echo site_url("c_kia/save_kia"); ?>">
		<input type="hidden" name="id_reg" value="<?php echo $id_reg; ?>">
		<input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
		<input type="hidden" name="nik_pemohon" value="<?php echo $nik_pemohon; ?>">
		<input type="hidden" name="nama_pemohon" value="<?php echo $nama_pemohon; ?>">
		<input type="hidden" name="jenis" value="<?php echo $jenis; ?>">
		<input type="hidden" name="id_status" value="<?php echo $id_status; ?>">
		<input type="hidden" name="ket" value="<?php echo $ket; ?>">
	</form>
</body>
<script type="text/javascript">
	function langsung() {
		document.form_redirect.submit();
		// clearTimeout(timeID);s
	}
</script>
</html>