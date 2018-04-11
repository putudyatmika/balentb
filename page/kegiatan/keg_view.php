<?php
$keg_id=$lvl3;
$db_view = new db();
$conn_view = $db_view -> connect();
$sql_view = $conn_view -> query("select * from kegiatan,unitkerja where kegiatan.keg_unitkerja=unitkerja.unit_kode and keg_id='$keg_id'");
$cek=$sql_view->num_rows;
if ($cek>0) {
 $r=$sql_view -> fetch_object();
 $tgl_mulai=$r->keg_start;
 if ($r->keg_info=="") {
 	$keg_info=': Belum ada ';
 	$add_info='<p>&nbsp; <a href="'.$url.'/'.$page.'/addinfo/'.$r->keg_id.'"><i class="fa fa-plus-square text-success" aria-hidden="true"></i></a></p>';
 }
 else {
 	$keg_info=$r->keg_info;
 	$add_info='<p>&nbsp; <a href="'.$url.'/'.$page.'/editinfo/'.$r->keg_id.'"><i class="fa fa-pencil-square text-success" aria-hidden="true"></i></a> 
 	<a href="'.$url.'/'.$page.'/deleteinfo/'.$r->keg_id.'" data-confirm="Apakah info lanjutan ('.$r->keg_id.') '.$r->keg_nama.' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></p>';
 }

 echo '
<div class="table-responsive margin10px">
<table class="table table-hover table-striped table-condensed">
<tr>
  <th colspan="2" class="success text-danger"><h4>'.$r->keg_nama.'</h4></td>
  </tr>
	<tr>
		<td class="text-right"><strong>Kegiatan</strong></td>
		<td>: '.$r->keg_nama.'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Unit Kerja</strong></td>
		<td>: '.$r->unit_nama.'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Jenis Kegiatan</strong></td>
		<td>: '.$JenisKegiatan[$r->keg_jenis].'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Total target</strong></td>
		<td>: '.$r->keg_total_target.' '.$r->keg_target_satuan.'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Tanggal Mulai</strong></td>
		<td>: '.tgl_convert(1,$r->keg_start).'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Tanggal Berakhir</strong></td>
		<td>: '.tgl_convert(1,$r->keg_end).'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>SPJ</strong></td>
		<td>: '.$StatusSPJ[$r->keg_spj].'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Info Lanjutan</strong></td>
		<td>'.html_entity_decode($keg_info);
	if ($_SESSION['sesi_level'] > 2) {  echo $add_info; }
	echo '</td>
	</tr>
	';
if ($_SESSION['sesi_level'] > 3) {
  echo '
  <tr>
		<td class="text-right"><strong>Dibuat oleh</strong></td>
		<td>: '.$r->keg_dibuat_oleh.'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Dibuat tanggal</strong></td>
		<td>: '.tgl_convert(1,$r->keg_dibuat_waktu).'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Diupdate oleh</strong></td>
		<td>: '.$r->keg_diupdate_oleh.'</td>
	</tr>
	<tr>
		<td class="text-right"><strong>Diupdate tanggal</strong></td>
		<td>: '.tgl_convert(1,$r->keg_diupdate_waktu).'</td>
	</tr>'; }
  if ($_SESSION['sesi_level'] > 2) {
echo '
  <tr>
		<td class="text-right"></td>
		<td><a href="'.$url.'/'.$page.'/edit/'.$r->keg_id.'"><i class="fa fa-2x fa-pencil-square text-info" aria-hidden="true"></i></a>
		 <a href="'.$url.'/'.$page.'/delete/'.$r->keg_id.'" data-confirm="Apakah data ('.$r->keg_id.') '.$r->keg_nama.' ini akan di hapus?"><i class="fa fa-2x fa-trash-o text-danger" aria-hidden="true"></i></a>

		</td>
	</tr>';
}
echo '
</table>
</div>
 ';
 $sql_kabkota_target=$conn_view -> query("select * from keg_target,unitkerja where keg_target.keg_t_unitkerja=unitkerja.unit_kode and keg_target.keg_id='$keg_id' and keg_t_target>0");
 
 echo '
 <div class="table-responsive">
<table class="table table-hover table-bordered table-condensed">
<tr class="success">
	<th rowspan="2" class="text-center">No</th>
	<th rowspan="2" class="text-center">Unit Kerja</th>
	<th rowspan="2" class="text-center">Target</th>
	<th colspan="3" class="text-center">Pengiriman</th>
	<th colspan="3" class="text-center">Penerimaan</th>
	<th rowspan="2" class="text-center">Nilai</th>
	</tr>
	<tr class="success">
	<th class="text-center">Rincian</th>
	<th class="text-center">RR (%)</th>
	<th></th>
	<th class="text-center">Rincian</th>
	<th class="text-center">RR (%)</th>
	<th></th>
	</tr>
	';
	$i=1;
	$total=0;
	$total_kirim=0;
	$total_terima=0;
while ($k=$sql_kabkota_target->fetch_object()) {
	$d_keg_kirim=get_detil_kegiatan($k->keg_id,$k->keg_t_unitkerja,1);
	$d_kirim=$d_keg_kirim[1];
	$d_persen_kirim=($d_kirim/$k->keg_t_target)*100;
	if ($d_persen_kirim > 85) $rr_kirim='class="text-right bpsgood"';
	elseif ($d_persen_kirim > 70) $rr_kirim='class="text-right bpsmedium"';
	else $rr_kirim='class="text-right bpsbad"';

	$d_keg_terima=get_detil_kegiatan($k->keg_id,$k->keg_t_unitkerja,2);
	$d_terima=$d_keg_terima[1];
	$d_persen_terima=($d_terima/$k->keg_t_target)*100;
	if ($d_persen_terima > 85) $rr_terima='class="text-right bpsgood"';
	elseif ($d_persen_terima > 70) $rr_terima='class="text-right bpsmedium"';
	else $rr_terima='class="text-right bpsbad"';
	if (($_SESSION['sesi_level'] > 1) and ($tgl_mulai <= $tanggal_hari_ini)) {
		if ($_SESSION['sesi_level'] > 2) {
			if ($_SESSION['sesi_level'] > 3) { //level admin dan superadmin
			$kirim_data='<a href="'.$url.'/'.$page.'/kirim/'.$k->keg_id.'/'.$k->keg_t_unitkerja.'"><i class="fa fa-plus-square text-primary" aria-hidden="true"></i></a>';
			$terima_data='<a href="'.$url.'/'.$page.'/terima/'.$k->keg_id.'/'.$k->keg_t_unitkerja.'"><i class="fa fa-plus-square text-success" aria-hidden="true"></i></a>';
			}
			else { //level operator provinsi hanya kirim saja
				if ($d_keg_kirim[0]!='') {
					$terima_data='<a href="'.$url.'/'.$page.'/terima/'.$k->keg_id.'/'.$k->keg_t_unitkerja.'"><i class="fa fa-plus-square text-success" aria-hidden="true"></i></a>';
				}
				else {
					$terima_data='';
				}
				$kirim_data='';
			}
		}
		else { //level operator kabkota
			if ($_SESSION['sesi_unitkerja']==$k->keg_t_unitkerja) {
				$kirim_data='<a href="'.$url.'/'.$page.'/kirim/'.$k->keg_id.'/'.$k->keg_t_unitkerja.'"><i class="fa fa-plus-square text-primary" aria-hidden="true"></i></a>';
			}
			else {
				$kirim_data='';
			}
			$terima_data='';
		}
	}
	else {
		$kirim_data='';
		$terima_data='';
	}

	echo '
	<tr>
		<td class="text-center">'.$i.'</td>
		<td>'.$k->unit_nama.'</td>
		<td class="text-right">'.$k->keg_t_target.'</td>
		<td class="text-right">'.$d_keg_kirim[0].'</td>
		<td '.$rr_kirim.'>'.number_format($d_persen_kirim,2,",",".").' %</td>
		<td class="text-center">'.$kirim_data.'</td>
		<td class="text-right">'.$d_keg_terima[0].'</td>
		<td '.$rr_terima.'>'.number_format($d_persen_terima,2,",",".").' %</td>
		<td class="text-center">'.$terima_data.'</td>
		<td class="text-center">'.$k->keg_t_point.'</td>
	</tr>
	';
	$total_terima=$total_terima+$d_terima;
	$total_kirim=$total_kirim+$d_kirim;
	$total=$total+$k->keg_t_target;
	$i++;
}
$total_persen_kirim=($total_kirim/$total)*100;
$total_persen_terima=($total_terima/$total)*100;
echo '<tr class="success">
		<td colspan="2" class="text-center">TOTAL</td>
		<td class="text-right">'.number_format($total,0,",",".").'</td>
		<td class="text-right">'.number_format($total_kirim,0,",",".").'</td>
		<td class="text-right">'.number_format($total_persen_kirim,2,",",".").'%</td>
		<td></td>
		<td class="text-right">'.number_format($total_terima,0,",",".").'</td>
		<td class="text-right">'.number_format($total_persen_terima,2,",",".").'%</td>
		<td colspan="2"></td>
		</tr>';
echo '</table>
<div>
 ';
 if ($r->keg_spj==1) {
 $sql_kabkota_spj=$conn_view -> query("select * from keg_spj,unitkerja where keg_spj.keg_s_unitkerja=unitkerja.unit_kode and keg_spj.keg_id='$keg_id' and keg_s_target>0");
 $cek_spj=$sql_kabkota_spj->num_rows;

 echo '
 <p>Laporan pengiriman dan penerimaan SPJ</p>
 <div class="table-responsive">
<table class="table table-hover table-bordered table-condensed">
<tr class="info">
	<th rowspan="2" class="text-center">No</th>
	<th rowspan="2" class="text-center">Unit Kerja</th>
	<th rowspan="2" class="text-center">Target</th>
	<th colspan="3" class="text-center">Pengiriman</th>
	<th colspan="3" class="text-center">Penerimaan</th>
	<th rowspan="2" class="text-center">Nilai</th>
	</tr>
	<tr class="info">
	<th class="text-center">Rincian</th>
	<th class="text-center">RR (%)</th>
	<th></th>
	<th class="text-center">Rincian</th>
	<th class="text-center">RR (%)</th>
	<th></th>
	</tr>
	';
if ($cek_spj>0) {
	$i=1;
	$total=0;
	$total_kirim=0;
	$total_terima=0;
while ($k=$sql_kabkota_spj->fetch_object()) {
	$d_keg_kirim=get_detil_spj($k->keg_id,$k->keg_s_unitkerja,1);
	$d_kirim=$d_keg_kirim[1];
	$d_persen_kirim=($d_kirim/$k->keg_s_target)*100;
	if ($d_persen_kirim > 85) $rr_kirim='class="text-right bpsgood"';
	elseif ($d_persen_kirim > 70) $rr_kirim='class="text-right bpsmedium"';
	else $rr_kirim='class="text-right bpsbad"';

	$d_keg_terima=get_detil_spj($k->keg_id,$k->keg_s_unitkerja,2);
	$d_terima=$d_keg_terima[1];
	$d_persen_terima=($d_terima/$k->keg_s_target)*100;
	if ($d_persen_terima > 85) $rr_terima='class="text-right bpsgood"';
	elseif ($d_persen_terima > 70) $rr_terima='class="text-right bpsmedium"';
	else $rr_terima='class="text-right bpsbad"';
	if (($_SESSION['sesi_level'] > 1) and ($tgl_mulai <= $tanggal_hari_ini)) {
		if ($_SESSION['sesi_level'] > 2) {
			if ($_SESSION['sesi_level'] > 3) {
			$kirim_data='<a href="'.$url.'/'.$page.'/kirimspj/'.$k->keg_id.'/'.$k->keg_s_unitkerja.'"><i class="fa fa-plus-square text-primary" aria-hidden="true"></i>';
			$terima_data='<a href="'.$url.'/'.$page.'/terimaspj/'.$k->keg_id.'/'.$k->keg_s_unitkerja.'"><i class="fa fa-plus-square text-success" aria-hidden="true"></i></a>';
			}
			else {
				$kirim_data='';
				$terima_data='<a href="'.$url.'/'.$page.'/terimaspj/'.$k->keg_id.'/'.$k->keg_s_unitkerja.'"><i class="fa fa-plus-square text-success" aria-hidden="true"></i></a>';
			}
		}
		else {
			if ($_SESSION['sesi_unitkerja']==$k->keg_s_unitkerja) {
				$kirim_data='<a href="'.$url.'/'.$page.'/kirimspj/'.$k->keg_id.'/'.$k->keg_s_unitkerja.'"><i class="fa fa-plus-square text-primary" aria-hidden="true"></i></a>';
			}
			else {
				$kirim_data='';
			}
			$terima_data='';
		}
	}
	else {
		$kirim_data='';
		$terima_data='';
	}

	echo '
	<tr>
		<td class="text-center">'.$i.'</td>
		<td>'.$k->unit_nama.'</td>
		<td class="text-right">'.$k->keg_s_target.'</td>
		<td class="text-right">'.$d_keg_kirim[0].'</td>
		<td '.$rr_kirim.'>'.number_format($d_persen_kirim,2,",",".").' %</td>
		<td class="text-center">'.$kirim_data.'</td>
		<td class="text-right">'.$d_keg_terima[0].'</td>
		<td '.$rr_terima.'>'.number_format($d_persen_terima,2,",",".").' %</td>
		<td class="text-center">'.$terima_data.'</td>
		<td class="text-center">'.$k->keg_s_point.'</td>
	</tr>
	';
	$total_terima=$total_terima+$d_terima;
	$total_kirim=$total_kirim+$d_kirim;
	$total=$total+$k->keg_s_target;
	$i++;
}
$total_persen_kirim=($total_kirim/$total)*100;
$total_persen_terima=($total_terima/$total)*100;
echo '<tr class="info">
		<td colspan="2" class="text-center">TOTAL</td>
		<td class="text-right">'.number_format($total,0,",",".").'</td>
		<td class="text-right">'.number_format($total_kirim,0,",",".").'</td>
		<td class="text-right">'.number_format($total_persen_kirim,2,",",".").'%</td>
		<td></td>
		<td class="text-right">'.number_format($total_terima,0,",",".").'</td>
		<td class="text-right">'.number_format($total_persen_terima,2,",",".").'%</td>
		<td colspan="2"></td>
		</tr>';
echo '</table>
<div>
 ';
}
else {
	echo '
	<tr>
		<td class="text-center" colspan="10">Data target SPJ masih kosong</td>
		</tr>
		</table>
<div>';
	}

}
}
else {
	echo 'Data view kegiatan tidak tersedia';
}
?>
