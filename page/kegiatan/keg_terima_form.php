<?php
if ($_SESSION['sesi_level'] > 2) {
$keg_id=$lvl3;
$keg_nama=get_nama_kegiatan($keg_id);
$keg_d_unitkerja=$lvl4;
$db_view = new db();
$conn_view = $db_view -> connect();
$sql_view = $conn_view -> query("select * from keg_target,unitkerja where keg_target.keg_t_unitkerja=unitkerja.unit_kode and keg_id='$keg_id' and keg_t_unitkerja='$keg_d_unitkerja'");
$cek=$sql_view->num_rows;
if ($cek>0) {
   $kt=$sql_view->fetch_object();
   ?>
   <legend>Konfirmasi Penerimaan</legend>
   		<form id="formKirimTarget" name="formKirimTarget" action="<?php echo $url.'/'.$page;?>/saveterima/"  method="post" class="form-horizontal well" role="form">
   		<fieldset>
   		<div class="form-group">
   			<label for="keg_nama" class="col-sm-2 control-label">Nama Kegiatan</label>
   				<div class="col-lg-7 col-sm-7">
   					<?php echo $keg_nama; ?>
   				</div>
   		</div>
   		<div class="form-group">
   			<label for="keg_unitkerja" class="col-sm-2 control-label">Unit Kerja</label>
   				<div class="col-sm-6">
   					<?php echo $kt->unit_nama; ?>
   				</div>
   		</div>
      <div class="form-group">
        <label for="keg_unitkerja" class="col-sm-2 control-label">Target</label>
          <div class="col-sm-6">
            <?php echo $kt->keg_t_target; ?>
          </div>
      </div>
   		<div class="form-group">
   			<label for="keg_d_tgl" class="col-sm-2 control-label">Tanggal Penerimaan</label>
   				<div class="col-sm-3" id="tgl_mulai_keg">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_tgl" id="keg_tglmulai" class="form-control" placeholder="Format : YYYY-MM-DD" />
   				</div>
   				</div>
   		</div>
   	  <div class="form-group">
   			<label for="keg_d_jumlah" class="col-sm-2 control-label">Jumlah</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_jumlah" class="form-control" placeholder="Jumlah Diterima" />
   				</div>
   				</div>
   		</div>
   		<!--<div class="form-group">
   			<label for="keg_d_file" class="col-sm-2 control-label">File Lampiran</label>
   				<div class="col-sm-3">
            <div style="position:relative;">
		<a class='btn btn-primary' href='javascript:;'>
			Pilih File...
			<input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
		</a>
		&nbsp;
		<span class='label label-info' id="upload-file-info"></span>
	</div>
   				</div>
   		</div>-->
   		<div class="form-group">
   			<div class="col-sm-offset-2 col-sm-8">
   			  <button type="submit" id="submit_keg" name="submit_keg" value="kirim" class="btn btn-primary">KIRIM</button>
   			</div>
   		</div>
   </fieldset>
   <input type="hidden" name="keg_id" value="<?php echo $keg_id;?>" />
   <input type="hidden" name="keg_d_unitkerja" value="<?php echo $keg_d_unitkerja;?>" />
   </form>
<?php
}
else {
  echo 'Data kegiatan tidak tersedia';
}
}
else {
	echo 'Level user tidak bisa mengakses menu ini';
}
?>
