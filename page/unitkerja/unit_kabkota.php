<?php
$unit_kode='';
$tahun_kegiatan='';
if (isset($_POST['submit_unitkerja'])) {
	$unit_kode=$_POST['unit_kode'];
	$tahun_kegiatan=$_POST['tahun_kegiatan'];
}
if ($tahun_kegiatan=='') $tahun_kegiatan=$TahunDefault;
?>
<form class="form-inline margin10px" action="<?php echo $url.'/'.$page;?>/kabkota/" method="post">
  <div class="form-group">
    <label for="email">Pilih Kabkota</label>
		<select class="form-control" name="unit_kode" id="unit_kode" style="font-family:'FontAwesome', Arial;">
		<option value="">Pilih Kabkota</option>
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
<legend class="margin10px">Daftar Kegiatan <?php echo get_nama_unit($unit_kode); ?></legend>
<div class="table-responsive">
<table class="table table-hover table-bordered table-condensed">
	<tr class="success">
		<th>No</th>
		<th>Kegiatan</th>
		<th>Tanggal Berakhir</th>
		<th>Satuan</th>
		<th>Target</th>
		<th>Pengiriman</th>
		<th>Penerimaan</th>
	</tr>
	<?php
	if ($unit_kode=='') {
		$sql_list_bidang= $conn -> query("select * from unitkerja where unit_jenis=2 and unit_eselon=3 order by unit_kode asc");
		$cek_bid=$sql_list_bidang->num_rows;
		$i_bid=1;
		if ($cek_bid > 0) {
			while ($b=$sql_list_bidang->fetch_object()) {
				if ($i_bid>1)  echo '<tr class="success"><td colspan="7"></td></tr>';
				$sql_unit_es4='';
				$unit_es3=$b->unit_kode;
				echo '<tr><td colspan="7"><strong>'.$b->unit_nama .'</strong></td></tr>';
				$i=1;
				$sql_keg_es4= $conn->query("select * from kegiatan,keg_target where kegiatan.keg_id=keg_target.keg_id and keg_t_unitkerja='$unit_es3' and keg_t_target>0 and year(keg_start)='$tahun_kegiatan'");
				while ($k=$sql_keg_es4->fetch_object()) {
					$target_total=$k->keg_t_target;
					//get_keg_kabkota_realisasi($keg_id,$unit_kabkota, $keg_jenis)
					$total_kirim=get_keg_kabkota_realisasi($k->keg_id,$k->keg_t_unitkerja,1);
					$total_terima=get_keg_kabkota_realisasi($k->keg_id,$k->keg_t_unitkerja,2);
					$persen_kirim=($total_kirim/$target_total)*100;
					$persen_terima=($total_terima/$target_total)*100;

					if ($persen_kirim > 85) $rr_kirim='class="text-right bpsgood"';
					elseif ($persen_kirim > 70) $rr_kirim='class="text-right bpsmedium"';
					else $rr_kirim='class="text-right bpsbad"';

					if ($persen_terima > 85) $rr_terima='class="text-right bpsgood"';
					elseif ($persen_terima > 70) $rr_terima='class="text-right bpsmedium"';
					else $rr_terima='class="text-right bpsbad"';


					echo '
					<tr>
						<td class="text-center">'.$i.'.</td>
						<td><a href="'.$url.'/kegiatan/view/'.$k->keg_id.'">'.$k->keg_nama.'</a></td>
						<td>'.tgl_convert(1,$k->keg_end).'</td>
						<td>'.$k->keg_target_satuan.'</td>
						<td class="text-right">'.$k->keg_t_target.'</td>
						<td '.$rr_kirim.'>'.$total_kirim.' ('.number_format($persen_kirim,2,",",".").' %)</td>
						<td '.$rr_terima.'>'.$total_terima.' ('.number_format($persen_terima,2,",",".").' %)</td>
					</tr>
					';
					$i++;
				}
				$i_bid++;
			}
		}
		else {
			echo 'Data bagian/bidang kosong';
		}
	}
	else {
		$i=1;
				$sql_keg_es4= $conn->query("select * from kegiatan,keg_target where kegiatan.keg_id=keg_target.keg_id and keg_t_unitkerja='$unit_kode' and keg_t_target>0 and year(keg_start)='$tahun_kegiatan'");
				while ($k=$sql_keg_es4->fetch_object()) {
					$target_total=$k->keg_t_target;
					//get_keg_kabkota_realisasi($keg_id,$unit_kabkota, $keg_jenis)
					$total_kirim=get_keg_kabkota_realisasi($k->keg_id,$k->keg_t_unitkerja,1);
					$total_terima=get_keg_kabkota_realisasi($k->keg_id,$k->keg_t_unitkerja,2);
					$persen_kirim=($total_kirim/$target_total)*100;
					$persen_terima=($total_terima/$target_total)*100;

					if ($persen_kirim > 85) $rr_kirim='class="text-right bpsgood"';
					elseif ($persen_kirim > 70) $rr_kirim='class="text-right bpsmedium"';
					else $rr_kirim='class="text-right bpsbad"';

					if ($persen_terima > 85) $rr_terima='class="text-right bpsgood"';
					elseif ($persen_terima > 70) $rr_terima='class="text-right bpsmedium"';
					else $rr_terima='class="text-right bpsbad"';


					echo '
					<tr>
						<td class="text-center">'.$i.'.</td>
						<td><a href="'.$url.'/kegiatan/view/'.$k->keg_id.'">'.$k->keg_nama.'</a></td>
						<td>'.tgl_convert(1,$k->keg_end).'</td>
						<td>'.$k->keg_target_satuan.'</td>
						<td class="text-right">'.$k->keg_t_target.'</td>
						<td '.$rr_kirim.'>'.$total_kirim.' ('.number_format($persen_kirim,2,",",".").' %)</td>
						<td '.$rr_terima.'>'.$total_terima.' ('.number_format($persen_terima,2,",",".").' %)</td>
					</tr>
					';
					$i++;
				}
	}
	?>
</table>
