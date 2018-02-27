<?php
//untuk generate rekap absen bulanan
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
	
	
	if ($peg_id=="all") {
		//semua pegawai di generate
		echo '<p>Generate Semua Pegawai</p>';
		$r_peg=list_pegawai(0,false,true);
		if ($bln_absen<=12) {
			if ($r_peg["error"]==false) {
	    		$total_peg=$r_peg["peg_total"];
	    		$tglku = strtotime($thn_absen.'-'.$bln_absen.'-1');
	    		for ($j=1;$j<=$total_peg;$j++) {
	    			if ($r_peg["item"][$j]["peg_status"]==1) {
	    				$tgl_awal='';
	    				$tgl_akhir='';
	    				$begin='';
	    				$end='';
	    				$tgl_akhir = date("Y-m-t",$tglku);
						$tgl_awal = date("Y-m-d",$tglku);
						$begin = new DateTime($tgl_awal);
						$end   = new DateTime($tgl_akhir);
	    				echo '<p>'.$j.'. Data an. '.$r_peg["item"][$j]["peg_nama"].'<br />';
	    				for($i = $begin; $i <= $end; $i->modify('+1 day')){
			   // echo $i->format("Y-m-d").'<br />';
						if ((date('w',strtotime($i->format("Y-m-d")))>0) and (date('w',strtotime($i->format("Y-m-d")))<=5))	{
							if (cek_generate_rekap($r_peg["item"][$j]["peg_id"],$i->format("Y-m-d"))==false) {
								$hsl_input=input_generate_rekap($r_peg["item"][$j]["peg_id"],$i->format("Y-m-d"),1);
								if ($hsl_input) {
									echo 'Data rekap tanggal '. $i->format("Y-m-d").' tersimpan<br />'; 
								}
								else {
									echo 'Data rekap tanggal '. $i->format("Y-m-d").' error<br />'; 
								}
							}
							else {
								echo 'Data Rekap Tanggal '. $i->format("Y-m-d").' sudah tersimpan<br />'; 
							}
						}
						}
						echo '</p>';


	    				//echo '<option value="'.$r_peg["item"][$i]["peg_id"].'">'.$r_peg["item"][$i]["peg_nama"].'</option>';
	    			}
	    			else {

	    			}
	    		}
    		}
		}
		else {
			//semua pegawai selama 1 tahun
		}
	}
	else {
		$r_peg=peg_jabatan_absen($peg_id);
		//1 pegawai di generate
		echo '<p>Generate Pegawai an. '.$r_peg["peg_nama"].'</p>';
		if ($bln_absen<=12) {
			$tglku = strtotime($thn_absen.'-'.$bln_absen.'-1');
			$tgl_akhir = date("Y-m-t",$tglku);
			$tgl_awal = date("Y-m-d",$tglku);
			$begin = new DateTime($tgl_awal);
			$end   = new DateTime($tgl_akhir);
			//1 bulan saja
			for($i = $begin; $i <= $end; $i->modify('+1 day')) {
			 	//check dulu hari kerja apa hari libur
				//$tgl_cek=date("Y-m-d",strtotime($i->format("Y-m-d")));
				if (cek_hari_kerja($i->format("Y-m-d"))==false) {
					$hari_libur=cek_hari_libur($i->format("Y-m-d"));
					if ($hari_libur["error"]==true) {
						$r_rekap=rekap_bulan_peg_biasa($peg_id,$i->format("Y-m-d"));
						if ($r_rekap["error"]==false) {
							//ada record untuk 1 hari
							$tl=$r_rekap["tl"];
							$psw=$r_rekap["psw"];
							$telat_menit=$r_rekap["telat_masuk_menit"];
							$rekap_hadir=$r_rekap["rekap_hadir"];
						}
						else {
							//tidak ada record untuk 1 hari
							if (date("Y-m-d")<$i->format("Y-m-d")) {
								//check apakah hari ini lebih kecil dari kemaren;
								$tl=0;
								$psw=0;
								$telat_menit=0;
							}
							else {
								$tl=4;
								$psw=4;
								$telat_menit=480;
							}
							$rekap_hadir=0;
						}
						if (cek_gen_rekap_peg($peg_id,$i->format("Y-m-d"))==false) {
							//belum ada record insert lagi
							$hsl_input=input_gen_rekap_peg($peg_id,$i->format("Y-m-d"));
							if ($hsl_input) {
								//berhasil
								$hsl_update=update_rekap_peg($peg_id,$i->format("Y-m-d"),$rekap_hadir,$tl,$psw,$telat_menit);
								if ($hsl_update) { echo 'Data Rekap Tanggal '.$i->format("Y-m-d").' sudah diupdate<br />'; }
								else { echo 'error'; }
							}
							else {
								//error input
								echo 'Data rekap tanggal '. $i->format("Y-m-d").' error<br />'; 
							}
						}
						else {
							//sudah ada recordnya hanya di update
							$hsl_update=update_rekap_peg($peg_id,$i->format("Y-m-d"),$rekap_hadir,$tl,$psw,$telat_menit);
							if ($hsl_update) { echo 'Data Rekap Tanggal '.$i->format("Y-m-d").' sudah diupdate<br />'; }
							else { echo 'error'; }
						}
					}
				} //batas
			}
			
		}	
		else {
			$tglku = strtotime($thn_absen.'-01-01');
			$tgl_awal = date("Y-m-d",$tglku);
			$begin = new DateTime($tgl_awal);
			$tglakhir = strtotime($thn_absen.'-12-01');
			$tgl_akhir = date("Y-m-t",$tglakhir);
			$end   = new DateTime($tgl_akhir);
			//semua bulan
			for($i = $begin; $i <= $end; $i->modify('+1 day')) {
			   // echo $i->format("Y-m-d").'<br />';
				
			}
		}
		}
	

}
?>