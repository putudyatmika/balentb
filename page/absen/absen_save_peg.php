<legend>Simpan data log kehadiran karyawan</legend>
<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_log']) {
	$peg_id =$_POST['peg_id'];
	$peg_nama =$_POST['peg_nama'];
	$absen_tgl = date("Y-m-d",$_POST['absen_tgl']);
	$absen_hadir= $_POST['absen_hadir'];
	$absen_ket = $_POST['absen_ket'];
	
	$save_absen=save_hadir_absen($peg_id,$peg_nama,$absen_tgl,$absen_hadir,$absen_ket);
	if ($save_absen) {
		echo 'Berhasil di simpan';
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