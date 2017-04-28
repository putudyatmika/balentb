<?php
$bulan_kegiatan=date('n');
$tahun_kegiatan=$TahunDefault;

$db = new db();
$conn = $db -> connect();
$sql_list_kegiatan= $conn -> query("select * from kegiatan,unitkerja where kegiatan.keg_unitkerja=unitkerja.unit_kode and year(kegiatan.keg_start)='$tahun_kegiatan' order by kegiatan.keg_id desc");
$cek = $sql_list_kegiatan -> num_rows;
$json_respon=array();
if ($cek>0) {
   $json_respon["error"]=FALSE;
   while ($r=$sql_list_kegiatan->fetch_object()) {
   	 $json_respon["keg"][]=array(
   	 	"keg_id"=>$r->keg_id,
   	 	"keg_nama"=>$r->keg_nama,
   	 	"keg_end"=>tgl_convert_pendek_bulan(1,$r->keg_end),
   	 	"keg_unitkerja"=>$r->unit_nama,
   	 	"keg_target"=>$r->keg_total_target ." ".$r->keg_target_satuan
   	 	);
   	   }
   
}
else {
  $json_respon["error"]=TRUE;
  $json_respon["pesan_error"]="Belum ada kegiatan";
}
print json_encode($json_respon);
?>