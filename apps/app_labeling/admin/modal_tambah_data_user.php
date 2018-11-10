<div class="modal fade" id="tambah_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA USER</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Username</label>
					<div class="col-sx-10">
						<input type="text" name="username" id="inputEmail" class = "form-control" placeholder="Username">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Password</label>
					<div class="col-sx-10">
                		<input type="password" name="password_1" class="form-control" id="inputPassword3" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Re-Type Password</label>
					<div class="col-sx-10">
		                <input type="password" name="password_2" class="form-control" id="inputPassword3" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Level</label>
					<div class="col-sx-10">
	              	<select name="level" class="form-control select2" style="width: 100%;">
	                  <option selected="selected" disabled="true"> </option>
	                  <option value="1">Adminstrator</option>
	                  <option value="2">Operator</option>
	                </select>
	              	</div>
	            </div>
				<div class = "modal-footer">
					<button name = "simpan_data_user" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>