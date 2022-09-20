<?php
include "include/koneksi.php";
include "include/tanggal.php";
?>

<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>HOME</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/argon.min5438.css?v=1.2.0" type="text/css">
</head>

<body>
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#login" data-toggle="modal"><i class="ni ni-key-25 text-orange"></i><span class="nav-link-text">Login</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#regist" data-toggle="modal"><i class="ni ni-badge text-danger"></i><span class="nav-link-text">Registrasi</span></a></li>
          </ul>
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link active active-pro" href="">
                <span class="nav-link-text"><?php echo date("Y"); ?> &copy; Rio All Right Reserved.</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="main-content" id="panel">
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo tanggal_indo(date("Y-m-d")); ?></span>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-12 col-12">
              <h6 class="h1 text-white d-inline-block mb-0">SISTEM INFORMASI PEMINJAMAN BARANG LABORATORIUM <br>Teknik Komputer dan Komunikasi </h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <?php include "include/alert.php"; ?>
              <div class="row align-items-center">
                <img src="images/lab.jpg" width="100%">
              </div>
            </div>
            <div class="table-responsive">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal -->
  <form class="form-horizontal" method="post" action="proses.php?act=login">
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header no-bd">
            <h5 class="modal-title"><span class="fw-mediumbold">LOGIN</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>USERNAME</label>
                  <input type="text" name="username" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>PASSWORD</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer no-bd">
            <button type="submit" class="btn btn-primary">MASUK</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Modal -->
  <form class="form-horizontal" method="post" action="proses.php?act=regist">
    <div class="modal fade" id="regist" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header no-bd">
            <h5 class="modal-title"><span class="fw-mediumbold">REGISTRASI</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>NIM/NIDN</label>
                  <input type="number" name="nomor" class="form-control">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>NAMA LENGKAP</label>
                  <input type="text" name="nama" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>TELEPON</label>
                  <input type="text" name="hp" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>ALAMAT</label>
                  <input type="text" name="alamat" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>USERNAME</label>
                  <input type="text" name="username" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>PASSWORD</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer no-bd">
            <button type="submit" class="btn btn-primary">SIMPAN</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="assets/js/argon.min5438.js?v=1.2.0"></script>
  <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>
</body>

</html>