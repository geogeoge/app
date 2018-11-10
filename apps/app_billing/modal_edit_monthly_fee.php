<div class="modal fade" id="edit_monthly_fee<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>EDIT DATA PEMASANGAN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Monthly Fee</label>
					<div class="col-sx-10">
						<input type="text" name="monthly_fee" id="inputEmail" class = "form-control" value="<?php echo $data['monthly_fee']; ?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal Close</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal_close" id="inputEmail" class = "form-control" value="<?php echo $data['tanggal_trial']; ?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Biaya Register</label>
					<div class="col-sx-10">
						<input type="text" name="biaya_registrasi" id="inputEmail" class = "form-control" value="<?php echo $data['biaya_registrasi']; ?>" required="required">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_edit_monthly_fee" class="btn btn-success">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                