<div class="modal fade" id="modal_konfirmasi_pembayaran_tidak_terdeteksi<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>PROSES TRANSAKSI TAK TERDETEKSI</center></strong></div>
			</div>
			<div class="modal-body">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="id_register" id="inputEmail" class = "form-control" value="<?php echo $data['id_register']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center>Yakin Transaksi Tersebut Milik Sdr/i <strong><?php echo $data['nama_user'];?></strong>  ?</center></h4>
				<div class = "modal-footer">
                <a href="?page=page_access_data_transaksi_tidak_terdeteksi&proses_pembayaran_tidak_terdeteksi=ya&id_pembayaran=<?php echo $id_pembayaran; ?>&id_register=<?php echo $data['id_register'];?>" class="btn btn-success"><i class="icon-trash icon-large"></i>&nbsp;Iya</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
			</div>                                
		</div>
	</div>
</div>
                