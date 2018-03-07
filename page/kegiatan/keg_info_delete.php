<?php
if ($_SESSION['sesi_level'] > 2) {
$keg_id=$lvl3;
$db_keg = new db();
$conn_keg = $db_keg -> connect();
$sql_delete_keg = $conn_keg -> query("select * from kegiatan where keg_id='$keg_id'");
$cek=$sql_delete_keg->num_rows;
echo '<div class="margin10px"><div class="alert alert-danger" role="alert">'; //untuk alert semua pesan
if ($cek>0) {
	$r=$sql_delete_keg->fetch_object();
	if ($_SESSION['sesi_level'] > 3) {
		//query delete langsung
		$sql_hapus=$conn_keg -> query("update kegiatan set keg_info=NULL where keg_id='$keg_id'");
		if ($sql_hapus) echo '(BERHASIL) Info lanjutan Kegiatan '.$r->keg_nama.' berhasil di hapus';
		else echo '(ERROR) Konfirmasi info lanjutan kegiatan '.$r->keg_nama.' tidak bisa dihapus';
	}
	else {
		if ($_SESSION['sesi_unitkerja']==$r->keg_unitkerja) {
			//query hapus langsung
			$sql_hapus=$conn_keg -> query("update kegiatan set keg_info=NULL where keg_id='$keg_id'");
			if ($sql_hapus) echo '(BERHASIL) Info lanjutan Kegiatan '.$r->keg_nama.' berhasil di hapus';
			else echo '(ERROR) Konfirmasi info lanjutan kegiatan '.$r->keg_nama.' tidak bisa dihapus';
		}
		else {
			$parent_unit=get_parent_kode($r->keg_unitkerja);
			if ($_SESSION['sesi_unitkerja']==$parent_unit) {
			$sql_hapus=$conn_keg -> query("update kegiatan set keg_info=NULL where keg_id='$keg_id'");
			if ($sql_hapus) echo '(BERHASIL) Info lanjutan Kegiatan '.$r->keg_nama.' berhasil di hapus';
			else echo '(ERROR) Konfirmasi info lanjutan kegiatan '.$r->keg_nama.' tidak bisa dihapus';
			}
			else {
				echo '<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> Level user <strong>'.$_SESSION['sesi_user_id'].'</strong> tidak bisa menghapus info lanjutan kegiatan <strong>'.$r->keg_nama.' </strong>ini';
			}
		}
	}
}
else {
	echo '<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> ID Kegiatan tidak tersedia';
	}
}
else {
	echo '<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> Level user <strong>'.$_SESSION['sesi_user_id'].'</strong> tidak bisa mengakses master kegiatan ini';
}
echo '</div></div>
<a class="btn btn-success" href="'.$url.'/'.$page.'/view/'.$keg_id.'"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>';
?>
