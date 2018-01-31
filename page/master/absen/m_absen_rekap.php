<?php
if (isset($_POST['sdate'])) { $sdate=$_POST['sdate']; }
else { $sdate=date("Y-m-d"); }
?>
<legend>Rekap Absen Karyawan</legend>
<form class="form-inline" method="post">
  <div class="form-group" id="tgl_mulai_keg">
    <label for="sdate">Pilih</label>
    <input type="text" class="form-control input-sm" name="sdate" id="sdate" value="<?php echo $sdate;?>" placeholder="Tgl Awal">
  </div>
  <button type="submit" class="btn btn-default btn-sm">Generate</button>
</form>
<div class="table-responsive">
<table class="table table-hover table-striped table-condensed">
<thead>
 	<tr>
 		<th>#</th>
 		<th>Peg ID</th>
 		<th>Nama</th>
 		<th>Tgl</th>
 		<th>Pola</th>
 		<th>Kehadiran</th>
 		<th>Masuk</th>
 		<th>Pulang</th>
 		<th>Keluar</th>
 		<th>Kembali</th>
 		<th colspan="3">&nbsp;</th>
 	</tr>
 </thead>
 <tbody>
 
 </tbody>
</table>