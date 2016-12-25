<?php
if ($_POST['submit_update']) {
  $user_nama=$_POST['user_nama'];
  $user_email=$_POST['user_email'];
  $user_no=$_SESSION['sesi_user_no'];
  $waktu_lokal=date("Y-m-d H:i:s");
  $created=$_SESSION['sesi_user_id'];
  $db = new db();
	$conn = $db -> connect();
	$sql_users= $conn -> query("select * from users where user_no='$user_no'");
	$cek=$sql_users -> num_rows;
  if ($cek>0) {
    $r=$sql_users->fetch_object();
    $nama_lama=$r->user_nama;
    $email_lama=$r->user_email;
    $sql_update=$conn->query("update users set user_nama='$user_nama', user_email='$user_email', user_diupdate_oleh='$created', user_diupdate_waktu='$waktu_lokal' where user_no='$user_no'");
    if ($sql_update) {
      echo 'User profil : '.$_SESSION['sesi_user_id'].' berhasil diupdate  <br />
      dari '.$nama_lama.' --> '.$user_nama.' dan '.$email_lama.' --> '.$user_email;
      unset($_SESSION['sesi_nama']);
      $_SESSION['sesi_nama']=$user_nama;
      }
    else  {
      echo '(ERROR) user profil tidak bisa di update';
    }
  }
  else {
     echo '(ERROR) : User ID tidak tersedia';
  }
  $conn->close();
}
