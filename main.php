<section class="utama">
    <?php
		if ($page=="pegawai") {
			include 'page/pegawai/m_pegawai.php';
		}
		elseif (($page=="master") && ($_SESSION['sesi_level'] >= 4)) {
			include 'page/master/m_master.php';
		}
    elseif ($page=="profil") {
			include 'page/profil/m_profil.php';
		}
		elseif ($page=="logout") {
			include 'page/login/logout.php';
		}
		else {
			include 'page/utama/m_utama.php';
		}
	?>

</section>
