<div class="modal fade" id="modal_hapus<?php echo $data['id_bantu_log_pembayaran_rutin']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form  method="POST" enctype="multipart/form-data">
				<div class="modal-header">
					<div class="alert alert-danger"><strong><center>KONFIRMASI HAPUS TRANSAKSI RUTIN</center></strong></div>
				</div>
				<div class="modal-body">

					<h4 class="modal-title" id="myModalLabel"><center>Yakin hapus data <strong><?php echo $data['keterangan'];?></strong> ?</center></h4>
					<div class="form-group" hidden="hidden">
					<div class="col-sx-10" hidden="hidden">
						<input type="text" name="id_bantu_log_pembayaran_rutin" value="<?php echo $data['id_bantu_log_pembayaran_rutin'];?>"></input>
					</div>
				</div>
					<div class = "modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
						<button name="hapus_transaksi_rutin" class="btn btn-danger">DELETE</button>
					</div>
				</div>  
			</form>                              
		</div>
	</div>
</div>
                