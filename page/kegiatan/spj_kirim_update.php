<?php
if ($_POST['submit_spj']) {
$spj_d_id=$_POST['spj_d_id'];
$spj_d_tgl=$_POST['keg_d_tgl'];
$spj_d_jumlah=$_POST['keg_d_jumlah'];
$spj_d_ket=trim($_POST['keg_d_ket']);
$spj_d_link=trim($_POST['keg_d_link']);
$waktu_lokal=date("Y-m-d H:i:s");
$created=$_SESSION['sesi_user_id'];

//print_r($_POST['keg_kabkota']);
//var_dump($_POST['keg_kabkota']);
//echo '<br />';
$db = new db();
$conn = $db -> connect();
$sql_keg_d_id=$conn->query ("select * from spj_detil where spj_d_id='$spj_d_id'");
$cek=$sql_keg_d_id->num_rows;
if ($cek>0) {
$r=$sql_keg_d_id->fetch_object();
  $sql_keg = $conn->query("update spj_detil set spj_d_tgl='$spj_d_tgl', spj_d_jumlah='$spj_d_jumlah',  spj_d_ket='$spj_d_ket', spj_d_diupdate_oleh='$created', spj_d_link_laci='$spj_d_link'  where spj_d_id='$spj_d_id'");
if ($sql_keg) echo '(BERHASIL) data berhasil di simpan';
else echo '(ERROR) data tidak berhasil disimpan' ;
echo '<br /><a href="'.$url.'/'.$page.'/view/'.$r->keg_id.'">Kembali</a>';
}
else {
  echo 'Kegiatan : '. $spj_d_id .' tidak tersedia ada';
  }

}
?>
