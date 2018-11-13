<div class="modal fade" id="detail_subsidi<?php echo $login_id_marketing;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-success"><strong><center>DATA SALDO SUBSIDI MARKETING</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="POST" enctype="multipart/form-data">
				<div class="form-group" hidden="true">
					<label class="col-sx-2 control-label" for="inputEmail">ID</label>
					<div class="col-sx-10">
						<input type="text" name="login_id_marketing" id="inputEmail" class = "form-control" value="<?php echo $data['login_id_marketing']; ?>">
					</div>
				</div>
				<h4 class="modal-title" id="myModalLabel"><center>SALDO SUBSIDI ANDA : <strong>Rp. <?php echo number_format($select->select_saldo_subsidi_marketing($login_id_marketing),0,',','.');?></strong></center></h4>
				<br>
				<div class = "modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                