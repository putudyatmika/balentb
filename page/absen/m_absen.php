<?php
if (isset($_POST['sdate'])) { $sdate=$_POST['sdate']; }
else { $sdate=date("Y-m-d"); }
?>
<div class="container">
<div class="row konten">
	<div class="col-lg-3 col-sm-3">
		<div class="btn-toolbar" role="toolbar">
		<div class="btn-group">
			<a href="<?php echo $url; ?>/absen/add/" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></a>
			<a href="<?php echo $url; ?>/absen/unitkerja/" class="btn btn-danger btn-sm"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp; Bidang/Bagian</a>
			<a href="<?php echo $url; ?>/absen/" class="btn btn-success btn-sm"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Semua</a>
		</div>
		</div>
		</div>
		<div class="col-lg-9 col-sm-9">
		<form class="form-inline" method="post">
  <div class="form-group" id="tgl_mulai_keg">
    <label for="sdate">Tanggal</label>
    <input type="text" class="form-control input-sm" name="sdate" id="sdate" value="<?php echo $sdate;?>" placeholder="Tgl Awal">
  </div>
  <div class="form-group" id="tgl_mulai_keg">
    <label for="edate">s/d</label>
    <input type="text" class="form-control input-sm" name="edate" id="edate" placeholder="Tgl Akhir">
  </div>
  <button type="submit" class="btn btn-default btn-sm">View Data</button>
</form>
</div>
</div>
<div class="row margin10px">
	<div class="col-lg-12 col-sm-12">
	<?php
		if ($act=="add") {

		}
		elseif ($act=="unitkerja") {
			include 'page/absen/absen_unitkerja.php';
		}
		else {
			include 'page/absen/absen_all.php';
		}
	?>
	</div>
</div>
</div>