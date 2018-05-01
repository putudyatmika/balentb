<?php
if ($_SESSION['sesi_level'] > 1) {
   $keg_id=$lvl3;
   $keg_nama=get_nama_kegiatan($keg_id);
   if ($_SESSION['sesi_level']==2) {
   	$keg_d_unitkerja=$_SESSION['sesi_unitkerja'];
   }
   else {
   	$keg_d_unitkerja=$lvl4;
   }
$db_view = new db();
$conn_view = $db_view -> connect();
$sql_view = $conn_view -> query("select * from keg_target,unitkerja where keg_target.keg_t_unitkerja=unitkerja.unit_kode and keg_id='$keg_id' and keg_t_unitkerja='$keg_d_unitkerja'");
$sql_target_kirim = $conn_view -> query("select kegiatan.keg_id,keg_nama,keg_detil.keg_d_unitkerja, unitkerja.unit_nama, keg_total_target, sum(keg_detil.keg_d_jumlah) as jumlah_kirim from kegiatan left join keg_detil on kegiatan.keg_id=keg_detil.keg_id left join unitkerja on keg_detil.keg_d_unitkerja=unitkerja.unit_kode where kegiatan.keg_id='$keg_id' and keg_detil.keg_d_jenis='1' and keg_detil.keg_d_unitkerja='$keg_d_unitkerja'") or die(mysqli_error($conn_view));
$cek=$sql_view->num_rows;
if ($cek>0) {
   $kk=$sql_view->fetch_object();
   $t=$sql_target_kirim->fetch_object();
   if ($t->jumlah_kirim==NULL) {
      $total_kirim=0;
   }
   else {
      $total_kirim=$t->jumlah_kirim;
   }
   ?>
   <legend>Konfirmasi Pengiriman</legend>
   		<form id="formKirimTarget" name="formKirimTarget" action="<?php echo $url.'/'.$page;?>/savekirim/"  method="post" class="form-horizontal well" role="form">
   		<fieldset>
   		<div class="form-group">
   			<label for="keg_nama" class="col-sm-2 control-label">Nama Kegiatan</label>
   				<div class="col-lg-7 col-sm-7">
   					<?php echo $keg_nama; ?>
   				</div>
   		</div>
         <div class="form-group">
            <label for="keg_nama" class="col-sm-2 control-label">Batas waktu</label>
               <div class="col-lg-7 col-sm-7">
                  <?php echo tgl_convert(1,get_tgl_kegiatan($keg_id)); ?>
               </div>
         </div>
   		<div class="form-group">
   			<label for="keg_unitkerja" class="col-sm-2 control-label">Unit Kerja</label>
   				<div class="col-sm-6">
   					<?php echo '['.$kk->keg_t_unitkerja.'] '.$kk->unit_nama; ?>
   				</div>
   		</div>
			<div class="form-group">
   			<label for="keg_t_target" class="col-sm-2 control-label">Target</label>
   				<div class="col-sm-2">
                  <div class="input-group margin-bottom-sm">
               <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
               <input type="text" class="form-control"  value="<?php echo $kk->keg_t_target; ?>" disabled="" />
               </div>
               </div>
   		</div>
         <div class="form-group">
            <label for="keg_t_target" class="col-sm-2 control-label">Sudah terkirim</label>
               <div class="col-sm-2">
                  <div class="input-group margin-bottom-sm">
               <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
               <input type="text" class="form-control"  value="<?php echo $total_kirim; ?>" disabled="" />
               </div>
               </div>
         </div>
   		<div class="form-group">
   			<label for="keg_d_tgl" class="col-sm-2 control-label">Tanggal pengiriman</label>
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
   				<input type="text" name="keg_d_jumlah" class="form-control" placeholder="Jumlah Kirim" />
   				</div>
   				</div>
   		</div>
   		<div class="form-group">
   			<label for="keg_d_ket" class="col-sm-2 control-label">Dikirim melalui</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_ket" class="form-control" placeholder="Dikirim via apa?" />
   				</div>
   				</div>
   		</div>
         <div class="form-group">
            <label for="keg_d_link" class="col-sm-2 control-label">Link Laci/Dropbox</label>
               <div class="col-sm-5">
                  <div class="input-group margin-bottom-sm">
               <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
               <input type="text" name="keg_d_link" class="form-control" placeholder="Link LACI / DROPBOX" />
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
  echo 'Data kegiatan tidak tersedia <br />';
}
}
else {
	echo 'Level user tidak bisa mengakses menu ini <br />';
}
echo '<a href="'.$url.'/'.$page.'/view/'.$kk->keg_id.'" class="btn btn-success"><i class="fa fa-angle-left" aria-hidden="true"></i> Kembali</a>';
?>
