<legend>Daftar Kegiatan Menurut Bidang/Bagian</legend>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
	<tr class="success">
		<th>No</th>
		<th>Unitkerja</th>
		<th>Kegiatan</th>
		<th>Target</th>
		<th>Jenis</th>
		<th>Tgl Mulai</th>
		<th>Tgl Berakhir</th>
		<?php
		if ($_SESSION['sesi_level']>2) { ?>
		<th colspan="2">Aksi</th>
		<?php } ?>
	</tr>
	<?php
	$db = new db();
	$conn = $db -> connect();
	$sql_list_bidang= $conn -> query("select * from unitkerja where unit_jenis=1 and unit_eselon=3 order by unit_kode asc");
	$cek = $sql_list_bidang -> num_rows;
	if ($cek > 0) {
			if ($_SESSION['sesi_level']>2) $kol_span=9;
			else $kol_span=7;

		while ($r=$sql_list_bidang->fetch_object()) {
			$sql_unit_es4='';
			echo '
			<tr>
				<td colspan="'.$kol_span.'">['.$r->unit_kode.'] '.$r->unit_nama.'</td>
			</tr>
			';
			$unit_es3=$r->unit_kode;
			$sql_unit_es4=$conn -> query("select * from unitkerja where unit_parent='$unit_es3' and unit_eselon=4 order by unit_kode asc");
			$cek_unit_es4=$sql_unit_es4->num_rows;
			if ($cek_unit_es4>0) {
					$kol_span_es4=$kol_span-1;
						while ($s=$sql_unit_es4->fetch_object()) {
							$es4_prov=$s->unit_kode;
							echo '
							<tr>
								<td>&nbsp;</td>
								<td colspan="'.$kol_span_es4.'">['.$s->unit_kode.'] '.$s->unit_nama.'</td>
							</tr>
							';
							$i=1;
							$sql_keg_es4= $conn->query("select * from kegiatan where keg_unitkerja='$es4_prov'");
							while ($k=$sql_keg_es4->fetch_object()) {
								echo '
								<tr>
									<td></td>
									<td></td>
									<td><a href="'.$url.'/'.$page.'/view/'.$k->keg_id.'">'. $i.'. '.$k->keg_nama.'</a></td>
									<td>'.$k->keg_total_target.' '.$k->keg_target_satuan.'</td>
									<td>'.$JenisKegiatan[$k->keg_jenis].'</td>
									<td>'.$k->keg_start.'</td>
									<td>'.$k->keg_end.'</td>';
									if ($_SESSION['sesi_level'] > 2) {
										echo '
									<td><a href="'.$url.'/'.$page.'/edit/'.$k->keg_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a></td>
									<td><a href="'.$url.'/'.$page.'/delete/'.$k->keg_id.'" data-confirm="Apakah data ('.$k->keg_id.') '.$k->keg_nama.' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>';
									}
									$i++;
							}
						}
			}
			else {
				echo '
				<tr>
					<td colspan="'.$kol_span.'">Data Seksi masih kosong</td>
				</tr>
				';
			}

			echo '
			</tr>
			';
			$i++;
		}
	}
	else {
		echo '<tr><td colspan="9">Data kegiatan masih kosong</td></tr>';
	}
	?>
	</table>
</div>
