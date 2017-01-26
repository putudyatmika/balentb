<?php
if ($_POST['submit_keg']) {
$keg_d_id=$_POST['keg_d_id'];
$keg_d_tgl=$_POST['keg_d_tgl'];
$keg_d_jumlah=$_POST['keg_d_jumlah'];
$waktu_lokal=date("Y-m-d H:i:s");
$created=$_SESSION['sesi_user_id'];

//print_r($_POST['keg_kabkota']);
//var_dump($_POST['keg_kabkota']);
//echo '<br />';
$db = new db();
$conn = $db -> connect();
$sql_keg_d_id=$conn->query ("select * from keg_detil where keg_d_id='$keg_d_id'");
$cek=$sql_keg_d_id->num_rows;
if ($cek>0) {
$r=$sql_keg_d_id->fetch_object();
$sql_keg = $conn->query("update keg_detil set keg_d_tgl='$keg_d_tgl', keg_d_jumlah='$keg_d_jumlah', keg_d_diupdate_oleh='$created', keg_d_ket='$created' where keg_d_id='$keg_d_id'");

$nilai_point=get_nilai_kegiatan($r->keg_id,$r->keg_d_unitkerja);
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
$sql_update_nilai=$conn -> query("update keg_target set keg_t_point_waktu='$nilai_waktu', keg_t_point_jumlah='$nilai_volume', keg_t_point='$nilai_total' where keg_id='$keg_id' and keg_t_unitkerja='$keg_d_unitkerja'") or die(mysqli_error($conn));

if ($sql_keg) echo '(BERHASIL) data penerimaan berhasil diupdate';
else echo '(ERROR) data penerimaan tidak berhasil disimpan' ;
echo '<br /><br />';
if ($sql_update_nilai) echo '(BERHASIL) data nilai berhasil diupdate';
else echo '(ERROR) data nilai tidak berhasil diupdate' ;

echo '<br /><a href="'.$url.'/'.$page.'/view/'.$r->keg_id.'">Kembali</a>';
}
else {
  echo 'Kegiatan : '. $keg_d_id .' tidak tersedia ada';
  }

}
?>
