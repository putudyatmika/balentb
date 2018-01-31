<?php
if (isset($_POST['sdate'])) { $sdate=$_POST['sdate']; }
else { $sdate=date("Y-m-d"); }
?>
<legend>Daftar Absen</legend>
<form class="form-inline" method="post">
  <div class="form-group" id="tgl_mulai_keg">
    <label for="sdate">Tanggal</label>
    <input type="text" class="form-control input-sm" name="sdate" id="sdate" value="<?php echo $sdate;?>" placeholder="Tgl Awal">
  </div>
  <button type="submit" class="btn btn-default btn-sm">View Data</button>
</form>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<thead>
 	<tr>
 		<th>#</th>
 		<th>ID</th>
 		<th>Nama</th>
 		<th>Tgl</th>
 		<th>Jam</th>
 		<th>Kode</th>
 		<th>Sync</th>
 		<th>Rekap</th>
 		<th>Flag</th>
 		<th>Ket</th>
 		<th colspan="3">&nbsp;</th>
 	</tr>
 </thead>
 <tbody>
 	<?php
 	//$sdate=date('Y-m-d');
 	$r_absen=log_peg_absen($sdate);
 	if ($r_absen["error"]==false) {
			$i=1;
			$absen_total=$r_absen["absen_total"];
			for ($i=1;$i<=$absen_total;$i++) {
				
				echo '
				<tr>
					<td>'.$i.'</td>
					<td>'.$r_absen["item"][$i]["absen_peg_id"].'</td>
					<td>'.$r_absen["item"][$i]["absen_peg_nama"].'</td>
					<td>'.$r_absen["item"][$i]["absen_tgl"].'</td>
					<td>'.$r_absen["item"][$i]["absen_jam"].'</td>
					<td>'.$r_absen["item"][$i]["absen_kode"].'</td>
					<td>'.$r_absen["item"][$i]["absen_sync_tgl"].'</td>
					<td>'.$r_absen["item"][$i]["absen_rekap"].'</td>
					<td>'.$r_absen["item"][$i]["absen_flag"].'</td>
					<td>'.$r_absen["item"][$i]["absen_ket"].'</td>
					<td><a href="'.$url.'/'.$page.'/'.$act.'/view/'.$r_absen["item"][$i]["absen_id"].'"><i class="fa fa-search text-success" aria-hidden="true"></i></a></td>
					<td><a href="'.$url.'/'.$page.'/'.$act.'/edit/'.$r_absen["item"][$i]["absen_id"].'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a></td>
					<td><a href="'.$url.'/'.$page.'/'.$act.'/delete/'.$r_absen["item"][$i]["absen_id"].'" data-confirm="Apakah data ('.$r_absen["item"][$i]["absen_peg_id"].') '.$r_absen["item"][$i]["absen_peg_nama"].' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>
				</tr>
				';
			}
		}
	else {
		echo '<tr>
		<td colspan="13">Data masing kosong</td>
		</tr>';
	}
 	?>
 </tbody>
</table>