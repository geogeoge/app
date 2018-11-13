<div class="modal fade" id="modal_edit_tanggal_clossing<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>FORM EDTI TANGGAL CLOSSING</center></strong></div>
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
					<label class="col-sx-2 control-label" for="inputEmail">TROUBLE</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal_close" id="inputEmail" class = "form-control" value="<?php echo $data['tanggal_close']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "modal_edit_tanggal_clossing" class="btn btn-info">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                