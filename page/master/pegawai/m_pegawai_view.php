<?php
$peg_no=$lvl4;
$r_peg=list_pegawai($peg_no,true);
if ($r_peg["error"]==false) { 
	if ($r_peg["item"][1]["peg_unitkerja"]==0) {
				$peg_unitkerja='';
	}
	else {
		$peg_unitkerja='['.$r_peg["item"][1]["peg_unitkerja"].'] '.get_nama_unit($r_peg["item"][1]["peg_unitkerja"]);
	}

	$nama_user_buat=get_idnama_users($r_peg["item"][1]["peg_dibuat_oleh"]);
	$nama_user_update=get_idnama_users($r_peg["item"][1]["peg_diupdate_oleh"]);
	$dibuat_tgl=tgl_convert_waktu(1,$r_peg["item"][1]["peg_dibuat_waktu"]);
	$diupdate_tgl=tgl_convert_waktu(1,$r_peg["item"][1]["peg_diupdate_waktu"]);
	?>
<legend><strong><?php echo $r_peg["item"][1]["peg_nama"];?></strong></legend>
	<div class="alert alert-info" role="alert">
			<dl class="dl-horizontal">
				<dt>ID</dt>
				<dd><?php echo $r_peg["item"][1]["peg_id"];?></dd>
				<dt>Nama Lengkap</dt>
				<dd><?php echo $r_peg["item"][1]["peg_nama"];?></dd>
				<dt>Jenis Kelamin</dt>
				<dd><?php echo $JenisKelamin[$r_peg["item"][1]["peg_jk"]];?></dd>
				<dt>Unit Kerja</dt>
				<dd><?php echo $peg_unitkerja;?></dd>
				<dt>Status</dt>
				<dd><?php echo $status_umum[$r_peg["item"][1]["peg_status"]];?></dd>
				<dt>Dibuat Oleh</dt>
				<dd><?php echo $nama_user_buat;?></dd>
				<dt>Dibuat tanggal</dt>
				<dd><?php echo $dibuat_tgl;?></dd>
				<dt>Diupdate Oleh</dt>
				<dd><?php echo $nama_user_update;?></dd>
				<dt>Diupdate tanggal</dt>
				<dd><?php echo $diupdate_tgl;?></dd>
			</dl>
			<div class="row">
			<div class="container">
			<?php
			echo '
			<a href="'.$url.'/'.$page.'/'.$act.'/edit/'.$peg_no.'" class="btn btn-success"><i class="fa fa-pencil fa-lg"></i></a>
			<a href="'.$url.'/'.$page.'/'.$act.'/delete/'.$peg_no.'" class="btn btn-danger" data-confirm="Apakah data ('.$r_peg["item"][1]["peg_id"].') '.$r_peg["item"][1]["peg_nama"].' ini akan di hapus?"><i class="fa fa-trash fa-lg"></i></a>';
			?>
			</div>
			</div>
	</div>

<?php
}
else {
	echo 'Data pegawai tidak ditemukan';
}
?>
