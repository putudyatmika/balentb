<?php
if ($_POST['submit_keg']) {
$keg_id=trim($_POST['keg_id']);
$nama_kegiatan=trim($_POST['keg_nama']);
$keg_unitkerja=$_POST['keg_unitkerja'];
$keg_jenis=$_POST['keg_jenis'];
$keg_tglmulai=$_POST['keg_tglmulai'];
$keg_tglakhir=$_POST['keg_tglakhir'];
$keg_satuan=trim($_POST['keg_satuan']);
$keg_target=trim($_POST['keg_target']);
$waktu_lokal=date("Y-m-d H:i:s");
$created=$_SESSION['sesi_user_id'];
$kabkota_target=$_POST['keg_kabkota'];
$keg_spj=$_POST['keg_spj'];
//print_r($_POST['keg_kabkota']);
//var_dump($_POST['keg_kabkota']);
//echo '<br />';
echo '<div class="margin10px"><div class="alert alert-danger" role="alert">'; //untuk alert semua pesan
$cek=cek_id_kegiatan($keg_id);
if ($cek==0) {
	echo 'ID Kegiatan ('.$keg_id.') tidak tersedia';
}
else {
$db = new db();
$conn = $db -> connect();
$sql_keg = $conn->query("update kegiatan set keg_nama='$nama_kegiatan', keg_unitkerja='$keg_unitkerja', keg_start='$keg_tglmulai', keg_end='$keg_tglakhir', keg_jenis='$keg_jenis', keg_total_target='$keg_target', keg_target_satuan='$keg_satuan', keg_diupdate_oleh='$created', keg_spj='$keg_spj' where keg_id='$keg_id'") or die(mysqli_error($conn));

if ($sql_keg) echo '(BERHASIL) Target kegiatan berhasil diupdate';
else echo '(ERROR) target kegiatan tidak berhasil diupdate';
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
   $sql_cek_target = $conn -> query("select * from keg_target where keg_id='$keg_id' and keg_t_unitkerja='$kabkota_id'");
   $cek_target = $sql_cek_target -> num_rows;
   if ($cek_target>0) {
      //target sudah ada
      $sql_keg_kabkota = $conn -> query("update keg_target set keg_t_target='$target_kabkota', keg_t_diupdate_oleh='$created' where keg_id='$keg_id' and keg_t_unitkerja='$kabkota_id'") or die(mysqli_error($conn));
   }
   else {
     //target belum ada
      if ($target_kabkota<=0) {
          $target_kabkota=0;
      }
      $sql_keg_kabkota = $conn -> query("insert into keg_target(keg_id, keg_t_unitkerja, keg_t_target, keg_t_dibuat_oleh, keg_t_dibuat_waktu, keg_t_diupdate_oleh) values('$keg_id', '$kabkota_id', '$target_kabkota', '$created', '$waktu_lokal', '$created')") or die(mysqli_error($conn));
   }
   
   //echo $kabkota_id .' '. $target_kabkota .' '. $keg_id .'<br />';
   }
  if ($keg_spj==1) {
      $spj_target=$_POST['keg_target_spj'];
      foreach ($spj_target as $key => $value) {
        $kabkota_id='';
        $target_spj='';
        $sql_keg_spj='';
        $kabkota_id=$key;
        foreach ($value as $key2 => $value2) {
           $target_spj=$value2;
        }
            //cek dulu target spj
            $sql_cek_spj = $conn -> query("select * from keg_spj where keg_id='$keg_id' and keg_s_unitkerja='$kabkota_id'") or die(mysqli_error($conn));
            $cek_spj_target = $sql_cek_spj -> num_rows;
            if ($cek_spj_target > 0) {
               //sudah ada target spj
                $sql_keg_spj= $conn-> query("update keg_spj set keg_s_target='$target_spj' where keg_id='$keg_id' and keg_s_unitkerja='$kabkota_id'") or die(mysqli_error($conn));
            }
            else {
                //belum ada target spj
                if ($target_spj<=0) {
                   $target_spj=0;
                }
                $sql_keg_spj = $conn -> query("insert into keg_spj(keg_id, keg_s_unitkerja, keg_s_target, keg_s_dibuat_oleh, keg_s_dibuat_waktu, keg_s_diupdate_oleh) values('$keg_id', '$kabkota_id', '$target_spj', '$created', '$waktu_lokal', '$created')") or die(mysqli_error($conn));
            }
            
        }

  }
	if ($sql_keg_kabkota) echo '<br />(BERHASIL) Target kegiatan masing-masing kabupaten/kota berhasil diupdate';
	else echo '<br />(ERROR) target kegiatan masing-masing kabupaten/kota tidak berhasil diupdate';
}
  echo '</div></div><a class="btn btn-success" href="'.$url.'/'.$page.'/view/'.$keg_id.'"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>';
}
?>
