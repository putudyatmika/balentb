<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_pegawai']) {

	$peg_id =$_POST['peg_id'];
	$peg_nama = $_POST['peg_nama'];
	$peg_jk = $_POST['peg_jk'];
	$peg_user_no = $_POST['peg_user_no'];
	$peg_unitkerja = $_POST['peg_unitkerja'];
	$peg_jabatan = $_POST['peg_jabatan'];
	$peg_status = $_POST['peg_status'];
	//$peg_nama= strtoupper(strtolower($peg_nama));
	//$waktu_lokal=date("Y-m-d H:i:s");
	$user_created=$_SESSION['sesi_user_id'];
	if (cek_pegawai_absen($peg_id)!=false) {
		echo 'Pegawai ID sudah tersedia';
	}
	else {
		if ($peg_user_no!="") {
			//save_pegawai_absen($peg_id,$peg_nama,$peg_jk,$peg_user_no,$peg_unitkerja,$peg_status,$peg_jabatan,$user_created)
			$result_absen=save_pegawai_absen($peg_id,$peg_nama,$peg_jk,$peg_user_no,$peg_unitkerja,$peg_status,$peg_jabatan,$user_created);
			if ($result_absen) {
				echo "Berhasil di simpan database absen pegawai";
			}
			else {
				echo 'Error menyimpan';
			}
			
		}
		else {
			//simpan tanpa peg_user_no
			$result_absen_dua=save_pegawai_absen($peg_id,$peg_nama,$peg_jk,0,$peg_unitkerja,$peg_status,$peg_jabatan,$user_created);
			if ($result_absen_dua) {
				echo 'Berhasil di simpan database absen pegawai';
			}
			else {
				echo 'Error menyimpan II';
			}
		}	

	}
}
else {
	echo 'ERORR';
}

?>
</div>