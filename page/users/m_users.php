<div class="container">
<div class="row konten">
	<div class="col-lg-12 col-sm-12">
	<?php
		if ($act=='gantipasswd') {
			include 'page/users/user_gantipasswd.php';
		}
		elseif ($act=='updatepasswd') {
			include 'page/users/user_updatepasswd.php';
		}
		elseif ($act=='edit') {
			include 'page/users/user_edit_form.php';
		}
		elseif ($act=='update') {
			include 'page/users/user_update.php';
		}
		else {
			include 'page/users/user_profil.php';
		}
	?>
	</div>
</div>
</div>
