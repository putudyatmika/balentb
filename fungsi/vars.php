<?php
/*
(balentb) Monitoring Kegiatan BPS Provinsi NTB
Created by I Putu Dyatmika
Tgl 1 Desember 2016

*/
//variabel-variabel

$ver_app='1.3.2';
$ver_db='1.3.2';
date_default_timezone_set('Asia/Makassar');
//variabel-variabel
$pengacak='Jb##ndhBN**adj##%)%hdn8xx60;:0621##213.#..12??//><LSjjds31-+~~=276';
$cryptKey  = 'huxLLLnHHJjdfa652jdhHHGKnzhanleipz$$@a9832VZQzzsmpohahdg156';
$nama_bulan_panjang=array (1 => 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
$nama_bulan_pendek=array (1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
$nama_hari_indo = array (0=> "Minggu", 1=> "Senin", 2=> "Selasa", 3=> "Rabu", 4=> "Kamis", 5=> "Jumat", 6=> "Sabtu");
$nama_hari_pendek = array (0=> "Min", 1=> "Sen", 2=> "Sel", 3=> "Rab", 4=> "Kam", 5=> "Jum", 6=> "Sab");
$nama_hari_eng_indo= array ("Sunday" => "Minggu", "Monday"=> "Senin","Tuesday" => "Selasa","Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jumat", "Saturday" => "Sabtu");
$nama_hari_eng_indo_pendek= array ("Sunday" => "Min", "Monday"=> "Sen","Tuesday" => "Sel","Wednesday" => "Rab", "Thursday" => "Kam", "Friday" => "Jum", "Saturday" => "Sab");
$lvl_user=array(1=>"Pemantau",2=>'Operator Kab/Kota',3=>'Operator Prov',4=>"Admin",5=>"SuperAdmin",);
$status_umum=array(0=>'Tidak Aktif',1=>'Aktif');
$JenisKelamin=array(1=>'Laki-Laki',2=>'Perempuan');
$JenisUnit=array(1=>'Provinsi',2=>'Kabupaten');
$JenisJabatan=array(1=>'Kepala',2=>'Staf',3=>"CS/Satpam",4=>"Tugas Belajar");
$unit_eselon=array(1=>'I',2=>'II',3=>'III',4=>'IV');
$JenisKegiatan=array(1=>'Bulanan',2=>'Triwulanan',3=>'Semesteran',4=>'Tahunan',5=>'Subround',6=>'AdHoc');
$JenisDetilKegiatan=array(1=>'Pengiriman',2=>'Penerimaan');
$TahunDefault=date('Y');
$StatusSPJ=array(1=>'<span class="label label-success">Ya</span',2=>'<span class="label label-danger">Tidak</span>');
//pengaturan absen
$JamMasuk='07:30:00';
$JamPulang='16:00:00';
$JamPulangJumat='17:00:00';
$JamKeluarIstirahat='12:30:00';
$JamKembaliIstirahat='13:30:00';
$JamKeluarJumat='12:00:00';
$JamKembaliJumat='14:00:00';
//absen untuk bulan puasa
$AbsenMasukPuasa='08:00:00';
$AbsenPulangPuasa='15:00:00';
$AbsenPulangJumatPuasa='15:30:00';
$ip_server_absen='10.52.6.235';
$KodeMesinAbsen=array(0=>'Masuk',1=>'Pulang',2=>'Keluar',3=>'Kembali',4=>'Masuk Lembur',5=>'Pulang Lembur');
$JenisHariAbsen=array(0=>"Tanpa Keterangan",1=>"Kerja",2=>"Sakit",3=>"Ijin",4=>"Cuti",5=>"Dinas Luar",6=>"Libur Nasional",7=>"Libur Lainnya");
$JenisTelatMasuk=array(1=>"TL. 1",2=>"TL. 2",3=>"TL. 3",4=>"TL. 4");
$JenisPulangCepat=array(1=>"PSW. 1",2=>"PSW. 2",3=>"PSW. 3",4=>"PSW. 4");
?>
