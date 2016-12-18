<div class="container">
<div class="row konten">
	<div class="col-lg-12 col-sm-12">
		<div class="btn-toolbar" role="toolbar">
		<div class="btn-group">
			<a href="<?php echo $url; ?>/unitkerja/" class="btn btn-danger"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Provinsi</a>
			<a href="<?php echo $url; ?>/unitkerja/kabkota/" class="btn btn-success"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Kabupaten/Kota</a>
		</div>
		</div>
	</div>
</div>
<div class="row margin10px">
	<div class="col-lg-12 col-sm-12">
	<?php
		if ($act=='kabkota') {
			include 'page/unitkerja/unit_kabkota.php';
		}
		else {
			include 'page/unitkerja/unit_prov.php';
		}
	?>
	</div>
</div>
</div>
