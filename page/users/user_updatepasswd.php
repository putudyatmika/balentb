<?php
if ($_POST['submit_passwd']) {
  $user_pass_lama=$_POST['user_pass_lama'];
  $user_pass_baru=$_POST['user_pass_baru'];
  $user_pass_baru2=$_POST['user_pass_baru2'];
  $user_no=$_SESSION['sesi_user_no'];
  $waktu_lokal=date("Y-m-d H:i:s");
  $pass_md5=$_SESSION['sesi_passwd_md5'];
  $pass_ori=$_SESSION['sesi_passwd_ori'];
	$pass_md5_baru=gen_passwd($user_pass_baru);
  $pass_md5_lama=gen_passwd($user_pass_lama);
  $created=$_SESSION['sesi_user_id'];
  $db = new db();
	$conn = $db -> connect();
	$sql_users= $conn -> query("select * from users where user_no='$user_no'");
	$cek=$sql_users -> num_rows;
  if ($cek>0) {
    $r=$sql_users->fetch_object();
    if ($user_pass_lama == $pass_ori) {
       //update password
       if ($r->user_passwd==$pass_md5_lama) {
          $sql_update_passwd=$conn->query("update users set user_passwd='$pass_md5_baru', user_diupdate_waktu='$waktu_lokal', user_diupdate_oleh='$created' where user_no='$user_no'");
          if ($sql_update_passwd) {
            unset($_SESSION['sesi_passwd_md5']);
          	unset($_SESSION['sesi_passwd_ori']);
          	$_SESSION['sesi_passwd_md5']=$pass_md5_baru;
            $_SESSION['sesi_passwd_ori']=$user_pass_baru;
            echo '(BERHASIL) Password sudah diganti';
          }
          else echo '(ERROR) Password tidak bisa diganti';
       }
       else {
         echo 'Password lama masih salah';
       }
    }
    else {
      echo 'Password Lama salah';
    }
  }
  else {
     echo '(ERROR) : User ID tidak tersedia';
  }
}
