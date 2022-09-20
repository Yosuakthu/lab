<?php
include "../include/koneksi.php";
if ($_GET['act'] == 'Y') {
  $query = mysqli_query($konek, "UPDATE user SET status='1' WHERE id_user='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=regist&alert=1");
  } else {
    header("location: ../index.php?page=regist&alert=2");
  }
} elseif ($_GET['act'] == 'N') {
  $query = mysqli_query($konek, "UPDATE user SET status='2' WHERE id_user='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=regist&alert=1");
  } else {
    header("location: ../index.php?page=regist&alert=2");
  }
}
