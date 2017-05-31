<?php
$bulan_kegiatan=date('n');
$tahun_kegiatan=$TahunDefault;

$db = new db();
$conn = $db -> connect();
if (!isset($keg_hal)) { $hal_posisi=1; }
else { $hal_posisi=$keg_hal; }
$sql_list_kegiatan= $conn -> query("select * from kegiatan,unitkerja where kegiatan.keg_unitkerja=unitkerja.unit_kode and year(kegiatan.keg_start)='$tahun_kegiatan' order by kegiatan.keg_end desc");
$cek = $sql_list_kegiatan -> num_rows;
$json_respon=array("error" => FALSE);
if ($cek>0) {
   $json_respon["error"]=FALSE;
   $json_respon["keg_total"]=$cek;
   $json_respon["keg_hal"]=$hal_posisi;
   //$json_respon["keg"]=array();
   $i=1;
   while ($r=$sql_list_kegiatan->fetch_object()) {
    	 $json_respon["keg"][$i]=array(
   	 	"keg_id"=>$r->keg_id,
   	 	"keg_nama"=>$r->keg_nama,
   	 	"keg_start"=>tgl_convert_pendek_bulan(1,$r->keg_start),
   	 	"keg_end"=>tgl_convert_pendek_bulan(1,$r->keg_end),
   	 	"keg_unitkerja"=>$r->unit_nama,
   	 	"keg_target"=>$r->keg_total_target ." ".$r->keg_target_satuan
   	 	);
       $i++;
   	   }
   	   
   	 
   
}
else {
  $json_respon["error"]=TRUE;
  $json_respon["pesan_error"]="Belum ada kegiatan";
}
echo json_encode($json_respon);
?>