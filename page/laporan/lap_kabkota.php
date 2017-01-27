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
<form class="form-inline" action="<?php echo $url.'/'.$page;?>/kabkota/" method="post">
  <div class="form-group">
    <label for="email">Pilih Kabkota</label>
		<select class="form-control" name="unit_kode" id="unit_kode" style="font-family:'FontAwesome', Arial;">
		<option value="">Pilih</option>
		<?php
		$db = new db();
		$conn = $db -> connect();
		$sql_unitkerja = $conn -> query("select * from unitkerja where unit_jenis='2' and unit_eselon=3 order by unit_kode asc");
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
<?php
if ($unit_kode=='') {
?>
<div class="table-responsive col-sm-6 col-lg-6">
<table class="table table-hover table-bordered table-condensed">
	<tr class="success">
		<th>Bulan</th>
		<th>Peringkat</th>
		<th>Kegiatan</th>
		<th>Target</th>
		<th>Nilai</th>
	</tr>
	<?php
	for ($i=1;$i<=12;$i++) {
		$sql_list_kabkota= $conn -> query("select keg_t_unitkerja, count(*) as keg_jml, sum(keg_target.keg_t_target) as keg_jml_target, sum(keg_target.keg_t_point_waktu) as point_waktu, sum(keg_target.keg_t_point_jumlah) as point_jumlah, sum(keg_target.keg_t_point) as point_total from keg_target,kegiatan where kegiatan.keg_id=keg_target.keg_id and month(kegiatan.keg_end)='$i' group by keg_t_unitkerja order by point_total desc, keg_t_unitkerja asc");
		$cek_kabkota=$sql_list_kabkota->num_rows;
		if ($cek_kabkota>0) {
			$j=1;
			echo '
				<tr>
					<td rowspan="'.$cek_kabkota.'">'.$nama_bulan_panjang[$i].'</td>';
			while ($k=$sql_list_kabkota->fetch_object()) {
				$total_keg=$k->keg_jml;
				$point_total=$k->point_total;
				$nilai=$point_total/$total_keg;
				$nama_unit=get_nama_unit($k->keg_t_unitkerja);
				echo '
				<td>'.$j.'. '.$nama_unit.'</td>
				<td>'.$k->keg_jml.'</td>
				<td>'.$k->keg_jml_target.'</td>
				<td>'.number_format($nilai,4,",",".").'</td>
				</tr>
				<tr>
				';
				$j++;
			}
			echo '<td colspan="5"></td></tr>';
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
	?>
</table>
</div>
<?php } 
else { //terpilih salaah satu kabkota
?>
<div class="table-responsive">
<table class="table table-hover table-bordered table-condensed">
	<tr class="success">
		<th>Bulan</th>
		<th>Peringkat Kabupaten/Kota</th>
		<th>Jumlah Kegiatan</th>
		<th>Jumlah Target</th>
		<th>Nilai</th>
	</tr>
	
</table>
</div>
<?php
}
?>

