<div class="col-lg-12 col-sm-12">
		<div class="btn-toolbar" role="toolbar">
			<div class="btn-group">
				<a href="<?php echo $url; ?>/master/absen/add/" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span></a>
				<a href="<?php echo $url; ?>/master/absen/pola/" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-th"></span> Pola</a>
				<a href="<?php echo $url; ?>/master/absen/rekap/" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-th"></span> Generate Rekap</a>
				<a href="<?php echo $url; ?>/master/absen/rekapbulan/" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-th"></span> View TL-PSW</a>
				<a href="<?php echo $url; ?>/master/absen/" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-th"></span> Log Absen</a>
				<a href="<?php echo $url; ?>/master/absen/libur/" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-th"></span> Hari Libur</a>
				<a href="<?php echo $url; ?>/master/absen/kalendar/" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-th"></span> Kalendar Tahunan</a>
				<a href="<?php echo $url; ?>/master/absen/updatetlpsw/" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-th"></span> UpdateTLPSW</a>
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
				include 'page/master/absen/m_absen_rekapabsen.php';
			}
			elseif ($lvl3=='rekapbulan') {
				include 'page/master/absen/m_absen_rekapbulan.php';
			}
			elseif ($lvl3=='log') {
				include 'page/master/absen/m_log.php';
			}
			elseif ($lvl3=='updatetlpsw') {
				include 'page/master/absen/m_absen_update_tlpsw.php';
			}
			elseif ($lvl3=='kalendar') {
				include 'page/master/absen/m_kalendar.php';
			}
			elseif ($lvl3=='pola') {
				include 'page/master/absen/m_pola.php';
			}
			else {
				include 'page/master/absen/m_absen_list.php';
			}
		?>
</div>
