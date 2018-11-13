<div class="modal fade" id="edit<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>EDIT DATA TAGIHAN KHUSUS</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Tagihan Awal</label>
					<div class="col-sx-10">
						<input type="date" name="pelanggan_khusus_bulan_awal" id="inputEmail" class = "form-control" value="<?php echo $data['pelanggan_khusus_bulan_awal']; ?>" required="required">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Periode Tagihan (Bulan)</label>
					<div class="col-sx-10">
						<input type="text" name="pelanggan_khusus_periode" id="inputEmail" class = "form-control" value="<?php echo $data['pelanggan_khusus_periode']; ?>" required="required">
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name = "tombol_edit_tagihan_khusus" class="btn btn-success">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                