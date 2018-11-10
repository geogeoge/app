<div class="modal fade" id="modal_trial_cancel<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-danger"><strong><center>BATALKAN REGISTRASI USER</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center>Yakin Anda Ingin Membatalkan Registrasi User <strong><?php echo $data['nama_user'];?></strong> ?</center></h4>
				<br>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Catatan Untuk User</label>
					<div class="col-sx-10">
						<textarea style="resize:vertical;" class="form-control" placeholder="Catatan..." rows="4" name="catatan" required></textarea>
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "tombol_cancel" class="btn btn-danger">Iya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                