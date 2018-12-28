        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary box-solid">
                    <div class="box-header">
                        <h2 class="box-title" style="vertical-align: middle;">Detail Data Pemasangan Alat</h2>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped">
                            <tr><td>Tanggal Pemasangan</td><td><?php echo $tanggal_pemasangan; ?></td></tr>
                            <tr><td>Tipe</td><td><?php echo $type_user; ?></td></tr>
                            <tr>
                                <td>
                                    <?php 
                                    if ($type_user=='BTS') {
                                         echo 'Nama BTS';
                                     }else{
                                         echo 'Nama User';
                                     } 
                                     ?>
                                </td>
                                <td><?php echo $id_user; ?></td></tr>
                            <tr><td>Alat</td><td><?php echo $nama; ?></td></tr>
                            <tr><td>Jumlah Alat</td><td><?php echo $jumlah_alat; ?></td></tr>
                            <tr><td>Harga</td><td><?php echo 'Rp. '.number_format($harga,0,',','.'); ?></td></tr>
                            <tr><td>Umur Alat</td><td><?php echo $umur_alat; ?> Bulan</td></tr>
                            <tr><td>Perbulan</td><td><?php echo 'Rp. '.number_format($perbulan,0,',','.'); ?></td></tr>
                            <tr>
                                <td colspan="2">
                                    <div class="progress-group">
                                        <span class="progress-text" style="font-weight: normal;">Sisa Umur</span>
                                        <span class="progress-number"><?=$umur_jalan?>/<?=$umur_alat?> Bulan</span>

                                        <div class="progress progress-sm progress-striped active">
                                            <?php if ($umur_jalan==$umur_alat){ ?>
                                                <div class="progress-bar progress-bar-red" style="width: <?=$rata_sisa?>%"></div>
                                            <?php }else{ ?>
                                                <div class="progress-bar progress-bar-success" style="width: <?=$rata_sisa?>%"></div>
                                            <?php } ?>
                                        </div>
                                      </div>                            
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="box-footer text-right">
                        <a href="<?php echo base_url('data_pemasangan_alat') ?>" class="btn btn-flat btn-default">Kembali</a></td></tr>
                    </div>
                </div>
            </div>
        </div>
