<?php
  $user_no=$lvl4;
	$db = new db();
	$conn = $db -> connect();
  $sql_user=$conn-> query("select * from users where user_no='$user_no'");
  $cek_user=$sql_user -> num_rows;
  if ($cek_user>0) {
    $r=$sql_user ->fetch_object();
    if ($_SESSION['sesi_user_no']==$r->user_no) {
      echo '(ERROR) tidak bisa menghapus user sendiri';
    }
    elseif ($_SESSION['sesi_level'] < $r->user_level) {
      echo '(ERROR) tidak bisa menghapus user level lebih tinggi';
    }
    else {
    $user_del='('.$r->user_id .') '. $r->user_nama;
    $sql_delete=$conn->query("delete from users where user_no='$user_no'");
    if ($sql_delete) echo '<strong>(SUCCESS)</strong> Data user : '.$user_del.' telah dihapus';
    else echo '<strong>(ERROR)</strong> Data user : '.$user_del.' tidak dihapus';
  }
  }
  else {
    echo '<strong>(ERROR)</strong> data username tidak tersedia';
    }
  	$conn -> close();
?>
