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
function cek_spj_kegiatan($keg_id) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_id_keg = $conn_keg -> query("select * from kegiatan where keg_id='$keg_id'");
	$cek=$sql_id_keg->num_rows;
	$cek_spj='';
	if ($cek>0) {
	   $r=$sql_id_keg->fetch_object();
	   $cek_spj=$r->keg_spj;
	}
	else {
	   $cek_spj='';
	}
	return $cek_spj;
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
	$d_jml=0;
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
					if ($_SESSION['sesi_level'] == 3 and $jenis_keg==2 ) {
					$link_crud='<a href="'.$url.'/'.$page.'/'.$edit_d.'/'.$r->keg_d_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a> <a href="'.$url.'/'.$page.'/deletedetil/'.$r->keg_d_id.'" data-confirm="Apakah data ('.$r->keg_d_id.') ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>';
					}
					elseif ($_SESSION['sesi_level'] > 3 ) {
					$link_crud='<a href="'.$url.'/'.$page.'/'.$edit_d.'/'.$r->keg_d_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a> <a href="'.$url.'/'.$page.'/deletedetil/'.$r->keg_d_id.'" data-confirm="Apakah data ('.$r->keg_d_id.') ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>';
					}
					else { //level operator provinsi
						$link_crud='';
					}

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
		$keg_nilai=0;
		$nilai_waktu=0;
		$nilai_volume=0;
		$nilai_vol=0;
		$batas_waktu=get_tgl_kegiatan($keg_id);
		$kabkota_target=get_keg_kabkota_target($keg_id,$keg_unitkerja);
		
		while ($r=$sql_d_keg->fetch_object()) {
			$nilai_vol+=$r->keg_d_jumlah;
			$target_waktu = new DateTime($batas_waktu);
			$pengiriman = new DateTime($r->keg_d_tgl);
			$interval = $pengiriman->diff($target_waktu);
			$int=$interval->format('%r%a');

			if ($int>=1) $nilai_wkt=5;
			elseif ($int>=0) $nilai_wkt=4;
			elseif ($int>=-1) $nilai_wkt=3;
			elseif ($int>=-2) $nilai_wkt=2;
			elseif ($int>=-3) $nilai_wkt=1;
			else $nilai_wkt=0;

			$nilai_waktu+=$nilai_wkt;
		}
		$nilai_waktu=($nilai_waktu/$cek);
		$persen_vol=($nilai_vol/$kabkota_target)*100;
		if ($persen_vol>94) $nilai_volume=5;
		elseif ($persen_vol>89) $nilai_volume=3;
		elseif ($persen_vol>85) $nilai_volume=1;
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
function get_detil_spj($keg_id,$spj_d_unitkerja,$jenis_keg) {
	global $url, $page;
	$db_spj = new db();
	$conn_spj = $db_spj->connect();
	$sql_d_spj = $conn_spj -> query("select * from spj_detil where keg_id='$keg_id' and spj_d_unitkerja='$spj_d_unitkerja' and spj_d_jenis='$jenis_keg' order by spj_d_tgl asc");
	$cek=$sql_d_spj->num_rows;
	$d_keg='';
	$d_jml=0;
	$link='';
	$link_laci='';
	if ($cek>0) {
		if ($jenis_keg==1) $edit_d='editkirimspj';
		else $edit_d='editterimaspj';
		while ($r=$sql_d_spj->fetch_object()) {
			$link="$r->spj_d_link_laci";
			if ($r->spj_d_link_laci == null) $link_laci='';
			else $link_laci='<a href="'.$link.'" target="_blank">File</a>';
			
			if ($_SESSION['sesi_level'] > 1) {
				if ($_SESSION['sesi_level'] > 2) {
					if ($_SESSION['sesi_level'] > 3) {
					$link_crud='<a href="'.$url.'/'.$page.'/'.$edit_d.'/'.$r->spj_d_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a> <a href="'.$url.'/'.$page.'/deletedetilspj/'.$r->spj_d_id.'" data-confirm="Apakah data ('.$r->spj_d_id.') ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>';
					}
					else {
						$link_crud='';
					}
				}
				else {
					if ($_SESSION['sesi_unitkerja']==$r->spj_d_unitkerja and $jenis_keg==1) {
						$link_crud='<a href="'.$url.'/'.$page.'/'.$edit_d.'/'.$r->spj_d_id.'"><i class="fa fa-pencil-square text-info" aria-hidden="true"></i></a> <a href="'.$url.'/'.$page.'/deletedetilspj/'.$r->spj_d_id.'" data-confirm="Apakah data ('.$r->spj_d_id.') ini akan di hapus?"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></a>';
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
			
			$d_keg .= tgl_convert_pendek_bulan(1,$r->spj_d_tgl) .' Jml '. $r->spj_d_jumlah .' ('.$r->spj_d_ket.') '.$link_laci.' '.$link_crud.'<br />';
			$d_jml += $r->spj_d_jumlah;
		}
		$detil_spj=array($d_keg,$d_jml);
	}
	else {
		$detil_spj=array('',0);
	}
	return $detil_spj;
	$conn_spj->close();
}
function get_spj_target($keg_id) {
	$spj_t_target='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select sum(keg_s_target) as jumlah from keg_spj where keg_id='$keg_id'");
	$r=$sql_d_keg->fetch_object();
	$spj_t_target=$r->jumlah;
	return $spj_t_target;
	$conn_keg->close();
}
function get_spj_kabkota_target($keg_id,$unit_kabkota) {
	$spj_t_target='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select * from keg_spj where keg_id='$keg_id' and keg_s_unitkerja='$unit_kabkota'");
	$cek_target=$sql_d_keg->num_rows;
	if ($cek_target>0) {
	$r=$sql_d_keg->fetch_object();
	$spj_t_target=$r->keg_s_target;
	}
	else {
		$spj_t_target=0;
	}
	return $spj_t_target;
	$conn_keg->close();
}
function get_spj_realisasi($keg_id,$keg_jenis) {
	$spj_jml='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select sum(spj_d_jumlah) as jumlah from spj_detil where keg_id='$keg_id' and spj_d_jenis='$keg_jenis'");
	$r=$sql_d_keg->fetch_object();
	$spj_jml=$r->jumlah;
	return $spj_jml;
	$conn_keg->close();
}
function get_spj_kabkota_realisasi($keg_id,$unit_kabkota, $keg_jenis) {
	$spj_jml='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select sum(spj_d_jumlah) as jumlah from spj_detil where keg_id='$keg_id' and spj_d_unitkerja='$unit_kabkota' and spj_d_jenis='$keg_jenis'");
	$r=$sql_d_keg->fetch_object();
	$spj_jml=$r->jumlah;
	return $spj_jml;
	$conn_keg->close();
}
function get_nilai_spj($keg_id,$keg_unitkerja) {
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_d_keg = $conn_keg -> query("select * from spj_detil where keg_id='$keg_id' and spj_d_unitkerja='$keg_unitkerja' and spj_d_jenis='2' order by spj_d_tgl asc");
	$cek=$sql_d_keg->num_rows;
	if ($cek>0) {
		$spj_nilai='';
		$nilai_waktu='';
		$nilai_volume='';
		$nilai_vol='';
		$batas_waktu=get_tgl_kegiatan($keg_id);
		$kabkota_target=get_spj_kabkota_target($keg_id,$keg_unitkerja);
		
		while ($r=$sql_d_keg->fetch_object()) {
			$nilai_vol+=$r->spj_d_jumlah;
			$target_waktu = new DateTime($batas_waktu);
			$pengiriman = new DateTime($r->spj_d_tgl);
			$interval = $pengiriman->diff($target_waktu);
			$int=$interval->format('%r%a');

			if ($int>=1) $nilai_wkt=5;
			elseif ($int>=0) $nilai_wkt=4;
			elseif ($int>=-1) $nilai_wkt=3;
			elseif ($int>=-2) $nilai_wkt=2;
			elseif ($int>=-3) $nilai_wkt=1;
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
		$spj_nilai=array($nilai_waktu,$nilai_volume,$nilai_total);
		
	}
	else {
		$spj_nilai='';
	}
	return $spj_nilai;
	$conn_keg->close();
}
function get_ranking_kegiatan($keg_bulan,$keg_tahun,$jenis_nilai) {
	//$jenis_nilai 1=vol, 2=waktu, 3=total 4=rata-rata
	$keg_rangking='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_keg= $conn_keg	-> query("select keg_t_unitkerja, sum(keg_target.keg_t_point_waktu) as point_waktu, sum(keg_target.keg_t_point_jumlah) as point_jumlah, sum(keg_target.keg_t_point) as point_total, avg(keg_target.keg_t_point) as point_rata from keg_target,kegiatan where kegiatan.keg_id=keg_target.keg_id and month(kegiatan.keg_end)='$keg_bulan' and year(kegiatan.keg_end)='$keg_tahun' and keg_target.keg_t_target>0 group by keg_t_unitkerja order by point_rata desc, point_total desc");
	$cek_keg=$sql_keg->num_rows;
	if ($cek_keg>0) {
		$data_rangking[]='';
		while ($k=$sql_keg->fetch_object()) {
			if ($jenis_nilai==1) {
				$data_rangking[]=number_format($k->point_jumlah,2,".",",");
			}
			elseif ($jenis_nilai==2) {
				$data_rangking[]=number_format($k->point_waktu,2,".",",");
			}
			elseif ($jenis_nilai==3) {
				$data_rangking[]=number_format($k->point_total,2,".",",");
			}
			elseif ($jenis_nilai==4) {
				$data_rangking[]=number_format($k->point_rata,4,".",",");
			}
			else {
				$data_rangking[]='';
			}
		}
		$keg_rangking=$data_rangking;
	}
	else {
		$keg_rangking='';
	}
	return $keg_rangking;
	$conn_keg->close();
}
function get_ranking_kabkota($keg_bulan,$keg_tahun) {
	$kabkota_rangking='';
	$db_keg = new db();
	$conn_keg = $db_keg->connect();
	$sql_keg= $conn_keg	-> query("select keg_t_unitkerja, count(*) as keg_jml, sum(keg_target.keg_t_target) as keg_jml_target, sum(keg_target.keg_t_point_waktu) as point_waktu, sum(keg_target.keg_t_point_jumlah) as point_jumlah, sum(keg_target.keg_t_point) as point_total, avg(keg_target.keg_t_point) as point_rata from keg_target,kegiatan where kegiatan.keg_id=keg_target.keg_id and month(kegiatan.keg_end)='$keg_bulan' and year(kegiatan.keg_end)='$keg_tahun' and keg_target.keg_t_target>0 group by keg_t_unitkerja order by point_rata desc, point_total desc");
	$cek_keg=$sql_keg->num_rows;
	if ($cek_keg>0) {
		$data_kabkota[]='';
		while ($k=$sql_keg->fetch_object()) {
			$nama_unit=get_nama_unit($k->keg_t_unitkerja);
			$data_kabkota[]=$nama_unit;
		}
		$kabkota_rangking=$data_kabkota;
	}
	else {
		$kabkota_rangking='';
	}
	return $kabkota_rangking;
	$conn_keg->close();
}
function progress_kegiatan($keg_id) {
	$db_keg = new db();
	$conn_keg = $db_keg -> connect();
	$sql_kegiatan = $conn_keg -> query("select keg_id,keg_d_jenis,sum(keg_d_jumlah) as jumlah from keg_detil where keg_id='$keg_id' group by keg_d_jenis order by keg_d_jenis asc") or die(mysqli_error($conn_keg));
	$cek=$sql_kegiatan->num_rows;
	$data_keg=array("error"=>false);
	if ($cek > 0) {
		$data_keg["error"]=false;
		$data_keg["jenis_total"]=$cek;
		$i=1;
		while ($r=$sql_kegiatan->fetch_object()) {
			$data_keg["item"][$i]=array(
				"keg_id"=>$r->keg_id,
				"jenis_id"=>$r->keg_d_jenis,
				"jenis_jumlah"=>$r->jumlah
			);
			$i++;
		}
	}
	else {
		$data_keg["error"]=true;
		$data_keg["pesan_error"]='Data tidak tersedia';
	}
	return $data_keg;
	$conn_keg->close();
}

function list_target_keg_spj_kabkota($keg_id) {
	$db_keg = new db();
	$conn_keg = $db_keg -> connect();
	$sql_target= $conn_keg -> query("select unit.unit_kode, unit.unit_nama, unit.unit_parent, keg_unit.*, keg_spj.* from (select * from unitkerja where unit_jenis='2') as unit left join (select * from keg_target where keg_id='$keg_id') as keg_unit on unit.unit_kode=keg_unit.keg_t_unitkerja LEFT join keg_spj on keg_spj.keg_id=keg_unit.keg_id and keg_spj.keg_s_unitkerja=unit.unit_kode order by unit.unit_kode asc") or die(mysqli_error($conn_keg));
	$cek=$sql_target->num_rows;
	$data_keg=array("error"=>false);
	if ($cek>0) {
		$data_keg["error"]=false;
		$data_keg["target_total"]=$cek;
		$i=1;
		while ($r=$sql_target->fetch_object()) {
			$data_keg["item"][$i]=array(
				"keg_id"=>$r->keg_id,
				"target_id"=>$r->keg_t_id,
				"target_unitkerja"=>$r->unit_kode,
				"target_unitnama"=>$r->unit_nama,
				"target_unitparent"=>$r->unit_parent,
				"target_jumlah"=>$r->keg_t_target,
				"target_dibuat_oleh"=>$r->keg_t_dibuat_oleh,
				"target_dibuat_waktu"=>$r->keg_t_dibuat_waktu,
				"target_diupdate_oleh"=>$r->keg_t_diupdate_oleh,
				"target_diupdate_waktu"=>$r->keg_t_diupdate_waktu,
				"target_poin_waktu"=>$r->keg_t_point_waktu,
				"target_poin_jumlah"=>$r->keg_t_point_jumlah,
				"target_poin_total"=>$r->keg_t_point,
				"spj_id"=>$r->keg_s_id,
				"spj_jumlah"=>$r->keg_s_target,
				"spj_dibuat_oleh"=>$r->keg_s_dibuat_oleh,
				"spj_dibuat_waktu"=>$r->keg_s_dibuat_waktu,
				"spj_diupdate_oleh"=>$r->keg_s_diupdate_oleh,
				"spj_diupdate_waktu"=>$r->keg_s_diupdate_waktu,
				"spj_poin_waktu"=>$r->keg_s_point_waktu,
				"spj_poin_jumlah"=>$r->keg_s_point_jumlah,
				"spj_poin_total"=>$r->keg_s_point,
			);
			$i++;
		}
	}
	else {
		$data_keg["error"]=true;
		$data_keg["pesan_error"]='Data tidak tersedia';
	}
	return $data_keg;
	$conn_keg->close();
}
?>
