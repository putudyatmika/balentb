<div class="col-lg-12 col-sm-12">
		<div class="btn-toolbar" role="toolbar">
			<div class="btn-group">
				<a href="<?php echo $url; ?>/master/absen/add/" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></a>
				<a href="<?php echo $url; ?>/master/absen/pola/" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-th"></span> Pola</a>
				<a href="<?php echo $url; ?>/master/absen/rekap/" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-th"></span> Generate Rekap</a>
				<a href="<?php echo $url; ?>/master/absen/" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-th"></span> Log Absen</a>
				
			</div>
		</div>
		
</div>

<div class="col-lg-12 col-sm-12" style="margin-top:20px;">
		<?php
			if ($lvl3=='add') {
				include 'page/master/absen/m_absen_form.php';
			}
			elseif ($lvl3=='save') {
				include 'page/master/absen/m_absen_save.php';
			}
			elseif ($lvl3=='edit') {
				include 'page/master/absen/m_absen_form_edit.php';
			}
			elseif ($lvl3=='update') {
				include 'page/master/absen/m_absen_update.php';
			}
			elseif ($lvl3=='view') {
				include 'page/master/absenm_absen_view.php';
			}
			elseif ($lvl3=='delete') {
				include 'page/master/absen/m_absen_delete.php';
			}
			elseif ($lvl3=='rekap') {
				include 'page/master/absen/m_absen_rekap.php';
			}
			elseif ($lvl3=='log') {
				include 'page/master/absen/m_log.php';
			}
			else {
				include 'page/master/absen/m_absen_list.php';
			}
		?>
</div>
