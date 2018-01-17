	<legend>Tambah data absen pegawai</legend>
		<form id="formAddPegawaiAbsen" name="formAddPegawaiAbsen" action="<?php echo $url.'/'.$page.'/'.$act;?>/save/"  method="post" class="form-horizontal well" role="form">
		<fieldset>
		<div class="form-group">
			<label for="peg_id" class="col-sm-3 control-label">ID Absen Pegawai</label>

				<div class="col-lg-4 col-sm-4">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="peg_id" class="form-control" placeholder="ID Absen di Mesin" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_nama" class="col-sm-3 control-label">Nama Lengkap</label>

				<div class="col-lg-7 col-sm-7">
					<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
					<input type="text" name="peg_nama" class="form-control" placeholder="nama lengkap tanpa gelar" />
				 </div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_jk" class="col-sm-3 control-label">Jenis Kelamin</label>
				<div class="col-sm-4">
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
						<select class="form-control" name="peg_jk" id="peg_jk" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih Jenis Kelamin</option>
						<?php
						for ($i=1;$i<=2;$i++)
							{
								echo '<option value="'.$i.'">'.$JenisKelamin[$i].'</option>';
							}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_user_no" class="col-sm-3 control-label">ID Username</label>

				<div class="col-sm-4">
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
						<select class="form-control" name="peg_user_no" id="peg_user_no" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih User ID</option>
						<?php
						$r_user=list_users(0,false);
						if ($r_user["error"]==false) {
							$i=1;
							$max_users=$r_user["user_total"];
							for ($i=1;$i<=$max_users;$i++)
								{
									echo '<option value="'.$r_user["item"][$i]["user_no"].'">('.$r_user["item"][$i]["user_id"].') '.$r_user["item"][$i]["user_nama"].'</option>';
								}
						}
						else {
							echo '<option value="">Data User Kosong</option>';
						}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_unitkerja" class="col-sm-3 control-label">Unitkerja</label>

				<div class="col-sm-7">
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
						<select class="form-control" name="peg_unitkerja" id="peg_unitkerja" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih Unitkerja</option>
						<?php
						$r_unit=list_unitkerja(0,false,false);
						if ($r_unit["error"]==false) {
							$i=1;
							$max_unit=$r_unit["unit_total"];
							for ($i=1;$i<=$max_unit;$i++)
								{
									echo '<option value="'.$r_unit["item"][$i]["unit_kode"].'">['.$r_unit["item"][$i]["unit_kode"].'] '.$r_unit["item"][$i]["unit_nama"].'</option>';
								}
						}
						else {
							echo '<option value="">Data Unit Kosong</option>';
						}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_jabatan" class="col-sm-3 control-label">Jabatan</label>
				<div class="col-sm-4">
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
						<select class="form-control" name="peg_jabatan" id="peg_jabatan" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih Jabatan</option>
						<?php
						for ($i=1;$i<=2;$i++)
							{
								echo '<option value="'.$i.'">'.$JenisJabatan[$i].'</option>';
							}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<label for="peg_status" class="col-sm-3 control-label">Status</label>
				<div class="col-sm-4">
					<div class="input-group margin-bottom-sm">
						<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
						<select class="form-control" name="peg_status" id="peg_status" style="font-family:'FontAwesome', Arial;">
						<option value="">Pilih Status Pegawai</option>
						<?php
						for ($i=0;$i<=1;$i++)
							{
								echo '<option value="'.$i.'">'.$status_umum[$i].'</option>';
							}
						?>
						</select>
					</div>
				</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_pegawai" name="submit_pegawai" value="save" class="btn btn-primary">SAVE</button>
			</div>
		</div>
</fieldset>
</form>
