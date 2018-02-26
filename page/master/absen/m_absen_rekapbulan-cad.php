<?php
if (isset($_POST['sdate'])) { $sdate=$_POST['sdate']; }
else { $sdate=date("Y-m-d"); }
?>
<legend>Rekap Absen Karyawan</legend>
<form class="form-inline" method="post">
  <div class="form-group" id="tgl_mulai_keg">
    <label for="sdate">Pilih</label>
    <select name="peg_id" class="form-control input-sm">
    	<option value="">Nama Pegawai</option>
    	<?php
    	$r_peg=list_pegawai(0,false,true);
    	if ($r_peg["error"]==false) {
    		$total_peg=$r_peg["peg_total"];
    		for ($i=1;$i<=$total_peg;$i++) {
    			if ($r_peg["item"][$i]["peg_status"]==1) {
    			echo '<option value="'.$r_peg["item"][$i]["peg_id"].'">'.$r_peg["item"][$i]["peg_nama"].'</option>';
    		}
    		}
    	}

    	?>
    	<option value="all">Semua Pegawai</option>
    </select>
    <select name="bln_absen" class="form-control input-sm">
    	<option value="">Bulan</option>
    	<?php 
    	$bln_skrg=date("n");
    	for ($i=1;$i<=12;$i++) {
    		if ($i==$bln_skrg) { $pilih_bln='selected="selected"'; }
    		else { $pilih_bln=''; }
    		echo '<option value="'.$i.'" '.$pilih_bln.'>'.$nama_bulan_panjang[$i].'</option>';
    	}
    	?>
    	<option value="13">Semua Bulan</option>
    </select>
     <select name="thn_absen" class="form-control input-sm">
    	<option value="">Tahun</option>
    	<?php
    	$thn_skrg=date("Y");
    	for ($j=($thn_skrg-2);$j<=($thn_skrg+1);$j++) {
    		if ($j==$thn_skrg) { $pilih_thn='selected="selected"'; }
    		else { $pilih_thn=''; }
    		echo '<option value="'.$j.'" '.$pilih_thn.'>'.$j.'</option>';

    	}
    	?>
    </select>
  </div>
  <button type="submit" name="generate_rekap" class="btn btn-default btn-sm">Generate</button>
</form>
<?php
if (isset($_POST["generate_rekap"])) {
	$peg_id=$_POST['peg_id'];
	$bln_absen=$_POST['bln_absen'];
	$thn_absen=$_POST['thn_absen'];
	$tglku='';
	$tgl_awal='';
	$tgl_akhir='';
	$begin='';
	$end='';
	//cek untuk 1 org pegawai atau semua pegawai
	if ($peg_id=="all") {
		//semua upegawai
	}
	else {
		//untuk 1 orang pegawai
		$r_peg=peg_jabatan_absen($peg_id);
		echo '<p>Generate Pegawai an. ('.$peg_id.') '.$r_peg["peg_nama"].'</p>';
		//check bulan yang dipilih setahun apa perbulan
		if ($bln_absen<=12) {
			//hanya 1 bulan saja
			$tglku = strtotime($thn_absen.'-'.$bln_absen.'-1');
			$tgl_akhir = date("Y-m-t",$tglku);
			$tgl_awal = date("Y-m-d",$tglku);
			$begin = new DateTime($tgl_awal);
			$end   = new DateTime($tgl_akhir);
			for($i = $begin; $i <= $end; $i->modify('+1 day')) {
				//check dulu hari kerja apa hari libur
				//$tgl_cek=date("Y-m-d",strtotime($i->format("Y-m-d")));
				if (cek_hari_kerja($i->format("Y-m-d"))==false) {
					$hari_libur=cek_hari_libur($i->format("Y-m-d"));
					if ($hari_libur["error"]==true) {
						if (cek_gen_rekap_peg($peg_id,$i->format("Y-m-d"))==false) {
							//belum ada record insert lagi
							$hsl_input=input_gen_rekap_peg($peg_id,$i->format("Y-m-d"));
							if ($hsl_input) {
								//berhasil
								echo 'Data rekap tanggal '. $i->format("Y-m-d").' tersimpan<br />'; 
							}
							else {
								//error input
								echo 'Data rekap tanggal '. $i->format("Y-m-d").' error<br />'; 
							}
						}
						else {
							//sudah ada recordnya
							echo 'Data Rekap Tanggal '.$i->format("Y-m-d").' sudah tersimpan<br />';
						}
					}
					else {
						echo 'Data Rekap Tanggal '.$i->format("Y-m-d").' Hari Libur (tidak tersimpan)<br />';
					}
				} //batas
				else {
					echo 'Data Rekap Tanggal '.$i->format("Y-m-d").' Hari Libur Jumat Sabtu<br />';
				}
									
			} //batas for
		} //batas 1 bulan saja
		else {
			//semua tanggal dlm setahun
			$tglku = strtotime($thn_absen.'-01-01');
			$tgl_awal = date("Y-m-d",$tglku);
			$begin = new DateTime($tgl_awal);
			$tglakhir = strtotime($thn_absen.'-12-01');
			$tgl_akhir = date("Y-m-t",$tglakhir);
			$end   = new DateTime($tgl_akhir);
			for($i = $begin; $i <= $end; $i->modify('+1 day')) {
				//check dulu hari kerja apa hari libur
				//$tgl_cek=date("Y-m-d",strtotime($i->format("Y-m-d")));
				if (cek_hari_kerja($i->format("Y-m-d"))==false) {
					$hari_libur=cek_hari_libur($i->format("Y-m-d"));
					if ($hari_libur["error"]==true) {
						if (cek_gen_rekap_peg($peg_id,$i->format("Y-m-d"))==false) {
							//belum ada record insert lagi
							$hsl_input=input_gen_rekap_peg($peg_id,$i->format("Y-m-d"));
							if ($hsl_input) {
								//berhasil
								echo 'Data rekap tanggal '.$i->format("Y-m-d").' tersimpan<br />'; 
							}
							else {
								//error input
								echo 'Data rekap tanggal '.$i->format("Y-m-d").' error<br />'; 
							}
						}
						else {
							//sudah ada recordnya
							echo 'Data Rekap Tanggal '.$i->format("Y-m-d").' sudah tersimpan<br />';
						}
					}
				} //batas
					
			} //batas for
		} //batas 12 bulan
		
	} //batas untuk 1 orang
}
else {
	//belum ada klik tombol generate
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<thead>
 	<tr>
 		<th>#</th>
 		<th>Peg ID</th>
 		<th>Nama</th>
 		<th>Tgl</th>
 		<th>TL1</th>
 		<th>TL2</th>
 		<th>TL3</th>
 		<th>TL4</th>
 		<th>PSW1</th>
 		<th>PSW2</th>
 		<th>PSW3</th>
 		<th>PSW4</th>
 		<th>Total Telat</th>
 		<th colspan="3">&nbsp;</th>
 	</tr>
 </thead>
 <tbody>
 
 </tbody>
</table>
</div>
<?php } ?>