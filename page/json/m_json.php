	<?php
		if ($act=='laporan') {
			include 'page/users/user_gantipasswd.php';
		}
		elseif ($act=='kegiatan') {
			if ($lvl3=="view") {
				include 'page/json/json_kegiatan_view.php';
			}
			else {
				include 'page/json/json_kegiatan.php';
		}
		}
		elseif ($act=='unitkerja') {
			include 'page/users/user_edit_form.php';
		}
		else {
			include 'page/json/json_deadline.php';
		}
	?>
