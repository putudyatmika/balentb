<?php
if ($_POST['submit_keg']) {
$keg_id=trim($_POST['keg_id']);
$keg_info=trim($_POST['keg_info']);
$keg_info_html = htmlentities($keg_info, ENT_QUOTES);
$created=$_SESSION['sesi_user_id'];

echo '<div class="margin10px"><div class="alert alert-danger" role="alert">'; //untuk alert semua pesan
$cek=cek_id_kegiatan($keg_id);
if ($cek==0) {
  echo 'ID Kegiatan ('.$keg_id.') tidak tersedia';
}
else {
$db = new db();
$conn = $db -> connect();
$sql_keg = $conn->query("update kegiatan set keg_info='$keg_info_html', keg_diupdate_oleh='$created' where keg_id='$keg_id'") or die(mysqli_error($conn));

if ($sql_keg) echo '(BERHASIL) Informasi kegiatan berhasil di update';
else echo '(ERROR) Informasi kegiatan tidak berhasil diupdate';
 
}
  echo '</div></div><a class="btn btn-success" href="'.$url.'/'.$page.'/view/'.$keg_id.'"><i class="fa fa-angle-left" aria-hidden="true"></i> Kembali</a>';
}
?>
