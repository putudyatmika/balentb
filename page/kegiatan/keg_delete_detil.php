<?php
if ($_SESSION['sesi_level'] > 1) {
$keg_d_id=$lvl3;
$db_keg = new db();
$conn_keg = $db_keg -> connect();
$sql_delete_keg = $conn_keg -> query("select * from keg_detil where keg_d_id='$keg_d_id'");
$cek=$sql_delete_keg->num_rows;
$update_nilai='';
if ($cek>0) {
	$r=$sql_delete_keg->fetch_object();
	$keg_id=$r->keg_id;
	$keg_d_unitkerja=$r->keg_d_unitkerja;
  if ($_SESSION['sesi_level'] > 2) {
	  //query delete langsung
	  $sql_hapus=$conn_keg -> query("delete from keg_detil where keg_d_id='$keg_d_id'");
	  if ($sql_hapus) { $update_nilai=1;echo '(BERHASIL) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' berhasil di hapus'; }
	  else { $update_nilai=0;echo '(ERROR) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' tidak bisa dihapus'; }
  }
  else {
	if ($r->keg_d_jenis==1) {
		//query delete
		if ($r->keg_d_unitkerja == $_SESSION['sesi_unitkerja']) {
		  $sql_hapus=$conn_keg -> query("delete from keg_detil where keg_d_id='$keg_d_id'");
		  if ($sql_hapus) { $update_nilai=1;echo '(BERHASIL) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' berhasil di hapus'; }
		  else { $update_nilai=2;echo '(ERROR) Konfirmasi '.$JenisDetilKegiatan[$r->keg_d_jenis].' tidak bisa dihapus';}
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
  $nilai_point=get_nilai_kegiatan($keg_id,$keg_d_unitkerja);
	if ($nilai_point!='') {
	$nilai_waktu=$nilai_point[0];
	$nilai_volume=$nilai_point[1];
	$nilai_total=$nilai_point[2];
	}
	else {
	$nilai_waktu='';
	$nilai_volume='';
	$nilai_total='';
	}
	$keg_id=$r->keg_id;
	$keg_d_unitkerja=$r->keg_d_unitkerja;
	$sql_update_nilai=$conn_keg -> query("update keg_target set keg_t_point_waktu='$nilai_waktu', keg_t_point_jumlah='$nilai_volume', keg_t_point='$nilai_total' where keg_id='$keg_id' and keg_t_unitkerja='$keg_d_unitkerja'") or die(mysqli_error($conn));
	}
else {
	echo 'Data kegiatan ini tidak tersedia';
}
}
else {
	echo 'Level user tidak bisa mengakses menu ini';
}

?>
