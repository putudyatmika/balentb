<?php
$spj_d_id=$lvl3;
$db_view = new db();
$conn_view = $db_view -> connect();
$sql_view = $conn_view -> query("select * from spj_detil,unitkerja where spj_detil.spj_d_unitkerja=unitkerja.unit_kode and spj_d_id='$spj_d_id'");
$cek=$sql_view->num_rows;
if ($cek>0) {
   $kk=$sql_view->fetch_object();
   $keg_nama=get_nama_kegiatan($kk->keg_id);
   ?>
   <legend>Edit Pengiriman</legend>
   		<form id="formKirimTarget" name="formKirimTarget" action="<?php echo $url.'/'.$page;?>/updatekirimspj/"  method="post" class="form-horizontal well" role="form">
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
            <label for="keg_t_target" class="col-sm-2 control-label">Target</label>
               <div class="col-sm-6">
                  <?php echo get_spj_kabkota_target($kk->keg_id,$kk->spj_d_unitkerja); ?>
               </div>
         </div>
   		<div class="form-group">
   			<label for="keg_d_tgl" class="col-sm-2 control-label">Tanggal pengiriman</label>
   				<div class="col-sm-3" id="tgl_mulai_keg">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_tgl" id="keg_tglmulai" class="form-control" value="<?php echo $kk->spj_d_tgl;?>" placeholder="Format : YYYY-MM-DD" />
   				</div>
   				</div>
   		</div>
   	  <div class="form-group">
   			<label for="keg_d_jumlah" class="col-sm-2 control-label">Jumlah</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_jumlah" class="form-control" value="<?php echo $kk->spj_d_jumlah; ?>" placeholder="Satuan Kegiatan" />
   				</div>
   				</div>
   		</div>
   		<div class="form-group">
   			<label for="keg_d_ket" class="col-sm-2 control-label">Dikirim melalui</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="text" name="keg_d_ket" class="form-control" value="<?php echo $kk->spj_d_ket; ?>" placeholder="Dikirim melalui?" />
   				</div>
   				</div>
   		</div>
         <div class="form-group">
            <label for="keg_d_link" class="col-sm-2 control-label">Link Laci/Dropbox</label>
               <div class="col-sm-5">
                  <div class="input-group margin-bottom-sm">
               <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
               <input type="text" name="keg_d_link" class="form-control" value="<?php echo $kk->spj_d_link_laci; ?>" placeholder="Link LACI / DROPBOX" />
               </div>
               </div>
         </div>
        		<div class="form-group">
   			<div class="col-sm-offset-2 col-sm-8">
   			  <button type="submit" id="submit_spj" name="submit_spj" value="kirim" class="btn btn-primary">KIRIM</button>
   			</div>
   		</div>
   </fieldset>
   <input type="hidden" name="spj_d_id" value="<?php echo $spj_d_id;?>" />
   </form>
<?php
}
else {
  echo 'Data kegiatan tidak tersedia<br />';
}
echo '<a href="'.$url.'/'.$page.'/view/'.$kk->keg_id.'">Kembali</a>';
?>
