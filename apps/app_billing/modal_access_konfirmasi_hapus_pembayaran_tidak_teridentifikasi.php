<div class="modal fade" id="modal_konfirmasi<?php echo $data['id_pembayaran_tidak_terdeteksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-danger"><strong><center>Konfirmasi Hapus</center></strong></div>
			</div>
			<div class="modal-body">
				<h4 class="modal-title" id="myModalLabel"><center>Yakin Transaksi Tersebut Akan Anda Hapus ?</center></h4>
				<div class = "modal-footer">
                	<a href="?page=page_access_data_transaksi_tidak_terdeteksi&hapus_transaksi_tidak_teridentifikasi=ya&id_pembayaran=<?php echo $data['id_pembayaran_tidak_terdeteksi']; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Hapus</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
			</div>                                
		</div>
	</div>
</div>
                