        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h2 class="box-title"><?php echo $button ?> Data Pemasangan Alat</h2>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo $action; ?>" method="post"  class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="date">Tanggal Pemasangan</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                    <input type="text" class="form-control" name="tanggal_pemasangan" id="datepicker" placeholder="Tanggal Pemasangan" value="<?php echo $tanggal_pemasangan; ?>" autocomplete="off" readonly="" style="cursor: pointer;"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="varchar">Nota</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="nota" id="nota" data-placeholder="Nota">
                                        <?php 
                                            if($nota!=''){
                                                echo '<option value="'.$nota.'">'.$nota.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="enum">Tipe</label>
                                <div class="col-md-10">
                                    <div class="" style="display: inline-block; width: auto;">
                                        <input class="tipe-user" type="radio" name="type_user" value="BTS" <?php if($type_user=='BTS')echo "checked";?> <?php if($type_user=='')echo "checked";?>>
                                        <label>BTS</label>
                                    </div>
                                    <div class="" style="display: inline-block; width: auto;">
                                        <input class="tipe-user2" type="radio" name="type_user" value="Client" <?php if($type_user=='Client')echo "checked";?>>
                                        <label>Client</label>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="varchar">User</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="id_user" id="id_user" data-placeholder="Pilih User">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="varchar">Alat</label>
                                <div class="col-md-10">
                                    <select class="form-control select2" name="id_alat" id="id_alat" data-placeholder="Pilih Alat" data-disable="true">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="int">Jumlah Alat</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="jumlah_alat" id="jumlah_alat" placeholder="Jumlah Alat" value="<?php echo $jumlah_alat; ?>" data-inputmask="'mask' : '9' , 'greedy': false" data-mask min='0'/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="int">Harga</label>
                                <!-- <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" /> -->
                                <div class="col-md-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="numeric" readonly class="form-control" name="harga" id="harga" placeholder="Harga Alat" value="<?php echo $harga; ?>" data-inputmask="'alias': 'decimal', 'groupSeparator': '.', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0','rightAlignNumerics': false" data-mask style="text-align: left!important" autocomplete="off">
                                        </div>
                                </div>
                            </div>
                            <?php 
                                if ($this->uri->segment(2)=='create' || $this->uri->segment(2)=='create_action') {
                            ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="int">Umur Alat</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="umur_alat" id="umur_alat" placeholder="Umur Alat" value="<?php echo $umur_alat; ?>" data-inputmask="'mask' : '9' , 'repeat' : 3, 'greedy': false" data-mask/>
                                        <span class="input-group-addon">Bulan</span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                    </div>
                    <div class="box-footer text-right">
                            <input type="hidden" name="id_pemasangan_alat" value="<?php echo $id_pemasangan_alat; ?>" /> 
                            <button type="submit" class="btn btn-flat btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo base_url('data_pemasangan_alat') ?>" class="btn btn-flat btn-default ">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>