<?php
if ($lvl4=='add') {
	include 'page/master/absen/m_pola_form.php';
	}
elseif ($lvl4=='edit') {
	include 'page/master/absen/m_log_form_edit.php';
}
elseif ($lvl4=='update') {
	include 'page/master/absen/m_log_update.php';
}
elseif ($lvl4=='delete') {

}
elseif ($lvl4=='save') {
	include 'page/master/absen/m_pola_save.php';
}
else {
	include 'page/master/absen/m_pola_list.php';
}
?>