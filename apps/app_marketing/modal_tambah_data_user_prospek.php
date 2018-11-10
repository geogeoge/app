<form method="POST">
<div class="modal fade" id="tambah_user_prospek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="alert alert-info"><strong><center>TAMBAH DATA USER PROSPEK</center></strong></div>
			</div>
			<div class="modal-body">
				<div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="nik" placeholder="No Induk KTP" type="text" autofocus/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="nama_user" placeholder="Nama User Sesuai KTP" type="text" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="nama_instansi" placeholder="Nama Instansi" type="text" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="telp" placeholder="Nomor HP" type="text" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                        <input class="form-control" name="email" placeholder="E-Mail" type="text" />
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_1" placeholder="Alamat Lengkap" type="text" />
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_2" placeholder="RT" type="text" />
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_3" placeholder="RW" type="text" />
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_4" placeholder="Desa/Kelurahan" type="text" />
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_5" placeholder="Kecamatan" type="text" />
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
						<input class="form-control" name="alamat_6" placeholder="Kabupaten" type="text" />
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
						<input class="form-control" name="koordinat" placeholder="Koordinat Lokasi" type="text" />
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<textarea style="resize:vertical;" class="form-control" placeholder="Catatan..." rows="6" name="catatan"></textarea>
					</div>
				</div>
			</div> 
			<div class="modal-footer">
				<button name = "simpan_user_prospek" class="btn btn-primary">Simpan</button>
				<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i>&nbsp;Batal</button>
			</div>                            
		</div>
	</div>
</div>
</form>