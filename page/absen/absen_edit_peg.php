	<legend>Entri data log absen karyawan</legend>
	<?php
	$peg_id=$lvl3;
	$tgl_absen=date("Y-m-d",$lvl4);
	$r_absen=peg_hadir_absen($peg_id,$tgl_absen);
	if ($r_absen["error"]==false) {
		$peg_nama=$r_absen["peg_nama"];
		$absen_hadir=$r_absen["absen_hadir"];
		$absen_ket=$r_absen["absen_ket"];
		$absen_id=$r_absen["absen_id"];
		
	?>
		<form id="formLogAbsen" name="formAddPegawaiAbsen" action="<?php echo $url.'/'.$page;?>/updatepeg/"  method="post" class="form-horizontal well" role="form">
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
							if ($absen_hadir==$i) {
								$pilih='selected="selected"';
							}
							else {
								$pilih='';
							}
							echo '<option value="'.$i.'" '.$pilih.'>('.$i.') '.$JenisHariAbsen[$i].'</option>';
								
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
					<input type="text" name="absen_ket" class="form-control" value="<?php echo $absen_ket;?>" placeholder="Keterangan Absen" />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_log" name="submit_log" value="save" class="btn btn-primary">UPDATE</button>
			</div>
		</div>
		<input type="hidden" name="absen_id" value="<?php echo $absen_id;?>" />
	</fieldset>
</form>
<?php
}
else {
	echo 'Data tidak tersedia';
}
?>
