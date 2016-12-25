<?php
$user_no=$_SESSION['sesi_user_no'];
$db = new db();
$conn = $db -> connect();
$sql_users = $conn -> query("select * from users where user_no='$user_no'");
$cek=$sql_users-> num_rows;
if ($cek>0) {
$r = $sql_users ->fetch_object();
?>
	<legend>Edit user <strong><?php echo $r->user_nama;?></strong></legend>
	<form id="formEditUser" name="formEditUser" action="<?php echo $url.'/'.$page;?>/update/"  method="post" class="form-horizontal well" role="form">
	<fieldset>
	<div class="form-group">
		<label for="user_nama" class="col-sm-2 control-label">Nama</label>
			<div class="col-lg-4 col-sm-4">
				<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="user_nama" class="form-control" value="<?php echo $r->user_nama;?>" placeholder="Nama" />
			 </div>
			</div>
	</div>
	<div class="form-group">
		<label for="user_email" class="col-sm-2 control-label">Email</label>
			<div class="col-lg-4 col-sm-4">
				<div class="input-group margin-bottom-sm">
			<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="user_email" class="form-control" value="<?php echo $r->user_email;?>" placeholder="E-mail" />
			 </div>
			</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" id="submit_update" name="submit_update" value="update" class="btn btn-primary">UPDATE</button>
		</div>
	</div>
</fieldset>
</form>
<?php }
else {
	echo '<strong>(ERROR) </strong>Data user tidak tersedia';
} ?>
