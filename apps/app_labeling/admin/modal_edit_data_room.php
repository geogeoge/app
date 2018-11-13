<div class="modal fade" id="edit_data_ruang<?php echo $id_ruang; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>EDIT DATA ROOM </center></strong></div>
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
					<label class="col-sx-2 control-label" for="inputEmail">Nama Room</label>
					<div class="col-sx-10">
						<input type="text" name="nama_ruang" id="inputEmail" class = "form-control" value="<?php echo $data['nama_ruang']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Room</label>
					<div class="col-sx-10">
						<input type="text" name="kode_ruang" id="inputEmail" class = "form-control" value="<?php echo $data['kode_ruang']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "update_data_ruang" class="btn btn-primary">Update</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>