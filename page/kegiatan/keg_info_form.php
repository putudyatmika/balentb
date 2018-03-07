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
 $parent_unit=get_parent_kode($e->keg_unitkerja);
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
<legend>Tambah Info Kegiatan</legend>
		<form id="formKegBaru" name="formKegBaru" action="<?php echo $url.'/'.$page;?>/saveinfo/"  method="post" class="form-horizontal well" role="form">
		<fieldset>
		<div class="form-group">
			<label for="keg_nama" class="col-sm-2 control-label">Nama Kegiatan</label>
				<div class="col-lg-7 col-sm-7">
					<?php echo $e->keg_nama;?>
				 </div>
				
		</div>
		<div class="form-group">
			<label for="keg_unitkerja" class="col-sm-2 control-label">Unit Kerja</label>
				<div class="col-sm-6">
					<?php echo '['.$e->keg_unitkerja.'] '.get_nama_unit($e->keg_unitkerja) ; ?>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_jenis" class="col-sm-2 control-label">Jenis Kegiatan</label>
				<div class="col-sm-3">
					<?php echo $JenisKegiatan[$e->keg_jenis]; ?>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_tglmulai" class="col-sm-2 control-label">Tgl Mulai</label>
				<div class="col-sm-3" id="tgl_mulai_keg">
					<?php echo $e->keg_start;?>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_tglmulai" class="col-sm-2 control-label">Tgl Berakhir</label>
				<div class="col-sm-3" id="tgl_akhir_keg">
					<?php echo $e->keg_end;?>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_satuan" class="col-sm-2 control-label">Satuan</label>
				<div class="col-sm-3">
					<?php echo $e->keg_target_satuan;?>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_target" class="col-sm-2 control-label">Total Target</label>
				<div class="col-sm-3">
					<?php echo $e->keg_total_target;?>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_spj" class="col-sm-2 control-label">Laporan SPJ Provinsi</label>
				<div class="col-sm-2">
					<?php echo $StatusSPJ[$e->keg_spj]; ?>
				</div>
		</div>
		<div class="form-group">
			<label for="keg_spj" class="col-sm-2 control-label">Informasi Kegiatan</label>
				<div class="col-sm-8"> 
					<textarea cols="20" rows="5" name="keg_info" class="form-control ckeditor"></textarea>
				</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_keg" name="submit_keg" value="update" class="btn btn-primary">SIMPAN</button>
			</div>
		</div>
</fieldset>
<input type="hidden" name="keg_id" value="<?php echo $keg_id;?>" />
</form>
<?php }
	else {
		echo '<div class="margin10px"><div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i> Level user <strong>'.$_SESSION['sesi_user_id'].'</strong> tidak bisa menambah info pada kegiatan <strong>'. get_nama_kegiatan($keg_id).'</strong> ini</div></div>';
		
	}
}
else {
	echo 'Data kegiatan masih kosong <br />';
}
}
else {
	echo '<div class="margin10px"><div class="alert alert-danger" role="alert">(ERROR) Level user <strong>'.$_SESSION['sesi_user_id'].'</strong> tidak bisa mengakses menu ini </div></div>';
	
}
echo '<a class="btn btn-success" href="'.$url.'/'.$page.'/view/'.$keg_id.'"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>';
?>
