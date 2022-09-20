<!-- Card stats -->
<div class="row">
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
            <div class="col">
              <h2 class="mb-0">Detail Peminjaman</h2>
              <?php
              $detail = mysqli_query($konek, "SELECT * FROM pinjam INNER JOIN user USING(id_user) WHERE id_pinjam='$_GET[id]'");
              while ($getqheader = mysqli_fetch_array($detail)) {
                $tanggal = date('Y-m-d', strtotime($getqheader['tgl']));
              ?>
                <div class="control-group">
                  <table>
                    <tr>
                      <td>Nama</td>
                      <td>:</td>
                      <td><?php echo $getqheader['nama'] ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal</td>
                      <td>:</td>
                      <td><?php echo tanggal_indo($tanggal); ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>No Invoice</td>
                      <td>:</td>
                      <td><?php echo $getqheader['kode'] ?></td>
                    </tr>
                  </table>
                <?php } ?>
                </div>
            </div>
            <div class="col text-right">
              <a href="?page=pinjam" class="btn btn-warning btn-sm">Kembali</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead>
              <tr>
                <th style="width: 3%">No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query1 = mysqli_query($konek, "SELECT barang.id_barang,barang.foto,barang.nama,sub_transaksi.jlh from sub_transaksi INNER JOIN barang on barang.id_barang=sub_transaksi.id_barang WHERE sub_transaksi.id_pinjam='$_GET[id]'");
              while ($data1 = mysqli_fetch_assoc($query1)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><img src="images/barang/<?php echo $data1["foto"]; ?>" width="70px" height="70px">
                  </td>
                  <td><?php echo $data1["nama"]; ?></td>
                  <td><?php echo $data1["jlh"]; ?></td>
                  <?php include 'aksi/barang_edit.php'; ?>
                </tr>
              <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <?php include "include/alert.php"; ?>
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Status Peminjaman</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead>
              <tr>
                <th width="7%">No</th>
                <th>Periode</th>
                <?php if ($level == 3) { ?>
                  <th width="15%">Surat</th>
                <?php } ?>
                <th width="10%">Status Permohonan</th>
                <th width="10%">Status Peminjaman</th>
                <th width="10%">Ambil</th>
                <th width="10%">Kembali</th>

              </tr>
            </thead>
            <?php
            $no = 1;
            $query  = mysqli_query($konek, "SELECT * FROM pinjam WHERE id_pinjam='$_GET[id]'");
            while ($data = mysqli_fetch_array($query)) {
            ?>
              <tbody>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td>
                    <?php echo date('d/m/Y', strtotime($data['dari'])); ?> -
                    <?php echo date('d/m/Y', strtotime($data['sampai'])); ?>
                  </td>
                  <?php if ($level == 3) { ?>
                    <td><a href="aksi/pinjam.php?act=download&surat=<?php echo $data['surat']; ?>&id=<?php echo $data['id_pinjam']; ?>" target="_blank">Download</a></td>
                  <?php } ?>
                  <td><?php if ($data["status_kajur"] == 'Y') { ?>
                      <span style='color: green;'>Diterima</span>
                    <?php } elseif ($data["status_kajur"] == 'N') { ?>
                      <span style='color: red;'>Ditolak</span>
                    <?php } elseif ($data["surat"] != '' && $data["status_kajur"] == '') { ?>
                      <span style='color: orange;'>Menunggu</span>
                    <?php } else {
                        echo "";
                      } ?>
                  </td>
                  <td><?php if ($data["status_kalab"] == 'Y') { ?>
                      <span style='color: green;'>Diterima</span>
                    <?php } elseif ($data["status"] == 'N') { ?>
                      <span style='color: red;'>Ditolak</span>
                    <?php } elseif ($data["status_kajur"] == 'Y' && $data["status_kalab"] == '') { ?>
                      <span style='color: orange;'>Menunggu</span>
                    <?php } else {
                        echo "";
                      } ?>
                  </td>
                  <td><?php if ($data["bukti_ambil"] == '' && $data["status_kalab"] == 'Y') { ?>
                      <span style='color: red;'>Belum Diambil</span>
                    <?php } elseif ($data["bukti_ambil"] != '') { ?>
                      <a href="#lihat_ambil<?php echo $data['id_pinjam']; ?>" data-toggle="modal"><img src="images/bukti/<?php echo $data["bukti_ambil"]; ?>" width="70px" height="70px">
                      <?php } else {
                        echo "";
                      } ?>
                  </td>
                  <td><?php if ($data["bukti_ambil"] != '' && $data["bukti_antar"] == '') { ?>
                      <span style='color: red;'>Belum Dikembalikan</span>
                    <?php } elseif ($data["bukti_antar"] != '') { ?>
                      <a href="#lihat_antar<?php echo $data['id_pinjam']; ?>" data-toggle="modal"><img src="images/bukti/<?php echo $data["bukti_antar"]; ?>" width="70px" height="70px">
                      <?php } else {
                        echo "";
                      } ?>
                  </td>
                </tr>
                <?php include 'aksi/pinjam_edit.php'; ?>
              <?php
              $no++;
            }
              ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>