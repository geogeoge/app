<div class="modal fade" id="modal_konfirmasi_hapus_lokasi_bts<?php echo $data['id_lokasi_bts']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center><strong>HAPUS LOKASI BTS</strong></center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin anda ingin menghapus lokasi BTS "<strong><?php echo $data['lokasi_bts']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id_lokasi_bts" value="<?php echo $data['id_lokasi_bts']; ?>" />
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
					<button name="tombol_hapus_lokasi_bts" class="btn btn-danger">Iya</button>
				</div>
			</form>
		</div>
	</div>
</div>
                