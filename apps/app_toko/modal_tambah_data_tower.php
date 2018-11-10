<div class="modal fade" id="tambah_tower" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA TOWER </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Tower</label>
					<div class="col-sx-10">
						<input type="text" name="id_tower" id="inputEmail" class = "form-control" value="<?php echo $select->select_id_tower_terakhir();?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Tower</label>
					<div class="col-sx-10">
						<input type="text" name="nama_tower" id="inputEmail" class = "form-control" placeholder="Nama tower">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button name = "tombol_tambah_tower" class="btn btn-primary">Simpan</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>