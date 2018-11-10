<div class="modal fade" id="hapus_data_radio<?php echo $id_radio; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center>HAPUS DATA RADIO</center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin anda ingin menghapus data "<strong><?php echo $data['nama_radio']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id" value="<?php echo $data['id_radio']; ?>" />
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
					<button name="tombol_hapus_radio" class="btn btn-danger">Iya</button>
				</div>
			</form>
		</div>
	</div>
</div>
                