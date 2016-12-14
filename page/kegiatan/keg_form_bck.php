	<legend>Tambah kegiatan baru</legend>
		<form id="formKegBaru" name="formKegBaru" action="<?php echo $url.'/'.$page;?>/save/"  method="post" class="form-horizontal well" role="form">
		<fieldset>
		<div class="form-group">
			<label for="keg_nama" class="col-sm-2 control-label">Nama Kegiatan</label>
				<div class="col-lg-7 col-sm-7">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="keg_nama" class="form-control" placeholder="nama unit" />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_unitkerja" class="col-sm-2 control-label">Unit Kerja</label>
				<div class="col-sm-6">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<select class="form-control" name="keg_unitkerja" id="keg_unitkerja" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih</option>
						<?php
						$db = new db();
						$conn = $db -> connect();
						$sql_unit = $conn->query("select * from unitkerja where unit_jenis=1 and unit_eselon=4 order by unit_jenis,unit_kode asc");
						while ($r = $sql_unit ->fetch_object()) {
							echo '<option value="'.$r->unit_kode.'">['.$r->unit_kode.'] '.$r->unit_nama.'</option>'."\n";

						}	?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_jenis" class="col-sm-2 control-label">Jenis Kegiatan</label>
				<div class="col-sm-3">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<select class="form-control" name="keg_jenis" id="keg_jenis" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih</option>
						<?php
						$i=0;
						for ($i=1;$i<=6;$i++)
							{
								echo '<option value="'.$i.'">'.$JenisKegiatan[$i].'</option>';
							}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_tglmulai" class="col-sm-2 control-label">Tgl Mulai</label>
				<div class="col-sm-3" id="tgl_mulai_keg">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="keg_tglmulai" id="keg_tglmulai" class="form-control" placeholder="Format : YYYY-MM-DD" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_tglmulai" class="col-sm-2 control-label">Tgl Berakhir</label>
				<div class="col-sm-3" id="tgl_akhir_keg">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="keg_tglakhir" id="keg_tglakhir" class="form-control" placeholder="Format : YYYY-MM-DD" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_satuan" class="col-sm-2 control-label">Satuan</label>
				<div class="col-sm-3">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="keg_satuan" class="form-control" placeholder="Satuan Kegiatan" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_target" class="col-sm-2 control-label">Total Target</label>
				<div class="col-sm-3">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="keg_target" class="form-control" placeholder="Total Target Kegiatan" />
				</div>
				</div>
		</div>
	<div id="menu_kabkota" style='display:none'>
					<?php
					$i=1;
					$db_kabkota = new db();
					$conn_kabkota = $db_kabkota -> connect();
					$sql_kabkota = $conn_kabkota->query("select * from unitkerja where unit_jenis=2 and unit_eselon=3 order by unit_kode asc");
					while ($k = $sql_kabkota ->fetch_object()) {
						echo '<div class="form-group">';
						if ($i==1) echo '<label for="keg_target" class="col-sm-2 control-label">Target Kab/Kota</label>';
						else echo '<label for="keg_target_'.$k->unit_kode.'" class="col-sm-2 control-label"></label>';
							echo '
							<div class="col-sm-5">
							<div class="input-group margin-bottom-sm">
						<span class="input-group-addon">'.$k->unit_nama.'</span>
						<input type="text" name="keg_target_'.$k->unit_kode.'" class="form-control" placeholder="Target Kegiatan" />
						</div></div></div>
							';
							$i++;
					}	?>

</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_unit" name="submit_unit" value="save" class="btn btn-primary">SAVE</button>
			</div>
		</div>
</fieldset>
</form>
