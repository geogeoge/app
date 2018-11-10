<div class="modal fade" id="modal_rubah_jadwal<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-warning"><strong><center>RUBAH JADWAL PEMASANGAN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center><b>TANGGAL PEMASANGAN</b></center></h4>
				<br>
				<div class="form-group">
					<div class="col-sx-10">
						<input type="date" name="tanggal_penjadwalan" id="inputEmail" class = "form-control" value="<?php echo $data['tanggal_penjadwalan']; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_rubah_penjadwalan" class="btn btn-warning">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                