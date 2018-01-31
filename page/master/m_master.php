<div class="container">
<div class="row konten">
	<div class="col-lg-2 col-sm-2">
		<div class="list-group">
		<a href="#" class="list-group-item active"><i class="fa fa-cubes fa-fw"></i>&nbsp; Master Data</a>
		<a href="<?php echo $url; ?>/master/users/" class="list-group-item"><i class="fa fa-dot-circle-o text-primary fa-fw"></i>&nbsp; Users</a>
		<a href="<?php echo $url; ?>/master/unitkerja/" class="list-group-item"><i class="fa fa-dot-circle-o text-primary fa-fw"></i>&nbsp; Unit Kerja</a>
		<a href="<?php echo $url; ?>/master/pegawai/" class="list-group-item"><i class="fa fa-dot-circle-o text-primary fa-fw"></i>&nbsp; Pegawai</a>
		<a href="<?php echo $url; ?>/master/absen/" class="list-group-item"><i class="fa fa-dot-circle-o text-primary fa-fw"></i>&nbsp; Absen</a>
		</div>
	</div>
		<div class="col-lg-10 col-sm-10">
		<div class="row">
<?php
	if ($act=="users") {
		include 'page/master/users/m_users.php';
	}
	elseif ($act=="settings")
	{
		include 'page/master/settings/m_settings.php';
	}
	elseif ($act=="pegawai") {
		include 'page/master/pegawai/m_pegawai.php';
	}
	elseif ($act=="absen") {
		include 'page/master/absen/m_absen.php';
	}
	elseif ($act=="unitkerja") {
		include 'page/master/unitkerja/m_unitkerja.php';
	}
	elseif ($act=="surat") {

	}
	elseif ($act=="verifikator") {

	}
	elseif ($act=="ckp") {
		include 'page/master/ckp/m_ckp.php';
	}
	else {
		echo 'Sistem Informasi BPS NTB<br />Menu ini merupakan kumpulan master data untuk sistem';
	}
?>
		</div>
		</div>

	</div>
</div>
