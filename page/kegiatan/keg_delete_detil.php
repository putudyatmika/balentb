<?php
if ($_SESSION['sesi_level'] > 1) {
$keg_d_id=$lvl3;
$db_keg = new db();
$conn_keg = $db_keg -> connect();
$sql_delete_keg = $conn_keg -> query("select * from keg_detil where keg_d_id='$keg_d_id'");
$cek=$sql_delete_keg->num_rows;
if ($cek>0) {
	$r=$sql_delete_keg->fetch_object();
  if ($_SESSION['sesi_level'] > 2) {
	  //query delete langsung
	  $sql_hapus=$conn_keg -> query("delete from keg_detil where keg_d_id='$keg_d_id'");
	  if ($sql_hapus) echo '(BERHASIL) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' berhasil di hapus';
	  else echo '(ERROR) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' tidak bisa dihapus';
  }
  else {
	if ($r->keg_d_jenis==1) {
		//query delete
		if ($r->keg_d_unitkerja == $_SESSION['sesi_unitkerja']) {
		  $sql_hapus=$conn_keg -> query("delete from keg_detil where keg_d_id='$keg_d_id'");
		  if ($sql_hapus) echo '(BERHASIL) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' berhasil di hapus';
		  else echo '(ERROR) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' tidak bisa dihapus';
		}
		else {
			echo 'unit kerja user tidak bisa mengakses menu ini';
		}
	}
	else {
		echo 'Level user tidak mengakses menu ini';
	}
  }
  echo '<br /><a href="'.$url.'/'.$page.'/view/'.$r->keg_id.'">Kembali</a>';
}
else {
	echo 'Data kegiatan ini tidak tersedia';
}
}
else {
	echo 'Level user tidak bisa mengakses menu ini';
}

?>
