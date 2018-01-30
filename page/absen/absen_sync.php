<legend>Sync Absen</legend>
<?php
if ($edate!='') {
	echo '<p>Hari '.tgl_convert(1,$sdate).' s/d '.tgl_convert(1,$edate).' </p>';
}
else {
	echo '<p>Hari '.tgl_convert(1,$sdate).'</p>';
	$edate=date("Y-m-d");
}
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<thead>
 	<tr>
 		<th>#</th>
 		<th>Nama</th>
 		<th class="hidden-xs">Jabatan</th>
 		<th>Tanggal</th>
 		<th>Jam</th>
 		<th>Kode</th>
 		<th>Status</th>
 	</tr>
 </thead>
 <tbody>
 	<?php
 	$number="";
    for($i=1;$i<=140;$i++){
      $number.=($i.",");
    }
	$number=substr($number,0,strlen($number)-1);
	$url_absen = "http://".$ip_server_absen."/form/Download?uid=".$number."&sdate=".$sdate."&edate=".$edate;
  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url_absen);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    $server_output = curl_exec ($ch);
  
    curl_close ($ch);
  
    $data = array();
    $record = explode("\n",$server_output);
	$banyak_data=count($record);
    $j=1;
    //cek record
    $peg_id='';
    $kode='';
    $tgl='';
    foreach($record as $r) {
	  
	 
      $r = str_replace("\t","|",$r);
	  
      $isi = explode("|",$r);
      array_push($data, $isi);
	  if ($isi[0]!="")  {
		   
	  $tgl = explode(" ", $isi[2]);
	  $peg_id=$isi[0];
	  $tgl_absen=$tgl[0];
	  $jam_absen=$tgl[1];
	  $kode=$isi[4];
	  $peg_nama=$isi[1];
	  $kode_absen=intval($kode);
	  $r_peg=peg_jabatan_absen(intval(trim($peg_id)));
	  if ($r_peg["error"]==false) {
	  	$peg_nama_rill=$r_peg["peg_nama"];
	  	$peg_jabatan_rill=$JenisJabatan[$r_peg["peg_jabatan"]].' '.$r_peg["unit_nama"];
	  }
	  else {
	  	$peg_nama_rill=$peg_nama;
	  	$peg_jabatan_rill='-';
	  }

	  if (cek_absen_sync($peg_id,$tgl_absen,$jam_absen,$kode)==TRUE) {
		  $status_sync='tidak disimpan';
	  }
	  else {
		  //simpan
		  if (sync_absen($peg_id,$peg_nama,$tgl_absen,$jam_absen,$kode)==TRUE) {
			  $status_sync='tersimpan';
		  }
		  else {
			  $status_sync='error';
		  }
	  }
	  echo '<tr>
		<td>'.$j.'</td>
		<td>'.$peg_nama_rill.'</td>
		<td>'.$peg_jabatan_rill.'</td>
		<td>'.$tgl[0].'</td>
		<td>'.$tgl[1].'</td>
		<td>'.$KodeMesinAbsen[$kode_absen].'</td>
		<td>'.$status_sync.'</td>
	  </tr>';
	  $j++;
	  
	  }
    }
 	?>
 </tbody>
</table>