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
elseif ($page=="unitkerja") {
		include 'page/unitkerja/m_unitkerja.php';
	}
elseif ($page=="laporan") {
		include 'page/laporan/m_laporan.php';
	}
elseif (($page=="absen") && ($_SESSION['sesi_provkab'] == 1)) {
		include 'page/absen/m_absen.php';
	}
elseif ($page=="logout") {
	include 'page/login/logout.php';
}
elseif ($page=="users") {
	include 'page/users/m_users.php';
}
elseif ($page=="json") {
	include 'page/json/m_json.php';
}
else {
	include 'page/utama/m_utama.php';
}
?>
</section>
