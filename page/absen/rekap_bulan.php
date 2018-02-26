<legend>Rekap Bulanan Kehadiran Karyawan</legend>
Bulan : 
<?php
	$tgl_dipilih=strtotime($sdate);
 	echo $nama_bulan_panjang[date("n",$tgl_dipilih)].' '.date("Y",$tgl_dipilih);
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
	<thead>
 	<tr>
 		<th>#</th>
 		<th>Nama</th>
 		<th>Jabatan</th>
 		<th>TL1</th>
 		<th>TL2</th>
 		<th>TL3</th>
 		<th>TL4</th>
 		<th>PSW1</th>
 		<th>PSW2</th>
 		<th>PSW3</th>
 		<th>PSW4</th>
 		<th>Total Telat</th>
 	</tr>
 	<tr>
 		<th>(1)</th>
 		<th>(2)</th>
 		<th>(3)</th>
 		<th>(4)</th>
 		<th>(5)</th>
 		<th>(6)</th>
 		<th>(7)</th>
 		<th>(8)</th>
 		<th>(9)</th>
 		<th>(10)</th>
 		<th>(11)</th>
 		<th>(12)</th>
 	</tr>
 </thead>
 <tbody>
 <?php
 $r_peg=list_pegawai_aktif(0,false);
 if ($r_peg["error"]==false) {
 	$i=1;
	$max_peg=$r_peg["peg_total"];
	for ($i=1;$i<=$max_peg;$i++) {
		if ($r_peg["item"][$i]["peg_jabatan"]==1) {
			$NamaAwal='<th>'.$i.'</th>
			<th>'.$r_peg["item"][$i]["peg_nama"].'</th><th>'.$JenisJabatan[$r_peg["item"][$i]["peg_jabatan"]].' '.$r_peg["item"][$i]["unit_nama"].'</th>';
		}
		else {
			$NamaAwal='<td>'.$i.'</td>
			<td>'.$r_peg["item"][$i]["peg_nama"].'</td>
			<td>'.$JenisJabatan[$r_peg["item"][$i]["peg_jabatan"]].' '.$r_peg["item"][$i]["unit_nama"].'</td>';
		}
		
		echo '
			<tr>
				'.$NamaAwal.'
				<td>'.$tl1.'</td>
				<td>'.$tl2.'</td>
				<td>'.$tl3.'</td>
				<td>'.$tl4.'</td>
				<td>'.$psw1.'</td>
				<td>'.$psw2.'</td>
				<td>'.$psw3.'</td>
				<td>'.$psw4.'</td>
				<td>'.$telat_menit.'</td>
			</tr>
			';
			
	}
 }
 else {

 }
 ?>
 </tbody>

</table>

