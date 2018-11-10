<div class="modal fade" id="tambah_device" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA DEVICE </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Device</label>
					<div class="col-sx-10">
						<input type="text" name="nama_device" id="inputEmail" class = "form-control" placeholder="Nama Device">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Device</label>
					<div class="col-sx-10">
						<input type="text" name="kode_device" id="inputEmail" class = "form-control" placeholder="Kode Device">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jenis Device</label>
					<div class="col-sx-10">
						<input type="text" name="jenis_device" id="inputEmail" class = "form-control" placeholder="Jenis Device">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Type Device</label>
					<div class="col-sx-10">
						<input type="text" name="type_device" id="inputEmail" class = "form-control" placeholder="Type Device">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jumlah Port</label>
					<div class="col-sx-10">
						<input type="text" name="jumlah_port" id="inputEmail" class = "form-control" placeholder="Jumlah Port">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "simpan_data_device" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>