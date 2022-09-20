<?php
error_reporting("no");

if (empty($_GET['alert'])) {
  echo "";
} elseif ($_GET['alert'] == 1) {
  echo "<div class='alert alert-success alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h3><i class='icon mdi mdi-check-circle'></i> Success!</h3>
    </div>";
} elseif ($_GET['alert'] == 2) {
  echo "<div class='alert alert-danger alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h4>  <i class='icon mdi mdi-close'></i> Error!</h4>
  </div>";
} elseif ($_GET['alert'] == 3) {
  echo "<div class='alert alert-danger alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h4><i class='icon mdi mdi-close-circle'></i> GAGAL!</h4>
  Stok Tidak Cukup.
  </div>";
} elseif ($_GET['alert'] == 4) {
  echo "<div class='alert alert-primary alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h4><i class='icon mdi mdi-check-circle'></i> Login Sukses, Selamat Datang $nama !</h4>
  </div>";
} elseif ($_GET['alert'] == 5) {
  echo "<div class='alert alert-success alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h4><i class='icon mdi mdi-check-circle'></i> Berhasil Logout!</h4>
  Terima Kasih Telah Berkunjung.
  </div>";
} elseif ($_GET['alert'] == 6) {
  echo "<div class='alert alert-danger alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h4><i class='icon mdi mdi-close-circle'></i> ERROR!</h4>
  Silahkan Login Terlebih Dahulu.
  </div>";
} elseif ($_GET['alert'] == 7) {
  echo "<div class='alert alert-primary alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h4><i class='icon mdi mdi-close-circle'></i> SUKSES!</h4>
  Data anda akan dicek oleh ADMIN terlebih dahulu.
  </div>";
} elseif ($_GET['alert'] == 8) {
  echo "<div class='alert alert-primary alert-dismissable'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
  <h4><i class='icon mdi mdi-close-circle'></i> SUKSES!</h4>
  Login Kembali.
  </div>";
}
