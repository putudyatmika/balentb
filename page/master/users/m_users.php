<div class="col-lg-12 col-sm-12">
		<div class="btn-toolbar" role="toolbar">
			<div class="btn-group">
				<a href="<?php echo $url; ?>/master/users/add/" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah User</a>
				<a href="<?php echo $url; ?>/master/users/" class="btn btn-success"><span class="glyphicon glyphicon-th"></span> Semua User</a>
				<a href="<?php echo $url; ?>/master/users/admin/" class="btn btn-danger"><span class="glyphicon glyphicon-th"></span> Admin</a>
				<a href="<?php echo $url; ?>/master/users/operatorkab/" class="btn btn-info"><span class="glyphicon glyphicon-th"></span> Operator KabKota</a>
				<a href="<?php echo $url; ?>/master/users/operatorprov/" class="btn btn-primary"><span class="glyphicon glyphicon-th"></span> Operator Provinsi</a>
				<a href="<?php echo $url; ?>/master/users/pemantau/" class="btn btn-warning"><span class="glyphicon glyphicon-th"></span> Pemantau</a>
			</div>
		</div>
</div>

<div class="col-lg-12 col-sm-12" style="margin-top:20px;">
		<?php
			if ($lvl3=='add') {
				include 'page/master/users/m_users_form.php';
			}
			elseif ($lvl3=='save') {
				include 'page/master/users/m_users_save.php';
			}
			elseif ($lvl3=='edit') {
				include 'page/master/users/m_users_form_edit.php';
			}
			elseif ($lvl3=='update') {
				include 'page/master/users/m_users_update.php';
			}
			elseif ($lvl3=='view') {
				include 'page/master/users/m_users_view.php';
			}
			elseif ($lvl3=='delete') {
				include 'page/master/users/m_users_delete.php';
			}
			elseif ($lvl3=='admin') {
				include 'page/master/users/m_users_list_admin.php';
			}
			elseif ($lvl3=='pemantau') {
				include 'page/master/users/m_users_list_pemantau.php';
			}
			elseif ($lvl3=='operatorkab') {
				include 'page/master/users/m_users_list_operatorkab.php';
			}
			elseif ($lvl3=='operatorprov') {
				include 'page/master/users/m_users_list_operatorprov.php';
			}
			else {
				include 'page/master/users/m_users_list.php';
			}
		?>
</div>
