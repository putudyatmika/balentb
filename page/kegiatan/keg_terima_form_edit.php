<?php
$keg_d_id=$lvl3;
$db_view = new db();
$conn_view = $db_view -> connect();
$sql_view = $conn_view -> query("select * from keg_detil,unitkerja where keg_detil.keg_d_unitkerja=unitkerja.unit_kode and keg_d_id='$keg_d_id'");
$cek=$sql_view->num_rows;
if ($cek>0) {
   $kk=$sql_view->fetch_object();
   $keg_nama=get_nama_kegiatan($kk->keg_id);
   ?>
   <legend>Edit Penerimaan</legend>
   		<form id="formKirimTarget" name="formKirimTarget" action="<?php echo $url.'/'.$page;?>/updateterima/"  method="post" class="form-horizontal well" role="form">
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
   					<?php echo $kk->unit_nama; ?>
   				</div>
   		</div>
   		<div class="form-group">
   			<label for="keg_d_tgl" class="col-sm-2 control-label">Tanggal pengiriman</label>
   				<div class="col-sm-3" id="tgl_mulai_keg">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_tgl" id="keg_tglmulai" class="form-control" value="<?php echo $kk->keg_d_tgl;?>" placeholder="Format : YYYY-MM-DD" />
   				</div>
   				</div>
   		</div>
   	  <div class="form-group">
   			<label for="keg_d_jumlah" class="col-sm-2 control-label">Jumlah</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_jumlah" class="form-control" value="<?php echo $kk->keg_d_jumlah; ?>" placeholder="Satuan Kegiatan" />
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
   			  <button type="submit" id="submit_keg" name="submit_keg" value="update" class="btn btn-primary">UPDATE TERIMA</button>
   			</div>
   		</div>
   </fieldset>
   <input type="hidden" name="keg_d_id" value="<?php echo $keg_d_id;?>" />
   </form>
<?php
}
else {
  echo 'Data kegiatan tidak tersedia';
}
?>
