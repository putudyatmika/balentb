<?php
function tgl_hari_ini() { //Hari, 12 Maret 2016
	global $hari_ini,$nama_hari_eng_indo,$nama_bulan_panjang;
	$hari=date('l');
	$bln=date('n');
	$tgl=date('j');
	$tahun=date('Y');
	$hari_ini="$nama_hari_eng_indo[$hari], $tgl $nama_bulan_panjang[$bln] $tahun";
	return $hari_ini;
}
function tgljam_hari_ini() { //Hari, 12 Maret 2016
	global $hari_ini,$nama_hari_eng_indo,$nama_bulan_panjang;
	$hari=date('l');
	$bln=date('n');
	$tgl=date('j');
	$tahun=date('Y');
	$jam=date('H:i');
	$hari_ini="$nama_hari_eng_indo[$hari], $tgl $nama_bulan_panjang[$bln] $tahun Pukul $jam";
	return $hari_ini;
}
function tgl_convert($bahasa,$tgl) { //Selasa, 12 Januari 2016
	//format tahun-bulan-tgl
	global $tanggalan,$nama_hari_eng_indo,$nama_bulan_panjang;
	if ($bahasa==1) {
	$tahun=date("Y",strtotime($tgl));
	$hari=date("l",strtotime($tgl));
	$tgl_=date("j",strtotime($tgl));
	$bulan=date("n",strtotime($tgl));
	$tanggalan="$nama_hari_eng_indo[$hari], $tgl_ $nama_bulan_panjang[$bulan] $tahun";
	}
	else {
		$tanggalan=date("l, j F Y",strtotime($tgl));
	}
	return $tanggalan;
}
function tgl_convert_bln($bahasa,$tgl) { //Sel, 12 Jan 2016
	//format tahun-bulan-tgl
	global $tanggalan,$nama_hari_eng_indo_pendek,$nama_bulan_pendek;
	if ($bahasa==1) {
	$tahun=date("Y",strtotime($tgl));
	$hari=date("l",strtotime($tgl));
	$tgl_=date("j",strtotime($tgl));
	$bulan=date("n",strtotime($tgl));
	$tanggalan="$nama_hari_eng_indo_pendek[$hari], $tgl_ $nama_bulan_pendek[$bulan] $tahun";
	}
	else {
		$tanggalan=date("l, j F Y",strtotime($tgl));
	}
	return $tanggalan;
}
function tgl_convert_waktu($bahasa,$tgl) {
	//format tahun-bulan-tgl hh:mm:ss
	global $tanggalan,$nama_hari_eng_indo,$nama_bulan_panjang;
	if ($bahasa==1) {
	$tahun=date("Y",strtotime($tgl));
	$hari=date("l",strtotime($tgl));
	$tgl_=date("j",strtotime($tgl));
	$bulan=date("n",strtotime($tgl));
	$jam=date("H:i:s",strtotime($tgl));
	$tanggalan="$nama_hari_eng_indo[$hari], $tgl_ $nama_bulan_panjang[$bulan] $tahun $jam";
	}
	else {
		$tanggalan=date("l, j F Y H:i:s",strtotime($tgl));
	}
	return $tanggalan;
}
function tgl_convert_pendek($bahasa,$tgl) {
	//format tahun-bulan-tgl
	global $tanggalan,$nama_bulan_panjang;
	if ($bahasa==1) {
	$tahun=date("Y",strtotime($tgl));
	$hari=date("l",strtotime($tgl));
	$tgl_=date("j",strtotime($tgl));
	$bulan=date("n",strtotime($tgl));
	$tanggalan="$tgl_ $nama_bulan_panjang[$bulan] $tahun";
	}
	else {
		$tanggalan=date("F jS, Y",strtotime($tgl));
	}
	return $tanggalan;
}
function tgl_convert_pendek_bulan($bahasa,$tgl) {
	//format tahun-bulan-tgl
	global $tanggalan,$nama_bulan_pendek;
	if ($bahasa==1) {
	$tahun=date("Y",strtotime($tgl));
	$hari=date("l",strtotime($tgl));
	$tgl_=date("j",strtotime($tgl));
	$bulan=date("n",strtotime($tgl));
	$tanggalan="$tgl_ $nama_bulan_pendek[$bulan] $tahun";
	}
	else {
		$tanggalan=date("F jS, Y",strtotime($tgl));
	}
	return $tanggalan;
}
function tgl_periode_ckp($month = '', $year = '') {
	 global $nama_bulan_pendek;
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
	 $tgl=date('Y-m-d',$result);
	 $tahun=date("Y",strtotime($tgl));
 	 $tgl_=date("j",strtotime($tgl));
 	 $bulan=date("n",strtotime($tgl));
	 $tgl_periode_nya='1 '.$nama_bulan_pendek[$bulan].' - '. $tgl_ .' '. $nama_bulan_pendek[$bulan] .' '. $tahun;
	 return $tgl_periode_nya;
}
function cek_hari_kerja($tgl_hari) {
	$hari_kerja=date("w",strtotime($tgl_hari));
	if ($hari_kerja==0 || $hari_kerja==6) {
		$libur=true;
	}
	else {
		$libur=false;
	}
	return $libur;
}
function cek_hari_libur($tgl_hari) {
	$db_hari = new db();
	$conn_hari = $db_hari -> connect();
	$sql_hari = $conn_hari -> query("select * from hari_libur where tanggal='$tgl_hari'");
	$cek_hari = $sql_hari -> num_rows;
	$data_libur=array("error"=>false);
	if ($cek_hari>0) {
		$r=$sql_hari->fetch_object();
		$data_libur["error"]=false;
		$data_libur["libur_tgl"]=$r->tanggal;
		$data_libur["libur_ket"]=$r->ket;
	}
	else {
		$data_libur["error"]=true;
		$data_libur["pesan_error"]='Data tidak ada';
	}
	return $data_libur;
	$conn_hari -> close();
}
?>
