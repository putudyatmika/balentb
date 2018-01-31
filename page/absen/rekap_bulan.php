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
 		<th class="hidden-xs">Jabatan</th>
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
 </thead>
 <tbody>
 	
 </tbody>

</table>

