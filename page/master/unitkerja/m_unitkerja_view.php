<?php
$unit_kode=$lvl4;
$db = new db();
$conn = $db -> connect();
$sql_unitkerja = $conn -> query("select * from unitkerja where unit_kode='$unit_kode'");
$r = $sql_unitkerja ->fetch_object();
$nama_unit=get_nama_unit($r->unit_parent);
$nama_user_buat=get_idnama_users($r->unit_dibuat_oleh);
$nama_user_update=get_idnama_users($r->unit_diupdate_oleh);
$dibuat_tgl=tgl_convert_waktu(1,$r->unit_dibuat_waktu);
$diupdate_tgl=tgl_convert_waktu(1,$r->unit_diupdate_waktu);
?>
<legend>Unit Kerja Detil</legend>
<div class="row">
<div class="col-lg-8 col-xs-12 col-sm-12">
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<tr>
	<td class="text-right"><strong>Unit Kode</strong></td>
	<td><?php echo $r->unit_kode;?></td>
</tr>
<tr>
	<td class="text-right"><strong>Nama Unit</strong></td>
	<td><?php echo $r->unit_nama;?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Parent</strong></td>
	<td><?php echo $nama_unit;?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Dibuat Oleh</strong></td>
	<td><?php echo $nama_user_buat;?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Dibuat tanggal</strong></td>
	<td><?php echo $dibuat_tgl;?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Diupdate Oleh</strong></td>
	<td><?php echo $nama_user_update;?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Diupdate tanggal</strong></td>
	<td><?php echo $diupdate_tgl;?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Jenis</strong></td>
	<td><?php echo $JenisUnit[$r->unit_jenis];?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Eselon Unit</strong></td>
	<td><?php echo $unit_eselon[$r->unit_eselon];?></td>
</tr>
<tr>
<td></td>
<td>
	<?php
	echo '
	<a href="'.$url.'/'.$page.'/'.$act.'/edit/'.$r->unit_kode.'" class="btn btn-success"><i class="fa fa-pencil fa-lg"></i></a>
	<a href="'.$url.'/'.$page.'/'.$act.'/delete/'.$r->unit_kode.'" class="btn btn-danger" data-confirm="Apakah data ('.$r->unit_kode.') '.$r->unit_nama.' ini akan di hapus?"><i class="fa fa-trash fa-lg"></i></a>';
	?>
</td>
</tr>
</table>
</div>
</div>
</div>
