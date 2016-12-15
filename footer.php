<footer id="footer">
        <div class="container">
		<div class="row">
			<div class="col-lg-12 col-xs-12">

			<p class="text-left"> <?php echo date('Y') .' - <a href="'.$url.'"> BPS Provinsi NTB</a>'; ?></p>
			  <p class="text-left"><i class="fa fa-home fa-fw" aria-hidden="true"></i> Jl. Gunung Rinjani No. 2 Mataram</p>
        <p class="text-left">User : <?php if (isset($_SESSION['sesi_user_id'])) { echo $_SESSION['sesi_user_id'] .' ('. $_SESSION['sesi_nama'].')'; } ?> Level : <?php if (isset($_SESSION['sesi_level'])) { echo $lvl_user[$_SESSION['sesi_level']]; } ?></p>
			 </div>

		</div>
		</div>
</footer>

	<div id="back-top" style="display: none;">
        <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>
<!-- JavaScript -->
    <script src="<?php echo $url; ?>/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo $url; ?>/addons/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $url; ?>/addons/validator/js/bootstrapValidator.min.js"></script>
	<script src="<?php echo $url; ?>/js/bpsntb.js"></script>
	<script src="<?php echo $url; ?>/addons/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo $url; ?>/addons/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
  $(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'keg_klik') {
            $('#menu_kabkota').show();
       }

       else {
            $('#menu_kabkota').hide();
       }
   });
});
		 $(document).ready(function() {
          $('#tgl_mulai_keg input').datepicker({
       format: "yyyy-mm-dd",
       todayHighlight: true,
	   autoclose: true
  });

});
$(document).ready(function() {
     $('#tgl_akhir_keg input').datepicker({
  format: "yyyy-mm-dd",
  todayHighlight: true,
autoclose: true
});

});
	$(document).ready(function() {
          $('#tgl_cpns').datepicker({
       format: "yyyy-mm-dd",
	   autoclose: true
  });

           $('#tgl_cpns').datepicker()
    .on("changeDate", function(e){
      $('#pegawai_tmt_cpns').prop('readonly',false);
      $('#pegawai_tmt_cpns').val(e.format('yyyy-mm-dd'));
      $('#pegawai_tmt_cpns').prop('readonly',true);

  });

});
$(document).ready(function() {
          $('#tgl_pns').datepicker({
       format: "yyyy-mm-dd",
	   autoclose: true
  });

           $('#tgl_pns').datepicker()
    .on("changeDate", function(e){
      $('#pegawai_tmt_pns').prop('readonly',false);
      $('#pegawai_tmt_pns').val(e.format('yyyy-mm-dd'));
      $('#pegawai_tmt_pns').prop('readonly',true);

  });

});
	</script>


</body>
<?php //tutup_db($con); ?>
</html>
