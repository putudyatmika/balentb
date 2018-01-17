<div class="col-lg-12 col-sm-12">
<?php
  $peg_no=$lvl4;
	if (cek_pegawai_no($peg_no)==false) {
    echo 'Pegawai ID tidak ada';
  }
  else {
    $r_peg=list_pegawai($peg_no,true);
    $peg_nama=$r_peg["item"][1]["peg_nama"];
    $hapus_peg=hapus_pegawai_absen($peg_no);
    if ($hapus_peg) { echo 'Pegawai an. <strong>'.$peg_nama.'</strong> berhasil di hapus'; }
    else { echo 'Error menghapus data pegawai'; }
  }
?>
</div>