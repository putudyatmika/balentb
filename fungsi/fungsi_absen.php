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
function cek_log_absen($log_id) {
	$db_cek = new db();
	$conn_cek = $db_cek -> connect();
	$sql_cek = $conn_cek -> query("select * from peg_absen where absen_id='$log_id'");
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
function update_log_absen($absen_id,$absen_kode,$absen_ket) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("update peg_absen set absen_kode='$absen_kode', absen_ket='$absen_ket' where absen_id='$absen_id'") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function update_absen_tl_tw($absen_id,$absen_tgl,$absen_jam,$absen_kode) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_absen = $db_sync -> connect();
	
	if ($absen_kode==0) {
		$hsl_cek_telat=cek_telat($absen_jam);
		$tl=$hsl_cek_telat["tl"];
		$psw=0;
	}
	elseif ($absen_kode==1) {
		$tl=0;
		$jumat_tidak=date("w",strtotime($absen_tgl));
		if ($jumat_tidak==5) { $hariJumat=true; }
		else { $hariJumat=false; }	
		$cek_absen_plg=cek_psw($absen_jam,$hariJumat);
		$psw=$cek_absen_plg["psw"];
	}
	else {
		$tl=0;
		$psw=0;
	}
	$sql_update_tl_psw= $conn_absen->query("update peg_absen set absen_tl='$tl', absen_psw='$psw', absen_sync_tgl='$waktu_lokal' where absen_id='$absen_id'") or die(mysqli_error($conn_absen));
	if ($sql_update_tl_psw) { $status_update=true; }
	else { $status_update=false; }
	return $status_update;
	$conn_absen-> close();
}
function update_log_absen_tlpsw($tgl_awal,$tgl_akhir) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_absen = $db_sync -> connect();
	$sql_absen = $conn_absen -> query("select peg_absen.*, m_pegawai.peg_nama, m_pegawai.peg_jabatan, m_pegawai.peg_status from peg_absen left join m_pegawai on peg_absen.absen_peg_id=m_pegawai.peg_id where absen_tgl>='$tgl_awal' and absen_tgl<='$tgl_akhir' order by absen_tgl desc,absen_jam asc") or die(mysqli_error($conn_absen));
	$cek_absen = $sql_absen->num_rows;
	$list_absen=array("error"=>false);
	if ($cek_absen>0) {
		$list_absen["error"]=false;
		$list_absen["absen_total"]=$cek_absen;
		$i=1;
		while ($r=$sql_absen->fetch_object()) {
			$list_absen["item"][$i]=array(
				"absen_id"=>$r->absen_id,
				"absen_peg_id"=>$r->absen_peg_id,
				"absen_peg_nama"=>$r->absen_peg_nama,
				"peg_nama"=>$r->peg_nama,
				"absen_tgl"=>$r->absen_tgl,
				"absen_jam"=>$r->absen_jam,
				"absen_tl"=>$r->absen_tl,
				"absen_psw"=>$r->absen_psw,
				"absen_kode"=>$r->absen_kode,
				"absen_sync_tgl"=>$r->absen_sync_tgl,
				"absen_rekap"=>$r->absen_rekap,
				"absen_flag"=>$r->absen_flag,
				"absen_ket"=>$r->absen_ket,
				"peg_jabatan"=>$r->peg_jabatan,
				"peg_status"=>$r->peg_status
			);
			$i++;
		}
	}
	else {
		$list_absen["error"]=true;
		$list_absen["pesan_error"]='Data masih kosong';
	}
	return $list_absen;
	$db_sync->close();
}

