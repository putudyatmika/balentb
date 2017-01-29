<?php
$unit_kode='';
$tahun_kegiatan='';
$bulan_kegiatan='';
if (isset($_POST['submit_unitkerja'])) {
	$unit_kode=$_POST['unit_kode'];
	$tahun_kegiatan=$_POST['tahun_kegiatan'];
	$bulan_kegiatan=$_POST['bulan_kegiatan'];
}
if ($tahun_kegiatan=='') $tahun_kegiatan=$TahunDefault;

?>
<form class="form-inline" action="<?php echo $url.'/'.$page;?>/provinsi/" method="post">
  <div class="form-group">
    <label for="email">Pilih Bidang/Bagian</label>
		<select class="form-control" name="unit_kode" id="unit_kode" style="font-family:'FontAwesome', Arial;">
		<option value="">Pilih Bidang/Bagian</option>
		<?php
		$db = new db();
		$conn = $db -> connect();
		$sql_unitkerja = $conn -> query("select * from unitkerja where unit_jenis='1' and unit_eselon=3 order by unit_kode asc");
		$cek= $sql_unitkerja -> num_rows;
		if ($cek > 0) {
			while ($r=$sql_unitkerja->fetch_object()) {
				if ($unit_kode==$r->unit_kode) $pilih='selected="selected"';
				else $pilih='';
				echo '<option value="'.$r->unit_kode.'" '.$pilih.'>'.$r->unit_nama.'</option>';
			}
		}
		else {
			echo '<option value="">data kosong</option>';
		}
		?>
		</select>
  </div>
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
<?php
if ($bulan_kegiatan=='') {
	echo '<legend>Laporan Kegiatan '.get_nama_unit($unit_kode).' Tahun '.$tahun_kegiatan.'</legend>';
}
else {
	echo '<legend>Laporan Kegiatan '.get_nama_unit($unit_kode).' Bulan '. $nama_bulan_panjang[$bulan_kegiatan].' '.$tahun_kegiatan.'</legend>';
}
?>

