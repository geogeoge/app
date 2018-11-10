<div class="modal fade" id="modal_detail_log_trouble<?php echo $data['id_maintenance']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>DETAIL TROUBLE</center></strong></div>
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
					<label class="col-sx-2 control-label" for="inputEmail">SOLUSI</label>
					<div class="col-sx-10">
						<TEXTAREA name="solusi" id="inputEmail" class = "form-control" rows="5"><?php echo htmlentities($data['solusi'],ENT_QUOTES); ?></TEXTAREA> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tanggal Selesai</label>
					<div class="col-sx-10">
						<input type="date" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $data['tanggal_penanganan_maintenance']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jenis Penanganan</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $data['status_kunjungan']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Teknisi</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $teknisi; ?>">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                