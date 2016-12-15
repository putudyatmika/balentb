<?php
if ($_SESSION['sesi_level'] > 2) {
$keg_id=$lvl3;
$db_keg = new db();
$conn_keg = $db_keg -> connect();
$sql_delete_keg = $conn_keg -> query("select * from kegiatan where keg_id='$keg_id'");
$cek=$sql_delete_keg->num_rows;
if ($cek>0) {
	$r=$sql_delete_keg->fetch_object();
	if ($_SESSION['sesi_level'] > 3) {
		//query delete langsung
		$sql_hapus=$conn_keg -> query("delete from kegiatan where keg_id='$keg_id'");
		$sql_hapus2=$conn_keg -> query("delete from keg_target where keg_id='$keg_id'");
		$sql_hapus3=$conn_keg -> query("delete from keg_detil where keg_id='$keg_id'");
		if ($sql_hapus) echo '(BERHASIL) Kegiatan '.$r->keg_nama.' berhasil di hapus';
		else echo '(ERROR) Konfirmasi '.$r->keg_nama.' tidak bisa dihapus';
	}
	else {
		if ($_SESSION['sesi_unitkerja']==$r->keg_unitkerja) {
			//query hapus langsung
			$sql_hapus=$conn_keg -> query("delete from kegiatan where keg_id='$keg_id'");
			$sql_hapus2=$conn_keg -> query("delete from keg_target where keg_id='$keg_id'");
			$sql_hapus3=$conn_keg -> query("delete from keg_detil where keg_id='$keg_id'");
			if ($sql_hapus) echo '(BERHASIL) Kegiatan '.$r->keg_nama.' berhasil di hapus';
			else echo '(ERROR) Konfirmasi '.$r->keg_nama.' tidak bisa dihapus';
		}
		else {
			$parent_unit=get_parent_unit($r->keg_unitkerja);
			if ($_SESSION['sesi_unitkerja']==$parent_unit) {
				$sql_hapus=$conn_keg -> query("delete from kegiatan where keg_id='$keg_id'");
				$sql_hapus2=$conn_keg -> query("delete from keg_target where keg_id='$keg_id'");
				$sql_hapus3=$conn_keg -> query("delete from keg_detil where keg_id='$keg_id'");
				if ($sql_hapus) echo '(BERHASIL) Kegiatan '.$r->keg_nama.' berhasil di hapus';
				else echo '(ERROR) Konfirmasi '.$r->keg_nama.' tidak bisa dihapus';
			}
			else {
				echo 'Level user tidak bisa mengakses menu ini';
			}
		}
	}
}
else {
	echo 'ID Kegiatan tidak tersedia';
	}
}
else {
	echo 'Level user tidak bisa mengakses menu ini';
}

?>
