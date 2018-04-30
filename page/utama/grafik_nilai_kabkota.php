<?php
	$db = new db();
	$conn = $db -> connect();
	$bulan_kegiatan=date('n');
	$tahun_kegiatan=$TahunDefault;
	$sql_list_kabkota= $conn -> query("select keg_t_unitkerja, count(*) as keg_jml, sum(keg_target.keg_t_target) as keg_jml_target, sum(keg_target.keg_t_point_waktu) as point_waktu, sum(keg_target.keg_t_point_jumlah) as point_jumlah, sum(keg_target.keg_t_point) as point_total, avg(keg_target.keg_t_point) as point_rata from keg_target,kegiatan where kegiatan.keg_id=keg_target.keg_id and month(kegiatan.keg_end)='$bulan_kegiatan' and year(kegiatan.keg_end)='$tahun_kegiatan' and keg_target.keg_t_target>0 group by keg_t_unitkerja order by point_rata desc, point_total desc");
		$cek_kabkota=$sql_list_kabkota->num_rows;
		
			$j=1; //untuk buat kolom grafik
			$nilai_grafik_vol=get_ranking_kegiatan($bulan_kegiatan,$tahun_kegiatan,1);
			$nilai_grafik_waktu=get_ranking_kegiatan($bulan_kegiatan,$tahun_kegiatan,2);
			$nilai_grafik_total=get_ranking_kegiatan($bulan_kegiatan,$tahun_kegiatan,3);
            $nilai_grafik_rata=get_ranking_kegiatan($bulan_kegiatan,$tahun_kegiatan,4);
			$kabkota_grafik=get_ranking_kabkota($bulan_kegiatan,$tahun_kegiatan); ?>
			<script type="text/javascript">
$(function () {
    Highcharts.chart('grafiknilaikabkota', {
       chart: {
        type: 'bar'
    },
        title: {
            text: 'Nilai Bulan <?php echo $nama_bulan_panjang[$bulan_kegiatan] .' '.$tahun_kegiatan;?> (Max 5)',
            x: -20 //center
        },
        subtitle: {
            text: 'Keadaan : <?php echo tgljam_hari_ini(); ?>',
            x: -20
        },
        xAxis: {
            categories: [<?php echo '\''.ltrim(implode("','",$kabkota_grafik),"',").'\'';?>],
             title: {
            text: null
        	}
        },
        yAxis: {
        min: 0,
        title: {
            text: '',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ''
    },
     plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
        legend: {
             enabled: false
        },
        series: [{
            name: 'Point',
            data: [<?php echo ltrim(implode (",",$nilai_grafik_rata),',');?>]
        }]
    });
}); 
		</script>
<div id="grafiknilaikabkota" style="min-width: 200px; height: 350px; margin: 0 auto"></div>
<a href="<?php echo $url; ?>/laporan/kabkota/" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Laporan Nilai BPS Kabupaten/Kota Selengkapnya"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Selengkapnya</a>