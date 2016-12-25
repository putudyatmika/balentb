<legend>Ganti Password</legend>
   		<form id="formGantiPasswd" name="formGantiPasswd" action="<?php echo $url.'/'.$page;?>/updatepasswd/"  method="post" class="form-horizontal well" role="form">
   		<fieldset>
   		<div class="form-group">
   			<label for="user_pass_lama" class="col-sm-2 control-label">Password Lama</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="password" name="user_pass_lama" class="form-control" />
   				</div>
   				</div>
   		</div>
		<div class="form-group">
   			<label for="user_pass_baru" class="col-sm-2 control-label">Password Baru</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="password" name="user_pass_baru" class="form-control" />
   				</div>
   				</div>
   		</div>
		<div class="form-group">
   			<label for="user_pass_baru2" class="col-sm-2 control-label">Konfirmasi Password</label>
   				<div class="col-sm-3">
   					<div class="input-group margin-bottom-sm">
   				<span class="input-group-addon"><i class="fa fa-tag fa-fw"></i></span>
   				<input type="password" name="user_pass_baru2" class="form-control" />
   				</div>
   				</div>
   		</div>
   		<div class="form-group">
   			<div class="col-sm-offset-2 col-sm-8">
   			  <button type="submit" id="submit_passwd" name="submit_passwd" value="kirim" class="btn btn-primary">GANTI PASSWORD</button>
   			</div>
   		</div>
   </fieldset>
   </form>
