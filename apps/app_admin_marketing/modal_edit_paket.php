<div class="modal fade" id="edit_data_paket<?php echo $id_paket; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>Edit DATA PAKET</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Paket</label>
					<div class="col-sx-10">
						<input type="text" name="id_paket" id="inputEmail" class = "form-control" value="<?php echo $data['id_paket']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Paket</label>
					<div class="col-sx-10">
                		<input type="text" name="nama_paket" class="form-control" id="inputPassword3" value="<?php echo $nama_paket; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Harga</label>
					<div class="col-sx-10">
		                <input type="text" name="harga" class="form-control" id="inputPassword3" value="<?php echo $harga; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "update_paket_internet" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>