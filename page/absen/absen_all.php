<legend>Daftar Absen</legend>
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
 		<th>Keluar Istirahat</th>
 		<th>Masuk Istirahat</th>
 		<th>Pulang</th>
 		<th>Pulang Cepat</th>
 	</tr>
 </thead>
 <tbody>
 	<?php
 	$r_peg=list_pegawai_absen($sdate,0,false);
 	if ($r_peg["error"]==false) {
			$i=1;
			$max_peg=$r_peg["peg_total"];
			for ($i=1;$i<=$max_peg;$i++) {
				$a_masuk=peg_absen_v3($r_peg["item"][$i]["peg_id"],$sdate,0);
				if ($a_masuk["absen_telat"]==1) {
					$waktu_telat=$a_masuk["absen_selisih"];
				}
				else {
					$waktu_telat='';
				}
				$a_pulang=peg_absen_v3($r_peg["item"][$i]["peg_id"],$sdate,1);
				$a_keluar=peg_absen_v3($r_peg["item"][$i]["peg_id"],$sdate,2);
				$a_kembali=peg_absen_v3($r_peg["item"][$i]["peg_id"],$sdate,3);
				echo '
				<tr>
					<td>'.$i.'</td>
					<td>'.$r_peg["item"][$i]["peg_nama"].'</td>
					<td class="hidden-xs">'.$JenisJabatan[$r_peg["item"][$i]["peg_jabatan"]].' '.get_nama_unit($r_peg["item"][$i]["peg_unitkerja"]).'</td>
					<td>'.$a_masuk["absen_teks"].'</td>
					<td>'.$waktu_telat.'</td>
					<td>'.$a_keluar["absen_teks"].'</td>
					<td>'.$a_kembali["absen_teks"].'</td>
					<td>'.$a_pulang["absen_teks"].'</td>
					<td></td>
				</tr>
				';
			}
		}
	else {
		echo '<tr>
		<td colspan="9">Data masing kosong</td>
		</tr>';
	}
 	?>
 </tbody>
</table>