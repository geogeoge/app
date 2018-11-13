<?php
	include "../../koneksi/koneksi.php";
	 
	//PERSEBARAN BTS
	$sql_lokasi_bts="SELECT * FROM mon_lokasibts order by id_lokasi_bts ASC";
	$query_lokasi_bts=mysqli_query($koneksi,$sql_lokasi_bts);
?>
<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      	<div class="row">
			<?php
			while($data_lokasi_bts=mysqli_fetch_array($query_lokasi_bts)){
			    $id_lokasi = $data_lokasi_bts['id_lokasi_bts'];
			    //MULAI PERSENTASE KAPASITAS
            	//HITUNG TOTAL KAPASITAS
                $total_kapasitas=0;
                $sql_kapasitas="SELECT * FROM  mon_databts WHERE lokasi='$id_lokasi'";
                $query_kapasitas=mysqli_query($koneksi,$sql_kapasitas);
                while($data_kapasitas=mysqli_fetch_array($query_kapasitas)){
                    $total_kapasitas = $total_kapasitas + $data_kapasitas['kapasitas_bts'];
                }
                
                //HITUNG TOTAL USER
                  $total_user=0;
                  $sql_jml="SELECT * FROM  mon_databts WHERE lokasi='$id_lokasi'";
                  $query_jml=mysqli_query($koneksi,$sql_jml);
                  while($data_jml_user=mysqli_fetch_array($query_jml)){
                    $id_bts2=$data_jml_user['id_bts'];
                    $sql_jml2="SELECT count(id_pelanggan) as jml_user2 FROM mon_pelanggan WHERE id_bts='$id_bts2'";
                    $query_jml2=mysqli_query($koneksi,$sql_jml2);
                    $data_total_user=mysqli_fetch_array($query_jml2);
                  
                    $total_user=$total_user+$data_total_user['jml_user2'];
                  }
                  $sisa_kapasitas = $total_kapasitas - $total_user;
                  $persentase = ($total_user / $total_kapasitas) * 100;
                 
                 //SELESAI PERSENTASI KAPASITAS

				if ($persentase <= 30) {
					$warna = "red";
				} else
				if ($persentase >= 31 AND $persentase <= 60) {
					$warna = "yellow";
				} else
				if ($persentase >= 61 AND $persentase <= 90) {
					$warna = "green";
				} else
				if ($persentase >= 91) {
					$warna = "aqua";
				} else {
					$warna = "teal";
				}
				?>
				<div class="col-lg-3 col-xs-4">
		          <!-- small box -->
		          <div class="small-box bg-<?php echo $warna; ?>">
		            <div class="inner">
		              <h5><b><?php echo strtoupper($data_lokasi_bts['lokasi_bts']); ?></b></h5>

		              <p><?php echo $persentase; ?> %</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-wifi"></i>
		            </div>
		            <a href="index.php?page=detail_persebaran_bts&id_lokasi=<?php echo $data_lokasi_bts['id_lokasi_bts']; ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
		          </div>
		        </div>
			<?php
			}
			?>
    	</div>
    </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h2 class="box-title"><strong>Data Proyek</strong></h2><br>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10">No.</th>
                  <th width="100">Tanggal Dimulai</th>
                  <th>Nama Project</th>
                  <th colspan="2">Progress</th>
                  <th width="150">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=1;
                foreach ($select->select_persebaran_user_lokasi_bts() as $data) {
                  $id_master_project=$data['id_master_project'];
                  $total_progress=0;
                  $query = mysqli_query($koneksi,"select * from project where id_master_project='$id_master_project'");
                  while($tampil = mysqli_fetch_array($query)){
                    $progress = $tampil['progress'];
                    $total_progress = $total_progress + $progress;
                  }
                  $jumlah_tampil = mysqli_num_rows($query);
                  $rata_rata_progress = $total_progress/$jumlah_tampil;

                  if($jumlah_tampil<=0){
                    $rata_rata_progress=0;
                  }

                  if($rata_rata_progress<=30){
                    $warna_progress_batang = 'danger';
                    $warna_progress = 'red';
                  } else
                  if($rata_rata_progress<=75){
                    $warna_progress_batang = 'warning';
                    $warna_progress = 'yellow';
                  } else
                  if($rata_rata_progress>75){
                    $warna_progress_batang = 'success';
                    $warna_progress = 'green';
                  } else {
                    $warna_progress_batang = 'red';
                    $warna_progress = 'red';
                  }
                ?>
                <tr>
                  <td align="center"><?php echo $no;?></td>
                  <td align="center"><?php echo date("d-m-Y",strtotime($data['tanggal_project']));?></td>
                  <td><?php echo $data['nama_master_project'];?></td>
                  <td width="200">
                    <div class="progress progress-xs">
                      <div class="progress-bar progress-bar-<?php echo $warna_progress_batang;?>" style="width: <?php echo $rata_rata_progress;?>%"></div>
                    </div>
                  </td>
                  <td width="50"><span class="badge bg-<?php echo $warna_progress;?>"><?php echo $rata_rata_progress;?>%</span></td>
                  <td align="center">
                    <a href="?page=page_detail_project_rata_rata&id_master_project=<?php echo $data['id_master_project']; ?>" class="btn btn-xs btn-info">&nbsp;<i class="fa fa-search"></i></a>
                    <a href="#edit_data_master_project<?php echo $data['id_master_project']; ?>" role="button"  data-target = "#edit_data_master_project<?php echo $data['id_master_project'];?>"data-toggle="modal" class="btn btn-xs btn-warning">&nbsp;<i class="fa fa-edit"></i></a>
                    <a href="#hapus_data_master_project<?php echo $data['id_master_project']; ?>" role="button"  data-target = "#hapus_data_master_project<?php echo $data['id_master_project'];?>"data-toggle="modal" class="btn btn-xs btn-danger">&nbsp;<i class="fa fa-close"></i>&nbsp;</a>
                  </td>
                </tr>
                <?php
                $no++;
                include "modal_hapus_master_project.php";
                include "modal_edit_master_project.php";
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th width="10">No.</th>
                  <th width="150">Tanggal Dimulai</th>
                  <th>Nama Project</th>
                  <th colspan="2">Progress</th>
                  <th width="150">Action</th>
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