		<form id="formAddUser" name="formAddUser" action="<?php echo $url.'/'.$page.'/'.$act;?>/save/"  method="post" class="form-horizontal well" role="form">
		<fieldset>
		<div class="form-group">
			<label for="user_id" class="col-sm-2 control-label">ID</label>
				<div class="col-lg-4 col-sm-4">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="user_id" class="form-control" placeholder="user ID" />
				 </div>
				</div>
		</div>
    <div class="form-group">
      <label for="user_nama" class="col-sm-2 control-label">Nama</label>
        <div class="col-lg-4 col-sm-4">
          <div class="input-group margin-bottom-sm">
        <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
          <input type="text" name="user_nama" class="form-control" placeholder="Nama" />
         </div>
        </div>
    </div>
    <div class="form-group">
      <label for="user_email" class="col-sm-2 control-label">Email</label>
        <div class="col-lg-4 col-sm-4">
          <div class="input-group margin-bottom-sm">
        <span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
          <input type="text" name="user_email" class="form-control" placeholder="E-mail" />
         </div>
        </div>
    </div>
		<div class="form-group">
			<label for="user_passwd" class="col-sm-2 control-label">Password</label>
			<div class="col-lg-5 col-sm-5">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="password" name="user_passwd" class="form-control" placeholder="user password" />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<label for="user_passwd2" class="col-sm-2 control-label">Konfirmasi Password</label>
			<div class="col-lg-5 col-sm-5">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="password" name="user_passwd2" class="form-control" placeholder="konfirmasi password" />
				 </div>
				</div>

		</div>
		<div class="form-group">
			<label for="user_unitkerja" class="col-sm-2 control-label">Unit Kerja</label>
				<div class="col-sm-6">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
        <select class="form-control" name="user_unitkerja" id="user_unitkerja" style="font-family:'FontAwesome', Arial;">
          <option value="">Pilih</option>
          <?php
          $db = new db();
          $conn = $db -> connect();
          $sql_unit = $conn->query("select * from unitkerja order by unit_jenis,unit_kode asc");
          while ($r = $sql_unit ->fetch_object()) {
            echo '<option value="'.$r->unit_kode.'">['.$r->unit_kode.'] '.$r->unit_nama.'</option>'."\n";
          }	?>
          </select>
					</div>
				</div>
		</div>
    <div class="form-group">
			<label for="user_level" class="col-sm-2 control-label">Level</label>
				<div class="col-sm-4">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<select class="form-control" name="user_level" id="user_level" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih Level</option>
						<?php
          	for ($i=1;$i<=$_SESSION['sesi_level'];$i++) {
							echo '<option value="'.$i.'">'.$lvl_user[$i].'</option>';
						}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="user_status" class="col-sm-2 control-label">Status</label>
				<div class="col-sm-3">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<select class="form-control" name="user_status" id="user_status" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih Status</option>
						<?php
						for ($i=0;$i<=1;$i++) {
							echo '<option value="'.$i.'">'.$status_umum[$i].'</option>';
						}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_save" name="submit_save" value="save" class="btn btn-primary">SAVE</button>
			</div>
		</div>
</fieldset>
</form>
