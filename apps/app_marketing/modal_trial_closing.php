<div class="modal fade" id="modal_trial_closing<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>CLOSING USER</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center>Yakin Yang Closing User <strong><?php echo $data['nama_user'];?></strong> ?</center></h4>
				<br>
				<div class = "modal-footer">
					<button name = "tombol_clossing" class="btn btn-success">Iya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                