<div class="modal fade" id="modal_edit<?php echo $data['id_bantu_log_pembayaran_rutin']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-warning"><strong><center>TAMBAH TRANSAKSI RUTIN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Keterangan</label>
					<div class="col-sx-10">
						<textarea class="form-control" name="keterangan" rows="3"><?php echo $data['keterangan']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sx-10">
						<input type="text" name="id_bantu_log_pembayaran_rutin" value="<?php echo $data['id_bantu_log_pembayaran_rutin'];?>"></input>
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
					<button name="edit_transaksi_rutin" class="btn btn-warning">UPDATE</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                