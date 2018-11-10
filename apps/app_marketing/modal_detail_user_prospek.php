<div class="modal fade" id="modal_detail_user_prospek<?php echo $data['id_prospek'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>DATA USER PROSPEK</center></strong></div>
			</div>
			<div class="modal-body">
				<div class="row" hidden="hidden">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="id_prospek" placeholder="No Induk KTP" type="text" value="<?php echo $data['id_prospek']; ?>" autofocus/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="nik" placeholder="No Induk KTP" type="text" value="<?php echo $data['nik']; ?>" autofocus/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="nama_user" placeholder="Nama User Sesuai KTP" type="text" value="<?php echo $data['nama_user']; ?>" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="nama_instansi" placeholder="Nama Instansi" type="text" value="<?php echo $data['nama_instansi']; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="telp" placeholder="Nomor HP" type="text" value="<?php echo $data['telp']; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="email" placeholder="E-Mail" type="text" value="<?php echo $data['email']; ?>"/>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_1" placeholder="Alamat Lengkap" type="text"  value="<?php echo $pecah_alamat['0']; ?>"/>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_2" placeholder="RT" type="text" value="<?php echo $pecah_alamat['1']; ?>"/>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_3" placeholder="RW" type="text" value="<?php echo $pecah_alamat['2']; ?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_4" placeholder="Desa/Kelurahan" type="text" value="<?php echo $pecah_alamat['3']; ?>"/>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_5" placeholder="Kecamatan" type="text" value="<?php echo $pecah_alamat['4']; ?>"/>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_6" placeholder="Kabupaten" type="text" value="<?php echo $pecah_alamat['5']; ?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
					<?php
					$koordinat = $data['koordinat'];
					?>
						<input class="form-control" name="koordinat" placeholder="Koordinat Lokasi" type="text" value="<?php echo htmlentities($koordinat,ENT_QUOTES); ?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<textarea style="resize:vertical;" class="form-control" placeholder="Catatan..." rows="6" name="catatan"><?php echo $data['catatan']; ?></textarea>
					</div>
				</div>
			</div> 
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" name="update_user_prospek" value="Update" />
				<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Batal</button>
			</div> 
			</form>                           
		</div>
	</div>
</div>
