<div class="modal fade" id="konfirmasi_pembayaran<?php echo $no; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-danger"><strong><center>MEMBATALKAN TRANSAKSI</center></strong></div>
			</div>
			<div class="modal-body">
				<h4 class="modal-title" id="myModalLabel"><center>Yakin Transaksi <strong><?php echo $data['nama_user'];?></strong> Akan Batalkan ?</center></h4>
				<div class = "modal-footer">
					<a href="?page=page_access_data_transaksi_harian&tanggal=<?php echo $tanggal; ?>&batal_transaksi=YA&no_transaksi=<?php echo $no; ?>&kode_transaksi=<?php echo $kode_keterangan; ?>" class="btn btn-danger">Iya</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                