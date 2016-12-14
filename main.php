<section class="utama">
    <?php
		if ($page=="kegiatan") {
			include 'page/kegiatan/m_keg.php';
		}
		elseif (($page=="master") && ($_SESSION['sesi_level'] >= 4)) {
			include 'page/master/m_master.php';
		}
    elseif ($page=="ranking") {
			include 'page/ranking/m_ranking.php';
		}
    elseif ($page=="laporan") {
			include 'page/laporan/m_laporan.php';
		}
		elseif ($page=="logout") {
			include 'page/login/logout.php';
		}
		else {
			include 'page/utama/m_utama.php';
		}
	?>

</section>