function log_peg_absen($absen_id,$absen_tgl,$detil=false) {
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	if ($detil==false) {
		$sql_absen = $conn_absen -> query("select peg_absen.*, m_pegawai.peg_nama from peg_absen left join m_pegawai on peg_absen.absen_peg_id=m_pegawai.peg_id where absen_tgl='$absen_tgl' order by absen_jam asc");
	}	
	else {
		$sql_absen = $conn_absen -> query("select peg_absen.*, m_pegawai.peg_nama from peg_absen left join m_pegawai on peg_absen.absen_peg_id=m_pegawai.peg_id where absen_id='$absen_id'");
	}
	$cek_absen = $sql_absen->num_rows;
	$list_absen=array("error"=>false);
	if ($cek_absen>0) {
		$list_absen["error"]=false;
		$list_absen["absen_total"]=$cek_absen;
		$i=1;
		while ($r=$sql_absen->fetch_object()) {
			$list_absen["item"][$i]=array(
				"absen_id"=>$r->absen_id,
				"absen_peg_id"=>$r->absen_peg_id,
				"absen_peg_nama"=>$r->absen_peg_nama,
				"peg_nama"=>$r->peg_nama,
				"absen_tgl"=>$r->absen_tgl,
				"absen_jam"=>$r->absen_jam,
				"absen_tl"=>$r->absen_tl,
				"absen_psw"=>$r->absen_psw,
				"absen_kode"=>$r->absen_kode,
				"absen_sync_tgl"=>$r->absen_sync_tgl,
				"absen_rekap"=>$r->absen_rekap,
				"absen_flag"=>$r->absen_flag,
				"absen_ket"=>$r->absen_ket
			);
			$i++;
		}
	}
	else {
		$list_absen["error"]=true;
		$list_absen["pesan_error"]='Data masih kosong';
	}
	return $list_absen;
	$conn_absen->close();
}
function list_pegawai($peg_no,$detil=false,$semua=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==true) {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where peg_no='$peg_no'");
	}
	else {
		if ($semua==false) {
			$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no order by m_pegawai.peg_status desc, m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
		}
		else {
		$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_jabatan<>3 order by m_pegawai.peg_status desc, m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
		}
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
				"peg_nip"=>$r->peg_nip,
				"peg_nip_lama"=>$r->peg_nip_lama,
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

function input_generate_rekap($peg_id,$tgl_absen,$pola_absen) {
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen= $conn_absen->query("insert into rekap_absen (peg_id,pola,tgl) values('$peg_id','$pola_absen','$tgl_absen')") or die(mysqli_error($conn_absen));
	if ($sql_absen) {
		$status_rekap=true;
	}
	else {
		$status_rekap=false;
	}
	return $status_rekap;
	$conn_absen->close();
}
function cek_generate_rekap($peg_id,$tgl_absen) {
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen= $conn_absen->query("select * from rekap_absen where peg_id='$peg_id' and tgl='$tgl_absen'") or die(mysqli_error($conn_absen));
	$cek_absen=$sql_absen->num_rows;
	if ($cek_absen>0) {
		$status_rekap=true;
	}
	else {
		$status_rekap=false;
	}
	return $status_rekap;
	$conn_absen->close();
}
function cek_gen_rekap_peg($peg_id,$tgl_absen) {
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen= $conn_absen->query("select * from rekap_tl_psw where peg_id='$peg_id' and rekap_tgl='$tgl_absen'") or die(mysqli_error($conn_absen));
	$cek_absen=$sql_absen->num_rows;
	if ($cek_absen>0) {
		$status_rekap=true;
	}
	else {
		$status_rekap=false;
	}
	return $status_rekap;
	$conn_absen->close();
}
function input_gen_rekap_peg($peg_id,$tgl_absen) {
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen= $conn_absen->query("insert into rekap_tl_psw (peg_id,rekap_tgl) values('$peg_id','$tgl_absen')") or die(mysqli_error($conn_absen));
	if ($sql_absen) {
		$status_rekap=true;
	}
	else {
		$status_rekap=false;
	}
	return $status_rekap;
	$conn_absen->close();
}
function update_rekap_peg($peg_id,$absen_tgl,$absen_hadir,$tl,$psw,$total_menit) {
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	if ($tl==0) { $tl1=0; $tl2=0; $tl3=0;$tl4=0; }
	elseif ($tl==1) { $tl1=1; $tl2=0; $tl3=0;$tl4=0; }
	elseif ($tl==2) { $tl1=0; $tl2=1; $tl3=0;$tl4=0; }
	elseif ($tl==3) { $tl1=0; $tl2=0; $tl3=1;$tl4=0; }
	elseif ($tl==4) { $tl1=0; $tl2=0; $tl3=0;$tl4=1; }
	if ($psw==0) { $psw1=0; $psw2=0; $psw3=0; $psw4=0; }
	elseif ($psw==1) { $psw1=1; $psw2=0; $psw3=0; $psw4=0; }
	elseif ($psw==2) { $psw1=0; $psw2=2; $psw3=0; $psw4=0; }
	elseif ($psw==3) { $psw1=0; $psw2=0; $psw3=3; $psw4=0; }
	elseif ($psw==4) { $psw1=0; $psw2=0; $psw3=0; $psw4=1; }

	$sql_absen= $conn_absen->query("update rekap_tl_psw set rekap_hadir='$absen_hadir', tl1='$tl1', tl2='$tl2', tl3='$tl3', tl4='$tl4', psw1='$psw1', psw2='$psw2', psw3='$psw3', psw4='$psw4', total_telat_menit='$total_menit' where peg_id='$peg_id' and  rekap_tgl='$absen_tgl'") or die(mysqli_error($conn_absen));
	if ($sql_absen) {
		$status_rekap=true;
	}
	else {
		$status_rekap=false;
	}
	return $status_rekap;
	$conn_absen->close();
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
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='4' order by absen_jam desc limit 1");
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
						$jam_telat='00:'.sprintf("%02s", $menit_sisa).':'.sprintf("%02s", $detik);
					}
				}
				else {
					$detik=$selisih;
					$menit_sisa=0;
					$jam=0;
					$jam_telat='00:00:'.sprintf("%02s", $detik);
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
function cek_psw($absen_jam,$hariJumat=false) {
	global $JamPulang,$JamPulangJumat;
	$wkt_absen_plg=strtotime($absen_jam);
	$JamPulangBiasa=strtotime($JamPulang);
	$JamJumatPulang=strtotime($JamPulangJumat);
	if ($hariJumat==false) {
		//hari biasa
		$selisih_plg=$wkt_absen_plg-$JamPulangBiasa;
		if ($wkt_absen_plg<=$JamPulangBiasa) {
				$menit_plg = floor($selisih_plg/60);
			if ($menit_plg<=0 and $menit_plg >=-30) {
				$psw=1;
			}
			elseif ($menit_plg>=-60 and $menit_plg<-30) {
				$psw=2;
			}
			elseif ($menit_plg>=-90 and $menit_plg<-60) {
				$psw=3;
			}
			else {
				$psw=4;
			}
		}
		else {
			$menit_plg = floor($selisih_plg/60);
			$psw=0;
		}
	}
	else {
		//hari jumat
		$selisih_plg=$wkt_absen_plg-$JamJumatPulang;
		if ($wkt_absen_plg<=$JamJumatPulang) {
			$menit_plg = floor($selisih_plg/60);
			if ($menit_plg<=0 and $menit_plg >=-30) {
				$psw=1;
			}
			elseif ($menit_plg>=-60 and $menit_plg<-30) {
				$psw=2;
			}
			elseif ($menit_plg>=-90 and $menit_plg<-60) {
				$psw=3;
			}
			else {
				$psw=4;
			}
		}
		else {
			$menit_plg = floor($selisih_plg/60);
			$psw=0;
		}
	}
	$telat_pulang=array("psw"=>$psw,"waktu"=>$menit_plg);
	return $telat_pulang;
}
function cek_telat($absen_jam) {
	global $JamMasuk;
	$absen_jam=strtotime($absen_jam);
	$jam_masuk=strtotime($JamMasuk);
	if ($absen_jam > $jam_masuk) {
		$selisih = $absen_jam - $jam_masuk;
		if ($selisih>59) {
			$menit=floor($selisih/60);
			$jam=floor($menit/60);
			$menit_sisa=$menit-($jam*60);
			$jam_telat=sprintf("%02s", $jam).':'.sprintf("%02s", $menit_sisa);
		if ($menit<=30) {
			$jam_telat='00:'.sprintf("%02s", $menit);
			$telat=array("tl"=>1,"waktu"=>$jam_telat);
		}
		elseif ($menit>30 and $menit <= 60) {
			
			$telat=array("tl"=>2,"waktu"=>$jam_telat);
		}
		elseif ($menit>60 and $menit<=90) {
			$telat=array("tl"=>3,"waktu"=>$jam_telat);
		}
		else {
			$telat=array("tl"=>4,"waktu"=>$jam_telat);
			}
		}
		else {
			$telat=array("tl"=>0,"waktu"=>0);
		}
	}
	else {
		$telat=array("tl"=>0,"waktu"=>0);
	}
	return $telat;
}
function list_pegawai_all_aktif($peg_id,$detil=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==false) {
		//semua
		$sql_pegawai= $conn_pegawai -> query("select * from pegawai_all_aktif");
	}
	else {
		//satu pegawai saja
		$sql_pegawai= $conn_pegawai -> query("select * from pegawai_all_aktif where peg_id='$peg_id'");
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
				"peg_nip_lama"=>$r->peg_nip_lama,
				"peg_nip"=>$r->peg_nip,
				"peg_nama"=>$r->peg_nama,
				"peg_jk"=>$r->peg_jk,
				"peg_status"=>$r->peg_status,
				"user_no"=>$r->peg_user_no,
				"peg_unitkerja"=>$r->peg_unitkerja,
				"peg_jabatan"=>$r->peg_jabatan,
				"unit_nama"=>$r->unit_nama
			);
			$i++;
		}
	}
	else {
		$list_pegawai["error"]=true;
		$list_pegawai["pesan_error"]="data pegawai kosong";
	}
	return $list_pegawai;
	$conn_pegawai->close();
}
function peg_absen_v3($peg_id,$tgl_absen,$kode_absen,$peg_jabatan) {
	// kode 0:masuk, 1:pulang, 2:keluar, 3:kembali, 4:masuk lembur, 5:plg lembur
	$hari_libur = date("w",strtotime($tgl_absen));
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	if ($kode_absen==0) {
		if ($peg_jabatan==3) {
			//honorer
			$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_kode='0' and absen_tgl='$tgl_absen' order by absen_jam asc limit 1");
		}
		else {
			//pegawai
			$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and hour(absen_jam) between 5 and 11 order by absen_jam asc limit 1");
		}
	}
	elseif ($kode_absen==1) {
		if ($peg_jabatan==3) {
			$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_kode='1' and absen_tgl='$tgl_absen' order by absen_jam desc limit 1");
		}
		else {
			$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and hour(absen_jam) between 15 and 23 order by absen_jam desc limit 1");
		}
	}
	elseif ($kode_absen==2) {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='2' order by absen_jam asc limit 1");
	}
	elseif ($kode_absen==3) {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='3' order by absen_jam desc limit 1");
	}
	elseif ($kode_absen==4) {
		$sql_absen = $conn_absen -> query("select absen_jam from peg_absen where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen' and absen_kode='4' order by absen_jam desc limit 1");
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
			//cek hari sabtu / minggu
			if ($peg_jabatan<3 && ( $hari_libur==0 || $hari_libur==6)) {
				$waktu_absen_list["absen_telat"]=0;
				$waktu_absen_list["absen_selisih"]=0;
				$waktu_absen_list["absen_teks"]='-';
			}
			else {
				if ($peg_jabatan==3) {
					$jam_absen=substr($jam_absen,0,5);
					$waktu_absen_list["absen_telat"]=0;
					$waktu_absen_list["absen_selisih"]=0;
					$waktu_absen_list["absen_teks"]=$jam_absen;
				}
				else {
				$pagi = strtotime("07:31:00");
				if ($w_absen>=$pagi) {
					//telat merah
					$waktu_absen_list["absen_telat"]=1;
					$selisih= $w_absen - $pagi;
					$selisih=$selisih + 60;
					if ($selisih>59) {
						$menit=floor($selisih/60);
						if ($menit>59) {
							$jam=floor($menit/60);
							$menit_sisa=$menit-($jam*60);
						}
						else {
							$jam=0;
							$menit_sisa=$menit;
							//$jam_telat=sprintf("%02s", $menit_sisa).':'.sprintf("%02s", $detik);
						}
						$jam_telat=sprintf("%02s", $jam).':'.sprintf("%02s", $menit_sisa);
					}
					else {
						//$menit_sisa=1;
						//$jam=0;
						$menit_sisa=floor($selisih/60);
						$jam_telat='00:'.sprintf("%02s", $menit_sisa);
					}
					$jam_absen=substr($jam_absen,0,5);
					$waktu_absen_list["absen_selisih"]=$jam_telat;
					$waktu_absen_list["absen_teks"]='<span class="label label-danger">'.$jam_absen.'</span>';
				}
				else {
					//bner hijau
					//$waktu_absen='<span class="bg-success">'.$waktu_absen.'</span>';
					$jam_absen=substr($jam_absen,0,5);
					$waktu_absen_list["absen_telat"]=0;
					$waktu_absen_list["absen_selisih"]=0;
					$waktu_absen_list["absen_teks"]=$jam_absen;
				}
				}
		 	}
		}
		elseif ($kode_absen==1) {
			//cek hari sabtu / minggu
			if ($peg_jabatan<3 && ( $hari_libur==0 || $hari_libur==6)) {
				$waktu_absen_list["absen_telat"]=0;
				$waktu_absen_list["absen_selisih"]=0;
				$waktu_absen_list["absen_teks"]='-';
			}
			else {
			$sore = strtotime('16:00:00');
			$jam_absen=substr($jam_absen,0,5);
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
		}
		else {
			$jam_absen=substr($jam_absen,0,5);
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
function sync_absen($peg_id,$peg_nama,$tgl_absen,$jam_absen,$kode,$peg_jabatan) {
	$waktu_lokal=date("Y-m-d H:i:s");
	if ($kode==0 and $peg_jabatan<=2) {
		$hsl_cek_telat=cek_telat($jam_absen);
		$tl=$hsl_cek_telat["tl"];
		$psw=0;
	}
	elseif ($kode==1 and $peg_jabatan<=2) {
		$tl=0;
		$jumat_tidak=date("w",strtotime($tgl_absen));
		if ($jumat_tidak==5) { $hariJumat=true; }
		else { $hariJumat=false; }	
		$cek_absen_plg=cek_psw($jam_absen,$hariJumat);
		$psw=$cek_absen_plg["psw"];
	}
	else {
		$tl=0;
		$psw=0;
	}
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("insert into peg_absen(absen_peg_id,absen_peg_nama,absen_tgl,absen_jam,absen_tl,absen_psw,absen_kode,absen_sync_tgl,absen_rekap,absen_flag,absen_pola,absen_hadir)
	values('$peg_id','$peg_nama','$tgl_absen','$jam_absen',$tl,$psw,'$kode','$waktu_lokal',0,0,1,1)") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function save_hadir_absen($peg_id,$peg_nama,$tgl_absen,$absen_hadir,$absen_ket) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("insert into peg_absen(absen_peg_id,absen_peg_nama,absen_tgl,absen_kode,absen_sync_tgl,absen_rekap,absen_flag,absen_pola,absen_hadir,absen_ket)
	values('$peg_id','$peg_nama','$tgl_absen',0,'$waktu_lokal',0,0,1,'$absen_hadir','$absen_ket')") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function update_hadir_absen($absen_id,$absen_hadir,$absen_ket) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("update peg_absen set absen_hadir='$absen_hadir',absen_ket='$absen_ket' where absen_id='$absen_id'") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function peg_hadir_absen($peg_id,$tgl_absen) {
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync= $conn_sync->query("select peg_absen.*, m_pegawai.peg_nama from peg_absen inner join m_pegawai on peg_absen.absen_peg_id=m_pegawai.peg_id where absen_peg_id='$peg_id' and absen_tgl='$tgl_absen'");
	$r_absen=array("error"=>false);
	$cek=$sql_sync->num_rows;
	if ($cek>0) {
		$r=$sql_sync->fetch_object();
		$r_absen["error"]=false;
		$r_absen["absen_id"]=$r->absen_id;
		$r_absen["peg_nama"]=$r->peg_nama;
		$r_absen["absen_ket"]=$r->absen_ket;
		$r_absen["absen_hadir"]=$r->absen_hadir;
		$r_absen["absen_peg_nama"]=$r->absen_peg_nama;
		$r_absen["absen_pola"]=$r->absen_pola;
		$r_absen["absen_flag"]=$r->absen_flag;
		$r_absen["absen_rekap"]=$r->absen_rekap;
	}
	else {
		$r_absen["error"]=true;
		$r_absen["pesan_error"]="data tidak ada";
	}
	return $r_absen;
	$conn_sync->close();
}
function sync_absen_v2($peg_id,$peg_nama,$tgl_absen,$jam_absen,$kode,$waktu_sync_lokal) {
	//$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("insert into peg_absen(absen_peg_id,absen_peg_nama,absen_tgl,absen_jam,absen_kode,absen_sync_tgl,absen_rekap,absen_flag,absen_pola,absen_hadir)
	values('$peg_id','$peg_nama','$tgl_absen','$jam_absen','$kode','$waktu_sync_lokal',0,1,1,1)") or die(mysqli_error($conn_sync));
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
function save_pegawai_absen($peg_id,$peg_nama,$peg_jk,$peg_user_no,$peg_unitkerja,$peg_status,$peg_jabatan,$user_created,$peg_nip_lama,$peg_nip) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("insert into m_pegawai(peg_id,peg_nama,peg_jk,peg_user_no,peg_status,peg_unitkerja,peg_jabatan,peg_dibuat_waktu,peg_dibuat_oleh,peg_nip_lama,peg_nip) values('$peg_id','$peg_nama','$peg_jk','$peg_user_no','$peg_status','$peg_unitkerja','$peg_jabatan','$waktu_lokal','$user_created','$peg_nip_lama','$peg_nip')") or die(mysqli_error($conn_sync));
	if ($sql_sync) {
		$status_sync=TRUE;
	}
	else {
		$status_sync=FALSE;
	}
	return $status_sync;
	$db_sync->close();
}
function update_pegawai_absen($peg_no,$peg_id,$peg_nama,$peg_jk,$peg_user_no,$peg_unitkerja,$peg_jabatan,$peg_status,$user_update,$peg_nip_lama,$peg_nip) {
	$waktu_lokal=date("Y-m-d H:i:s");
	$db_sync = new db();
	$conn_sync = $db_sync -> connect();
	$sql_sync = $conn_sync-> query("update m_pegawai set peg_id='$peg_id', peg_nama='$peg_nama', peg_jk='$peg_jk', peg_user_no='$peg_user_no', peg_unitkerja='$peg_unitkerja', peg_jabatan='$peg_jabatan', peg_status='$peg_status', peg_diupdate_oleh='$user_update', peg_diupdate_waktu='$waktu_lokal', peg_nip_lama='$peg_nip_lama', peg_nip='$peg_nip' where peg_no='$peg_no'") or die(mysqli_error($conn_sync));
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
function set_flag_data($absen_id) {
	$db_absen = new db();
	$conn_absen = $db_absen -> connect();
	$sql_absen = $conn_absen -> query("update peg_absen set absen_flag='1' where absen_id='$absen_id'");
	if ($sql_absen) {
		$set_flag=true;
	}
	else {
		$set_flag=false;
	}
	return $set_flag;
	$conn_absen->close();
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
				"absen_id"=>$r->absen_id,
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
function list_pegawai_unitkerja($unit_kode,$detil=false,$honor=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==true) {
		if ($honor==false) {
			$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_status='1' and substring(m_pegawai.peg_unitkerja,1,4)=substring('$unit_kode',1,4) order by m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
		}
		else {
			$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_status='1' and substring(m_pegawai.peg_unitkerja,1,4)=substring('$unit_kode',1,4) and m_pegawai.peg_jabatan<3 order by m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
		}
	}
	else {
		if ($honor==false) {
			$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_status='1' order by m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
		}
		else {
			$sql_pegawai = $conn_pegawai -> query("select m_pegawai.*,user_id from m_pegawai left join users on m_pegawai.peg_user_no=users.user_no where m_pegawai.peg_status='1' and m_pegawai.peg_jabatan<3 order by m_pegawai.peg_unitkerja,m_pegawai.peg_jabatan asc");
		}
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
function list_pegawai_aktif($peg_id,$detil=false) {
	$db_pegawai = new db();
	$conn_pegawai = $db_pegawai -> connect();
	if ($detil==false) {
		//semua
		$sql_pegawai= $conn_pegawai -> query("select * from pegawai_aktif");
	}
	else {
		//satu pegawai saja
		$sql_pegawai= $conn_pegawai -> query("select * from pegawai_aktif where peg_id='$peg_id'");
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
				"unit_nama"=>$r->unit_nama
			);
			$i++;
		}
	}
	else {
		$list_pegawai["error"]=true;
		$list_pegawai["pesan_error"]="data pegawai kosong";
	}
	return $list_pegawai;
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
function rekap_harian($peg_id,$absen_tgl) {
  $db_absen = new db();
  $conn_absen = $db_absen -> connect();
  $sql_rekap = $conn_absen -> query("select * from rekap_absen_harian where absen_tgl='$absen_tgl' and peg_id='$peg_id' limit 1");
  $cek_rekap = $sql_rekap->num_rows;
  $rekap_data=array("error"=>false);
  if ($cek_rekap>0) {
  	$rekap_data["error"]=false;
  	$r=$sql_rekap->fetch_object();
  	$rekap_data["peg_no"]=$r->peg_no;
  	$rekap_data["peg_id"]=$r->peg_id;
  	$rekap_data["peg_nama"]=$r->peg_nama;
  	$rekap_data["absen_tgl"]=$r->absen_tgl;
  	$rekap_data["absen_pola"]=$r->absen_pola;
  	$rekap_data["absen_hadir"]=$r->absen_hadir;
  	$rekap_data["masuk_id"]=$r->masuk_id;
  	$rekap_data["jam_masuk"]=$r->jam_masuk;
  	$rekap_data["pulang_id"]=$r->pulang_id;
  	$rekap_data["jam_pulang"]=$r->jam_pulang;
  	$rekap_data["keluar_id"]=$r->keluar_id;
  	$rekap_data["jam_keluar"]=$r->jam_keluar;
  	$rekap_data["kembali_id"]=$r->kembali_id;
  	$rekap_data["jam_kembali"]=$r->jam_kembali;
  	$rekap_data["absen_ket"]=$r->absen_ket;
}
  else {
  	$rekap_data["error"]=true;
  	$rekap_data["pesan_error"]="Data tidak tersedia";
  }
  return $rekap_data;
  $conn_absen->close();
}
function list_rekap_bulan_peg($peg_id,$bln_absen,$thn_absen) {
	$db_absen = new db();
  	$conn_absen = $db_absen -> connect();
  	$sql_rekap = $conn_absen->query("select rekap_tl_psw.*, peg_nama,peg_unitkerja from rekap_tl_psw inner join m_pegawai on rekap_tl_psw.peg_id=m_pegawai.peg_id where rekap_tl_psw.peg_id='$peg_id' and month(rekap_tgl)='$bln_absen' and year(rekap_tgl)='$thn_absen' order by rekap_tgl asc");
  	$cek_rekap= $sql_rekap->num_rows;
  	$list_rekap=array("error"=>false);
  	if ($cek_rekap>0) {
  		$list_rekap["error"]=false;
  		$list_rekap["total_rekap"]=$cek_rekap;
  		$i=1;
  		while ($r=$sql_rekap->fetch_object()) {
  			$list_rekap["item"][$i]=array(
  				"rekap_id"=>$r->rekap_id,
  				"peg_id"=>$r->peg_id,
  				"rekap_tgl"=>$r->rekap_tgl,
  				"rekap_hadir"=>$r->rekap_hadir,
  				"tl1"=>$r->tl1,
  				"tl2"=>$r->tl2,
  				"tl3"=>$r->tl3,
  				"tl4"=>$r->tl4,
  				"psw1"=>$r->psw1,
  				"psw2"=>$r->psw2,
  				"psw3"=>$r->psw3,
  				"psw4"=>$r->psw4,
  				"total_telat_menit"=>$r->total_telat_menit,
  				"peg_nama"=>$r->peg_nama,
  				"peg_unitkerja"=>$r->peg_unitkerja
  			);
  			$i++;
  		}

  	}
  	else {
  		$list_rekap["error"]=true;
  		$list_rekap["pesan_error"]="Data tidak tersedia";
  	}
  	return $list_rekap;
  	$conn_absen->close();
}
function rekap_bulan_peg_biasa($peg_id,$tgl_absen) {
  global $JamMasuk, $JamPulang, $JamPulangJumat;
  $db_absen = new db();
  $conn_absen = $db_absen -> connect();
  $hari_kerja=date("w",strtotime($tgl_absen));
  if ($hari_kerja==5) {
  	//hari jumat
  	$waktu_pulang=$JamPulangJumat;
  }
  else {
  	$waktu_pulang=$JamPulang;
  }
  $sql_rekap = $conn_absen -> query("select * from rekap_absen_harian where peg_id='$peg_id' and absen_tgl='$tgl_absen'") or die(mysqli_error($conn_absen));
  $cek_rekap = $sql_rekap->num_rows;
  $rekap_data=array("error"=>false);
  if ($cek_rekap>0) {
  		$r=$sql_rekap->fetch_object();
  		if ($r->detik_telat_masuk_biasa>59 and $r->absen_hadir==1) {
  				$menit=floor($r->detik_telat_masuk_biasa/60);
  				if ($menit<=30) {
  					$tl=1;
  				}
  				elseif ($menit>30 and $menit<=60) {
  					$tl=2;
  				}
  				elseif ($menit>60 and $menit<=90) {
  					$tl=3;
  				}
  				elseif ($menit>90) {
  					$tl=4;
  				  }
  				$telat_menit=$menit;

  		}
		else {
			$telat_menit=0;
			$tl=0;
		}
	$rekap_data["telat_masuk_menit"]=$telat_menit;
	$rekap_data["tl"]=$tl;	
	 if ($r->detik_cepat_pulang_biasa==null and $r->detik_telat_masuk_biasa!=null) {
	 	$psw=4;
	 	$telat_pulang_menit=-480;
	 }
	 elseif ($r->detik_cepat_pulang_biasa<59) {
		$menit_pulang=ceil($r->detik_cepat_pulang_biasa/60);
		if ($menit_pulang>=-30) {
			$psw=1;
		}
		elseif ($menit_pulang<-30 and $menit_pulang>=-60) {
			$psw=2;
		}
		elseif ($menit_pulang<-60 and $menit_pulang>=-90) {
			$psw=3;
		}
		else {
			$psw=4;
		}
		$telat_pulang_menit=$menit_pulang;
	}
	else {
		$telat_pulang_menit=0;
		$psw=0;
	}
	$rekap_data["pulang_cepat_menit"]=$telat_pulang_menit;
	$rekap_data["psw"]=$psw;
	$rekap_data["rekap_hadir"]=$r->absen_hadir;
  }
  else {
  	$rekap_data["error"]=true;
  	$rekap_data["pesan_error"]="Data tidak tersedia";
  }
  return $rekap_data;
  $conn_absen->close();
}
?>