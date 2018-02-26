<?php
if (isset($_POST['sdate'])) { $sdate=$_POST['sdate']; }
else { $sdate=date("Y-m-d"); }

if (isset($_POST['edate'])) { $edate=$_POST['edate']; }
else { $edate=''; }
if (isset($_POST['submit'])) { $ngapain=$_POST['submit']; }
else { $ngapain='';}
?>
<legend>Daftar Absen</legend>
<form class="form-inline" method="post">
  <div class="form-group" id="tgl_mulai_keg">
    <label for="sdate">Tanggal</label>
    <input type="text" class="form-control input-sm" name="sdate" id="sdate" value="<?php echo $sdate;?>" placeholder="Tgl Awal">
  </div>
  <div class="form-group" id="tgl_mulai_keg">
    <label for="edate">s/d</label>
    <input type="text" class="form-control input-sm" name="edate" id="edate" value="<?php echo $edate;?>" placeholder="Tgl Akhir">
  </div>
  <button type="submit" name="submit" value="view" class="btn btn-primary btn-sm">View Data</button>
  <button type="submit" name="submit" value="update" class="btn btn-danger btn-sm">Update Data</button>
</form>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">

 	<?php
	if ($ngapain=="update") {
		//update data
		echo '
	 		<thead>
		 	<tr>
		 		<th>#</th>
		 		<th>ID</th>
		 		<th>Nick</th>
		 		<th>Nama</th>
		 		<th>Tgl</th>
		 		<th>Jam</th>
		 		<th>Flag</th>
		 		<th>Status Update</th>
		 		<th colspan="2">&nbsp;</th>
		 	</tr>
		 </thead>
		 <tbody>
	 	';
	 	$r_absen=update_log_absen_tlpsw($sdate,$edate);
		if ($r_absen["error"]==false) {
			$i=1;
				$absen_total=$r_absen["absen_total"];
				for ($i=1;$i<=$absen_total;$i++) {
					$absen_id='';
					$absen_tgl='';
					$absen_jan='';
					$absen_kode='';
					if ($r_absen["item"][$i]["peg_jabatan"]<=2) {
						$absen_id=$r_absen["item"][$i]["absen_id"];
						$absen_tgl=$r_absen["item"][$i]["absen_tgl"];
						$absen_jam=$r_absen["item"][$i]["absen_jam"];
						$absen_kode=$r_absen["item"][$i]["absen_kode"];
						$update_log=update_absen_tl_tw($absen_id,$absen_tgl,$absen_jam,$absen_kode);
						if ($update_log==true) {
							$update_tlpsw='<span class="label label-success">Sudah terupdate</span>';
						}
						else {
							$update_tlpsw='<span class="label label-danger">Error</span>';
						}
					}
					else {
						$update_tlpsw='<span class="label label-warning">Tidak terupdate</span>';
					}
					echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$r_absen["item"][$i]["absen_peg_id"].'</td>
						<td>'.$r_absen["item"][$i]["absen_peg_nama"].'</td>
						<td>'.$r_absen["item"][$i]["peg_nama"].'</td>
						<td>'.$r_absen["item"][$i]["absen_tgl"].'</td>
						<td>'.$r_absen["item"][$i]["absen_jam"].'</td>
						<td>'.$r_absen["item"][$i]["absen_flag"].'</td>
						<td>'.$update_tlpsw.'</td>
						<td><a href="'.$url.'/'.$page.'/'.$act.'/log/edit/'.$r_absen["item"][$i]["absen_id"].'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a></td>
						<td><a href="'.$url.'/'.$page.'/'.$act.'/log/delete/'.$r_absen["item"][$i]["absen_id"].'" data-confirm="Apakah data ('.$r_absen["item"][$i]["absen_peg_id"].') '.$r_absen["item"][$i]["absen_peg_nama"].' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>
					</tr>
					';
				}

		}
		else {
			echo '<tr>
			<td colspan="10">Data masih kosong</td>
			</tr>';
		}
	}
	else {
		//view data
	 	//$sdate=date('Y-m-d');
	 	echo '
	 		<thead>
		 	<tr>
		 		<th>#</th>
		 		<th>ID</th>
		 		<th>Nick</th>
		 		<th>Nama</th>
		 		<th>Tgl</th>
		 		<th>Jam</th>
		 		<th>TL</th>
		 		<th>PSW</th>
		 		<th>Kode</th>
		 		<th>Sync</th>
		 		<th>Rekap</th>
		 		<th>Flag</th>
		 		<th>Ket</th>
		 		<th colspan="2">&nbsp;</th>
		 	</tr>
		 </thead>
		 <tbody>
	 	';
	 	$r_absen=log_peg_absen(0,$sdate,false);
	 	if ($r_absen["error"]==false) {
				$i=1;
				$absen_total=$r_absen["absen_total"];
				for ($i=1;$i<=$absen_total;$i++) {
					
					echo '
					<tr>
						<td>'.$i.'</td>
						<td>'.$r_absen["item"][$i]["absen_peg_id"].'</td>
						<td>'.$r_absen["item"][$i]["absen_peg_nama"].'</td>
						<td>'.$r_absen["item"][$i]["peg_nama"].'</td>
						<td>'.$r_absen["item"][$i]["absen_tgl"].'</td>
						<td>'.$r_absen["item"][$i]["absen_jam"].'</td>
						<td>'.$r_absen["item"][$i]["absen_tl"].'</td>
						<td>'.$r_absen["item"][$i]["absen_psw"].'</td>
						<td>'.$r_absen["item"][$i]["absen_kode"].'</td>
						<td>'.$r_absen["item"][$i]["absen_sync_tgl"].'</td>
						<td>'.$r_absen["item"][$i]["absen_rekap"].'</td>
						<td>'.$r_absen["item"][$i]["absen_flag"].'</td>
						<td>'.$r_absen["item"][$i]["absen_ket"].'</td>
						<td><a href="'.$url.'/'.$page.'/'.$act.'/log/edit/'.$r_absen["item"][$i]["absen_id"].'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a></td>
						<td><a href="'.$url.'/'.$page.'/'.$act.'/log/delete/'.$r_absen["item"][$i]["absen_id"].'" data-confirm="Apakah data ('.$r_absen["item"][$i]["absen_peg_id"].') '.$r_absen["item"][$i]["absen_peg_nama"].' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>
					</tr>
					';
				}
			}
		else {
			echo '<tr>
			<td colspan="13">Data masih kosong</td>
			</tr>';
		}
	}
 	?>
 </tbody>
</table>
</div>