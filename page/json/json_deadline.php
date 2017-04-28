<?php
$db = new db();
$conn = $db -> connect();
$bulan_kegiatan=date('n');
$tahun_kegiatan=$TahunDefault;
$sql_list_deadline=$conn-> query("select * from kegiatan where (keg_end BETWEEN date_add(now(), INTERVAL -14 day) and date_add(now(),INTERVAL 20 day)) order by keg_end asc");
$cek_list=$sql_list_deadline->num_rows;
$json_respon=array();
if ($cek_list > 0) {
   
   $json_respon["error"]=FALSE;
   while ($r=$sql_list_deadline->fetch_object()) {
   	 $json_respon["keg"][]=array(
   	 	"keg_id"=>$r->keg_id,
   	 	"keg_nama"=>$r->keg_nama,
   	 	"keg_end"=>tgl_convert_pendek_bulan(1,$r->keg_end)
   	 	);
   	   }
   
}
else {
  $json_respon["error"]=TRUE;
  $json_respon["pesan_error"]="Belum ada kegiatan";
}
echo json_encode($json_respon);

?>