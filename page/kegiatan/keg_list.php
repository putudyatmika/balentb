<?php
$tahun_kegiatan='';
$bulan_kegiatan='';
if (isset($_POST['submit_unitkerja'])) {
	$tahun_kegiatan=$_POST['tahun_kegiatan'];
	$bulan_kegiatan=$_POST['bulan_kegiatan'];
}
if ($tahun_kegiatan=='') $tahun_kegiatan=$TahunDefault;
?>
<legend>Daftar Kegiatan</legend>
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
		<th>No</th>
		<th>Kegiatan</th>
		<th>Unit Kerja</th>
		<th>Tanggal Berakhir</th>
		<th>Satuan</th>
		<th>Target</th>
		<th>SPJ</th>
		<?php
		if ($_SESSION['sesi_level']>2) { ?>
		<th colspan="2">Aksi</th>
		<?php } ?>
	</tr>
	<?php
	$db = new db();
	$conn = $db -> connect();
	if ($bulan_kegiatan=='') {
		$sql_list_kegiatan= $conn -> query("select * from kegiatan,unitkerja where kegiatan.keg_unitkerja=unitkerja.unit_kode and year(kegiatan.keg_start)='$tahun_kegiatan' order by kegiatan.keg_end asc"); 
	}
	else {
	$sql_list_kegiatan= $conn -> query("select * from kegiatan,unitkerja where kegiatan.keg_unitkerja=unitkerja.unit_kode and month(kegiatan.keg_end)='$bulan_kegiatan' and year(kegiatan.keg_end)='$tahun_kegiatan' order by kegiatan.keg_end asc"); 
	}
	$cek = $sql_list_kegiatan -> num_rows;
	if ($cek > 0) {
		$i=1;
		while ($r= $sql_list_kegiatan->fetch_object()) {
			echo '
			<tr>
				<td class="text-center">'.$i.'</td>
				<td><a href="'.$url.'/'.$page.'/view/'.$r->keg_id.'">'.$r->keg_nama.'</a></td>
				<td>'.$r->unit_nama.'</td>
				<td>'.tgl_convert_bln(1,$r->keg_end).'</td>
				<td>'.$r->keg_target_satuan.'</td>
				<td>'.$r->keg_total_target.'</td>
				<td>'.$StatusSPJ[$r->keg_spj].'</td>';
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