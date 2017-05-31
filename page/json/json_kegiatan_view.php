<?php
$db = new db();
$conn = $db -> connect();
$keg_id=$lvl4;
$sql_list_kegiatan= $conn -> query("select * from kegiatan,unitkerja where kegiatan.keg_unitkerja=unitkerja.unit_kode and kegiatan.keg_id='$keg_id'");
$cek = $sql_list_kegiatan -> num_rows;
$json_respon=array("error" => FALSE);
if ($cek>0) {
	$r=$sql_list_kegiatan->fetch_object();
	$json_respon["keg_id"]=$r->keg_id;
   	$json_respon["keg_nama"]=$r->keg_nama;
   	$json_respon["keg_start"]=tgl_convert_pendek_bulan(1,$r->keg_start);
   	$json_respon["keg_end"]=tgl_convert_pendek_bulan(1,$r->keg_end);
   	$json_respon["keg_unitkerja"]=$r->unit_nama;
   	$json_respon["keg_target"]=$r->keg_total_target ." ".$r->keg_target_satuan;
}
else {
  $json_respon["error"]=TRUE;
  $json_respon["pesan_error"]="Kegiatan tidak tersedia";
}
echo json_encode($json_respon);
?>