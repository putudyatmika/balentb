	<legend>Edit data log absen karyawan</legend>
	<?php
	$log_id=$lvl5;
	$r_absen=log_peg_absen($log_id,0,true);
	if ($r_absen["error"]==false) {
		$peg_id=$r_absen["item"][1]["absen_peg_id"];
		$peg_nama=$r_absen["item"][1]["peg_nama"];
		$absen_tgl=$r_absen["item"][1]["absen_tgl"];
		$absen_jam=$r_absen["item"][1]["absen_jam"];
		$absen_kode=$r_absen["item"][1]["absen_kode"];
		$absen_rekap=$r_absen["item"][1]["absen_rekap"];
		$absen_flag=$r_absen["item"][1]["absen_flag"];
		$absen_ket=$r_absen["item"][1]["absen_ket"];
	?>
		<form id="formLogAbsen" name="formAddPegawaiAbsen" action="<?php echo $url.'/'.$page.'/'.$act;?>/log/update/"  method="post" class="form-horizontal well" role="form">
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
					<input type="text" name="peg_nama" class="form-control" value="<?php echo $absen_tgl;?>" placeholder="nama lengkap tanpa gelar" disabled />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_nama" class="col-sm-3 control-label">Jam</label>

				<div class="col-lg-7 col-sm-7">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="peg_nama" class="form-control" value="<?php echo $absen_jam;?>" placeholder="nama lengkap tanpa gelar" disabled />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<label for="absen_kode" class="col-sm-3 control-label">Jenis</label>

				<div class="col-sm-4">
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
						<select class="form-control" name="absen_kode" id="absen_kode" style="font-family:'FontAwesome', Arial;">
						<option value="">Kode Absen</option>
						<?php
						for ($i=0;$i<=5;$i++)
								{
									
								if ($i==$absen_kode) {
									$dipilih_user='selected="selected"';
								}
								else { $dipilih_user='';}

									echo '<option value="'.$i.'" '.$dipilih_user.'>('.$i.') '.$KodeMesinAbsen[$i].'</option>';
								
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
		<input type="hidden" name="absen_id" value="<?php echo $log_id;?>" />
</fieldset>
</form>
<?php
}
else {
	echo 'Data log absen tidak tersedia';
}
?>
