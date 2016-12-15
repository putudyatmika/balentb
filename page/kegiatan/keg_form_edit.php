<?php
if ($_SESSION['sesi_level'] > 2) {
$keg_id=$lvl3;
$db_edit = new db();
$conn_edit = $db_edit -> connect();
$sql_edit = $conn_edit -> query("select * from kegiatan where keg_id='$keg_id'");
$cek=$sql_edit->num_rows;
if ($cek>0) {
 $e=$sql_edit -> fetch_object();
 $es_unit=get_eselon_unit($_SESSION['sesi_unitkerja']);
 $parent_unit=get_parent_unit($e->keg_unitkerja);
 if ($_SESSION['sesi_level'] > 3 ) {
	 $edit=1;
 }
 else {
	 if (($es_unit==4) and ($_SESSION['sesi_unitkerja']==$e->keg_unitkerja)) {
		 $edit=1;
	 }
	 elseif (($es_unit==3) and ($_SESSION['sesi_unitkerja']==$parent_unit)) {
		 $edit=1;
	 }
	 else {
		$edit=2;
	 }
 }
 
 if ($edit==1) {
?>
<legend>Edit Kegiatan</legend>
		<form id="formKegBaru" name="formKegBaru" action="<?php echo $url.'/'.$page;?>/update/"  method="post" class="form-horizontal well" role="form">
		<fieldset>
		<div class="form-group">
			<label for="keg_nama" class="col-sm-2 control-label">Nama Kegiatan</label>
				<div class="col-lg-7 col-sm-7">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="keg_nama" class="form-control" value="<?php echo $e->keg_nama;?>" placeholder="nama unit" />
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
            if ($_SESSION['sesi_level'] > 2) {
							  if ($_SESSION['sesi_level']==3) {
										$es_op=get_eselon_unit($_SESSION['sesi_unitkerja']);
										if ($es_op==4) $sql_unit = $conn->query("select * from unitkerja where unit_kode='".$_SESSION['sesi_unitkerja']."' order by unit_jenis,unit_kode asc");
										else $sql_unit = $conn->query("select * from unitkerja where unit_jenis=1 and unit_eselon=4 and unit_parent='".$_SESSION['sesi_unitkerja']."' order by unit_jenis,unit_kode asc");
								}
								else {
									$sql_unit = $conn->query("select * from unitkerja where unit_jenis=1 and unit_eselon=4 order by unit_jenis,unit_kode asc");
								}
						}
						while ($r = $sql_unit ->fetch_object()) {
							if ($e->keg_unitkerja == $r->unit_kode) $pilih='selected="selected"';
							else $pilih='';
							echo '<option value="'.$r->unit_kode.'" '.$pilih.'>['.$r->unit_kode.'] '.$r->unit_nama.'</option>'."\n";

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
								if ($e->keg_jenis == $i) $pilih='selected="selected"';
								else $pilih='';
								echo '<option value="'.$i.'" '.$pilih.'>'.$JenisKegiatan[$i].'</option>';
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
				<input type="text" name="keg_tglmulai" id="keg_tglmulai" class="form-control" value="<?php echo $e->keg_start;?>" placeholder="Format : YYYY-MM-DD" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_tglmulai" class="col-sm-2 control-label">Tgl Berakhir</label>
				<div class="col-sm-3" id="tgl_akhir_keg">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="keg_tglakhir" id="keg_tglakhir" class="form-control" value="<?php echo $e->keg_end;?>" placeholder="Format : YYYY-MM-DD" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_satuan" class="col-sm-2 control-label">Satuan</label>
				<div class="col-sm-3">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="keg_satuan" class="form-control" value="<?php echo $e->keg_target_satuan;?>" placeholder="Satuan Kegiatan" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_target" class="col-sm-2 control-label">Total Target</label>
				<div class="col-sm-3">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="keg_target" class="form-control" value="<?php echo $e->keg_total_target;?>" placeholder="Total Target" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  Target BPS Kabupaten/Kota
			</div>
		</div>
		<?php
		$db_kabkota = new db();
		$conn_kabkota = $db_kabkota -> connect();
		$sql_kabkota = $conn_kabkota->query("select * from unitkerja,keg_target where keg_target.keg_t_unitkerja=unitkerja.unit_kode and keg_target.keg_id='$keg_id' order by unitkerja.unit_kode asc");
		$i=1;
		while ($k = $sql_kabkota ->fetch_object()) {
			echo '
			<div class="form-group">
				<label for="keg_target_lobar" class="col-sm-3 control-label">'.$k->unit_nama.'</label>
					<div class="col-sm-3">
						<div class="input-group margin-bottom-sm">
					<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="keg_kabkota['.$k->unit_kode.'][]" class="form-control" value="'.$k->keg_t_target.'" placeholder="Target Kegiatan" />
					</div>
					</div>
			</div>
			';
			$i++;
		}	?>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_keg" name="submit_keg" value="update" class="btn btn-primary">UPDATE</button>
			</div>
		</div>
</fieldset>
<input type="hidden" name="keg_id" value="<?php echo $keg_id;?>" />
</form>
<?php }
	else {
		echo 'Level user tidak bisa mengedit';
	}
}
else {
	echo 'Data kegiatan masih kosong';
}
}
else {
	echo 'Level user tidak bisa mengakses menu ini';
}
?>
