<div class="modal fade" id="edit_data_data_marketing<?php echo $id_data_marketing; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>Edit DATA MARKETING</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">ID Marketing</label>
					<div class="col-sx-10">
						<input type="text" name="id_user" id="inputEmail" class = "form-control" value="<?php echo $data['id_user'];?>" readonly="readonly" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Marketing</label>
					<div class="col-sx-10">
                		<input type="text" name="nama_user" class="form-control" id="inputPassword3" value="<?php echo $data['nama_user'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Username</label>
					<div class="col-sx-10">
		                <input type="text" name="username" class="form-control" id="inputPassword3" value="<?php echo $data['username'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Password</label>
					<div class="col-sx-10">
		                <input type="text" name="password1" class="form-control" id="inputPassword3" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Re-type Password</label>
					<div class="col-sx-10">
		                <input type="text" name="password2" class="form-control" id="inputPassword3" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Level</label>
					<div class="col-sx-10">
						<select class = "form-control" name="level">
						<?php
						$marketing = '';
						$admin_marketing = 'selected="selected"';
						if($data['level']=="MARKETING"){
							$marketing = 'selected="selected"';
							$admin_marketing = '';
						}
						?>
							<option value="MARKETING" <?php echo $marketing;?>>MARKETING</option>
							<option value="ADMIN_MARKETING" <?php echo $admin_marketing;?>>ADMIN</option>
		                </select>
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "edit_data_marketing" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>