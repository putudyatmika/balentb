	<legend>Tambah data pola</legend>
		<form id="formAddPegawaiAbsen" name="formAddPegawaiAbsen" action="<?php echo $url.'/'.$page.'/'.$act;?>/pola/save/"  method="post" class="form-horizontal well" role="form">
		<fieldset>
		<div class="form-group">
			<label for="pola_nama" class="control-label col-sm-2">Nama</label>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="pola_nama" class="form-control" placeholder="Pola nama" />
				</div>
				</div>
				
		</div>
		<div class="form-group">
			<label for="pola_senin" class="control-label col-sm-2">Senin</label>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="senin_masuk" class="form-control" placeholder="Jam Masuk" />
				</div>
				</div>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="senin_pulang" class="form-control" placeholder="Jam Pulang" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="pola_senin" class="control-label col-sm-2">Selasa</label>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="selasa_masuk" class="form-control" placeholder="Jam Masuk" />
				</div>
				</div>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="selasa_pulang" class="form-control" placeholder="Jam Pulang" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="pola_senin" class="control-label col-sm-2">Rabu</label>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="rabu_masuk" class="form-control" placeholder="Jam Masuk" />
				</div>
				</div>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="rabu_pulang" class="form-control" placeholder="Jam Pulang" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="pola_senin" class="control-label col-sm-2">Kamis</label>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="kamis_masuk" class="form-control" placeholder="Jam Masuk" />
				</div>
				</div>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="kamis_pulang" class="form-control" placeholder="Jam Pulang" />
				</div>
				</div>
		</div>
		<div class="form-group">
			<label for="pola_senin" class="control-label col-sm-2">Jumat</label>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="jumat_masuk" class="form-control" placeholder="Jam Masuk" />
				</div>
				</div>
				<div class="col-sm-4 col-lg-4">
				<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
				<input type="text" name="jumat_pulang" class="form-control" placeholder="Jam Pulang" />
				</div>
				</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
			  <button type="submit" id="submit_pola" name="submit_pola" value="save" class="btn btn-primary">SAVE</button>
			</div>
		</div>
</fieldset>
</form>
