<?php
if ($_POST['submit_keg']) {
$keg_id=$_POST['keg_id'];
$spj_d_id=$_POST['spj_d_id'];
$spj_d_unitkerja=$_POST['spj_d_unitkerja'];
$spj_d_jenis=2;
$spj_d_tgl=$_POST['keg_d_tgl'];
$spj_d_jumlah=$_POST['keg_d_jumlah'];
$waktu_lokal=date("Y-m-d H:i:s");
$created=$_SESSION['sesi_user_id'];

//print_r($_POST['keg_kabkota']);
//var_dump($_POST['keg_kabkota']);
//echo '<br />';
$cek=cek_id_kegiatan($keg_id);
if ($cek==0) {
  echo 'Kegiatan : '. $nama_kegiatan .' tidak tersedia ada';
}
else {
$db = new db();
$conn = $db -> connect();
$sql_keg = $conn->query("update spj_detil set spj_d_tgl='$spj_d_tgl', spj_d_jumlah='$spj_d_jumlah', spj_d_diupdate_oleh='$created' where spj_d_id='$spj_d_id'");
$nilai_point=get_nilai_spj($keg_id,$spj_d_unitkerja);
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

$sql_update_nilai=$conn -> query("update keg_spj set keg_s_point_waktu='$nilai_waktu', keg_s_point_jumlah='$nilai_volume', keg_s_point='$nilai_total' where keg_id='$keg_id' and keg_s_unitkerja='$spj_d_unitkerja'") or die(mysqli_error($conn));
if ($sql_keg) echo '(BERHASIL) data berhasil di simpan';
else echo '(ERROR) data tidak berhasil disimpan' ;
echo '<br />';
if ($sql_update_nilai) echo '(BERHASIL) data nilai berhasil disimpan';
else echo '(ERROR) data nilai tidak berhasil disimpan' ;

echo '<br /><a href="'.$url.'/'.$page.'/view/'.$keg_id.'">Kembali</a>';
}
}
?>
