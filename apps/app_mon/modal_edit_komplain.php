<div class="modal fade" id="modal_edit_komplain<?php echo $data['id_maintenance']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>DATA DETAIL KOMPLAIN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $data['id_maintenance']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama User</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $data['nama_user']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Alamat</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $alamat; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Telp</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $data['telp']; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Marketing</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $nama_marketing; ?>" readonly>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Penerima Komplain</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo $nama_penerima_komplen; ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Waktu Komplain</label>
					<div class="col-sx-10">
						<input type="text" name="id_maintenance" id="inputEmail" class = "form-control" value="<?php echo date("H:i d-m-Y", strtotime($data['tanggal_komplen'])); ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Trouble</label>
					<div class="col-sx-10">
						<TEXTAREA name="solusi" id="inputEmail" class = "form-control" rows="5"><?php echo $data['kerusakan']; ?></TEXTAREA> 
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_konfirmasi_maintenance_selesai" class="btn btn-info">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                