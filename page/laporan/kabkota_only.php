<?php
for ($i=1;$i<=12;$i++) {
	$sql_list_kabkota= $conn -> query("select keg_t_unitkerja, count(*) as keg_jml, sum(keg_target.keg_t_point_waktu) as point_waktu, sum(keg_target.keg_t_point_jumlah) as point_jumlah, sum(keg_target.keg_t_point) as point_total from keg_target,kegiatan where kegiatan.keg_id=keg_target.keg_id and month(kegiatan.keg_end)='$i' and year(kegiatan.keg_end)='$tahun_kegiatan' and keg_t_unitkerja='$unit_kode' order by point_total desc, keg_t_unitkerja asc");
	$cek_jumlah=$sql_list_kabkota->num_rows;
	if ($cek_jumlah>0) {
		$k=$sql_list_kabkota->fetch_object();
		$total_keg=$k->keg_jml;
		$data_keg[]=$k->keg_jml;
		if ($total_keg==0) {
			$data[]=0;
		}
		else {
			$data[]=number_format($k->point_total,4,".",",");
		}
	}
	else {
		$data[]=0;
	}
}
?>
<script type="text/javascript">
$(function () {
    Highcharts.chart('grafikkabkota', {
    	chart: {
        type: 'column'
    },
        title: {
            text: 'Jumlah Kegiatan dan Nilai Perbulan <?php echo get_nama_unit($unit_kode);?>',
            x: -20 //center
        },
        subtitle: {
            text: 'Keadaan : <?php echo tgljam_hari_ini(); ?>',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: ''
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        plotOptions: {
            column: {
                pointPadding: 0.1,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jumlah Kegiatan',
            data: [<?php echo join($data_keg, ',')?>]
        },
        {
            name: 'Nilai Total',
            data: [<?php echo join($data, ',')?>]
        }]
    });
});
		</script>

<div id="grafikkabkota" style="min-width: 200px; height: 300px; margin: 0 auto"></div>

<div class="table-responsive">
<table class="table table-hover table-bordered table-condensed">
	<tr class="success">
		<th>Bulan</th>
		<th>Kegiatan</th>
		<th>Batas Waktu</th>
		<th>Satuan</th>
		<th>Target</th>
		<th>Pengiriman</th>
		<th>Penerimaan</th>
		<th>Nilai</th>
	</tr>
	<?php
	if ($bulan_kegiatan=='') {
		for ($i=1;$i<=12;$i++) {
			$sql_kabkota=$conn->query("select * from keg_target, kegiatan where keg_target.keg_id=kegiatan.keg_id and keg_target.keg_t_unitkerja='$unit_kode' and year(kegiatan.keg_end)='$tahun_kegiatan' and month(kegiatan.keg_end)='$i' order by keg_end asc") or die(mysqli_error($conn));
			$cek_keg=$sql_kabkota->num_rows;
			if ($cek_keg>0) {
				$j=1;
				echo '
				<tr>
					<td rowspan="'.$cek_keg.'">'.$nama_bulan_panjang[$i].'</td>';
				while ($k=$sql_kabkota->fetch_object()) {
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
					<td><a href="'.$url.'/kegiatan/view/'.$k->keg_id.'">'.$j.'. '.$k->keg_nama.'</a></td>
					<td>'.tgl_convert_bln(1,$k->keg_end).'</td>
					<td>'.$k->keg_target_satuan.'</td>
					<td class="text-right">'.$k->keg_t_target.'</td>
					<td '.$rr_kirim.'>'.$total_kirim.' ('.number_format($persen_kirim,2,",",".").' %)</td>
					<td '.$rr_terima.'>'.$total_terima.' ('.number_format($persen_terima,2,",",".").' %)</td>
					<td>'.$k->keg_t_point.'</td>
					</tr>
					<tr>
					';
					$j++;
				}
				echo '<td class="success" colspan="8"></td></tr>
				';
			}
			else {
				echo '
				<tr>
					<td>'.$nama_bulan_panjang[$i].'</td>
					<td colspan="7" class="text-center">Belum ada kegiatan dibulan ini</td>
				</tr>
				';
			}
		}
	}
	else {
		$sql_kabkota=$conn->query("select * from keg_target, kegiatan where keg_target.keg_id=kegiatan.keg_id and keg_target.keg_t_unitkerja='$unit_kode' and year(kegiatan.keg_end)='$tahun_kegiatan' and month(kegiatan.keg_end)='$bulan_kegiatan' order by keg_end asc") or die(mysqli_error($conn));
			$cek_keg=$sql_kabkota->num_rows;
			if ($cek_keg>0) {
				$j=1;
				echo '
				<tr>
					<td rowspan="'.$cek_keg.'">'.$nama_bulan_panjang[$bulan_kegiatan].'</td>';
				while ($k=$sql_kabkota->fetch_object()) {
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
					<td><a href="'.$url.'/kegiatan/view/'.$k->keg_id.'">'.$j.'. '.$k->keg_nama.'</a></td>
					<td>'.tgl_convert_bln(1,$k->keg_end).'</td>
					<td>'.$k->keg_target_satuan.'</td>
					<td class="text-right">'.$k->keg_t_target.'</td>
					<td '.$rr_kirim.'>'.$total_kirim.' ('.number_format($persen_kirim,2,",",".").' %)</td>
					<td '.$rr_terima.'>'.$total_terima.' ('.number_format($persen_terima,2,",",".").' %)</td>
					<td>'.$k->keg_t_point.'</td>
					</tr>
					<tr>
					';
					$j++;
				}
				echo '<td class="success" colspan="8"></td></tr>
				';
			}
			else {
				echo '
				<tr>
					<td>'.$nama_bulan_panjang[$bulan_kegiatan].'</td>
					<td colspan="7" class="text-center">Belum ada kegiatan dibulan ini</td>
				</tr>
				';
			}
	}
	?>
</table>
</div>