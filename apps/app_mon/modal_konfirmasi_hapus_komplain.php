<div class="modal fade" id="modal_konfirmasi_hapus_komplain<?php echo $data['id_maintenance']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center><strong>HAPUS KOMPLAIN</strong></center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin anda ingin menghapus komplain Pak/Bu "<strong><?php echo $data['nama_user']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id_maintenance" value="<?php echo $data['id_maintenance']; ?>" />
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
					<button name="tombol_konfirmasi_hapus_komplain" class="btn btn-danger">Iya</button>
				</div>
			</form>
		</div>
	</div>
</div>
                