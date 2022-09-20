<?php
session_start();
include "../include/koneksi.php";
$id_user = $_SESSION['id_user'];
$nama    = $_SESSION['nama'];

if ($_GET['act'] == 'entry') {
  $id_barang = $_POST['id_barang'];
  $jlh       = $_POST['jlh'];
  $query     = mysqli_query($konek, "SELECT * FROM barang WHERE id_barang='$id_barang'");
  $data      = mysqli_fetch_assoc($query);
  $stok      = $data['stok'];
  $stok2     = $stok - $jlh;
  if ($stok < $jlh) {
    header("location: ../index.php?page=pinjam_entry&alert=3");
  } else {
    $query1 = mysqli_query($konek, "SELECT * FROM tempo WHERE id_barang='$id_barang'");
    if (mysqli_num_rows($query1) > 0) {
      $ubah   = mysqli_fetch_assoc($query1);
      $jumbel = $ubah['jlh'] + $jlh;
      $query2 = mysqli_query($konek, "UPDATE tempo SET jlh='$jumbel' WHERE id_barang='$id_barang'");
      if ($query2 === TRUE) {
        $query2 = mysqli_query($konek, "UPDATE barang SET stok='$stok2' WHERE id_barang='$id_barang'");
        header("location: ../index.php?page=pinjam_entry&alert=1");
      }
    } else {
      $query3 = mysqli_query($konek, "INSERT INTO tempo SET id_barang='$id_barang',id_user='$id_user',jlh='$jlh'");
      if ($query3 === TRUE) {
        $query4 = mysqli_query($konek, "UPDATE barang set stok='$stok2' WHERE id_barang='$id_barang'");
        header("location: ../index.php?page=pinjam_entry&alert=1");
      }
    }
  }
} elseif ($_GET['act'] == 'delete') {
  $query     = mysqli_query($konek, "SELECT * FROM tempo WHERE id_tempo='$_GET[id_tempo]'");
  $data      = mysqli_fetch_assoc($query);
  $id_barang = $data['id_barang'];
  $jlh       = $data['jlh'];
  $query2    = mysqli_query($konek, "SELECT * FROM barang WHERE id_barang='$id_barang'");
  $data2     = mysqli_fetch_assoc($query2);
  $stok      = $data2['stok'];
  $stok2     = $stok + $jlh;
  $query3    = mysqli_query($konek, "UPDATE barang set stok='$stok2' WHERE id_barang='$id_barang'");
  if ($query3 === TRUE) {
    $query4   = mysqli_query($konek, "DELETE FROM tempo WHERE id_tempo='$_GET[id_tempo]'");
  }
  if ($query4 === TRUE) {
    header("location: ../index.php?page=pinjam_entry&alert=1");
  } else {
    header("location: ../index.php?page=pinjam_entry&alert=2");
  }
} elseif ($_GET['act'] == 'selesai') {
  $tgl    = date('Y-m-d');
  $dari   = $_POST['dari'];
  $sampai = $_POST['sampai'];
  $kode   = date("d") . "/LAB.TKK/" . $id_user . "/" . date("y/h/i/s");
  $surat      = $_FILES["surat"]["name"];
  $nama_baru = str_replace(' ', '_', $surat);
  move_uploaded_file($_FILES['surat']['tmp_name'], '../images/surat/' . $nama_baru);
  $query  = mysqli_query($konek, "INSERT INTO pinjam SET id_user='$id_user',nama='$nama',dari='$dari',sampai='$sampai',surat='$nama_baru',kode='$kode',tgl='$tgl'");
  // ----------------------------------------------------------------
  $q     = mysqli_query($konek, "SELECT max(id_pinjam) as maksimal FROM pinjam");
  $hasil = mysqli_fetch_array($q);
  $nilai = $hasil['maksimal'];

  $query2 = mysqli_query($konek, "SELECT * FROM tempo WHERE id_user='$id_user'");
  while ($data = mysqli_fetch_assoc($query2)) {
    $id_barang = $data['id_barang'];
    $jlh       = $data['jlh'];
    $query3    = mysqli_query($konek, "INSERT INTO sub_transaksi SET id_barang='$id_barang',id_pinjam ='$nilai',jlh='$jlh'");
  }
  if ($query3 === TRUE) {
    $query4 = mysqli_query($konek, "DELETE FROM tempo WHERE id_user='$id_user'");
  }
  if ($query4 === TRUE) {
    header("location: ../index.php?page=pinjam&alert=1");
  } else {
    header("location: ../index.php?page=pinjam&alert=2");
  }
} elseif ($_GET['act'] == 'kajurY') {
  $query   = mysqli_query($konek, "UPDATE pinjam SET status_kajur='Y' WHERE id_pinjam='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=pinjam&alert=1");
  } else {
    header("location: ../index.php?page=pinjam&alert=2");
  }
} elseif ($_GET['act'] == 'kajurN') {
  $query   = mysqli_query($konek, "UPDATE pinjam SET status_kajur='N' WHERE id_pinjam='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=pinjam&alert=1");
  } else {
    header("location: ../index.php?page=pinjam&alert=2");
  }
} elseif ($_GET['act'] == 'kalabY') {
  $query   = mysqli_query($konek, "UPDATE pinjam SET status_kalab='Y' WHERE id_pinjam='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=pinjam&alert=1");
  } else {
    header("location: ../index.php?page=pinjam&alert=2");
  }
} elseif ($_GET['act'] == 'kajurY') {
  $query   = mysqli_query($konek, "UPDATE pinjam SET status_kalab='N' WHERE id_pinjam='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=pinjam&alert=1");
  } else {
    header("location: ../index.php?page=pinjam&alert=2");
  }
} elseif ($_GET['act'] == 'download') {
  $back_dir   = "../images/surat/";
  $file = $back_dir . $_GET['surat'];

  if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: private');
    header('Pragma: private');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
  } else {
    header("location: ../index.php?page=pinjam_detail&id=$_GET[id]&alert=2");
  }
} elseif ($_GET['act'] == 'ambil') {
  $bukti_ambil = $_FILES["bukti_ambil"]["name"];
  $nama_baru   = str_replace(' ', '_', $bukti_ambil);
  move_uploaded_file($_FILES['bukti_ambil']['tmp_name'], '../images/bukti/' . $nama_baru);
  $query       = mysqli_query($konek, "UPDATE pinjam SET bukti_ambil='$nama_baru' WHERE id_pinjam='$_GET[id]'");
  if ($query) {
    header("location: ../index.php?page=pinjam&alert=1");
  } else {
    header("location: ../index.php?page=pinjam&alert=2");
  }
} elseif ($_GET['act'] == 'antar') {
  $bukti_antar = $_FILES["bukti_antar"]["name"];
  $nama_baru   = str_replace(' ', '_', $bukti_antar);
  move_uploaded_file($_FILES['bukti_antar']['tmp_name'], '../images/bukti/' . $nama_baru);
  $query       = mysqli_query($konek, "UPDATE pinjam SET bukti_antar='$nama_baru' WHERE id_pinjam='$_GET[id]'");
  if ($query) {
    $query1     = mysqli_query($konek, "SELECT * FROM sub_transaksi WHERE id_pinjam='$_GET[id]'");
    while ($data = mysqli_fetch_array($query1)) {
      $id_barang = $data['id_barang'];
      $jlh       = $data['jlh'];
      // ------------------------------------------------------
      $query2 = mysqli_query($konek, "SELECT * FROM barang WHERE id_barang='$id_barang'");
      while ($row = mysqli_fetch_array($query2)) {
        $id_barang2 = $row['id_barang'];
        $stok       = $row['stok'] + $jlh;
        $sql        = mysqli_query($konek, "UPDATE barang SET stok='$stok' WHERE id_barang = '$id_barang2'");
      }
    }
  }
  if ($sql) {
    header("location: ../index.php?page=pinjam&alert=1");
  } else {
    header("location: ../index.php?page=pinjam&alert=2");
  }
} 
// elseif ($_GET['act'] == 'cancel') {
//   $query     = mysqli_query($konek, "SELECT * FROM sub_transaksi WHERE id_transaksi='$_GET[id]'");
//   while ($data = mysqli_fetch_array($query)) {
//     $id_barang = $data['id_barang'];
//     $jlh       = $data['jlh'];
//     // ------------------------------------------------------
//     $query1 = mysqli_query($konek, "SELECT * FROM barang WHERE id_barang='$id_barang'");
//     while ($row = mysqli_fetch_array($query1)) {
//       $id_barang2 = $row['id_barang'];
//       $stok       = $row['stok'] + $jlh;
//       $sql        = mysqli_query($konek, "UPDATE barang SET stok='$stok' WHERE id_barang = '$id_barang2'");
//     }
//   }
//   // ------------------------------------------------------
//   $query3   = mysqli_query($konek, "DELETE FROM sub_transaksi WHERE id_transaksi='$_GET[id]'");
//   $query4   = mysqli_query($konek, "DELETE FROM transaksi WHERE id_transaksi='$_GET[id]'");
//   // ------------------------------------------------------
//   if ($query4 === TRUE) {
//     header("location: ../index.php?page=pinjam&alert=1");
//   }
// }
