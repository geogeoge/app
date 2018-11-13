<div class="modal fade" id="modal_input_komplen<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-warning"><strong><center>FORM INPUT TROUBLE</center></strong></div>
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
						<TEXTAREA name="kerusakan" id="inputEmail" class = "form-control" rows="5"></TEXTAREA> 
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_input_komplen" class="btn btn-warning">SIMPAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                