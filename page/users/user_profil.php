<?php
$user_no=$_SESSION['sesi_user_no'];
$db = new db();
$conn = $db -> connect();
$sql_user = $conn -> query("select * from users where user_no='$user_no'");
$r=$sql_user->fetch_object();

?>
<legend class="margin10px">Profil User <strong><?php echo $r->user_nama;?></strong></legend>
<div class="row">
<div class="col-lg-8 col-sm-10 col-xs-12">
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<tr>
	<td>ID</td>
	<td>: <?php echo $r->user_id; ?></td>
</tr>
<tr>
	<td>Nama</td>
	<td>: <?php echo $r->user_nama; ?></td>
</tr>
<tr>
	<td>Email</td>
	<td>: <?php echo $r->user_email; ?></td>
</tr>
<tr>
	<td>Level</td>
	<td>: <?php echo $lvl_user[$r->user_level]; ?></td>
</tr>
<tr>
	<td>Unit Kerja</td>
	<td>: <?php echo get_nama_unit($r->user_unitkerja); ?></td>
</tr>
<tr>
	<td>Register Tanggal</td>
	<td>: <?php echo tgl_convert_waktu(1,$r->user_dibuat_waktu); ?></td>
</tr>
<tr>
	<td>Terakhir Update</td>
	<td>: <?php echo tgl_convert_waktu(1,$r->user_diupdate_waktu); ?></td>
</tr>
<tr>
	<td>Terakhir Login</td>
	<td>: <?php echo tgl_convert_waktu(1,$r->user_lastlogin); ?></td>
</tr>
<tr>
	<td>Dari IP</td>
	<td>: <?php echo $r->user_lastip; ?></td>
</tr>
<?php
echo '
<tr>
	<td>&nbsp;</td>
	<td><a href="'.$url.'/'.$page.'/edit/"><i class="fa fa-2x fa-pencil-square text-info" aria-hidden="true"></i></a></td>
</tr>';
?>
</table>
</div>
</div>
</div>
