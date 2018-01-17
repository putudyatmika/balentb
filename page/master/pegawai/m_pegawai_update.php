<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_pegawai']) {
	$peg_no =$_POST['peg_no'];
	$peg_id =$_POST['peg_id'];
	$peg_nama = $_POST['peg_nama'];
	$peg_jk = $_POST['peg_jk'];
	$peg_user_no = $_POST['peg_user_no'];
	$peg_unitkerja = $_POST['peg_unitkerja'];
	$peg_jabatan = $_POST['peg_jabatan'];
	$peg_status = $_POST['peg_status'];
	//$peg_nama= strtoupper(strtolower($peg_nama));
	$waktu_lokal=date("Y-m-d H:i:s");
	$user_update=$_SESSION['sesi_user_id'];
	if (cek_pegawai_no($peg_no)==false) {
		echo 'Pegawai ID tidak ada';
	}
	else {
			//simpan tanpa peg_user_no
			$update_absen=update_pegawai_absen($peg_no,$peg_id,$peg_nama,$peg_jk,$peg_user_no,$peg_unitkerja,$peg_jabatan,$peg_status,$user_update);
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