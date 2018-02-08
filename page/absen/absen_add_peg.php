	<legend>Entri data log absen karyawan</legend>
	<?php
	$peg_id=$lvl3;
	
	$r_absen=peg_jabatan_absen($peg_id);
	if ($r_absen["error"]==false) {
		$peg_nama=$r_absen["peg_nama"];
		$tgl_absen=date("Y-m-d",$lvl4);
		
	?>
		<form id="formLogAbsen" name="formAddPegawaiAbsen" action="<?php echo $url.'/'.$page;?>/savepeg/"  method="post" class="form-horizontal well" role="form">
		<fieldset>
		<div class="form-group">
			<label for="peg_id" class="col-sm-3 control-label">ID Absen Pegawai</label>

				<div class="col-lg-4 col-sm-4">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="peg_id" class="form-control" value="<?php echo $peg_id;?>" placeholder="ID Absen di Mesin" disabled/>
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_nama" class="col-sm-3 control-label">Nama</label>

				<div class="col-lg-7 col-sm-7">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="peg_nama" class="form-control" value="<?php echo $peg_nama;?>" placeholder="nama lengkap tanpa gelar" disabled />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_nama" class="col-sm-3 control-label">Tanggal</label>

				<div class="col-lg-7 col-sm-7">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="peg_nama" class="form-control" value="<?php echo $tgl_absen;?>" placeholder="nama lengkap tanpa gelar" disabled />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<label for="absen_hadir" class="col-sm-3 control-label">Kehadiran</label>

				<div class="col-sm-4">
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
						<select class="form-control" name="absen_hadir" id="absen_hadir" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih</option>
						<?php
						for ($i=2;$i<=9;$i++) {
							echo '<option value="'.$i.'">('.$i.') '.$JenisHariAbsen[$i].'</option>';
								
						}
						
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="absen_ket" class="col-sm-3 control-label">Ket</label>

				<div class="col-lg-7 col-sm-7">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="absen_ket" class="form-control" placeholder="Keterangan Absen" />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_log" name="submit_log" value="save" class="btn btn-primary">SIMPAN</button>
			</div>
		</div>
		<input type="hidden" name="peg_id" value="<?php echo $peg_id;?>" />
		<input type="hidden" name="absen_tgl" value="<?php echo $lvl4;?>" />
		<input type="hidden" name="peg_nama" value="<?php echo $peg_nama;?>" />
</fieldset>
</form>
<?php
}
else {
	echo 'Data tidak tersedia';
}
?>
