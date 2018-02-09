<legend>Simpan data log kehadiran karyawan</legend>
<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_log']) {
	$absen_id =$_POST['absen_id'];
	$absen_hadir= $_POST['absen_hadir'];
	$absen_ket = $_POST['absen_ket'];
	
	$update_absen=update_hadir_absen($absen_id,$absen_hadir,$absen_ket);
	if ($update_absen) {
		echo 'Berhasil di diupdate';
	}
	else {
		echo 'Error update';
	}
}	
else {
	echo 'ERORR';
}

?>
</div>