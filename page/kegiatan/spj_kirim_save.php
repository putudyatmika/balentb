<?php
if ($_POST['submit_keg']) {
$keg_id=$_POST['keg_id'];
$spj_d_unitkerja=$_POST['spj_d_unitkerja'];
$spj_d_jenis=1;
$spj_d_tgl=$_POST['keg_d_tgl'];
$spj_d_jumlah=$_POST['keg_d_jumlah'];
$spj_d_ket=trim($_POST['keg_d_ket']);
$spj_d_link=trim($_POST['keg_d_link']);
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
$sql_keg = $conn->query("insert into spj_detil(keg_id, spj_d_unitkerja, spj_d_tgl, spj_d_jumlah, spj_d_jenis, spj_d_ket, spj_d_dibuat_oleh, spj_d_dibuat_waktu, spj_d_diupdate_oleh,spj_d_link_laci) value('$keg_id', '$spj_d_unitkerja', '$spj_d_tgl', '$spj_d_jumlah', '$spj_d_jenis', '$spj_d_ket', '$created', '$waktu_lokal', '$created','$spj_d_link')") or die(mysqli_error($conn));
if ($sql_keg) echo '(BERHASIL) data berhasil di simpan';
else echo '(ERROR) data tidak berhasil disimpan' ;
echo '<br /><a href="'.$url.'/'.$page.'/view/'.$keg_id.'">Kembali</a>';
}
}
?>
