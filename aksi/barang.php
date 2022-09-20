<?php
include "../include/koneksi.php";

if ($_GET['act'] == 'insert') {
  $nama      = $_POST['nama'];
  $stok      = $_POST['stok'];
  $deskripsi = $_POST['deskripsi'];
  $foto      = $_FILES["foto"]["name"];
  $nama_baru = str_replace(' ', '_', $foto);
  move_uploaded_file($_FILES['foto']['tmp_name'], '../images/barang/' . $nama_baru);
  $query    = mysqli_query($konek, "INSERT INTO barang(nama,deskripsi,stok,foto)
    VALUES('$nama','$deskripsi','$stok','$nama_baru')");
  if ($query) {
    header("location: ../index.php?page=barang&alert=1");
  } else {
    header("location: ../index.php?page=barang&alert=2");
  }
} elseif ($_GET['act'] == 'update') {
  $nama      = $_POST['nama'];
  $stok      = $_POST['stok'];
  $deskripsi = $_POST['deskripsi'];
  $foto      = $_FILES["foto"]["name"];
  $nama_baru = str_replace(' ', '_', $foto);
  if (empty($foto)) {
    $query = mysqli_query($konek, "UPDATE barang SET  nama='$nama',deskripsi='$deskripsi',stok='$stok' WHERE id_barang = '$_GET[id]'");
  } else {
    $hapus      = mysqli_query($konek, "SELECT * FROM barang WHERE id_barang='$_GET[id]'");
    $nama_foto  = mysqli_fetch_array($hapus);
    $lokasi     = $nama_foto['foto'];
    $hapus_foto = "../images/barang/$lokasi";
    unlink($hapus_foto);
    move_uploaded_file($_FILES['foto']['tmp_name'], '../images/barang/' . $nama_baru);
    $query = mysqli_query($konek, "UPDATE barang SET  nama='$nama',deskripsi='$deskripsi',stok='$stok',foto='$nama_baru'WHERE id_barang = '$_GET[id]'");
  }
  if ($query) {
    header("location: ../index.php?page=barang&alert=1");
  } else {
    header("location: ../index.php?page=barang&alert=2");
  }
} elseif ($_GET['act'] == 'delete') {
  $hapus      = mysqli_query($konek, "SELECT * FROM barang WHERE id_barang='$_GET[id]'");
  $nama_foto  = mysqli_fetch_array($hapus);
  $lokasi     = $nama_foto['foto'];
  $hapus_foto = "../images/barang/$lokasi";
  unlink($hapus_foto);
  $query   = mysqli_query($konek, "DELETE FROM barang WHERE id_barang='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=barang&alert=1");
  } else {
    header("location: ../index.php?page=barang&alert=2");
  }
}
