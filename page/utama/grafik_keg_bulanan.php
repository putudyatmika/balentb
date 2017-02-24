<?php
	$db = new db();
	$conn = $db -> connect();
	$sql_es3_prov= $conn-> query("select unit_kode, unit_nama from unitkerja where unit_jenis=1 and unit_eselon=3 order by unit_kode asc") or die(mysqli_error($conn));
	while ($r=$sql_es3_prov->fetch_object()) {
		$data_bidang[]=$r->unit_nama;
		$kode_bidang=$r->unit_kode;
		$sql_keg_bid= $conn->query("select kegiatan.keg_unitkerja, unitkerja.unit_nama, unitkerja.unit_parent, COUNT(*) as jumlah from kegiatan inner join unitkerja on kegiatan.keg_unitkerja=unitkerja.unit_kode and unitkerja.unit_parent='".$kode_bidang."' and month(kegiatan.keg_end)='".date('n')."' group by unitkerja.unit_parent") or die(mysqli_error($conn));
		$cek_bidang=$sql_keg_bid->num_rows;
		if ($cek_bidang>0) {
			$b=$sql_keg_bid->fetch_object();
			$data_bulanan[]=$b->jumlah;
		}	
		else {
			$data_bulanan[]=0;
		}
	}
	$conn->close();
?>
<script type="text/javascript">
$(function () {
    Highcharts.chart('grafikbulanan', {
    	chart: {
        type: 'column'
    },
        title: {
            text: 'Grafik Jumlah Kegiatan Menurut Bidang',
            x: -20 //center
        },
        subtitle: {
            text: 'Bulan : <?php echo $nama_bulan_panjang[date('n')] .' '.$TahunDefault; ?>',
            x: -20
        },
        xAxis: {
            categories: [<?php echo '\''.ltrim(implode("','",$data_bidang),"',").'\'';?>]
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
        legend: {
             enabled: false
        },
        plotOptions: {
            column: {
                pointPadding: 0.1,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Jumlah Kegiatan',
            data: [<?php echo join($data_bulanan, ',')?>]
        }]
    });
});
</script>
<div id="grafikbulanan" style="min-width: 200px; height: 300px; margin: 0 auto"></div>
<a href="<?php echo $url; ?>/kegiatan/bidang/" class="btn btn-success btn-xs"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Selengkapnya</a>