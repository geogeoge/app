<div class="modal fade" id="edit_data_tower<?php echo $id_tower; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>EDIT DATA TOWER </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode tower</label>
					<div class="col-sx-10">
						<input type="text" name="id" id="inputEmail" class = "form-control" value="<?php echo $data['id_tower']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama tower</label>
					<div class="col-sx-10">
						<input type="text" name="nama_tower" id="inputEmail" class = "form-control" value="<?php echo $data['nama_tower']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button name = "tombol_update_tower" class="btn btn-primary">Update</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>