<?php
function get_idnama_users($user_id) {
	//(user_id) user_nama
	$db_users = new db();
	$conn_users = $db_users->connect();
	$sql_users = $conn_users -> query("select * from users where user_id='".$user_id."'");
	$cek=$sql_users->num_rows;
	if ($cek>0) {
	   $nama_user='';
	   $r=$sql_users->fetch_object();
	   $nama_user='('.$r->user_id.') '. $r->user_nama;
	}
	else {
	 $nama_user='';
	}
	return $nama_user;
	$conn_users->close();
	}

function get_email_users($user_id) {
	//(user_id) user_nama
	$db_users = new db();
	$conn_users = $db_users->connect();
	$sql_users = $conn_users -> query("select * from users where user_id='".$user_id."'");
	$cek=$sql_users->num_rows;
	if ($cek>0) {
	   $email_user='';
	   $r=$sql_users->fetch_object();
	   $email_user=$r->user_email;
	}
	else {
	 $email_user='';
	}
	return $email_user;
	$conn_users->close();
	}

function gen_passwd($passwd_ori) {
	global $pengacak;
	$passwd_md5=md5($pengacak.'('.$passwd_ori.')'.$pengacak);
  return $passwd_md5;
}
function cek_user_akses ($user_id,$user_level,$user_unitkerja,$target_unitkerja) {
//function untuk edit,akses dan hapus
	if ($user_level > 1) {
		if ($user_level > 2) {

		}
		else {
			
		}
	}
	else {
		$hak_akses=array(1,'user : '.$user_id.' tidak mempunyai akses');
	}
}
?>
