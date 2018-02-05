<legend>Update data log karyawan</legend>
<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_log']) {
	$absen_id =$_POST['absen_id'];
	$absen_kode =$_POST['absen_kode'];
	$absen_ket = $_POST['absen_ket'];
	
	if (cek_log_absen($absen_id)==false) {
		echo 'Log absen ID tidak ada';
	}
	else {
			//simpan tanpa peg_user_no
			$update_absen=update_log_absen($absen_id,$absen_kode,$absen_ket);
			if ($update_absen) {
				echo 'Berhasil di update';
			}
			else {
				echo 'Error update';
			}
		}	

	}
else {
	echo 'ERORR';
}

?>
</div>