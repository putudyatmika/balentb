<?php
$user_no=$lvl4;
$db = new db();
$conn = $db -> connect();
$sql_user = $conn -> query("select * from users where user_no='$user_no'");
$r = $sql_user ->fetch_object();
$lastlog=tgl_convert_waktu(1,$r->user_lastlogin);
$nama_unit=get_nama_unit($r->user_unitkerja);
$nama_user_buat=get_idnama_users($r->user_dibuat_oleh);
$nama_user_update=get_idnama_users($r->user_diupdate_oleh);
$dibuat_tgl=tgl_convert_waktu(1,$r->user_dibuat_waktu);
$diupdate_tgl=tgl_convert_waktu(1,$r->user_diupdate_waktu);
?>
<legend>Detil User <strong><?php echo $r->user_nama;?></strong></legend>
<div class="row">
<div class="col-lg-8 col-xs-12 col-sm-12">
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<tr>
	<td class="text-right"><strong>ID</strong></td>
	<td><?php echo $r->user_id; ?></td>
</tr>
<tr>
<td class="text-right"><strong>Password</strong></td>
<td><?php echo $r->user_passwd;?></td></tr>
<tr>
</tr>
<tr>
	<td class="text-right"><strong>Nama</strong></td>
	<td><?php echo $r->user_nama;?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Email</strong></td>
	<td><?php echo $r->user_email;?></td>
</tr>
<tr>
	<td class="text-right"><strong>Level</strong></td>
	<td><?php echo $lvl_user[$r->user_level];?></td>
</tr>
<tr>	
	<td class="text-right"><strong>Unit Kerja</strong></td>
	<td><?php echo $nama_unit;?></td>
</tr>
<tr>
	<td class="text-right"><strong>Lastlogin</strong></td>
	<td><?php echo $lastlog;?></td>
</tr>
<tr>
	<td class="text-right"><strong>IP</strong></td>
	<td><?php echo $r->user_lastip;?></td>
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
<td></td>
<td>
		<?php
		echo '
		<a href="'.$url.'/'.$page.'/'.$act.'/edit/'.$r->user_no.'" class="btn btn-success"><i class="fa fa-pencil fa-lg"></i></a>
		<a href="'.$url.'/'.$page.'/'.$act.'/delete/'.$r->user_no.'" class="btn btn-danger" data-confirm="Apakah data ('.$r->user_id.') '.$r->user_nama.' ini akan di hapus?"><i class="fa fa-trash fa-lg"></i></a>';
		?>		
		</td>
</table>
</div>
</div>
</div>
