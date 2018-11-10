<div class="modal fade" id="modal_trial_perpanjang<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-warning"><strong><center>PERPANJANG MASA TRIAL</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center>Berapa hari perpanjang masa trial user <strong><?php echo $data['nama_user'];?></strong> ?</center></h4>
				<br>
				<div class="form-group">
					<div class="col-sx-10">
						<select class = "form-control" name="perpanjang">
							<option value="+1 days">1 Hari</option>
							<option value="+2 days">2 Hari</option>
							<option value="+3 days">3 Hari</option>
							<option value="+4 days">4 Hari</option>
							<option value="+5 days">5 Hari</option>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "tombol_perpanjang" class="btn btn-warning">Iya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                