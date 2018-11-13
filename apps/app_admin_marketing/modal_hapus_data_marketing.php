<div class="modal fade" id="hapus_data_data_marketing<?php echo $id_data_marketing; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center>Hapus Data Marketing</center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin anda ingin menghapus data "<strong><?php echo $data['nama_user']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id_user" value="<?php echo $id_data_marketing; ?>" />
				</div>
				<div class="modal-footer">
					<button name = "hapus_data_marketing" class="btn btn-danger">Iya</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>
                