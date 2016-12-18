<?php
if ($_POST['submit_keg']) {
$nama_kegiatan=trim($_POST['keg_nama']);
$keg_unitkerja=$_POST['keg_unitkerja'];
$keg_jenis=$_POST['keg_jenis'];
$keg_tglmulai=$_POST['keg_tglmulai'];
$keg_tglakhir=$_POST['keg_tglakhir'];
$keg_satuan=trim($_POST['keg_satuan']);
$keg_t=trim($_POST['keg_target']);
$waktu_lokal=date("Y-m-d H:i:s");
$created=$_SESSION['sesi_user_id'];
$kabkota_target=$_POST['keg_kabkota'];
//print_r($_POST['keg_kabkota']);
//var_dump($_POST['keg_kabkota']);
//echo '<br />';
$cek=cek_kegiatan($nama_kegiatan,$keg_unitkerja);
if ($cek==1) {
  echo 'Kegiatan : '. $nama_kegiatan .' sudah ada';
}
else {
$db = new db();
$conn = $db -> connect();
$sql_keg = $conn->query("insert into kegiatan(keg_nama, keg_unitkerja, keg_start, keg_end, keg_dibuat_oleh, keg_dibuat_waktu, keg_diupdate_oleh, keg_jenis, keg_total_target, keg_target_satuan) values('$nama_kegiatan', '$keg_unitkerja', '$keg_tglmulai', '$keg_tglakhir', '$created', '$waktu_lokal', '$created', '$keg_jenis', '$keg_t', '$keg_satuan')");
$keg_id=get_id_kegiatan($nama_kegiatan,$waktu_lokal,$created);
if ($sql_keg) echo '(BERHASIL) Target kegiatan berhasil disimpan';
else echo '(ERROR) target kegiatan tidak berhasil di simpan';
foreach ($kabkota_target as $key => $value) {
	$kabkota_id='';
	$target_kabkota='';
	$sql_keg_kabkota='';
  //echo $key ." => ". $value ."<br/ >" ;
  //echo $i.' Kode kabkota : '. $key .'<br /> ';
  //print_r($value);
  $kabkota_id=$key;
  foreach ($value as $key2 => $value2) {
    //echo $key2 ." => ". $value2 ."<br/ >" ;
    //echo $i.' Isi target kabkota : '.$value2 .'<br />';
	$target_kabkota=$value2;
   }
    if ($target_kabkota > 0) {
   $sql_keg_kabkota = $conn -> query("insert into keg_target(keg_id, keg_t_unitkerja, keg_t_target, keg_t_dibuat_oleh, keg_t_dibuat_waktu, keg_t_diupdate_oleh) values('$keg_id', '$kabkota_id', '$target_kabkota', '$created', '$waktu_lokal', '$created')") or die(mysqli_error($conn));
   //echo $kabkota_id .' '. $target_kabkota .' '. $keg_id .'<br />';
   }
   else {
	   $sql_keg_kabkota='';
   }
}
	if ($sql_keg_kabkota) echo '<br />(BERHASIL) Target kegiatan masing-masing kabupaten/kota berhasil disimpan';
	else echo '<br />(ERROR) target kegiatan masing-masing kabupaten/kota tidak berhasil di simpan';
  echo '<br /><a href="'.$url.'/'.$page.'">Kembali</a>';
}
}
?>
