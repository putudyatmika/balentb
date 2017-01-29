<?php
function get_id_kegiatan($NamaKegiatan,$waktu_save,$pembuat) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select * from kegiatan where keg_nama='$NamaKegiatan' and keg_dibuat_waktu='$waktu_save' and keg_dibuat_oleh='$pembuat'");
	$cek=$sql_id_keg->num_rows;
	if ($cek>0) {
	   $id_keg='';
	   $r=$sql_id_keg->fetch_object();
	   $id_keg=$r->keg_id;
	}
	else {
	 $id_keg='';
	}
	return $id_keg;
	$conn_keg->close();
	}
function get_nama_kegiatan($keg_id) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select keg_nama from kegiatan where keg_id='$keg_id'");
	$cek=$sql_id_keg->num_rows;
	if ($cek>0) {
	   $keg_nama='';
	   $r=$sql_id_keg->fetch_object();
	   $keg_nama=$r->keg_nama;
	}
	else {
	 $keg_nama='';
	}
	return $keg_nama;
	$conn_keg->close();
}
function get_unitkerja_kegiatan($keg_id) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select keg_unitkerja from kegiatan where keg_id='$keg_id'");
	$cek=$sql_id_keg->num_rows;
	if ($cek>0) {
	   $keg_unitkerja='';
	   $r=$sql_id_keg->fetch_object();
	   $keg_unitkerja=$r->keg_unitkerja;
	}
	else {
	 $keg_unitkerja='';
	}
	return $keg_unitkerja;
	$conn_keg->close();
}
function cek_kegiatan($NamaKegiatan,$unit_keg) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select * from kegiatan where keg_nama='$NamaKegiatan' and keg_unitkerja='$unit_keg'");
	$cek=$sql_id_keg->num_rows;
	if ($cek>0) {
	   $cek_keg=1;
	}
	else {
	 $cek_keg=0;
	}
	return $cek_keg;
	$conn_keg->close();
}
function jenis_detil_keg($keg_d_id) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select * from keg_detil where keg_d_id='$keg_d_id'");
	$cek=$sql_id_keg->num_rows;
	if ($cek>0) {
	   $jenis_keg=$r->keg_d_jenis;
	}
	else {
	 $jenis_keg='';
	}
	return $jenis_keg;
	$conn_keg->close();
}
function cek_id_kegiatan($keg_id) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select * from kegiatan where keg_id='$keg_id'");
	$cek=$sql_id_keg->num_rows;
	if ($cek>0) {
	   $cek_keg=1;
	}
	else {
	 $cek_keg=0;
	}
	return $cek_keg;
	$conn_keg->close();
}
function get_tgl_kegiatan($keg_id) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select * from kegiatan where keg_id='$keg_id'");
	$cek=$sql_id_keg->num_rows;
	if ($cek>0) {
	   $r=$sql_id_keg->fetch_object();
	   $tgl_kegiatan=$r->keg_end;
	}
	else {
		$tgl_kegiatan='';
	}
	return $tgl_kegiatan;
	$conn_keg->close();
}
function get_detil_kegiatan($keg_id,$keg_d_unitkerja,$jenis_keg) {
	global $url, $page;
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select * from keg_detil where keg_id='$keg_id' and keg_d_unitkerja='$keg_d_unitkerja' and keg_d_jenis='$jenis_keg' order by keg_d_tgl asc");
	$cek=$sql_d_keg->num_rows;
	$d_keg='';
	$d_jml='';
	$link='';
	$link_laci='';
	if ($cek>0) {
		if ($jenis_keg==1) $edit_d='editkirim';
		else $edit_d='editterima';
		while ($r=$sql_d_keg->fetch_object()) {
			$link="$r->keg_d_link_laci";
			if ($r->keg_d_link_laci == null) $link_laci='';
			else $link_laci='<a href="'.$link.'" target="_blank">File</a>';
			
			if ($_SESSION['sesi_level'] > 1) {
				if ($_SESSION['sesi_level'] > 2) {
					$link_crud='<a href="'.$url.'/'.$page.'/'.$edit_d.'/'.$r->keg_d_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a> <a href="'.$url.'/'.$page.'/deletedetil/'.$r->keg_d_id.'" data-confirm="Apakah data ('.$r->keg_d_id.') ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>';
				}
				else {
					if ($_SESSION['sesi_unitkerja']==$r->keg_d_unitkerja and $jenis_keg==1) {
						$link_crud='<a href="'.$url.'/'.$page.'/'.$edit_d.'/'.$r->keg_d_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a> <a href="'.$url.'/'.$page.'/deletedetil/'.$r->keg_d_id.'" data-confirm="Apakah data ('.$r->keg_d_id.') ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>';
					}
					else {
						$link_crud='';
					}
					//$link_crud='';
				}
			}
			else {
				$link_crud='';
			}
			
			$d_keg .= tgl_convert_pendek_bulan(1,$r->keg_d_tgl) .' Jml '. $r->keg_d_jumlah .' ('.$r->keg_d_ket.') '.$link_laci.' '.$link_crud.'<br />';
			$d_jml += $r->keg_d_jumlah;
		}
		$detil_keg=array($d_keg,$d_jml);
	}
	else {
		$detil_keg=array('',0);
	}
	return $detil_keg;
	$conn_keg->close();
}
function get_keg_realisasi($keg_id, $keg_jenis) {
	$keg_jml='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select sum(keg_d_jumlah) as jumlah from keg_detil where keg_id='$keg_id' and keg_d_jenis='$keg_jenis'");
	$r=$sql_d_keg->fetch_object();
	$keg_jml=$r->jumlah;
	return $keg_jml;
	$conn_keg->close();
}
function get_keg_kabkota_realisasi($keg_id,$unit_kabkota, $keg_jenis) {
	$keg_jml='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select sum(keg_d_jumlah) as jumlah from keg_detil where keg_id='$keg_id' and keg_d_unitkerja='$unit_kabkota' and keg_d_jenis='$keg_jenis'");
	$r=$sql_d_keg->fetch_object();
	$keg_jml=$r->jumlah;
	return $keg_jml;
	$conn_keg->close();
}
function get_keg_kabkota_target($keg_id,$unit_kabkota) {
	$keg_t_target='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select * from keg_target where keg_id='$keg_id' and keg_t_unitkerja='$unit_kabkota'");
	$r=$sql_d_keg->fetch_object();
	$keg_t_target=$r->keg_t_target;
	return $keg_t_target;
	$conn_keg->close();
}
function get_nilai_kegiatan($keg_id,$keg_unitkerja) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select * from keg_detil where keg_id='$keg_id' and keg_d_unitkerja='$keg_unitkerja' and keg_d_jenis='2' order by keg_d_tgl asc");
	$cek=$sql_d_keg->num_rows;
	if ($cek>0) {
		$keg_nilai='';
		$nilai_waktu='';
		$nilai_volume='';
		$nilai_vol='';
		$batas_waktu=get_tgl_kegiatan($keg_id);
		$kabkota_target=get_keg_kabkota_target($keg_id,$keg_unitkerja);
		
		while ($r=$sql_d_keg->fetch_object()) {
			$nilai_vol+=$r->keg_d_jumlah;
			$target_waktu = new DateTime($batas_waktu);
			$pengiriman = new DateTime($r->keg_d_tgl);
			$interval = $pengiriman->diff($target_waktu);
			$int=$interval->format('%r%a');

			if ($int>4) $nilai_wkt=5;
			elseif ($int>1) $nilai_wkt=3;
			elseif ($int>=0) $nilai_wkt=1;
			else $nilai_wkt=0;

			$nilai_waktu+=$nilai_wkt;
		}
		$nilai_waktu=($nilai_waktu/$cek);
		$persen_vol=($nilai_vol/$kabkota_target)*100;
		if ($persen_vol>99) $nilai_volume=5;
		elseif ($persen_vol>89) $nilai_volume=3;
		elseif ($persen_vol>79) $nilai_volume=1;
		else $nilai_volume=0;
		$nilai_total=($nilai_volume*0.70)+($nilai_waktu*0.30);
		$keg_nilai=array($nilai_waktu,$nilai_volume,$nilai_total);
		
	}
	else {
		$keg_nilai='';
	}
	return $keg_nilai;
	$conn_keg->close();
}
?>
