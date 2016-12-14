<?php
if ($_POST['submit_keg']) {
$keg_id=$_POST['keg_id'];
$keg_d_unitkerja=$_POST['keg_d_unitkerja'];
$keg_d_jenis=1;
$keg_d_tgl=$_POST['keg_d_tgl'];
$keg_d_jumlah=$_POST['keg_d_jumlah'];
$keg_d_ket=trim($_POST['keg_d_ket']);
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
$sql_keg = $conn->query("insert into keg_detil(keg_id, keg_d_unitkerja, keg_d_tgl, keg_d_jumlah, keg_d_jenis, keg_d_ket, keg_d_dibuat_oleh, keg_d_dibuat_waktu, keg_d_diupdate_oleh) value('$keg_id', '$keg_d_unitkerja', '$keg_d_tgl', '$keg_d_jumlah', '$keg_d_jenis', '$keg_d_ket', '$created', '$waktu_lokal', '$created')");
if ($sql_keg) echo '(BERHASIL) data berhasil di simpan';
else echo '(ERROR) data tidak berhasil disimpan' ;
echo '<br /><a href="'.$url.'/'.$page.'/view/'.$keg_id.'">Kembali</a>';
}
}
?>
