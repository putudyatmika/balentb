<?php
/*
(baleite) Monitoring Kegiatan BPS Provinsi NTB
Created by I Putu Dyatmika
Tgl 1 Desember 2016

*/
//variabel-variabel

$ver_app='1.0.0';
$ver_db='1.0.0';
date_default_timezone_set('Asia/Makassar');
//variabel-variabel
$pengacak='Jb##ndhBN**adj##%)%hdn8xx60;:0621##213.#..12??//><LSjjds31-+~~=276';
$nama_bulan_panjang=array (1 => 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
$nama_bulan_pendek=array (1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
$nama_hari_indo = array (0=> "Minggu", 1=> "Senin", 2=> "Selasa", 3=> "Rabu", 4=> "Kamis", 5=> "Jumat", 6=> "Sabtu");
$nama_hari_eng_indo= array ("Sunday" => "Minggu", "Monday"=> "Senin","Tuesday" => "Selasa","Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jumat", "Saturday" => "Sabtu");
$lvl_user=array(1=>'Operator Kab/Kota',2=>'Operator Prov',3=>"Pemantau",4=>"Admin",5=>"SuperAdmin",);
$status_umum=array(0=>'Tidak Aktif',1=>'Aktif');
$JenisKelamin=array(1=>'Laki-Laki',2=>'Perempuan');
$JenisUnit=array(1=>'Provinsi',2=>'Kabupaten');
$unit_eselon=array(1=>'I',2=>'II',3=>'III',4=>'IV');
?>
