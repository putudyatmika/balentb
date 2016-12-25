<?php
$db = new db();
$conn = $db -> connect();
$sql_users = $conn -> query("select * from users where user_level='3' order by user_no,user_id asc");
$cek= $sql_users -> num_rows;
if ($cek > 0) {
?>
<legend>Daftar <?php echo $cek;?> user Level Operator Provinsi</legend>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
	<tr class="active">
	<th>ID</th>
	<th>Nama</th>
	<th>Level</th>
	<th>Unit kerja</th>
	<th>Status</th>
	<th colspan="3">&nbsp;</th>
	</tr>
	<?php
	 while ($r=$sql_users->fetch_object()) {
		 	$nama_unit=get_nama_unit($r->user_unitkerja);
			$lastlog=tgl_convert_waktu(1,$r->user_lastlogin);
		 echo '
		 <tr>
			<td>'.$r->user_id.'</td>
			<td>'.$r->user_nama.'</td>
			<td>'.$lvl_user[$r->user_level].'</td>
			<td>'.$nama_unit.'</td>
			<td>'.$status_umum[$r->user_status].'</td>
			<td><a href="'.$url.'/'.$page.'/'.$act.'/view/'.$r->user_no.'"><i class="fa fa-search text-success" aria-hidden="true"></i></a></td>
			<td><a href="'.$url.'/'.$page.'/'.$act.'/edit/'.$r->user_no.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a></td>
			<td><a href="'.$url.'/'.$page.'/'.$act.'/delete/'.$r->user_no.'" data-confirm="Apakah data ('.$r->user_id.') '.$r->user_nama.' ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a></td>
		 </tr>
		 ';
	 }
	?>
</table>
<?php }
else {
	echo 'Data users masih kosong';
} ?>
</div>
