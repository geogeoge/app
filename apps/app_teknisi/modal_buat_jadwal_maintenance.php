<div class="modal fade" id="modal_buat_jadwal_maintenance<?php echo $data['id_maintenance']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>BUAT JADWAL MAINTENANCE</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $data['id_maintenance']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">TROUBLE</label>
					<div class="col-sx-10">
						<TEXTAREA name="kerusakan" id="inputEmail" class = "form-control" rows="5"><?php echo $data['kerusakan']; ?></TEXTAREA> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">PENJADWALAN</label>
					<div class="col-sx-10">
						<input type="date" name="tanggal_penjadwalan_maintenance" id="inputEmail" class = "form-control" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">SOLUSI</label>
					<div class="col-sx-10">
						<TEXTAREA name="solusi" id="inputEmail" class = "form-control" rows="5"></TEXTAREA> 
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_buat_jadwal_maintenance" class="btn btn-primary">JADWALKAN</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                