<div class="container">
<div class="row konten hidden-print">
	<div class="col-lg-12 col-sm-12">
		<div class="btn-toolbar" role="toolbar">
		<div class="btn-group">
			<a href="<?php echo $url; ?>/aktivitas/add/" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></a>
			<a href="<?php echo $url; ?>/aktivitas/unitkerja/" class="btn btn-danger btn-sm"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp; Master</a>
			<a href="<?php echo $url; ?>/aktivitas/" class="btn btn-success btn-sm"><i class="fa fa-area-chart" aria-hidden="true"></i>&nbsp; Semua</a>
		</div>
		</div>
		</div>
		
</div>
<div class="row margin10px">
	<div class="col-lg-12 col-sm-12">
	<?php
		if ($act=="add") {
			include 'page/aktivitas/absen_form.php';
		}
		elseif ($act=="addpeg") {
			include 'page/aktivitas/absen_add_peg.php';
		}
		elseif ($act=="savepeg") {
			include 'page/aktivitas/absen_save_peg.php';
		}
		elseif ($act=="editpeg") {
			include 'page/aktivitas/absen_edit_peg.php';
		}
		elseif ($act=="updatepeg") {
			include 'page/aktivitas/absen_update_peg.php';
		}
		elseif ($act=="sync") {
			include 'page/aktivitas/absen_sync.php';
		}
		elseif ($act=="unitkerja") {
			include 'page/aktivitas/absen_unitkerja.php';
		}
		elseif ($act=="rekap") {
			include 'page/aktivitas/absen_rekap.php';
		}
		else {
			
		}
	?>
	</div>
</div>
</div>