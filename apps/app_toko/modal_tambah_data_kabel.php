<div class="modal fade" id="tambah_kabel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA KABEL </center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Kode Kabel</label>
					<div class="col-sx-10">
						<input type="text" name="id_kabel" id="inputEmail" class = "form-control" value="<?php echo $select->select_id_kabel_terakhir();?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Nama Kabel</label>
					<div class="col-sx-10">
						<input type="text" name="nama_kabel" id="inputEmail" class = "form-control" placeholder="Nama kabel">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button name = "tombol_tambah_kabel" class="btn btn-primary">Simpan</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>