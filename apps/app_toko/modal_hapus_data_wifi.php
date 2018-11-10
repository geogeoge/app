<div class="modal fade" id="hapus_data_wifi<?php echo $id_wifi; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center>HAPUS DATA WIFI</center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin anda ingin menghapus data "<strong><?php echo $data['nama_wifi']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id" value="<?php echo $data['id_wifi']; ?>" />
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
					<button name="tombol_hapus_wifi" class="btn btn-danger">Iya</button>
				</div>
			</form>
		</div>
	</div>
</div>
                