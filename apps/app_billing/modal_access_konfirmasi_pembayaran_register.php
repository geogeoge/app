<div class="modal fade" id="konfirmasi_pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>KONFIRMASI PEMBAYARAN</center></strong></div>
			</div>
			<div class="modal-body">

				<h4 class="modal-title" id="myModalLabel"><center>Yakin uang pembayaran user <strong><?php echo $data['nama_user'];?></strong> sudah sesuai ?</center></h4>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
      	      		<button name="proses_transaksi_user_baru" type="submit" class="btn btn-primary">Iya</button>
				</div>
			</div>                                
		</div>
	</div>
</div>
                