<?php
if (isset($_POST['sdate'])) { $sdate=$_POST['sdate']; }
else { $sdate=date("Y-m-d"); }

if (isset($_POST['edate'])) { $edate=$_POST['edate']; }
else { $edate=''; }
?>
<div class="container">
<div class="row konten">
	<div class="col-lg-6 col-sm-6">
		<div class="btn-toolbar" role="toolbar">
		<div class="btn-group">
			<a href="<?php echo $url; ?>/absen/add/" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></a>
			<a href="<?php echo $url; ?>/absen/unitkerja/" class="btn btn-danger btn-sm"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp; Bidang/Bagian</a>
			<a href="<?php echo $url; ?>/absen/" class="btn btn-success btn-sm"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Semua</a>
			<a href="<?php echo $url; ?>/absen/rekap/" class="btn btn-info btn-sm"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Rekap Harian</a>
			<a href="<?php echo $url; ?>/absen/rekap/bulan/" class="btn btn-info btn-sm"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Rekap Bulanan</a>
			<a href="<?php echo $url; ?>/absen/sync/" class="btn btn-warning btn-sm"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Sync</a>
		</div>
		</div>
		</div>
		<div class="col-lg-6 col-sm-6">
		<form class="form-inline" method="post">
  <div class="form-group" id="tgl_mulai_keg">
    <label for="sdate">Tanggal</label>
    <input type="text" class="form-control input-sm" name="sdate" id="sdate" value="<?php echo $sdate;?>" placeholder="Tgl Awal">
  </div>
  <div class="form-group" id="tgl_mulai_keg">
    <label for="edate">s/d</label>
    <input type="text" class="form-control input-sm" name="edate" id="edate" value="<?php echo $edate;?>" placeholder="Tgl Akhir">
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
		elseif ($act=="sync") {
			include 'page/absen/absen_sync.php';
		}
		elseif ($act=="unitkerja") {
			include 'page/absen/absen_unitkerja.php';
		}
		elseif ($act=="rekap") {
			include 'page/absen/absen_rekap.php';
		}
		else {
			include 'page/absen/absen_all.php';
		}
	?>
	</div>
</div>
</div>