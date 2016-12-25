<?php
$tahun_kegiatan='';
if (isset($_POST['submit_unitkerja'])) {
	$tahun_kegiatan=$_POST['tahun_kegiatan'];
	$bulan_kegiatan=$_POST['bulan_kegiatan'];
}
if ($tahun_kegiatan=='') $tahun_kegiatan=$TahunDefault;
?>
<legend>Daftar Kegiatan Menurut Bidang/Bagian</legend>
<form class="form-inline" action="<?php echo $url.'/'.$page.'/'.$act;?>" method="post">
  <div class="form-group">
    <label for="email">Tahun Kegiatan</label>
		<select class="form-control" name="bulan_kegiatan" id="bulan_kegiatan" style="font-family:'FontAwesome', Arial;">
		<option value="">Pilih Bulan</option>
		<?php
		for ($i=1;$i<=12;$i++) {
			if ($bulan_kegiatan==$i) $pilih='selected="selected"';
			else $pilih='';
			echo '<option value="'.$i.'" '.$pilih.'>'.$nama_bulan_panjang[$i].'</option>';
		}
		 ?>
	</select>
		<select class="form-control" name="tahun_kegiatan" id="tahun_kegiatan" style="font-family:'FontAwesome', Arial;">
		<option value="">Pilih Tahun</option>
		<?php
		$db = new db();
		$conn = $db -> connect();
		$sql_unitkerja = $conn -> query("select year(keg_start) as tahun from kegiatan group by year(keg_start) order by tahun asc");
		$cek= $sql_unitkerja -> num_rows;
		if ($cek > 0) {
			while ($r=$sql_unitkerja->fetch_object()) {
				if ($tahun_kegiatan==$r->tahun) $pilih='selected="selected"';
				else $pilih='';
				echo '<option value="'.$r->tahun.'" '.$pilih.'>'.$r->tahun.'</option>';
			}
		}
		else {
			echo '<option value="">data kosong</option>';
		}
		?>
		</select>
  </div>
  <button type="submit" name="submit_unitkerja" class="btn btn-default">Get Data</button>
</form>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
	<tr class="success">
		<th class="text-center">No</th>
		<th class="text-center">Kegiatan</th>
		<th class="text-center">Target</th>
		<th class="text-center">Jenis</th>
		<th class="text-center">Tgl Mulai</th>
		<th class="text-center">Tgl Berakhir</th>
		<?php
		if ($_SESSION['sesi_level']>2) { ?>
		<th colspan="2">Aksi</th>
		<?php } ?>
	</tr>
	<tr class="success">
		<td class="text-center">(1)</td>
		<td class="text-center">(2)</td>
		<td class="text-center">(3)</td>
		<td class="text-center">(4)</td>
		<td class="text-center">(5)</td>
		<td class="text-center">(6)</td>
		<?php
		if ($_SESSION['sesi_level']>2) { ?>
		<td colspan="2">(7)</th>
		<?php } ?>
	</tr>
	<?php
	$db = new db();
	$conn = $db -> connect();
	$sql_list_bidang= $conn -> query("select * from unitkerja where unit_jenis=1 and unit_eselon=3 order by unit_kode asc");
	$cek = $sql_list_bidang -> num_rows;
	if ($cek > 0) {
			if ($_SESSION['sesi_level']>2) $kol_span=8;
			else $kol_span=6;
		$i_es3=1;
		while ($r=$sql_list_bidang->fetch_object()) {
			$sql_unit_es4='';
			if ($i_es3>1) {
					echo '<tr class="success"><td colspan="'.$kol_span.'"></td></tr>';
			}
			echo '
			<tr>
				<td colspan="'.$kol_span.'"><strong>['.$r->unit_kode.'] '.$r->unit_nama.'</strong></td>
			</tr>
			';
			$unit_es3=$r->unit_kode;
			$sql_unit_es4=$conn -> query("select * from unitkerja where unit_parent='$unit_es3' and unit_eselon=4 order by unit_kode asc");
			$cek_unit_es4=$sql_unit_es4->num_rows;
			if ($cek_unit_es4>0) {
					$kol_span_es4=$kol_span;
						while ($s=$sql_unit_es4->fetch_object()) {
							$es4_prov=$s->unit_kode;
							echo '
							<tr>
								<td colspan="'.$kol_span_es4.'">['.$s->unit_kode.'] '.$s->unit_nama.'</td>
							</tr>
							';
							$i=1;
							$sql_keg_es4= $conn->query("select * from kegiatan where keg_unitkerja='$es4_prov' and year(keg_start)='$tahun_kegiatan'");
							while ($k=$sql_keg_es4->fetch_object()) {
								echo '
								<tr>
									<td class="text-center">'. $i.'.</td>
									<td><a href="'.$url.'/'.$page.'/view/'.$k->keg_id.'">'.$k->keg_nama.'</a></td>
									<td>'.$k->keg_total_target.' '.$k->keg_target_satuan.'</td>
									<td>'.$JenisKegiatan[$k->keg_jenis].'</td>
									<td>'.tgl_convert_bln(1,$k->keg_start).'</td>
									<td>'.tgl_convert_bln(1,$k->keg_end).'</td>';
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
			$i_es3++;
		}
	}
	else {
		echo '<tr><td colspan="9">Data kegiatan masih kosong</td></tr>';
	}
	?>
	</table>
</div>
