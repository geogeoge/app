<div class="modal fade" id="hapus_cetak<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-danger"><strong><center>KONFIRMASI HAPUS DARI DAFTAR CETAK INVOICE</center></strong></div>
			</div>
			<div class="modal-body">

				<h4 class="modal-title" id="myModalLabel"><center>Yakin user <strong><?php echo $data['nama_user'];?></strong> invoicenya tidak dicetak lagi ?</center></h4>
				<div class = "modal-footer">
                <a href="?page=page_access_menu_cetak_invoice&proses_hapus_daftar_cetak_invoice=ya&id_register=<?php echo $data['id_register'];?>" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Iya</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
			</div>                                
		</div>
	</div>
</div>
                