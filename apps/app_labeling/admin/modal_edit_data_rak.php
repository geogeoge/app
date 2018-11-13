<div class="modal fade" id="edit_data_rak<?php echo $id_rak; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>EDIT DATA RAK </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id" id="inputEmail" class = "form-control" value="<?php echo $data['id']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Rak</label>
					<div class="col-sx-10">
						<input type="text" name="nama_rak" id="inputEmail" class = "form-control" value="<?php echo $data['nama_rak']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Rak</label>
					<div class="col-sx-10">
						<input type="text" name="kode_rak" id="inputEmail" class = "form-control" value="<?php echo $data['kode_rak']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jumlah Unit</label>
					<div class="col-sx-10">
						<input type="text" name="jumlah_unit" id="inputEmail" class = "form-control" value="<?php echo $data['jumlah_unit']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jenis Rak</label>
					<div class="col-sx-10">
						<input type="text" name="jenis_rak" id="inputEmail" class = "form-control" value="<?php echo $data['jenis_rak']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "update_data_rak" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>