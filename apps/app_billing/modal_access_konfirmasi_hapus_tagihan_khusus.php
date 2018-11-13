<div class="modal fade" id="hapus<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-danger"><strong><center>KONFIRMASI HAPUS TAGIHAN KHUSUS</center></strong></div>
			</div>
			<div class="modal-body">

				<h4 class="modal-title" id="myModalLabel"><center>Yakin user <strong><?php echo $data['nama_user'];?></strong> mau dihapus ?</center></h4>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
                	<a href="?page=page_access_menu_tagihan_khusus&proses_hapus_daftar_tagihan_khusus=ya&id_register=<?php echo $data['id_register'];?>" class="btn btn-danger"><i class="icon-trash icon-large"></i>&nbsp;Iya</a>
				</div>
			</div>                                
		</div>
	</div>
</div>
                