<p class="text-right">Keadaan : <strong><?php echo tgl_hari_ini(); ?></strong></p>
<div class="table-responsive">
<table class="table table-hover table-bordered table-condensed">
	<tr class="success">
		<th>Bulan</th>
		<th>Kegiatan <?php echo get_nama_unit($unit_kode);?></th>
		<th>Tanggal Berakhir</th>
		<th>Satuan</th>
		<th>Target</th>
		<th>Pengiriman</th>
		<th>Penerimaan</th>
	</tr>
	<?php
	if ($bulan_kegiatan=='') {
		for ($i=1;$i<=12;$i++) {
			if ($unit_kode=='') {
				$sql_keg= $conn->query("select * from kegiatan where year(keg_end)='$tahun_kegiatan' and month(keg_end)='$i' order by keg_end,keg_unitkerja asc");
			}
			else {
				$sql_keg= $conn->query("select * from kegiatan, unitkerja where year(keg_end)='$tahun_kegiatan' and month(keg_end)='$i' and kegiatan.keg_unitkerja=unitkerja.unit_kode and unitkerja.unit_parent='$unit_kode' order by keg_end asc");
			}
			$cek_keg=$sql_keg->num_rows;
			if ($cek_keg>0) {
				$j=1;
				echo '
				<tr>
					<td rowspan="'.$cek_keg.'">'.$nama_bulan_panjang[$i].'</td>';
				while ($k=$sql_keg->fetch_object()) {
					$target_total=$k->keg_total_target;
					$total_kirim=get_keg_realisasi($k->keg_id,1);
					$total_terima=get_keg_realisasi($k->keg_id,2);
					$persen_kirim=($total_kirim/$target_total)*100;
					$persen_terima=($total_terima/$target_total)*100;

					if ($persen_kirim > 85) $rr_kirim='class="text-right bpsgood"';
					elseif ($persen_kirim > 70) $rr_kirim='class="text-right bpsmedium"';
					else $rr_kirim='class="text-right bpsbad"';

					if ($persen_terima > 85) $rr_terima='class="text-right bpsgood"';
					elseif ($persen_terima > 70) $rr_terima='class="text-right bpsmedium"';
					else $rr_terima='class="text-right bpsbad"';
					echo '
					<td><a href="'.$url.'/kegiatan/view/'.$k->keg_id.'">'.$j.'. '.$k->keg_nama.'</a></td>
					<td>'.tgl_convert_bln(1,$k->keg_end).'</td>
					<td>'.$k->keg_target_satuan.'</td>
					<td class="text-right">'.$k->keg_total_target.'</td>
					<td '.$rr_kirim.'>'.$total_kirim.' ('.number_format($persen_kirim,2,",",".").' %)</td>
					<td '.$rr_terima.'>'.$total_terima.' ('.number_format($persen_terima,2,",",".").' %)</td>
					</tr>
					<tr>
					';
					$j++;
				}
				echo '<td class="success" colspan="7"></td></tr>
				';
			}
			else {
				echo '
				<tr>
					<td>'.$nama_bulan_panjang[$i].'</td>
					<td colspan="6" class="text-center">Belum ada kegiatan dibulan ini</td>
				</tr>
				';
			}
		}
	}
	else { //bulan_kegiatan ada nilai
			if ($unit_kode=='') {
				$sql_keg= $conn->query("select * from kegiatan where year(keg_end)='$tahun_kegiatan' and month(keg_end)='$bulan_kegiatan' order by keg_end,keg_unitkerja asc");
			}
			else {
				$sql_keg= $conn->query("select * from kegiatan, unitkerja where year(keg_end)='$tahun_kegiatan' and month(keg_end)='$bulan_kegiatan' and kegiatan.keg_unitkerja=unitkerja.unit_kode and unitkerja.unit_parent='$unit_kode' order by keg_end asc");
			}
			
			$cek_keg=$sql_keg->num_rows;
			if ($cek_keg>0) {
				$j=1;
				echo '
				<tr>
					<td rowspan="'.$cek_keg.'">'.$nama_bulan_panjang[$bulan_kegiatan].'</td>';
				while ($k=$sql_keg->fetch_object()) {
					$total_kirim=get_keg_realisasi($k->keg_id,1);
					$total_terima=get_keg_realisasi($k->keg_id,2);
					$target_total=$k->keg_total_target;
					$total_kirim=get_keg_realisasi($k->keg_id,1);
					$total_terima=get_keg_realisasi($k->keg_id,2);
					$persen_kirim=($total_kirim/$target_total)*100;
					$persen_terima=($total_terima/$target_total)*100;

					if ($persen_kirim > 85) $rr_kirim='class="text-right bpsgood"';
					elseif ($persen_kirim > 70) $rr_kirim='class="text-right bpsmedium"';
					else $rr_kirim='class="text-right bpsbad"';

					if ($persen_terima > 85) $rr_terima='class="text-right bpsgood"';
					elseif ($persen_terima > 70) $rr_terima='class="text-right bpsmedium"';
					else $rr_terima='class="text-right bpsbad"';
					echo '
					<td><a href="'.$url.'/kegiatan/view/'.$k->keg_id.'">'.$j.'. '.$k->keg_nama.'</a></td>
					<td>'.tgl_convert_bln(1,$k->keg_end).'</td>
					<td>'.$k->keg_target_satuan.'</td>
					<td class="text-right">'.$k->keg_total_target.'</td>
					<td '.$rr_kirim.'>'.$total_kirim.' ('.number_format($persen_kirim,2,",",".").' %)</td>
					<td '.$rr_terima.'>'.$total_terima.' ('.number_format($persen_terima,2,",",".").' %)</td>
					</tr>
					<tr>
					';
					$j++;
				}
				echo '<td class="success" colspan="7"></td></tr>
				';
			}
			else {
				echo '
				<tr>
					<td>'.$nama_bulan_panjang[$bulan_kegiatan].'</td>
					<td colspan="6" class="text-center">Belum ada kegiatan dibulan ini</td>
				</tr>
				';
			}
	}	
	?>
</table>
</div>