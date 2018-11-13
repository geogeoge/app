<section class="content-header">
  <h1 class="">
    Input Komplen
    <small>SoloNet</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tabel Data User</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach($select->select_user_input_komplen() as $data) {
            $pecah_alamat=explode("#",$data['alamat']);
              $alamat = $pecah_alamat['0']." Rt. ".$pecah_alamat['1']."/".$pecah_alamat['2'].", ".$pecah_alamat['3'].", ".$pecah_alamat['4'].", ".$pecah_alamat['5'];
            
            ?>
            <tr>
              <td align="left"><?php echo $data['nama_user']; ?></td>
              <td align="left"><?php echo $alamat; ?></td>
              <td align="center"><?php echo $data['telp']; ?></td>
              <td align="center"><?php echo $data['nama_marketing']; ?></td>
              <td width="50" align="center">
                <a href="#modal_input_komplen<?php echo $data['id_register']; ?>" role="button"  data-target = "#modal_input_komplen<?php echo $data['id_register']; ?>" data-toggle="modal" class="btn btn-info">&nbsp;<i class="fa fa-edit"></i></a>
              </td>
            </tr>
          <?php
          include "modal_input_komplen.php";

          $no++;
          }
          ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Nama User</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Marketing</th>
              <th>Action</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

