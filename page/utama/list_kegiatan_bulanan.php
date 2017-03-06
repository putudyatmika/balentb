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
	<div class="table-responsive"> 
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan</th>
                <th>Batas Waktu</th>
             </tr>
        </thead>
        <tbody>';
	while ($r=$sql_list_deadline->fetch_object()) {
		echo ' 
		<tr>
			<td>'.$i.'</td>
			<td><a href="'.$url.'/kegiatan/view/'.$r->keg_id.'">'.$r->keg_nama.'</a></td>
			<td class="text-right">'.tgl_convert_pendek_bulan(1,$r->keg_end).'</td>
		</tr>
		';
		$i++;
	}
	echo '</tbody>
    </table>
</div>';

}
else {
	echo 'Belum ada kegiatan yang mendekati batas waktu';
}
?>
<a href="<?php echo $url; ?>/kegiatan/" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Kegiatan Selengkapnya"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Selengkapnya</a>