<?php
$batas_waktu='2017-01-25';
$waktu_kirim='2017-01-24';
$target_waktu = new DateTime($batas_waktu);
$pengiriman = new DateTime($waktu_kirim);
$interval = $pengiriman->diff($target_waktu);
$int=$interval->format('%r%a');
echo $int;
?>