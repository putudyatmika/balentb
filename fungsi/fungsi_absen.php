<?php
function encrypt_url( $s ) {
	global $cryptKey;
    
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $s, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decrypt_url($s) {
   	global $cryptKey;
    $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $s ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

//fungsi untuk modul absen
function list_pegawai($peg_no,$detil=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==true) {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where peg_no='$peg_no'");
	}
	else {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_jabatan<3 order by m_pegawai.peg_status desc, m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
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
function list_pegawai_honor($peg_no,$detil=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==true) {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where peg_no='$peg_no'");
	}
	else {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_jabatan='3' order by m_pegawai.peg_status desc, m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
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
function peg_absen_v2($peg_id,$tgl_absen,$kode_absen) {
	// kode 0:masuk, 1:pulang, 2:keluar, 3:kembali, 4:masuk lembur, 5:plg lembur
	
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	if ($kode_absen==0) {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and hour(absen_jam) between 5 and 11 order by absen_jam asc limit 1");
	}
	elseif ($kode_absen==1) {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and hour(absen_jam) between 15 and 23 order by absen_jam desc limit 1");
	}
	elseif ($kode_absen==2) {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='2' order by absen_jam asc limit 1");
	}
	elseif ($kode_absen==3) {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='3' order by absen_jam desc limit 1");
	}
	elseif ($kode_absen==4) {

	}
	else {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='$kode_absen' order by absen_jam asc limit 1");
	}
	$cek_absen = $sql_absen->num_rows;
	if ($cek_absen>0) {
		$r=$sql_absen->fetch_object();
		$jam_absen=$r->absen_jam;
		$w_absen=strtotime($jam_absen);
		$waktu_absen_list=array("absen_telat"=>0);
		if ($kode_absen==0) {
			$pagi = strtotime("07:31:00");
			if ($w_absen>=$pagi) {
				//telat merah
				$waktu_absen_list["absen_telat"]=1;
				$selisih= $w_absen - $pagi;
				if ($selisih>59) {
					$menit=floor($selisih/60);
					$detik=$selisih-($menit*60);
					if ($menit>59) {
						$jam=floor($menit/60);
						$menit_sisa=$menit-($jam*60);
						$jam_telat=sprintf("%02s", $jam).':'.sprintf("%02s", $menit_sisa).':'.sprintf("%02s", $detik);
					}
					else {
						$jam=0;
						$menit_sisa=$menit;
						$jam_telat=sprintf("%02s", $menit_sisa).':'.sprintf("%02s", $detik);
					}
				}
				else {
					$detik=$selisih;
					$menit_sisa=0;
					$jam=0;
					$jam_telat='00:'.sprintf("%02s", $detik);
				}
				$waktu_absen_list["absen_selisih"]=$jam_telat;
				$waktu_absen_list["absen_teks"]='<span class="label label-danger">'.$jam_absen.'</span>';
			}
			else {
				//bner hijau
				//$waktu_absen='<span class="bg-success">'.$waktu_absen.'</span>';
				$waktu_absen_list["absen_telat"]=0;
				$waktu_absen_list["absen_selisih"]=0;
				$waktu_absen_list["absen_teks"]=$jam_absen;
			}
		 
		}
		elseif ($kode_absen==1) {
			$sore = strtotime('16:00:00');
			if ($w_absen<$sore) {
				//duluan pulang
				$waktu_absen_list["absen_telat"]=1;
				$selisih=$w_absen-$sore;
				//$wkt_telat=floor($selisih/60);
				$waktu_absen_list["absen_selisih"]=$selisih;
				$waktu_absen_list["absen_teks"]='<span class="label label-danger">'.$jam_absen.'</span>';
			}
			else {
				//normal
				//$waktu_absen='<span class="bg-success">'.$waktu_absen.'</span>';
				$waktu_absen_list["absen_telat"]=0;
				$waktu_absen_list["absen_selisih"]=0;
				$waktu_absen_list["absen_teks"]=$jam_absen;
			}
			
		}
		else {
			$istirahat = strtotime('12:30:00');
			$siang = strtotime('14:00:00');
			//$waktu_absen='<span class="label label-success">'.$waktu_absen.'</span>';
			$waktu_absen_list["absen_telat"]=0;
			$waktu_absen_list["absen_selisih"]=0;
			$waktu_absen_list["absen_teks"]=$jam_absen;
		}
		
	}
	else {
		$waktu_absen_list["absen_telat"]=0;
		$waktu_absen_list["absen_selisih"]=0;
		$waktu_absen_list["absen_teks"]='-';
	}
	return $waktu_absen_list;
	$conn_absen->close();
}
function peg_absen($peg_id,$tgl_absen,$kode_absen) {
	// kode 0:masuk, 1:pulang, 2:keluar, 3:kembali, 4:masuk lembur, 5:plg lembur
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='$kode_absen' order by absen_jam asc limit 1");
	$cek_absen = $sql_absen->num_rows;
	if ($cek_absen>0) {
		$r=$sql_absen->fetch_object();
		$waktu_absen=$r->absen_jam;
		$w_absen=strtotime($waktu_absen);
		if ($kode_absen==0) {
			$pagi = strtotime('07:30:59');
			if ($w_absen>$pagi) {
				//telat merah
				$telat_absen["absen_telat"]=1;
				$wkt_telat=floor($selisih/60);
				$telat_absen["absen_selisih"]=$wkt_telat;
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
	$sql_sync = $conn_sync-> query("insert into peg_absen(absen_peg_id,absen_peg_nama,absen_tgl,absen_jam,absen_kode,absen_sync_tgl,absen_rekap,absen_flag)
	values('$peg_id','$peg_nama','$tgl_absen','$jam_absen','$kode','$waktu_lokal',0,0)") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function sync_absen_v2($peg_id,$peg_nama,$tgl_absen,$jam_absen,$kode,$waktu_sync_lokal) {
	//$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("insert into peg_absen(absen_peg_id,absen_peg_nama,absen_tgl,absen_jam,absen_kode,absen_sync_tgl,absen_rekap,absen_flag)
	values('$peg_id','$peg_nama','$tgl_absen','$jam_absen','$kode','$waktu_sync_lokal',0,1)") or die(mysqli_error($conn_sync));
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
function upload_data_absen($banyak) {
	
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen = $conn_absen->query("select * from peg_absen where absen_flag='0' order by absen_tgl desc limit 0,$banyak");
	$cek_absen=$sql_absen->num_rows;
	$absen_list=array("error"=>false);
	if ($cek_absen>0) {
		$absen_list["error"]=false;
		$absen_list["absen_total"]=$cek_absen;
		$i=1;
		while ($r=$sql_absen->fetch_object()) {
			$absen_list["item"][$i]=array(
				"absen_peg_id"=>$r->absen_peg_id,
				"absen_peg_nama"=>$r->absen_peg_nama,
				"absen_tgl"=>$r->absen_tgl,
				"absen_jam"=>$r->absen_jam,
				"absen_kode"=>$r->absen_kode,
				"absen_sync_tgl"=>$r->absen_sync_tgl,
				"absen_rekap"=>$r->absen_rekap,
			);
			$i++;
		}
	}
	else {
		$absen_list["error"]=true;
		$absen_list["pesan_error"]="data kosong";
	}
	return $absen_list;
	$conn_absen->close();
}
function list_absen($peg_id,$detil=false,$sdate,$edate,$tglDurasi=false) {
	//semua absen list_absen(0,false,'tanggal',0,false) << 1 tanggal
	//semua absen interval list_absen(0,false,'tanggal',0,false) << beberapa tanggal
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	if ($detil==true) { //select 1 pegawai untuk detil banget
		if ($tglDurasi==true) {
			$sql_absen= $conn_absen->query();
		}
		else {

		}
	}
	else { //semua pegawai dari absen paling pagi ke paling telat 
		if ($tglDurasi==true) {

		}
		else {
			//list absen 1 titik tanggal untuk semua record
			$sql_absen= $conn_absen->query("select peg_absen.*, m_pegawai.* from peg_absen left join m_pegawai on peg_absen.absen_peg_id=m_pegawai.peg_id where peg_absen.absen_tgl='2018-01-26' and hour(peg_absen.absen_jam) between 5 and 11 group by peg_absen.absen_peg_id order by absen_jam asc");
		}	
	}
	$cek_absen = $sql_absen->num_rows;
	$absen_list=array("error"=>false);
	if ($cek_absen>0) {
		$absen_list["error"]=false;
		$absen_list["absen_total"]=$cek_absen;
		$i=1;
		while ($r=$sql_absen->fetch_object()) {
			$absen_list["item"][$i]=array(
				"absen_id"=>$r->absen_id,
				"absen_peg_id"=>$r->absen_peg_id,
				"absen_peg_nama"=>$r->absen_peg_nama,
				"absen_tgl"=>$r->absen_tgl,
				"absen_jam"=>$r->absen_jam,
				"absen_kode"=>$r->absen_kode,
				"absen_sync_tgl"=>$r->absen_sync_tgl,
				"absen_rekap"=>$r->absen_rekap,
				"absen_flag"=>$r->absen_flag,
				"absen_ket"=>$r->absen_ket,
				"peg_dibuat_waktu"=>$r->peg_dibuat_waktu,
				"peg_dibuat_oleh"=>$r->peg_dibuat_oleh,
				"peg_diupdate_waktu"=>$r->peg_diupdate_waktu,
				"peg_diupdate_oleh"=>$r->peg_diupdate_oleh
			);
			$i++;
		}
	}
	else {
		$absen_list["error"]=true;
		$absen_list["pesan_error"]="data kosong";
	}
	return $absen_list;
	$conn_absen->close();
}
function list_pegawai_absen($sdate,$edate,$tglDetil=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($tglDetil==false) {
		//list 1 tanggal
		//$sql_pegawai = $conn_pegawai -> query("select peg_absen.*, m_pegawai.* from peg_absen left join m_pegawai on peg_absen.absen_peg_id=m_pegawai.peg_id where peg_absen.absen_tgl='$sdate' and hour(peg_absen.absen_jam) between 5 and 11 group by peg_absen.absen_peg_id order by absen_jam asc");
		$sql_pegawai = $conn_pegawai -> query("select * from m_pegawai LEFT JOIN (select * from peg_absen where absen_tgl='$sdate' and hour(peg_absen.absen_jam) between 5 and 11 group by absen_peg_id ) as abs on m_pegawai.peg_id=abs.absen_peg_id where peg_status=1 order by abs.absen_jam desc");
	}
	else {
		//list durasi tanggal
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
function list_pegawai_unitkerja($unit_kode,$detil=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==true) {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_status='1' and substring(m_pegawai.peg_unitkerja,1,4)=substring('$unit_kode',1,4) order by m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
	}
	else {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_status='1' order by m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
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

function peg_jabatan_absen($peg_id) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	$sql_pegawai= $conn_pegawai -> query("select peg_id,peg_nama,peg_unitkerja, unit_nama, peg_jabatan from m_pegawai inner join unitkerja on m_pegawai.peg_unitkerja=unitkerja.unit_kode and m_pegawai.peg_id='$peg_id'");
	$cek_pegawai=$sql_pegawai->num_rows;
	$peg_data["error"]=false;
	if ($cek_pegawai>0) {
		$r=$sql_pegawai->fetch_object();
		$peg_data["error"]=false;
		$peg_data["peg_id"]=$r->peg_id;
		$peg_data["peg_nama"]=$r->peg_nama;
		$peg_data["peg_unitkerja"]=$r->peg_unitkerja;
		$peg_data["unit_nama"]=$r->unit_nama;
		$peg_data["peg_jabatan"]=$r->peg_jabatan;
	}
	else {
		$peg_data["error"]=true;
		$peg_data["pesan_error"]="Data tidak tersedia";
	}
	return $peg_data;
	$conn_pegawai->close();
}
function get_web_page($url_curl)
  {

          $options = array(
              CURLOPT_CUSTOMREQUEST  =>"GET",    // Atur type request, get atau post
              CURLOPT_POST           =>false,    // Atur menjadi GET
              CURLOPT_FOLLOWLOCATION => true,    // Follow redirect aktif
              CURLOPT_CONNECTTIMEOUT => 120,     // Atur koneksi timeout
              CURLOPT_TIMEOUT        => 120,     // Atur response timeout
          );

          $ch      = curl_init( $url_curl );          // Inisialisasi Curl
          curl_setopt_array( $ch, $options );    // Set Opsi
          $content = curl_exec( $ch );           // Eksekusi Curl
          curl_close( $ch );                     // Stop atau tutup script

          $header['content'] = $content;
          return $header;
  }
?>