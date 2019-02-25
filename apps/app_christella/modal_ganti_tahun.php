<div class="modal fade" id="ganti_tahun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>GANTI TAHUN</center></strong></div>
			</div>
			<div class="modal-body">
				<form  method="GET" enctype="multipart/form-data">
				<h4 class="modal-title" id="myModalLabel"><center>Berapa hari perpanjang masa trial user <strong><?php echo $data['nama_user'];?></strong> ?</center></h4>
				<br>
				<div hidden>
				    <input type="text" name="page" id="inputEmail" class = "form-control" value="page_data_user_setiap_bulan">
				</div>
				<div class="form-group">
					<div class="col-sx-10">
						<select class = "form-control" name="tahun">
						    <?php 
						    $tahun_list = $tahun;
						    for ($i=0; $i < 3; $i++) {
						        
						    ?>
							<option value="<?php echo $tahun_list;?>"><?php echo $tahun_list;?></option>
							<?php
							    $tahun_list = $tahun_list-1;
						    }
						    ?>
						</select>  
					</div>
				</div>
				<div class = "modal-footer">
					<button name = "tombol_perpanjang" class="btn btn-info">Iya</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Enggak</button>
				</div>
				</form> 
			</div>                                
		</div>
	</div>
</div>
                