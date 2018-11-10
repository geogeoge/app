<div class="modal fade" id="tambah_room" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA ROOM </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Room</label>
					<div class="col-sx-10">
						<input type="text" name="nama_ruang" id="inputEmail" class = "form-control" placeholder="Nama Room">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Room</label>
					<div class="col-sx-10">
						<input type="text" name="kode_ruang" id="inputEmail" class = "form-control" placeholder="Kode Room">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "simpan_data_ruang" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>