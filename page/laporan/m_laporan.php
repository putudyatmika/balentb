<div class="container">
<div class="row konten">
	<div class="col-lg-12 col-sm-12">
		<div class="btn-toolbar" role="toolbar">
		<div class="btn-group">
			<a href="<?php echo $url; ?>/laporan/" class="btn btn-danger"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Provinsi</a>
			<a href="<?php echo $url; ?>/laporan/kabkota/" class="btn btn-success"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Kabupaten/Kota</a>
		</div>
		</div>
	</div>
</div>
<div class="row margin10px">
	<div class="col-lg-12 col-sm-12">
	<?php
		if ($act=='kabkota') {
			include 'page/laporan/lap_kabkota.php';
		}
		else {
			include 'page/laporan/lap_prov.php';
		}
	?>
	</div>
</div>
</div>
