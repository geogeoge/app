<div class="modal fade" id="data_catatan<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>CATATAN TRANSAKSI</center></strong></div>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sx-2 control-label" for="inputEmail">Catatan</label>
					<div class="col-sx-10">
						<textarea class="form-control" name="catatan" rows="3" cols="65"><?php echo $data['catatan_pembayaran']; ?></textarea> 
					</div>
				</div>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>                                
		</div>
	</div>
</div>