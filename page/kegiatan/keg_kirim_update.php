<?php
if ($_POST['submit_keg']) {
$keg_d_id=$_POST['keg_d_id'];
$keg_d_tgl=$_POST['keg_d_tgl'];
$keg_d_jumlah=$_POST['keg_d_jumlah'];
$keg_d_ket=trim($_POST['keg_d_ket']);
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
  $sql_keg = $conn->query("update keg_detil set keg_d_tgl='$keg_d_tgl', keg_d_jumlah='$keg_d_jumlah',  keg_d_ket='$keg_d_ket', keg_d_diupdate_oleh='$created' where keg_d_id='$keg_d_id'");
if ($sql_keg) echo '(BERHASIL) data berhasil di simpan';
else echo '(ERROR) data tidak berhasil disimpan' ;
echo '<br /><a href="'.$url.'/'.$page.'/view/'.$r->keg_id.'">Kembali</a>';
}
else {
  echo 'Kegiatan : '. $keg_d_id .' tidak tersedia ada';
  }

}
?>
