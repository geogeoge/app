        <div class="row" style="margin-bottom: 10px">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h2 class="box-title"><?php echo $button ?> Alat</h2>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group">
                                <label class=" control-label col-sm-2" for="varchar">Mac</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" name="mac" id="mac" placeholder="Mac Address" value="<?php echo $mac; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" control-label col-sm-2" for="varchar">Serial Number</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" name="sn" id="sn" placeholder="Serial Number" value="<?php echo $sn; ?>" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label class=" control-label col-sm-2" for="varchar">BTS</label>
                                <div class="col-xs-10">
                                    <select class="form-control" name="nama_bts" id="nama_bts" placeholder="Nama BTS"></select>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label" for="int">BTS</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="id_bts" id="id_bts">
                                            <option selected >Pilih BTS</option>
                                    <?php 
                                        foreach ($bts as $key => $value ) {
                                            ?>
                                                <option value="<?=$value->id_bts?>" <?php if ($id_bts==$value->id_bts) {echo "selected";} ?>><?=$value->nama_bts?></option>
                                            <?php        
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="int">Nota</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="nota" id="nota">
                                            <option selected >Pilih Nota</option>
                                    <?php 
                                        foreach ($jual as $key => $value ) {
                                            ?>
                                                <option value="<?=$value->nota?>" <?php if ($nota==$value->nota) {echo "selected";} ?>><?=$value->nota?></option>
                                            <?php        
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div> -->
                    </div>
                    <div class="box-footer text-right">
                            <input type="hidden" name="id_alat" value="<?php echo $id_alat; ?>" /> 
                            <button type="submit" class="btn btn-flat btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo base_url('alat') ?>" class="btn btn-flat btn-default ">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>

