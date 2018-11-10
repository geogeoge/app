<div class="modal fade" id="tambah_rak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA RAK </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Rak</label>
					<div class="col-sx-10">
						<input type="text" name="nama_rak" id="inputEmail" class = "form-control" placeholder="Nama Rak">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Rak</label>
					<div class="col-sx-10">
						<input type="text" name="kode_rak" id="inputEmail" class = "form-control" placeholder="Kode Rak">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jumlah Unit</label>
					<div class="col-sx-10">
						<input type="text" name="jumlah_unit" id="inputEmail" class = "form-control" placeholder="Jumlah Unit">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jenis Rak</label>
					<div class="col-sx-10">
						<input type="text" name="jenis_rak" id="inputEmail" class = "form-control" placeholder="Jenis Rak">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "simpan_data_rak" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>