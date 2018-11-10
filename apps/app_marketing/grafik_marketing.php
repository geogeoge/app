<?php
    $tampil5     = mysqli_query($koneksi,"select * from sale_register order by id_register");
    $user5       = mysqli_num_rows($tampil5);
    $nama        = mysqli_query($koneksi, "SELECT nama_marketing FROM sale_marketing order by nama_marketing asc");
    $nama2       = mysqli_query($koneksi, "SELECT id_marketing FROM sale_register asc");
    $tampil      = mysqli_query($koneksi, "SELECT * from sale_register order by id_marketing asc");
    $user        = mysqli_num_rows($tampil);
    $jml         = mysqli_query($koneksi, "SELECT count('$user') as jumlahuser FROM sale_register GROUP BY sale_marketing asc");
?>
<body>    
<section>
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Total User SoloNet</h3>
            </div>
             <div class="box-body chart-responsive">
                <!-- <div class="chart" id="bar-chart" style="height: 300px;"></div> -->
                <script src="Chart.js/Chart.bundle.js"></script>
                    <style type="text/css">
                        .container {
                        width: auto;
                        margin: 15px auto;
                        }
                    </style>

                <div class="container">
                    <canvas id="myChart" width="100" height="100"></canvas>
                </div>
                <!-- <center><h4>Total User SoloNet : <?php echo "$user5"; ?> User </h4> </center> -->
                <script>
                    var ctx = document.getElementById("myChart");
                    var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                    labels: [<?php while ($b = mysqli_fetch_array($nama)) { echo '"' . $b['nama_marketing'] . '",';}?>],
                    datasets: [{
                            label: 'User SoloNet',
                            data: [<?php while ($p = mysqli_fetch_array($jml)) { echo '"' . $p['jumlahuser'] . '",';}?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                    });
                </script>
            </div>
        </div>
    </div>
</section>
</body>