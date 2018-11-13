<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-danger"><strong><center>PERINGATAN USER DENGAN TAGIHAN KHUSUS</center></strong></div>
			</div>
			<div class="modal-body">

			<?php
			while($data_tagihan_khusus = mysqli_fetch_array($query_tagihan_khusus)){

			?>
				<h4 class="modal-title" id="myModalLabel">~> <strong><?php echo $data_tagihan_khusus['nama_user'];?></strong>&nbsp;<small>Tunggakan : <?php echo $data_tagihan_khusus['(billing_bulan_berjalan-billing_bulan_terbayar)'];?></small></h4>
			<?php
			}
			?>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>                                
		</div>
	</div>
</div>
                