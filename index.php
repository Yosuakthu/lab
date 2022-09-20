<?php
session_start();
error_reporting("no");
include "include/koneksi.php";
include "include/tanggal.php";
include "include/rupiah.php";
$id_user  = $_SESSION['id_user'];
$username = $_SESSION['username'];
$nama     = $_SESSION['nama'];
$level    = $_SESSION['level'];

if ($level == 1) {
  $lvl = "Laboran";
} elseif ($level == 2) {
  $lvl = "Kepala Laboratorium";
} elseif ($level == 3) {
  $lvl = "Ketua Jurusan";
} else {
  $lvl = "Peminjam";
}

$kajur = mysqli_num_rows(mysqli_query($konek, "SELECT * from pinjam WHERE status_kajur=''"));
$kalab = mysqli_num_rows(mysqli_query($konek, "SELECT * from pinjam WHERE status_kajur='Y' AND status_kalab=''"));
$ambil = mysqli_num_rows(mysqli_query($konek, "SELECT * from pinjam WHERE status_kalab='Y' AND bukti_ambil=''"));
$antar = mysqli_num_rows(mysqli_query($konek, "SELECT * from pinjam WHERE bukti_ambil!='' AND bukti_antar=''"));
?>

<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>LAB TKK</title>
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
            <li class="nav-item"><a class="nav-link" href="index.php"><i class="ni ni-tv-2 text-primary"></i><span class="nav-link-text">Dashboard</span></a></li>
            <?php if ($level == 1) { ?>
              <li class="nav-item"><a class="nav-link" href="?page=user"><i class="ni ni-circle-08 text-orange"></i><span class="nav-link-text">User</span></a></li>
              <li class="nav-item"><a class="nav-link" href="?page=regist"><i class="ni ni-single-02 text-info"></i><span class="nav-link-text">Register</span></a></li>
            <?php } ?>
            <li class="nav-item"><a class="nav-link" href="?page=peminjam"><i class="ni ni-circle-08 text-primary"></i><span class="nav-link-text">Peminjam</span></a></li>
            <?php if ($level == 1) { ?>
              <li class="nav-item"><a class="nav-link" href="?page=barang"><i class="ni ni-archive-2 text-success"></i><span class="nav-link-text">Barang</span></a></li>
            <?php } else { ?>
              <li class="nav-item"><a class="nav-link" href="?page=barang2"><i class="ni ni-archive-2 text-success"></i><span class="nav-link-text">Barang</span></a></li>
            <?php } ?>
            <li class="nav-item"><a class="nav-link" href="?page=pinjam"><i class="ni ni-cart text-warning"></i><span class="nav-link-text">Peminjaman</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#akun" data-toggle="modal"><i class="ni ni-settings-gear-65 text-info"></i><span class="nav-link-text">Data Saya</span></a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="ni ni-button-power text-danger"></i><span class="nav-link-text">Logout</span></a></li>
          </ul>
          <!-- Navigation -->
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
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $nama; ?>/<small><?php echo $lvl; ?></small></span>
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
          <br>
          <?php
          if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
            echo "<meta http-equiv='refresh' content='0; url=home.php?alert=6'>";
          } else {
            if (isset($_GET['page'])) {
              if ($_GET['page'] == "barang")
                include "pages/barang.php";
              elseif ($_GET['page'] == "barang2")
                include "pages/barang2.php";
              elseif ($_GET['page'] == "user")
                include "pages/user.php";
              elseif ($_GET['page'] == "regist")
                include "pages/regist.php";
              elseif ($_GET['page'] == "pinjam")
                include "pages/pinjam.php";
              elseif ($_GET['page'] == "pinjam_entry")
                include "pages/pinjam_entry.php";
              elseif ($_GET['page'] == "pinjam_detail")
                include "pages/pinjam_detail.php";
              elseif ($_GET['page'] == "pinjam_cetak")
                include "pages/pinjam_cetak.php";
              elseif ($_GET['page'] == "peminjam")
                include "pages/peminjam.php";
            } else {
          ?>
              <?php if ($level != 4) { ?>
                <div class="row">
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <a href="?page=pinjam">
                              <h5 class="card-title text-uppercase text-muted mb-0">Permohonan Belum Disetujui</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $kajur; ?></span>
                            </a>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                              <i class="ni ni-active-40"></i>
                            </div>
                          </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                          <span class="text-success mr-2"></span>
                          <span class="text-nowrap"></span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <a href="?page=pinjam">
                              <h5 class="card-title text-uppercase text-muted mb-0">Permintaan Belum Diterima</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $kalab; ?></span>
                            </a>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                              <i class="ni ni-chart-pie-35"></i>
                            </div>
                          </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                          <span class="text-success mr-2"></span>
                          <span class="text-nowrap"></span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <a href="?page=pinjam">
                              <h5 class="card-title text-uppercase text-muted mb-0">Barang Belum Diambil</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $ambil; ?></span>
                            </a>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                              <i class="ni ni-money-coins"></i>
                            </div>
                          </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                          <span class="text-success mr-2"></span>
                          <span class="text-nowrap"></span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <a href="?page=pinjam">
                              <h5 class="card-title text-uppercase text-muted mb-0">Barang Belum Dikembalikan</h5>
                              <span class="h2 font-weight-bold mb-0"><?php echo $antar; ?></span>
                            </a>
                          </div>
                          <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                              <i class="ni ni-chart-bar-32"></i>
                            </div>
                          </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                          <span class="text-success mr-2"></span>
                          <span class="text-nowrap"></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
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
<?php
            }
          }
?>
  </div>


  <form method="post" action="aksi/user.php?act=akun&id=<?php echo $id_user; ?>">
    <div class="modal fade" id="akun" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Akun Saya</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              Nama Lengkap
              <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
              Username
              <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" required>
            </div>
            <div class="form-group">
              Password
              <input type="password" name="password" class="form-control" Placeholder="*****************">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
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