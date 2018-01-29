<legend>Daftar Absen Menurut Bidang/Bagian</legend>
<p>Hari <?php echo tgl_convert(1,$sdate); ?></p>
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
	$r_unit=list_unitkerja(0,false,false,true);

	if ($r_unit["error"]==false) {
		$i=1;
		$max_unit=$r_unit["unit_total"];
		for ($i=1;$i<=$max_unit;$i++) {
			if ($r_unit["item"][$i]["unit_eselon"] < 4) {
				//eselon 2 dan 3 bold
				echo '<tr>
			<td colspan="9"><strong>['.$r_unit["item"][$i]["unit_kode"].'] '.$r_unit["item"][$i]["unit_nama"].'</strong></td>
			</tr>';
			}
			else {
				
				echo '<tr>
			<td colspan="9">['.$r_unit["item"][$i]["unit_kode"].'] '.$r_unit["item"][$i]["unit_nama"].'</td>
			</tr>';
			}
			$r_peg=list_pegawai_unitkerja($r_unit["item"][$i]["unit_kode"],true);
			if ($r_peg["error"]==false) {
				$j=1;
				$max_peg=$r_peg["peg_total"];
				for ($j=1;$j<=$max_peg;$j++) {
					$a_masuk=peg_absen_v2($r_peg["item"][$j]["peg_id"],$sdate,0);
					if ($a_masuk["absen_telat"]==1) {
						$waktu_telat=$a_masuk["absen_selisih"];
					}
					else {
						$waktu_telat='';
					}
					$a_pulang=peg_absen_v2($r_peg["item"][$j]["peg_id"],$sdate,1);
					$a_keluar=peg_absen_v2($r_peg["item"][$j]["peg_id"],$sdate,2);
					$a_kembali=peg_absen_v2($r_peg["item"][$j]["peg_id"],$sdate,3);

					if ($r_peg["item"][$j]["peg_jabatan"]==1) {
						$AbsenAwalNama='
						<th>'.$j.'</th>
						<th>'.$r_peg["item"][$j]["peg_nama"].'</th>
						<th class="hidden-xs">'.$JenisJabatan[$r_peg["item"][$j]["peg_jabatan"]].' '.get_nama_unit($r_peg["item"][$j]["peg_unitkerja"]).'</th>
						';
					}
					else {
						$AbsenAwalNama='
						<td>'.$j.'</td>
						<td>'.$r_peg["item"][$j]["peg_nama"].'</td>
						<td class="hidden-xs">'.$JenisJabatan[$r_peg["item"][$j]["peg_jabatan"]].' '.get_nama_unit($r_peg["item"][$j]["peg_unitkerja"]).'</td>
						';
					}

					echo '
					<tr> '.$AbsenAwalNama.'
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
				echo '<tr><td colspan="9">Data pegawai masih kosong</td></tr>';
			}
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
</div>