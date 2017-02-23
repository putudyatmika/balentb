<?php
$keg_id=$lvl3;
if ($_SESSION['sesi_level'] > 2) {
$keg_nama=get_nama_kegiatan($keg_id);
$spj_d_unitkerja=$lvl4;
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

   if ($edit==1){
      $db_view = new db();
$conn_view = $db_view -> connect();
$sql_view = $conn_view -> query("select * from keg_spj,unitkerja where keg_spj.keg_s_unitkerja=unitkerja.unit_kode and keg_id='$keg_id' and keg_s_unitkerja='$spj_d_unitkerja'");
$cek=$sql_view->num_rows;
if ($cek>0) {
   $kt=$sql_view->fetch_object();
   ?>
   <legend>Konfirmasi Penerimaan SPJ</legend>
         <form id="formKirimTarget" name="formKirimTarget" action="<?php echo $url.'/'.$page;?>/saveterimaspj/"  method="post" class="form-horizontal well" role="form">
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
                  <?php echo $kt->unit_nama; ?>
               </div>
         </div>
      <div class="form-group">
        <label for="keg_unitkerja" class="col-sm-2 control-label">Target</label>
          <div class="col-sm-6">
            <?php echo $kt->keg_s_target; ?> SPJ
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
         <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
              <button type="submit" id="submit_keg" name="submit_keg" value="kirim" class="btn btn-primary">KIRIM</button>
            </div>
         </div>
   </fieldset>
   <input type="hidden" name="keg_id" value="<?php echo $keg_id;?>" />
   <input type="hidden" name="spj_d_unitkerja" value="<?php echo $spj_d_unitkerja;?>" />
   </form>
<?php
      }
      else {
        echo 'Data kegiatan tidak tersedia';
      }
   }
   else {
      echo 'User tidak bisa mengakses menu ini';
   }
}
else {
	echo 'Level user tidak bisa mengakses menu ini';
}
echo '<br /><a href="'.$url.'/'.$page.'/view/'.$keg_id.'">Kembali</a>';
?>
