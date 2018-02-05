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
			for($i = $begin; $i <= $end; $i->modify('+1 day')){
			   // echo $i->format("Y-m-d").'<br />';
			if ((date('w',strtotime($i->format("Y-m-d")))>0) and (date('w',strtotime($i->format("Y-m-d")))<=5))	{
				if (cek_generate_rekap($peg_id,$i->format("Y-m-d"))==false) {
					$hsl_input=input_generate_rekap($peg_id,$i->format("Y-m-d"),1);
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
			
		}	
		else {
			$tglku = strtotime($thn_absen.'-01-01');
			$tgl_awal = date("Y-m-d",$tglku);
			$begin = new DateTime($tgl_awal);
			$tglakhir = strtotime($thn_absen.'-12-01');
			$tgl_akhir = date("Y-m-t",$tglakhir);
			$end   = new DateTime($tgl_akhir);
			//semua bulan
			for($i = $begin; $i <= $end; $i->modify('+1 day')){
			   // echo $i->format("Y-m-d").'<br />';
				if ((date('w',strtotime($i->format("Y-m-d")))>0) and (date('w',strtotime($i->format("Y-m-d")))<=5))	{
				if (cek_generate_rekap($peg_id,$i->format("Y-m-d"))==false) {
					$hsl_input=input_generate_rekap($peg_id,$i->format("Y-m-d"),1);
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
		}
	}

}
else {
?>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<thead>
 	<tr>
 		<th>#</th>
 		<th>Peg ID</th>
 		<th>Nama</th>
 		<th>Tgl</th>
 		<th>Pola</th>
 		<th>Kehadiran</th>
 		<th>Masuk</th>
 		<th>Pulang</th>
 		<th>Keluar</th>
 		<th>Kembali</th>
 		<th colspan="3">&nbsp;</th>
 	</tr>
 </thead>
 <tbody>
 
 </tbody>
</table>
</div>
<?php } ?>