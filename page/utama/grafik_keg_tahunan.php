<?php
	$db = new db();
	$conn = $db -> connect();
    $i=1;
	for ($i=1;$i<=12;$i++) {
	$sql_list_keg = $conn -> query("select count(*) as jumlah from kegiatan where month(keg_end)='$i' and year(keg_end)='$TahunDefault'");
	$cek_jumlah=$sql_list_keg->num_rows;
	if ($cek_jumlah>0) {
		$k=$sql_list_keg->fetch_object();
		$data[]=$k->jumlah;
	}
	else {
		$data[]=0;
	}
}
	$conn->close();
?>
<script type="text/javascript">
$(function () {
    Highcharts.chart('grafiktahunan', {
    	chart: {
        type: 'column'
    },
        title: {
            text: 'Grafik Jumlah Kegiatan Perbulan Tahun <?php echo $TahunDefault;?>',
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
            data: [<?php echo join($data, ',')?>]
        }]
    });
});
</script>
<div id="grafiktahunan" style="min-width: 200px; height: 300px; margin: 0 auto"></div>
<a href="<?php echo $url; ?>/kegiatan/" class="btn btn-danger btn-xs"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Selengkapnya</a>