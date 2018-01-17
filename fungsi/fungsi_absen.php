<?php
//fungsi untuk modul absen
function list_pegawai($peg_no,$detil=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==true) {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where peg_no='$peg_no'");
	}
	else {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no order by m_pegawai.peg_no asc");
	}
	$cek_pegawai = $sql_pegawai->num_rows;
	$list_pegawai=array("error"=>false);
	if ($cek_pegawai>0) {
		$list_pegawai["error"]=false;
		$list_pegawai["peg_total"]=$cek_pegawai;
		$i=1;
		while ($r=$sql_pegawai->fetch_object()) {
			$list_pegawai["item"][$i]=array(
				"peg_no"=>$r->peg_no,
				"peg_id"=>$r->peg_id,
				"peg_nama"=>$r->peg_nama,
				"peg_jk"=>$r->peg_jk,
				"peg_status"=>$r->peg_status,
				"user_no"=>$r->peg_user_no,
				"peg_unitkerja"=>$r->peg_unitkerja,
				"peg_jabatan"=>$r->peg_jabatan,
				"user_id"=>$r->user_id,
				"peg_dibuat_waktu"=>$r->peg_dibuat_waktu,
				"peg_dibuat_oleh"=>$r->peg_dibuat_oleh,
				"peg_diupdate_waktu"=>$r->peg_diupdate_waktu,
				"peg_diupdate_oleh"=>$r->peg_diupdate_oleh
			);
			$i++;
		}
	}
	else {
		$list_pegawai["error"]=true;
		$list_pegawai["pesan_error"]="data kosong";
	}
	return $list_pegawai;
	$conn_pegawai->close();
}
function peg_absen($peg_id,$tgl_absen,$kode_absen) {
	// kode 0:masuk, 1:pulang, 2:keluar, 3:kembali, 4:masuk lembur, 5:plg lembur
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='$kode_absen' order by absen_jam asc limit 0,1");
	$cek_absen = $sql_absen->num_rows;
	if ($cek_absen>0) {
		$r=$sql_absen->fetch_object();
		$waktu_absen=$r->absen_jam;
		$w_absen=strtotime($waktu_absen);
		if ($kode_absen==0) {
			$pagi = strtotime('07:30:59');
			if ($w_absen>$pagi) {
				//telat merah
				$waktu_absen='<font color="red">'.$waktu_absen.'</font>';
			}
			else {
				//bner hijau
				$waktu_absen='<font color="green">'.$waktu_absen.'</font>';
			}
		 
		}
		elseif ($kode_absen==1) {
			$sore = strtotime('16:00:00');
			if ($w_absen<$sore) {
				//duluan pulang
				$waktu_absen='<font color="red">'.$waktu_absen.'</font>';
			}
			else {
				//normal
				$waktu_absen='<font color="green">'.$waktu_absen.'</font>';
			}
			
		}
		else {
			$istirahat = strtotime('12:30:00');
			$siang = strtotime('14:00:00');
			$waktu_absen='<font color="green">'.$waktu_absen.'</font>';
		}
	}
	else {
		$waktu_absen='-';
	}
	return $waktu_absen;
	$conn_absen->close();
}
function sync_absen($peg_id,$peg_nama,$tgl_absen,$jam_absen,$kode) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("insert into peg_absen(absen_peg_id,absen_peg_nama,absen_tgl,absen_jam,absen_kode,absen_sync_tgl,absen_status)
	values('$peg_id','$peg_nama','$tgl_absen','$jam_absen','$kode','$waktu_lokal',0)") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function cek_absen_sync($peg_id,$tgl_absen,$jam_absen,$kode) {
	$db_cek = new db();
	$conn_cek = $db_cek -> connect();
	$sql_cek = $conn_cek -> query("select * from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_jam='$jam_absen'");
	$cek_hsl = $sql_cek->num_rows;
	if ($cek_hsl>0) {
		$cekValue=TRUE;
	}
	else {
		$cekValue=FALSE;
	}
	return $cekValue;
	$conn_cek->close();
}
function cek_pegawai_absen($peg_id) {
	$db_cek = new db();
	$conn_cek = $db_cek -> connect();
	$sql_cek = $conn_cek -> query("select * from m_pegawai where peg_id='$peg_id'");
	$cek_hsl = $sql_cek->num_rows;
	if ($cek_hsl>0) {
		$cekValue=TRUE;
	}
	else {
		$cekValue=FALSE;
	}
	return $cekValue;
	$conn_cek->close();
}
function cek_pegawai_no($peg_no) {
	$db_cek = new db();
	$conn_cek = $db_cek -> connect();
	$sql_cek = $conn_cek -> query("select * from m_pegawai where peg_no='$peg_no'");
	$cek_hsl = $sql_cek->num_rows;
	if ($cek_hsl>0) {
		$cekValue=TRUE;
	}
	else {
		$cekValue=FALSE;
	}
	return $cekValue;
	$conn_cek->close();
}
function save_pegawai_absen($peg_id,$peg_nama,$peg_jk,$peg_user_no,$peg_unitkerja,$peg_status,$peg_jabatan,$user_created) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("insert into m_pegawai(peg_id,peg_nama,peg_jk,peg_user_no,peg_status,peg_unitkerja,peg_jabatan,peg_dibuat_waktu,peg_dibuat_oleh) values('$peg_id','$peg_nama','$peg_jk','$peg_user_no','$peg_status','$peg_unitkerja','$peg_jabatan','$waktu_lokal','$user_created')") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function update_pegawai_absen($peg_no,$peg_id,$peg_nama,$peg_jk,$peg_user_no,$peg_unitkerja,$peg_jabatan,$peg_status,$user_update) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("update m_pegawai set peg_id='$peg_id', peg_nama='$peg_nama', peg_jk='$peg_jk', peg_user_no='$peg_user_no', peg_unitkerja='$peg_unitkerja', peg_jabatan='$peg_jabatan', peg_status='$peg_status', peg_diupdate_oleh='$user_update', peg_diupdate_waktu='$waktu_lokal' where peg_no='$peg_no'") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}

function hapus_pegawai_absen($peg_no) {
	$db_peg_absen = new db();
	$conn_peg_absen = $db_peg_absen -> connect();
	$sql_hapus_peg = $conn_peg_absen-> query("delete from m_pegawai where peg_no='$peg_no'") or die(mysqli_error($conn_value));
	if ($sql_hapus_peg) {
		$peg_hapus_status=TRUE;
	}
	else {
		$peg_hapus_status=FALSE;
	}
	return $peg_hapus_status;
}
?>