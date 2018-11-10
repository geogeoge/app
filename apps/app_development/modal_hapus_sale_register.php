<div class="modal fade" id="modal_hapus<?php echo $data['id_register']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel"><center><strong>HAPUS SALE REGISTER</strong></center></h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger">Yakin Data "<strong><?php echo $data['nama_user']; ?></strong>" ?</div>
				</div>
				<div hidden="true">
					<input type="text" name="id_register" value="<?php echo $data['id_register']; ?>" />
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Tidak</button>
					<button name="hapus_sale_register" class="btn btn-danger">Iya</button>
				</div>
			</form>
		</div>
	</div>
</div>
                