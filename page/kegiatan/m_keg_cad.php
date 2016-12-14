<div class="container">
<div class="row konten">
	<div class="col-lg-2 col-sm-2">
		<div class="list-group">
		<a href="#" class="list-group-item active"><i class="fa fa-cubes fa-fw"></i>&nbsp; Kegiatan</a>
		<a href="<?php echo $url; ?>/kegiatan/" class="list-group-item"><i class="fa fa-dot-circle-o text-primary fa-fw"></i>&nbsp; Semua</a>
		<a href="<?php echo $url; ?>/kegiatan/provinsi/" class="list-group-item"><i class="fa fa-dot-circle-o text-primary fa-fw"></i>&nbsp; Bidang</a>
		</div>
	</div>
		<div class="col-lg-10 col-sm-10">

				<div class="btn-toolbar" role="toolbar">
					<div class="btn-group">
						<a href="<?php echo $url; ?>/kegiatan/add/" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
						</div>
				</div>
		</div>
<div class="col-lg-10 col-sm-10">
<?php
	if ($act=="add") {
		include 'page/kegiatan/keg_form.php';
	}
	elseif ($act=="save") {
			include 'page/kegiatan/keg_save.php';
		}
	elseif ($act=="edit") {
		include 'page/kegiatan/keg_form_edit.php';
	}
	elseif ($act=="update") {
			include 'page/kegiatan/keg_update.php';
		}
	elseif ($act=="view") {
			include 'page/kegiatan/keg_view.php';
	}
	elseif ($act=="kirim") {
			include 'page/kegiatan/keg_kirim_form.php';
	}
	elseif ($act=="savekirim") {
			include 'page/kegiatan/keg_kirim_save.php';
	}
	elseif ($act=="terima") {
			include 'page/kegiatan/keg_terima_form.php';
	}
	elseif ($act=="saveterima") {
			include 'page/kegiatan/keg_terima_save.php';
	}
	elseif ($act=="editkirim") {
			include 'page/kegiatan/keg_kirim_form_edit.php';
	}
	elseif ($act=="updatekirim") {
		include 'page/kegiatan/keg_kirim_update.php';
	}
	else {
		 include 'page/kegiatan/keg_list.php';
	}
?>

</div>
	</div>
</div>
