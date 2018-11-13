<div class="modal fade" id="modal_edit<?php echo $data['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-warning"><strong><center>FORM EDIT MASTER LOGIN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_user" id="inputEmail" class = "form-control" value="<?php echo $data['id_user'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama User</label>
					<div class="col-sx-10">
						<input type="text" name="nama_user" id="inputEmail" class = "form-control" value="<?php echo $data['nama_user'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Username</label>
					<div class="col-sx-10">
						<input type="text" name="username" id="inputEmail" class = "form-control" value="<?php echo $data['username'];?>" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Password</label>
					<div class="col-sx-10">
						<input type="text" name="password" id="inputEmail" class = "form-control" value="<?php echo $data['password'];?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Level</label>
					<div class="col-sx-10">
						<select class="form-control" style="width: 100%;" name="level" id="parent_bts">
	                        <option selected="selected" value="<?php echo $data['level'];?>"><?php echo $data['level'];?></option>
                            <option value="ADMINISTRASI">ADMINISTRASI</option>
							<option value="ACCOUNTING">ACCOUNTING</option>
							<option value="BILLING">BILLING</option>
							<option value="MARKETING">MARKETING</option>
							<option value="LABELING_ADMIN">LABELING_ADMIN</option>
							<option value="LABELING_TEKNISI">LABELING_TEKNISI</option>
							<option value="ACCOUNTING_ADMIN">ACCOUNTING_ADMIN</option>
							<option value="ACCOUNTING_KASIR">ACCOUNTING_KASIR</option>
							<option value="TOKO">TOKO</option>
							<option value="CHRISTELLA">CHRISTELLA</option>
							<option value="ADMIN_MARKETING">ADMIN_MARKETING</option>
							<option value="TEKNISI">TEKNISI</option>
							<option value="PENJADWALAN">PENJADWALAN</option>
							<option value="MONITORING">MONITORING</option>
							<option value="MANAGEMEN">MANAGEMEN</option>
							<option value="PERSEBARAN_USER">PERSEBARAN_USER</option>
							<option value="NOC">NOC</option>
							<option value="DEVELOPMENT">DEVELOPMENT</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">ekstra</label>
					<div class="col-sx-10">
						<input type="text" name="ekstra" id="inputEmail" class = "form-control" value="<?php echo $data['ekstra'];?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "edit_master_login" class="btn btn-warning">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                