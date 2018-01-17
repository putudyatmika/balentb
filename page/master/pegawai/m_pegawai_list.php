<legend>Daftar pegawai</legend>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
	<?php 
	$r_peg=list_pegawai(0,false);

	if ($r_peg["error"]==false) {
	?>
		<tr class="info">
		<th>No</th>
		<th>Absen ID</th>
		<th>Nama</th>
		<th>Jenis Kelamin</th>
		<th>User No</th>
		<th>Unit Kerja</th>
		<th>Jabatan</th>
		<th>Status</th>
		<th colspan="3">&nbsp;</th>
		</tr>
	<?php
		$i=1;
		$max_peg=$r_peg["peg_total"];
		for ($i=1;$i<=$max_peg;$i++) {
			//link user id login monitoring
			if ($r_peg["item"][$i]["user_no"]==0) {
				$user_no='';
			}
			else {
				$user_no='('.$r_peg["item"][$i]["user_no"].') '.$r_peg["item"][$i]["user_id"];
			}
			//unitkerja pegawai
			if ($r_peg["item"][$i]["peg_unitkerja"]==0) {
				$peg_unitkerja='';
			}
			else {
				$peg_unitkerja=get_nama_unit($r_peg["item"][$i]["peg_unitkerja"]);
			}
			//jenis jabatan
			if ($r_peg["item"][$i]["peg_jabatan"]==0) {
				$peg_jabatan='';
			}
			else {
				$peg_jabatan=$JenisJabatan[$r_peg["item"][$i]["peg_jabatan"]];
			}
			echo '
			<tr>
			<td>'.$i.'</td>
			<td>'.$r_peg["item"][$i]["peg_id"].'</td>
			<td>'.$r_peg["item"][$i]["peg_nama"].'</td>
			<td>'.$JenisKelamin[$r_peg["item"][$i]["peg_jk"]].'</td>
			<td>'.$user_no.'</td>
			<td>'.$peg_unitkerja.'</td>
			<td>'.$peg_jabatan.'</td>
			<td>'.$status_umum[$r_peg["item"][$i]["peg_status"]].'</td>
			<td><a href="'.$url.'/'.$page.'/'.$act.'/view/'.$r_peg["item"][$i]["peg_no"].'"><i class="fa fa-search text-success" aria-hidden="true"></i></a></td>
			<td><a href="'.$url.'/'.$page.'/'.$act.'/edit/'.$r_peg["item"][$i]["peg_no"].'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a></td>
			<td><a href="'.$url.'/'.$page.'/'.$act.'/delete/'.$r_peg["item"][$i]["peg_no"].'" data-confirm="Apakah data ('.$r_peg["item"][$i]["peg_id"].') '.$r_peg["item"][$i]["peg_nama"].' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>

			</tr>';

		}
	}
	else {
		echo '<tr>
		<td>Data masing kosong</td>
		</tr>';
	}
	?>
</table>
</div>

