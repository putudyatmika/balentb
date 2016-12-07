<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_save']) {
	$user_id = $_POST['user_id'];
	$user_nama = $_POST['user_nama'];
	$user_email = $_POST['user_email'];
	$user_passwd = $_POST['user_passwd'];
	$user_passwd2 = $_POST['user_passwd2'];
	$user_unitkerja = $_POST['user_unitkerja'];
	$user_status = $_POST['user_status'];
	$user_level = $_POST['user_level'];
	$waktu_lokal=date("Y-m-d H:i:s");
	$pass_md5=gen_passwd($user_passwd);

	//$tipe_nama= strtoupper(strtolower($tipe_nama));
	//$tipe_kode= strtoupper(strtolower($tipe_kode));

	$created=$_SESSION['sesi_user_id'];
	$db = new db();
	$conn = $db -> connect();
	$sql_unit= $conn -> query("select * from users where user_id='$user_id'");
	$cek=$sql_unit -> num_rows;
	if ($cek>0) {
			echo 'ERROR : User '.$user_nama.' ('.$user_id.') tidak tersedia';
	}
	else {
		$sql_users_save=$conn -> query("insert into users(user_id,user_nama,user_email,user_passwd,user_unitkerja,user_dibuat_oleh,user_dibuat_waktu,user_diupdate_oleh,user_diupdate_waktu,user_status,user_level) values('$user_id','$user_nama','$user_email','$pass_md5','$user_unitkerja','$created','$waktu_lokal','$created','$waktu_lokal','$user_status','$user_level')");
		if ($sql_users_save) echo 'SUCCESS : data user berhasil diupdate';
		else echo 'ERROR : data tidak bisa diupdate';
	}
	$conn -> close();
}
else {
	echo 'ERORR';
}

?>
</div>
