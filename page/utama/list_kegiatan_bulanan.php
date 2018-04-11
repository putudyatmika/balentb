<?php
$db = new db();
$conn = $db -> connect();
$bulan_kegiatan=date('n');
$tahun_kegiatan=$TahunDefault;
$sql_list_deadline=$conn-> query("select * from kegiatan where (keg_end BETWEEN date_add(now(), INTERVAL -2 day) and date_add(now(),INTERVAL 7 day)) order by keg_end asc");
$cek_list=$sql_list_deadline->num_rows;
echo '<p class="text-danger text-capitalize">Kegiatan mendekati batas waktu</p>';
if ($cek_list>0) {
	$i=1;
	
	echo '
	
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Batas Waktu</th>
             </tr>
        </thead>
        <tbody>';
	while ($r=$sql_list_deadline->fetch_object()) {
		$r_jenis=progress_kegiatan($r->keg_id);
    if ($r_jenis["error"]==false) {
        if ($r_jenis["jenis_total"]==1) {
            if ($r_jenis["item"][1]["jenis_id"]==1) {
                $jumlah_kirim=$r_jenis["item"][1]["jenis_jumlah"];
                $jumlah_terima=0;
            }
            else {
                $jumlah_kirim=0;
                $jumlah_terima=$r_jenis["item"][1]["jenis_jumlah"];
            }
        }
        else {
            $jumlah_kirim=$r_jenis["item"][1]["jenis_jumlah"];
            $jumlah_terima=$r_jenis["item"][2]["jenis_jumlah"];
        }
        
    }
    else {
        $jumlah_kirim=0;
        $jumlah_terima=0;
    }
    $progress_kirim=($jumlah_kirim/$r->keg_total_target)*100;
    $progress_terima=($jumlah_terima/$r->keg_total_target)*100;
    $progress_kirim=number_format($progress_kirim,2,".",",");
    $progress_terima=number_format($progress_terima,2,".",",");
    
    	if ($progress_kirim==0) {
    		$pro_kirim='<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$progress_kirim.'" aria-valuemin="0" aria-valuemax="100" style="min-width: 3em;">
	    '.$progress_kirim.'%</div>';
    	}
	    elseif ($progress_kirim>90) {
	    	$pro_kirim='<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$progress_kirim.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_kirim.'%;">
	    '.$progress_kirim.'%</div>';
	    }
	    elseif ($progress_kirim>85) { 
	    	$pro_kirim='<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$progress_kirim.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_kirim.'%;">
	    '.$progress_kirim.'%</div>';
	    }
	    elseif ($progress_kirim>75) { 
	    	$pro_kirim='<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="'.$progress_kirim.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_kirim.'%;">
	    '.$progress_kirim.'%</div>';
	    }
	    elseif ($progress_kirim>30) {
	    	$pro_kirim='<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$progress_kirim.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_kirim.'%;">
	    '.$progress_kirim.'%</div>';
	    }
	    else {
	    	$pro_kirim='<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$progress_kirim.'" aria-valuemin="0" aria-valuemax="100" style="min-width: 5em;">
	    '.$progress_kirim.'%</div>';
	    }

	    if ($progress_terima==0) {
    		$pro_terima='<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$progress_terima.'" aria-valuemin="0" aria-valuemax="100" style="min-width: 3em;">
	    '.$progress_terima.'%</div>';
    	}
	    elseif ($progress_terima>90) {
	    	$pro_terima='<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$progress_terima.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_terima.'%;">
	    '.$progress_terima.'%</div>';
	    }
	    elseif ($progress_terima>85) {
	    	$pro_terima='<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$progress_terima.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_terima.'%;">
	    '.$progress_terima.'%</div>';
	    }
	    elseif ($progress_terima>75) { 
	    	$pro_terima='<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="'.$progress_terima.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_terima.'%;">
	    '.$progress_terima.'%</div>';
	    }
	    elseif ($progress_terima>30) {
	    	$pro_terima='<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$progress_terima.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_terima.'%;">
	    '.$progress_terima.'%</div>';
	    }
	    else {
	    	$pro_terima='<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$progress_terima.'" aria-valuemin="0" aria-valuemax="100" style="lin-width: 5em;">
	    '.$progress_terima.'%</div>';
	    }
		echo ' 
		<tr>
			<td rowspan="2">'.$i.'</td>
			<td><a href="'.$url.'/kegiatan/view/'.$r->keg_id.'">'.$r->keg_nama.'</a></td>
			<td class="text-right" width="20%">'.tgl_convert_pendek_bulan(1,$r->keg_end).'</td>
		</tr>
		<tr>
			<td colspan="2">
			
			<div class="col-sm-6">
			<div class="progress" data-toggle="tooltip" data-placement="top" title="Pengiriman">'.$pro_kirim.'</div></div>
		
			<div class="col-sm-6">
			<div class="progress" data-toggle="tooltip" data-placement="top" title="Penerimaan">'.$pro_terima.'</div></div>
</td>
		</tr>
		';
		$i++;
	}
	echo '</tbody>
    </table>
';

}
else {
	echo 'Belum ada kegiatan yang mendekati batas waktu';
}
?>
<p><a href="<?php echo $url; ?>/kegiatan/" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Kegiatan Selengkapnya"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Selengkapnya</a></p>