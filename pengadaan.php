<?php
require 'cek-sesi.php';
if ($_SESSION['role'] == "admin") {
  if (isset($_GET['action']) && isset($_GET['request_id'])) {
    $act = $_GET['action'];
    $rid = $_GET['request_id'];
    $cek = mysqli_query($koneksi, "SELECT * FROM requests WHERE id='$rid'");
    if (mysqli_num_rows($cek) == 1) {
      switch ($act) {
        case "accept":
          $status = 1;
          break;
        case "reject":
          $status = 2;
          break;
      }

      if (isset($status)) {
        $timestamp = $_SERVER['REQUEST_TIME'];
        $a = mysqli_query($koneksi, "UPDATE requests SET status='$status', admin_response='$timestamp' WHERE id='$rid'");
        if ($a) {
          echo "<script>alert('Berhasil memperbarui data');</script>";
        } else {
          echo "<script>alert('Gagal memperbarui data');</script>";
        }
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pengadaan</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <?php require 'koneksi.php';
  require 'sidebar.php'; ?>
  <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
      <h1>Pengeluaran Keuangan Diskominfo</h1>

      <?php require 'user.php'; ?>
    </nav>
    <div class="container-fluid">
      <h1 class="h3 mb-2 text-gray-800">Daftar Permintaan Pengadaan Barang</h1>
      <a href="report/laporan-pengadaan.php"><button class="btn btn-success" style="margin:5px"><i class="fas fa-download fa-sm"> Download Laporan</i></button></a>
      <?php if ($_SESSION['role'] == "worker") { ?>
        <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#requestPengadaan"><i class="fa fa-plus"> Minta Pengadaan Barang</i></button><br>
      <?php } ?>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Riwayat</h6>
          <br>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Barang</th>
                  <th>Harga Satuan</th>
                  <th>Kuantitas</th>
                  <th>Pemohon</th>
                  <?php if ($_SESSION['role'] == "worker") { ?>
                    <th>Status</th>
                  <?php } elseif ($_SESSION['role'] == "admin") { ?>
                    <th>Aksi</th>
                  <?php }
                  if ($_SESSION['role'] == "admin") { ?>
                    <th>Opsi</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM requests ORDER BY id DESC");
                $no = 1;

                $get_karyawan = mysqli_query($koneksi, "SELECT * FROM users ORDER BY nama ASC");
                while ($data_karyawan = mysqli_fetch_array($get_karyawan)) {
                  $karyawan[$data_karyawan['id']] = array(
                    "nama" => $data_karyawan['nama']
                  );
                }

                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['title'] ?></td>
                    <td><?= number_format($data['price'], 2, ',', '.') ?></td>
                    <td><?= $data['qty'] ?></td>
                    <td><?= $karyawan[$data['requester']]['nama'] ?></td>
                    <td>
                      <?php
                      if ($_SESSION['role'] == "worker") {
                        switch ($data['status']) {
                          case 0:
                            echo "<span class='bg-warning text-white py-1 px-5 rounded d-block w-100 text-center'>Sedang direview</span>";
                            break;
                          case 1:
                            echo "<span class='bg-success text-white py-1 px-5 rounded d-block w-100 text-center'>Disetujui</span>";
                            break;
                          case 2:
                            echo "<span class='bg-danger text-white py-1 px-5 rounded d-block w-100 text-center'>Tidak Disetujui</span>";
                            break;
                        }
                      } elseif ($_SESSION['role'] == "admin") {
                        if ($data['status'] == 0) {
                          echo "<a href='pengadaan.php?action=accept&request_id=" . $data['id'] . "' class='btn btn-primary'>Accept</a> <a href='pengadaan.php?action=reject&request_id=" . $data['id'] . "' class='btn btn-warning'>Reject</a>";
                        } else {
                          switch ($data['status']) {
                            case 0:
                              echo "Sedang direview";
                              break;
                            case 1:
                              echo "Disetujui";
                              break;
                            case 2:
                              echo "Tidak Disetujui";
                              break;
                          }
                        }
                      }
                      ?>
                    </td>
                    <?php if ($_SESSION['role'] == "admin") { ?>
                      <td>
                        <!-- Button untuk modal -->
                        <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>"></a>
                      </td><?php } ?>
                  </tr>
                  <div class="modal fade" id="myModal<?php echo $data['id']; ?>" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Ubah Data Pengadaan</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form role="form" action="proses-edit-pengadaan.php" method="get">

                            <?php
                            $id = $data['id'];
                            $query_edit = mysqli_query($koneksi, "SELECT * FROM requests WHERE id='$id'");
                            //$result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($query_edit)) {
                            ?>


                              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                              <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>">
                              </div>

                              <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="price" class="form-control" value="<?php echo $row['price']; ?>">
                              </div>

                              <div class="form-group">
                                <label>Total</label>
                                <input type="text" name="qty" class="form-control" value="<?php echo $row['qty']; ?>">
                              </div>

                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Ubah</button>
                                <a href="hapus-pengadaan.php?id=<?= $row['id']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                              </div>
                            <?php
                            }
                            //mysql_close($host);
                            ?>

                          </form>
                        </div>
                      </div>

                    </div>
                  </div>
                  <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require 'footer.php' ?>
  </div>
  </div>

  <!-- Modal -->
  </div>

  <div id="requestPengadaan" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Request Pengadaan Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form action="proses-pengadaan-barang.php" method="get">
          <div class="modal-body">
            Nama Barang : <input type="text" class="form-control" name="nama_barang">
            Harga Satuan : <input type="number" class="form-control" name="harga_Satuan">
            Banyaknya : <input type="number" class="form-control" name="kuantitas">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
      </div>
    </div>

  </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php require 'logout-modal.php'; ?>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["7 hari lalu", "6 hari lalu", "5 hari lalu", "4 hari lalu", "3 hari lalu", "2 hari lalu", "1 hari lalu"],
        datasets: [{
          label: "Pendapatan",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: [<?php echo $tujuhhari['0'] ?>, <?php echo $enamhari['0'] ?>, <?php echo $limahari['0'] ?>, <?php echo $empathari['0'] ?>, <?php echo $tigahari['0'] ?>, <?php echo $duahari['0'] ?>, <?php echo $satuhari['0'] ?>],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return 'Rp.' + number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Pendapatan", "Pengeluaran"],
        datasets: [{
          data: [<?php echo $pendapatan ?>, <?php echo $pengeluaran ?>],
          backgroundColor: ['#4e73df', '#e74a3b'],
          hoverBackgroundColor: ['#2e59d9', '#e74a3b'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
  </script>



  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


</body>

</html>