<?php

if ($_SESSION['sesi_level'] > 2) {
$spj_d_id=$lvl3;
$db_view = new db();
$conn_view = $db_view -> connect();
$sql_view = $conn_view -> query("select * from spj_detil where spj_d_id='$spj_d_id'");
$cek=$sql_view->num_rows;
if ($cek>0) {
$kt=$sql_view->fetch_object();
$keg_id=$kt->keg_id;
$keg_nama=get_nama_kegiatan($keg_id);
$keg_unitkerja=get_unitkerja_kegiatan($keg_id);
  if ($_SESSION['sesi_level'] > 3) {
    $edit=1;
  }
  else {
     if ($_SESSION['sesi_unitkerja'] == $keg_unitkerja) {
       $edit=1;
     }
     else {
       $parent_unit=get_parent_kode($keg_unitkerja);
       if ($_SESSION['sesi_unitkerja'] == $parent_unit) {
          $edit=1;
       }
       else {
         $edit=2;
       }      
     }
  }

   if ($edit==1) {
     
   ?>
   <legend>Edit Penerimaan SPJ <?php echo get_nama_unit($kt->spj_d_unitkerja);?></legend>
         <form id="formKirimTarget" name="formKirimTarget" action="<?php echo $url.'/'.$page;?>/updateterimaspj/"  method="post" class="form-horizontal well" role="form">
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
                  <?php echo tgl_convert(1,get_tgl_kegiatan($kt->keg_id)); ?>
               </div>
         </div>
         <div class="form-group">
            <label for="keg_unitkerja" class="col-sm-2 control-label">Unit Kerja</label>
               <div class="col-sm-6">
                  <?php echo '['.$kt->spj_d_unitkerja.'] '.get_nama_unit($kt->spj_d_unitkerja); ?>
               </div>
         </div>
      <div class="form-group">
        <label for="keg_unitkerja" class="col-sm-2 control-label">Target</label>
          <div class="col-sm-6">
            <?php echo get_spj_kabkota_target($keg_id,$kt->spj_d_unitkerja); ?> SPJ
          </div>
      </div>
         <div class="form-group">
            <label for="keg_d_tgl" class="col-sm-2 control-label">Tanggal Penerimaan</label>
               <div class="col-sm-3" id="tgl_mulai_keg">
                  <div class="input-group margin-bottom-sm">
               <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
               <input type="text" name="keg_d_tgl" id="keg_tglmulai" class="form-control" placeholder="Format : YYYY-MM-DD" value="<?php echo $kt->spj_d_tgl;?>" />
               </div>
               </div>
         </div>
        <div class="form-group">
            <label for="keg_d_jumlah" class="col-sm-2 control-label">Jumlah</label>
               <div class="col-sm-3">
                  <div class="input-group margin-bottom-sm">
               <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
               <input type="text" name="keg_d_jumlah" class="form-control" placeholder="Jumlah Diterima" value="<?php echo $kt->spj_d_jumlah;?>"  />
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
              <button type="submit" id="submit_keg" name="submit_keg" value="kirim" class="btn btn-primary">UPDATE</button>
            </div>
         </div>
   </fieldset>
   <input type="hidden" name="spj_d_id" value="<?php echo $spj_d_id;?>" />
   <input type="hidden" name="keg_id" value="<?php echo $keg_id;?>" />
   <input type="hidden" name="spj_d_unitkerja" value="<?php echo $kt->spj_d_unitkerja;?>" />
   </form>
<?php
      }
   else {
      echo 'User tidak bisa mengakses menu ini';
   }
}
else {
    echo 'Data pengiriman SPJ tidak tersedia';
}
}
else {
	echo 'Level user tidak bisa mengakses menu ini';
}
echo '<br /><a href="'.$url.'/'.$page.'/view/'.$keg_id.'" class="btn btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>';
?>
