<?php
include "../include/koneksi.php";

if ($_GET['act'] == 'insert') {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $nama     = $_POST['nama'];
  $level    = $_POST['level'];
  $query    = mysqli_query($konek, "INSERT INTO user(username,password,nama,level,status)
    VALUES('$username','$password','$nama','$level','1')");
  if ($query) {
    header("location: ../index.php?page=user&alert=1");
  } else {
    header("location: ../index.php?page=user&alert=2");
  }
} elseif ($_GET['act'] == 'update') {
  $nama     = $_POST['nama'];
  $username = $_POST['username'];
  $level    = $_POST['level'];
  $password = md5($_POST['password']);
  if (empty($password)) {
    $query = mysqli_query($konek, "UPDATE user SET  username='$username',nama='$nama',level='$level' WHERE id_user = '$_GET[id]'");
  } else {
    $query = mysqli_query($konek, "UPDATE user SET  username='$username',password='$password',nama='$nama',level='$level' WHERE id_user = '$_GET[id]'");
  }
  mysqli_query($konek, "UPDATE regist SET nama='$nama' WHERE id_regist = '$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=user&alert=1");
  } else {
    header("location: ../index.php?page=user&alert=2");
  }
} elseif ($_GET['act'] == 'delete') {
  $query   = mysqli_query($konek, "DELETE FROM user WHERE id_user='$_GET[id]'");
  mysqli_query($konek, "DELETE FROM regist WHERE id_regist='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=user&alert=1");
  } else {
    header("location: ../index.php?page=user&alert=2");
  }
} elseif ($_GET['act'] == 'akun') {
  $nama      = $_POST['nama'];
  $pass      = $_POST['password'];
  $password  = md5($pass);

  if (empty($pass)) {
    $query = mysqli_query($konek, "UPDATE user SET nama='$nama' WHERE id_user = '$_GET[id]'");
  } else {
    $query = mysqli_query($konek, "UPDATE user SET password='$password',nama='$nama' WHERE id_user = '$_GET[id]'");
  }
  mysqli_query($konek, "DELETE FROM regist WHERE id_regist='$_GET[id]'");
  if ($query) {
    header("location: ../home.php?alert=8");
  } else {
    header("location: ../index.php?alert=2");
  }
}
