<?php
//view hasil generate rekap bulanan
if (isset($_POST['sdate'])) { $sdate=$_POST['sdate']; }
else { $sdate=date("Y-m-d"); }

if (isset($_POST["generate_rekap"])) {
	$peg_id=$_POST['peg_id'];
	$bln_absen=$_POST['bln_absen'];
	$thn_absen=$_POST['thn_absen'];
}
else {
	$peg_id="";
	$bln_absen=date("n");
	$thn_absen=date("Y");
}
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
    				if ($r_peg["item"][$i]["peg_id"]==$peg_id) { $pilih_peg='selected="selected"'; }
    				else { $pilih_peg=''; }
    				echo '<option value="'.$r_peg["item"][$i]["peg_id"].'" '.$pilih_peg.'>'.$r_peg["item"][$i]["peg_nama"].'</option>';
    			}
    		}
    	}

    	?>
    	<option value="all">Semua Pegawai</option>
    </select>
    <select name="bln_absen" class="form-control input-sm">
    	<option value="">Bulan</option>
    	<?php 
    	//$bln_skrg=date("n");
    	for ($i=1;$i<=12;$i++) {
    		if ($i==$bln_absen) { $pilih_bln='selected="selected"'; }
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
  <button type="submit" name="generate_rekap" class="btn btn-default btn-sm">View Data</button>
</form>

<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<thead>
 	<tr>
 		<th>#</th>
 		<th>Peg ID</th>
 		<th>Nama</th>
 		<th>Tgl</th>
 		<th>Hadir</th>
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
 <?php
 	if ($peg_id=="all") {
 		//tampilkan semua pegawai dalam 1 bulan
 	}
 	else {
 		//tampilan rekap absen 1 pegawai dalam 1 bulan
 		$r_rekap=list_rekap_bulan_peg($peg_id,$bln_absen,$thn_absen);
 		if ($r_rekap["error"]==false) {
 			$max_rekap=$r_rekap["total_rekap"];
			for ($i=1;$i<=$max_rekap;$i++) {
				echo '
<tr>
 		<td>'.$r_rekap["item"][$i]["rekap_id"].'</td>
 		<td>'.$r_rekap["item"][$i]["peg_id"].'</td>
 		<td>'.$r_rekap["item"][$i]["peg_nama"].'</td>
 		<td>'.$r_rekap["item"][$i]["rekap_tgl"].'</td>
 		<td>'.$r_rekap["item"][$i]["rekap_hadir"].'</td>
 		<td>'.$r_rekap["item"][$i]["tl1"].'</td>
 		<td>'.$r_rekap["item"][$i]["tl2"].'</td>
 		<td>'.$r_rekap["item"][$i]["tl3"].'</td>
 		<td>'.$r_rekap["item"][$i]["tl4"].'</td>
 		<td>'.$r_rekap["item"][$i]["psw1"].'</td>
 		<td>'.$r_rekap["item"][$i]["psw2"].'</td>
 		<td>'.$r_rekap["item"][$i]["psw3"].'</td>
 		<td>'.$r_rekap["item"][$i]["psw4"].'</td>
 		<td>'.$r_rekap["item"][$i]["total_telat_menit"].'</td>
 		<td colspan="3">&nbsp;</td>
 	</tr>
				';

			}
 		}
 		else {
 			echo '
 			<tr>
 				<td colspan="17">'.$r_rekap["pesan_error"].'</td> 
 			</tr>

 			';
 		}
 	}

 ?>
 </tbody>
</table>
</div>
