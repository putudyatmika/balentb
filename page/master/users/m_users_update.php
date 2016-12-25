<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_update']) {

	$user_no =$_POST['user_no'];
	$user_id = $_POST['user_id'];
	$user_nama = $_POST['user_nama'];
	$user_email = $_POST['user_email'];
	$user_passwd = $_POST['user_passwd'];
	$user_passwd2 = $_POST['user_passwd2'];
	$user_unitkerja = $_POST['user_unitkerja'];
	$user_level = $_POST['user_level'];
	$user_status = $_POST['user_status'];
	$waktu_lokal=date("Y-m-d H:i:s");
	$pass_md5=gen_passwd($user_passwd);
	//$tipe_nama= strtoupper(strtolower($tipe_nama));
	//$tipe_kode= strtoupper(strtolower($tipe_kode));

	if ($user_passwd=='' or $user_passwd2==''){
		$ganti_passwd=1;
	}
	elseif ($user_passwd != $user_passwd2) {
		$ganti_passwd=1;
	}
	else {
		$ganti_passwd=2;
	}
	$my_userlevel=$_SESSION['sesi_level'];
	$created=$_SESSION['sesi_user_id'];
	$db = new db();
	$conn = $db -> connect();
	$sql_user_update= $conn -> query("select * from users where user_no='$user_no'");
	$cek=$sql_user_update -> num_rows;
	if ($cek>0) {
		$r=$sql_user_update->fetch_object();
		if ($r->user_level <= $my_userlevel) {
		 if ($ganti_passwd==1) {
			$sql_users_save = $conn -> query("update users set user_id='$user_id',user_nama='$user_nama',user_email='$user_email', user_diupdate_oleh='$created',user_unitkerja='$user_unitkerja',user_status='$user_status',user_diupdate_waktu='$waktu_lokal',user_level='$user_level' where user_no='$user_no'");
		 }
		 else {
			 $sql_users_save = $conn -> query("update users set user_id='$user_id',user_nama='$user_nama',user_email='$user_email',user_diupdate_oleh='$created',user_unitkerja='$user_unitkerja',user_status='$user_status',user_diupdate_waktu='$waktu_lokal',user_level='$user_level',user_passwd='$pass_md5' where user_no='$user_no'");
		 }
		 if ($sql_users_save) echo 'SUCCESS : data user berhasil diupdate';
		 else echo 'ERROR : data tidak bisa diupdate';
	 }
	 else {
		 echo '(ERROR) User ID : '.$_SESSION['sesi_user_id'].' level '.$lvl_user[$my_userlevel].' tidak bisa mengedit '.$user_id.' level '.$lvl_user[$r->user_level];
	 }
	}
	else {

		 echo 'ERROR : User '.$user_id.' ('.$user_nama.') tidak tersedia';
	}
	$conn -> close();
}
else {
	echo 'ERORR';
}

?>
</div>
