<div class="modal fade" id="tambah_bts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA BTS</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama BTS</label>
					<div class="col-sx-10">
						<input type="text" name="nama_gedung" id="inputEmail" class = "form-control" placeholder="Nama Gedung">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode BTS</label>
					<div class="col-sx-10">
						<input type="text" name="kode_gedung" id="inputEmail" class = "form-control" placeholder="Kode Gedung">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Jumlah Lantai</label>
					<div class="col-sx-10">
						<input type="text" name="jumlah_lantai" id="inputEmail" class = "form-control" placeholder="Jumlah Lantai">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Alamat</label>
					<div class="col-sx-10">
						<input type="text" name="alamat" id="inputEmail" class = "form-control" placeholder="Alamat">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Koordinat</label>
					<div class="col-sx-10">
						<input type="text" name="koordinat" id="inputEmail" class = "form-control" placeholder="Koordinat">
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "simpan_data_bts" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>