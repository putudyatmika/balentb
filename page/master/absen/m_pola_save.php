<legend>Simpan Pola Kerja</legend>
<div class="col-lg-12 col-sm-12">
<?php
if ($_POST['submit_pola']) {
	$pola_nama=$_POST['pola_nama'];
	$masuk[1]=$_POST['senin_masuk'];
	$pulang[1]=$_POST['senin_pulang'];
	$masuk[2]=$_POST['selasa_masuk'];
	$pulang[2]=$_POST['selasa_pulang'];
	$masuk[3]=$_POST['rabu_masuk'];
	$pulang[3]=$_POST['rabu_pulang'];
	$masuk[4]=$_POST['kamis_masuk'];
	$pulang[4]=$_POST['kamis_pulang'];
	$masuk[5]=$_POST['jumat_masuk'];
	$pulang[5]=$_POST['jumat_pulang'];
	$pola_kode=gen_id_char(5);
	for ($i=1;$i<=5;$i++) {
		$pola_save=save_pola_absen($pola_kode,$pola_nama,$i,$masuk[$i],$pulang[$i]);
		if ($pola_save) {
			echo '<p>(Berhasil) Pola Hari '.$nama_hari_indo[$i].' disimpan </p>';
		}
		else {
			echo '<p>(Error) Pola Hari '.$nama_hari_indo[$i].' tidak disimpan </p>';
		}
	}
	
}
else {
	echo '<p>ERORR</p>';
}

?>
</div>