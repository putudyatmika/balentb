<legend>Rekap Kehadiran Karyawan</legend>
<?php
if ($edate=='') {
	echo '<p>Hari '.tgl_convert(1,$sdate).'</p>';
	$edate=$sdate;
}
else {
	if (strtotime($edate)>=strtotime($sdate)) {
	echo '<p>Hari '.tgl_convert(1,$sdate).' s/d '.tgl_convert(1,$edate).' </p>';
	}
}

if (strtotime($edate)<strtotime($sdate)) {
	//tanggal akhir lebih atau sama dgn tanggal awal
	echo 'Tanggal akhir lebih besar atau sama dengan tanggal awal';
}
else {
$date1 = new DateTime($sdate);
$date2 = new DateTime($edate);
$diff = $date2->diff($date1)->format("%a");
if ($diff>31) {
	echo 'Max 31 hari kalendar';
}
else {
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
	<thead>
 	<tr>
 		<th>#</th>
 		<th>Nama</th>
 		<th>Masuk</th>
 		<th>#</th>
 		<th>Pulang</th>
 		<th>#</th>
 		<th>Telat Masuk</th>
 		<th class="hidden-print">&nbsp;</th>
 	</tr>
 	<tr>
 		<th>(1)</th>
 		<th>(2)</th>
 		<th>(3)</th>
 		<th>(4)</th>
 		<th>(5)</th>
 		<th>(6)</th>
 		<th>(7)</th>
 		<th class="hidden-print">(8)</th>
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
			<td colspan="8"><strong>['.$r_unit["item"][$i]["unit_kode"].'] '.$r_unit["item"][$i]["unit_nama"].'</strong></td>
			</tr>';
			}
			else {
				
				echo '<tr>
			<td colspan="8">['.$r_unit["item"][$i]["unit_kode"].'] '.$r_unit["item"][$i]["unit_nama"].'</td>
			</tr>';
			}
			$r_peg=list_pegawai_unitkerja($r_unit["item"][$i]["unit_kode"],true,true);
			if ($r_peg["error"]==false) {
				$j=1;
				$max_peg=$r_peg["peg_total"];
				for ($j=1;$j<=$max_peg;$j++) {
					
					if ($r_peg["item"][$j]["peg_jabatan"]==1) {
						echo '<tr>
						<th>'.$j.'</th>
						<th colspan="7">'.$r_peg["item"][$j]["peg_nama"].' / '.get_nama_unit($r_peg["item"][$j]["peg_unitkerja"]).'</th>
						</tr>';
					}
					else {
						echo '<tr>
						<td>'.$j.'</td>
						<td colspan="7">'.$r_peg["item"][$j]["peg_nama"].'</td>
						</tr>';
					}

					
					$begin = new DateTime($sdate);
					$end   = new DateTime($edate);
					//tampilkan tanggalnya
					for($k=$begin; $k <= $end; $k->modify('+1 day')) {
						//tampilkan absen tanggal semua ip pegawai
						if (cek_hari_kerja($k->format("Y-m-d"))==false) {
							//menampilkan hari kerja saja
							$r_rekap=rekap_harian($r_peg["item"][$j]["peg_id"],$k->format("Y-m-d"));
							echo '
							<tr> 
							<td></td>
							<td>'.tgl_convert(1,$k->format("Y-m-d")).'</td>';
							if ($r_rekap["error"]==true) {
								$hr_libur=cek_hari_libur($k->format("Y-m-d"));
								if ($hr_libur["error"]==false) {
									echo '<td colspan="6"><span class="label label-success">'.$hr_libur["libur_ket"].'</a></td>';
								}
								else {
								echo '<td><span class="label label-danger">'.$JenisHariAbsen[0].'</a></td>
								<td><span class="label label-primary">'.$JenisTelatMasuk[4].'</a></td>
								<td colspan="3"></td>
								<td class="hidden-print"><a href="'.$url.'/'.$page.'/addpeg/'.$r_peg["item"][$j]["peg_id"].'/'.strtotime($k->format("Y-m-d")).'"><i class="fa fa-plus-square text-primary" aria-hidden="true"></i></a></td>';
								}
							}
							else {
								//ada isiannnya
								if ($r_rekap["absen_hadir"]==1) {
								$jam_telat=cek_telat($r_rekap["jam_masuk"]);
								if ($jam_telat["tl"]>0) {
									//telat
									$tl=$jam_telat["tl"];
									if ($tl==1) { $telat='<span class="label label-warning">'.$JenisTelatMasuk[$tl].'</span>';}
									elseif ($tl==2) { $telat='<span class="label label-info">'.$JenisTelatMasuk[$tl].'</span>';}
									elseif ($tl==3){ $telat='<span class="label label-primary">'.$JenisTelatMasuk[$tl].'</span>';}
									else { $telat='<span class="label label-danger">'.$JenisTelatMasuk[$tl].'</span>';}
									$jam_masuk='<span class="label label-danger">'.date("H:i",strtotime($r_rekap["jam_masuk"])).'</span>';
									$waktu_telat='<span class="label label-danger">'.date("H:i",strtotime($jam_telat["waktu"])).'</span>';
								}
								else {
									//tidak
									$telat='';
									$waktu_telat='';
									$jam_masuk=date("H:i",strtotime($r_rekap["jam_masuk"]));
								}

								if ($r_rekap["jam_pulang"]=='') {
									$jam_pulang='';
									$telat_pulang='<span class="label label-primary">'.$JenisPulangCepat[4].'</span>';
								}
								else {
									$jam_pulang=date("H:i",strtotime($r_rekap["jam_pulang"]));
									$telat_pulang='';
								}
								echo '<td>'.$jam_masuk.'</td>
									<td>'.$telat.'</td>
									<td>'.$jam_pulang.'</td>
									<td>'.$telat_pulang.'</td>
									<td>'.$waktu_telat.'</td>
									<td class="hidden-print">&nbsp;</td>';
								}
								else {
									echo '<td colspan="5"><span class="label label-default">'.$JenisHariAbsen[$r_rekap["absen_hadir"]].' '.$r_rekap["absen_ket"].'</span></td>
									<td class="hidden-print"><a href="'.$url.'/'.$page.'/editpeg/'.$r_peg["item"][$j]["peg_id"].'/'.strtotime($k->format("Y-m-d")).'"><i class="fa fa-pencil-square text-primary" aria-hidden="true"></i></a></td>';
								}
							}
							echo '</tr>';


						}
					
						}
						
					}
				
			}
			else {
				echo '<tr><td colspan="7">Data pegawai masih kosong</td></tr>';
			}
		}
	}
	else {
		echo '<tr>
		<td colspan="7">Data masing kosong</td>
		</tr>';
	}
	?>
 </tbody>

</table>
</div>
<?php
}
}
?>