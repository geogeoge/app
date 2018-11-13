<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>FORM TAMBAH MASTER LOGIN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_user" id="inputEmail" class = "form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama User</label>
					<div class="col-sx-10">
						<input type="text" name="nama_user" id="inputEmail" class = "form-control" >
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Username</label>
					<div class="col-sx-10">
						<TEXTAREA name="username" id="inputEmail" class = "form-control" rows="5"></TEXTAREA> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Password</label>
					<div class="col-sx-10">
						<input type="text" name="password" id="inputEmail" class = "form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Level</label>
					<div class="col-sx-10">
						<select class="form-control" style="width: 100%;" name="level" id="parent_bts">
	                        <option selected="selected" disabled="disabled"> </option>
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
						<input type="text" name="ekstra" id="inputEmail" class = "form-control">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tambah_master_login" class="btn btn-primary">SIMPAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                