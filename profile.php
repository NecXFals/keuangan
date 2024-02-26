<?php
require 'cek-sesi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Profile</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php
  require 'koneksi.php';
  require('sidebar.php'); ?>
  <!-- Main Content -->
  <div id="content">

    <?php require('navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Content Row -->
      <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

          <!-- Project Card Example -->
        </div>




        <!-- DataTales Example -->
        <div class="col-xl-8 col-lg-7">
          <button type="button" class="btn btn-success" style="margin:5px" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"> Admin</i></button>
          <br>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Kelola Admin</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>email</th>
                      <th>Password</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nama</th>
                      <th>email</th>
                      <th>Password</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM users");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                      <tr>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['pass'] ?></td>
                        <td><?= $data['role'] ?></td>
                        <td>
                          <!-- Button untuk modal -->
                          <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>"></a>
                        </td>
                      </tr>



                      <!-- Modal -->
                      <div id="myModalTambah" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                          <!-- konten modal-->
                          <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                              <h4 class="modal-title">Tambah Admin</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- body modal -->
                            <form action="tambah-admin.php" method="get">
                              <div class="modal-body">
                                Nama
                                <input type="text" class="form-control" name="nama">
                                Email
                                <input type="email" class="form-control" name="email">
                                Password
                                <input type="password" class="form-control" name="pass">
                              </div>
                              <!-- footer modal -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                          </div>
                        </div>

                      </div>
              </div>



            <?php
                    }
            ?>
            </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>


    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <?php require 'footer.php' ?>

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php require 'logout-modal.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>