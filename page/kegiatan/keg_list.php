<?php
$tahun_kegiatan='';
if (isset($_POST['submit_unitkerja'])) {
	$tahun_kegiatan=$_POST['tahun_kegiatan'];
}
if ($tahun_kegiatan=='') $tahun_kegiatan=date('Y');
?>
<legend>Daftar Kegiatan</legend>
<form class="form-inline" action="<?php echo $url.'/'.$page.'/'.$act;?>" method="post">
  <div class="form-group">
    <label for="email">Tahun Kegiatan</label>
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
		<th>No</th>
		<th>Kegiatan</th>
		<th>Unit Kerja</th>
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
	$sql_list_kegiatan= $conn -> query("select * from kegiatan,unitkerja where kegiatan.keg_unitkerja=unitkerja.unit_kode order by kegiatan.keg_end asc");
	$cek = $sql_list_kegiatan -> num_rows;
	if ($cek > 0) {
		$i=1;
		while ($r= $sql_list_kegiatan->fetch_object()) {
			echo '
			<tr>
				<td>'.$i.'</td>
				<td><a href="'.$url.'/'.$page.'/view/'.$r->keg_id.'">'.$r->keg_nama.'</a></td>
				<td>'.$r->unit_nama.'</td>
				<td>'.$r->keg_total_target.' '.$r->keg_target_satuan.'</td>
				<td>'.$JenisKegiatan[$r->keg_jenis].'</td>
				<td>'.$r->keg_start.'</td>
				<td>'.$r->keg_end.'</td>';
				if ($_SESSION['sesi_level'] > 2) {
					echo '
				<td><a href="'.$url.'/'.$page.'/edit/'.$r->keg_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a></td>
				<td><a href="'.$url.'/'.$page.'/delete/'.$r->keg_id.'" data-confirm="Apakah data ('.$r->keg_id.') '.$r->keg_nama.' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>';
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
