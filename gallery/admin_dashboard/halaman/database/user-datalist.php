<?php
require("koneksi.php");
include("functionUser.php");
include("functionAdmin.php");

if (!isset($_SESSION['username']) && !isset($_SESSION['password']) && !isset($_SESSION['admin_id']) && !isset($_SESSION['level'])) {
  header("location: ../../login.php");
} else if ($_SESSION['level'] == 'petugas'){
  header("location: gambar-datalist.php");
}
$see = true;
$admin = detail_data($_SESSION['admin_id']);

$result = tampil_data_user();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  edit_user();
  header("Location: user-datalist.php", true, 303);
  exit();
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Data | Home</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Default" disabled href="../../css/app-937c1ff7d52fd6f78dd9322599e2b5d4.css?vsn=d" />
  <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="../../css/app-wa-8d95b745961f6b33ab3aa1b98a45291a.css?vsn=d" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css" />

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css" />
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css" />
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php" role="button">
            <h6>Logout</h6>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-green elevation-4">
      <!-- Brand Logo -->
      <a href="../../index.php" class="brand-link">
        <span class="brand-text font-weight-light text-center"><?= ucfirst($_SESSION['level']) ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <div class="info">
            <a href="#" class="d-block"><?= $admin['username'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fa-solid fa-database"></i>
                <p>
                  Database
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <?php if($see) {?>
                <li class="nav-item">
                  <a href="user-datalist.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User Datalist</p>
                  </a>
                </li>
                <?php } ?>
                <li class="nav-item">
                  <a href="gambar-datalist.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gambar Datalist</p>
                  </a>
                </li>
                <?php if($see) {?>
                <li class="nav-item">
                  <a href="admin-datalist.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Admin Datalist</p>
                  </a>
                </li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6"></div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User Datalist</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body card-outline card-success">
                <table id="example1" class="table table-hover text-nowrap table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $row["username"] ?></td>
                        <td><?= $row["password"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td class="text-center">
                          <a href="#" class="btn bg-gradient-danger" onclick="showAlert(<?= $row['userid'] ?>)"><i class="fa-regular fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php
                      $i++;
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <!-- MODAL USER -->
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <card class="modal-title" id="exampleModalLabel">
                  Edit User
                </card>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post">
                  <input type="hidden" name="id" id="idp">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-text"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Name" id="nama" name="nama_pembeli" />
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-at"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" id="username" name="username" />
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Password" id="password" name="pw" />
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Telp" id="telp" name="telp" />
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Email" id="email" name="email" />
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-success" name="edit">
                  Save changes
                </button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <!-- Anything you want -->
      </div>
      <!-- Default to the left -->
      Copyright©:Farrel Corp. 2024
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <script>
    function dataModal(idp, tipa) {
      $.ajax({
        type: 'GET',
        url: 'get_data.php',
        data: {
          id: idp,
          tipe: tipa
        }, // Kirim ID barang yang ingin diambil detailnya
        success: function(response) {
          $('#idp').val(response.id_pembeli);
          $('#nama').val(response.nama_pembeli);
          $('#username').val(response.username);
          $('#password').val(response.password);
          $('#telp').val(response.telepon);
          $('#email').val(response.email);
        },
        error: function(xhr, status, error) {
          // Tangani kesalahan jika terjadi
          console.error(error);
        }
      });
    }
  </script>
  <script>
    function showAlert(idp) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success ml-2",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });

      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            window.location.href = "delete_user.php?id=" + idp;
            swalWithBootstrapButtons.fire({
              title: "Deleted!",
              text: "Your file has been deleted.",
              icon: "success",
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire({
              title: "Cancelled",
              text: "Data user is safe :)",
              icon: "error",
            });
          }
        });
    }

    $(function() {
      $("#example1")
        .DataTable({
          responsive: true,
          lengthChange: false,
          autoWidth: false,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          paging: true,
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
      $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
      });
    });
  </script>
</body>

</html>