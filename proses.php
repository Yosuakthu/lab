<?php
include "include/koneksi.php";
if ($_GET['act'] == 'login') {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $query    = mysqli_query($konek, "SELECT * FROM user WHERE username='$username' AND password='$password' AND status='1'");
  $rows     = mysqli_num_rows($query);
  if ($rows > 0) {
    $data  = mysqli_fetch_assoc($query);
    session_start();
    $_SESSION['id_user']  = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['level']    = $data['level'];
    header("Location: index.php?alert=4");
  } else {
    header("Location: home.php?alert=2");
  }
} elseif ($_GET['act'] == 'regist') {
  $nomor    = $_POST['nomor'];
  $nama     = $_POST['nama'];
  $hp       = $_POST['hp'];
  $alamat   = $_POST['alamat'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $q         = mysqli_query($konek, "SELECT max(id_user) as maksimal FROM user");
  $hasil     = mysqli_fetch_array($q);
  $nilai     = $hasil['maksimal'] + 1;

  $query = mysqli_query($konek, "INSERT INTO user SET id_user='$nilai',nama='$nama',username='$username',password='$password',level='4'");
  if ($query) {
    $query2 = mysqli_query($konek, "INSERT INTO regist SET id_regist='$nilai', nomor='$nomor',nama='$nama',hp='$hp',alamat='$alamat'");
  }
  if ($query2) {
    header("location: home.php?alert=7");
  } else {
    header("location: home.php?alert=2");
  }
}
