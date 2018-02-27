<?php
// monitoring.bpsntb.my.id/uploadabsen/input/peg_id+peg_nama+tgl_absen+jam_absen+kode_absen+absen_sync+absen_sync_lokal
	if ($act=="input") {

		$var_url=explode("input",$_SERVER["REQUEST_URI"]);
		$url_enkrip=substr($var_url[1], 1);
		$url_dekrip=decrypt_url($url_enkrip);
		$var_peg=explode("+",$url_dekrip);
		$waktu_sync_lokal=date('Y-m-d H:i:s',$var_peg[6]);
		$peg_id=$var_peg[0];
		$peg_nama=$var_peg[1];
		$tgl_absen=$var_peg[2];
		$jam_absen=$var_peg[3];
		$kode=$var_peg[4];
		
		
		$hasil_input=sync_absen_v2($peg_id,$peg_nama,$tgl_absen,$jam_absen,$kode,$waktu_sync_lokal);
		if ($hasil_input) { echo 'Berhasil'; }
		else { echo 'Error'; }
	}	
	elseif ($act=="view") { 
		$var_url=explode("input",$_SERVER["REQUEST_URI"]);
		$url_enkrip=substr($var_url[1], 1);
		$url_dekrip=decrypt_url($url_enkrip);
		$var_peg=explode("+",$url_enkrip);
		$stamp_date=date('Y-m-d H:i:s',$var_peg[6]);
		//$url_enkrip='peg_id+peg_nama+tgl_absen+jam_absen+kode_absen+absen_sync+absen_sync_lokal';

		echo $url_enkrip;

		$hasil_encrypt=encrypt_url($url_enkrip);

		echo '<p> Url Enkrip : '.$hasil_encrypt.'</p>';

		$hasil_dekrip = decrypt_url($hasil_encrypt);

		echo '<p> Url Dekrip : '.$hasil_dekrip.'</p>';
		
		echo '<br >Peg ID : '. $var_peg[0];
		echo '<br >Nama : '. $var_peg[1];
		echo '<br >Peg ID : '. $var_peg[2];
		echo '<br >Peg ID : '. $var_peg[3];
		echo '<br >Peg ID : '. $var_peg[4];
		echo '<br >Peg ID : '. $var_peg[5];
		echo '<br >Peg ID : '. $var_peg[6] .' / '. $stamp_date;
		
	}
	elseif ($act=="open") {
		$var_url=explode("open",$_SERVER["REQUEST_URI"]);
		$url_enkrip=substr($var_url[1], 1);
		$url_dekrip=decrypt_url($url_enkrip);
		$date_data='2018-01-24 07:36:09';
		$stamp_date=strtotime($date_data);
		$data_date=date('Y-m-d H:i:s',$stamp_date);
		echo '
	Segmen1 : '. $segmen1.' <br />
	Segmen2 : '. $segmen2.' <br />
	page : '.$page.' <br />
	act : '.$act.' <br />
	lvl3 : '.$lvl3.' <br />
	lvl4 : '.$lvl4.' <br />
	lvl5 : '.$lvl5.' <br />
	<br />
	';

echo $_SESSION['sesi_user_id'] .'<br />'.
$_SESSION['sesi_user_no'] .'<br />'.
$_SESSION['sesi_passwd_md5'] .'<br />'.
$_SESSION['sesi_passwd_ori'] .'<br />'.
$_SESSION['sesi_nama'] .'<br />'.
$_SESSION['sesi_level'] .'<br />'.
$_SESSION['sesi_unitkerja'].'<br />'.
$_SESSION['sesi_provkab'];
echo '<br />';
echo 'URL asli : '.$_SERVER["REQUEST_URI"];
echo '<br />Url DB : '.$url_db[2].'<br />URL server : '.$_SERVER['HTTP_HOST'];
echo '<br />Var URL : '. $var_url[0] .' kedua : '. $var_url[1];
echo '<br />Enkrip URL : '. $url_enkrip;
echo '<br />deEnkrip URL : '. $url_dekrip;
echo '<br />Date_data : '. $date_data;
echo '<br />stamp_data : '. $stamp_date;
echo '<br />data_date : '. $data_date;
	}
	elseif ($act=="coba") {
		if ($lvl3=="") {
			$max_data=3;
		}
		else {
			$max_data=$lvl3;
		}
		$r_absen=upload_data_absen($max_data);
		if ($r_absen["error"]==false) {
			//upload data absen
			$jml_record=$r_absen["absen_total"];
			$url_upload='http://monitoring.bpsntb.my.id/uploadabsen/input';
			for ($i=1;$i<=$jml_record;$i++) {
				//$url_enkrip='peg_id+peg_nama+tgl_absen+jam_absen+kode_absen+absen_sync+absen_sync_lokal';
				$data=$r_absen["item"][$i]["absen_peg_id"].'+'.$r_absen["item"][$i]["absen_peg_nama"].'+'.$r_absen["item"][$i]["absen_tgl"].'+'.$r_absen["item"][$i]["absen_jam"].'+'.$r_absen["item"][$i]["absen_kode"].'+1+'.strtotime($r_absen["item"][$i]["absen_sync_tgl"]);
				$data_enkrip=encrypt_url($data);
				$data_dekrip=decrypt_url($data_enkrip);
				$data_up=$url_upload.'/'.$data_enkrip;
				$hasil_upload=get_web_page($data_up);
				
				if ($hasil_upload) {
					echo '<br />'. $i .' ';
					set_flag_data($r_absen["item"][$i]["absen_id"]);
				}
				else {
					echo '<br />'. $i .' Error';
				}
			    
			    /*
				echo '<br /> Asli : '.$i.' '.$data;
				echo '<br /> Enkrip : '.$url_upload .'/'.$data_enkrip;
				echo '<br /> Dekrip : '.$url_upload .'/'.$data_dekrip;
				*/
			}
			
		}
		else {
			echo 'Data sudah semua diupload';
		}
	}
	

?>