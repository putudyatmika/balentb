<legend>Rekap Kehadiran Karyawan</legend>
<?php
if ($edate=='') {
	echo '<p>Hari '.tgl_convert(1,$sdate).'</p>';
	$edate=$sdate;
}
else {
	echo '<p>Hari '.tgl_convert(1,$sdate).' s/d '.tgl_convert(1,$edate).' </p>';
}

?>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<thead>
 	<tr>
 		<th>#</th>
 		<th>Nama</th>
 		<th class="hidden-xs">Jabatan</th>
 		<th>Masuk</th>
 		<th>Terlambat</th>
 		<th>Pulang</th>
 		<th>Pulang Cepat</th>
 	</tr>
 </thead>
 <tbody>
 	
 </tbody>
</table>