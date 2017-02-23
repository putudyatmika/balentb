<div class="container">
	<div class="row konten">
		<div class="col-xs-12 col-sm-12 text-center">
		  <div class="alert alert-danger">Anda sudah logout dari sistem</div>
<?php
	unset($_SESSION['sesi_user_id']);
	unset($_SESSION['sesi_user_no']);
	unset($_SESSION['sesi_passwd_md5']);
	unset($_SESSION['sesi_passwd_ori']);
	unset($_SESSION['sesi_nama']);
	unset($_SESSION['sesi_level']);
	unset($_SESSION['sesi_unitkerja']);
	print "<meta http-equiv=\"refresh\" content=\"2; URL=".$url."\">";
?>
		</div>
	</div>
</div>
