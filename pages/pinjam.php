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
              <h3 class="mb-0">Peminjaman</h3>
            </div>
            <div class="col text-right">
              <?php if ($level == 4) { ?>
                <a href="?page=pinjam_entry" class="btn btn-primary">Tambah</a>
              <?php } else { ?>
                <a href="laporan/semua.php" target="_blank" class="btn btn-success">Cetak Semua</a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <?php if ($level != 4) { ?>
            <table>
              <form method="POST" action="laporan/periode.php" target="_blank">
                <tr>
                  <td><label>Dari</label></td>
                  <td>&nbsp;</td>
                  <td><input class="form-control" type="date" autocomplete="off" placeholder="Tanggal" name="dari" required></th>
                  </td>
                  <td>&nbsp;</td>
                  <td><label>Sampai</label></td>
                  <td>&nbsp;</td>
                  <td><input class="form-control" type="date" autocomplete="off" placeholder="Tanggal" name="sampai" required></th>
                  </td>
                  <td>&nbsp;</td>
                  <td><button type="submit" name="simpan" class="btn btn-info">Cetak</button></td>
                </tr>
              </form>
            </table>
            <hr>
          <?php } ?>
          <!-- Projects table -->
          <table id="sampleTable" class="table align-items-center table-flush">
            <thead>
              <tr>
                <th width="7%">No</th>
                <th>Tanggal</th>
                <?php if ($level != 4) { ?>
                  <th width="22%">Nama</th>
                <?php } ?>
                <?php if ($level == 3) { ?>
                  <th width="15%">Surat</th>
                <?php } ?>
                <th width="10%">Waktu</th>
                <th width="10%">Status Permohonan</th>
                <th width="10%">Status Peminjaman</th>
                <th width="12%">Aksi</th>

              </tr>
            </thead>
            <?php
            $no = 1;
            if ($level == 4) {
              $query  = mysqli_query($konek, "SELECT * FROM pinjam WHERE id_user='$id_user' order by tgl DESC");
            } else {
              $query  = mysqli_query($konek, "SELECT * FROM pinjam INNER JOIN user USING(id_user) order by tgl DESC");
            }
            while ($data = mysqli_fetch_array($query)) {
            ?>
              <tbody>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo tanggal_indo($data['tgl']); ?></td>
                  <?php if ($level != '4') { ?>
                    <td><?php echo $data["nama"]; ?></td>
                  <?php } ?>
                  <?php if ($level == 3) { ?>
                    <td><a href="aksi/pinjam.php?act=download&surat=<?php echo $data['surat']; ?>&id=<?php echo $data['id_pinjam']; ?>" target="_blank">Download</a></td>
                  <?php } ?>
                  <td>
                    <?php echo date('d/m/Y', strtotime($data['dari'])); ?> -
                    <?php echo date('d/m/Y', strtotime($data['sampai'])); ?>
                  </td>
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
                  <td>
                    <p class="btn-group">
                      <a href="?page=pinjam_detail&id=<?php echo $data['id_pinjam']; ?>" class="btn btn-dark btn-sm">Detail</a>
                      <?php if ($level == 3) { ?>
                        <?php if ($data["status_kajur"] == "") { ?>
                          <a href="aksi/pinjam.php?act=kajurY&id=<?php echo $data['id_pinjam']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Setujui Surat Permohonan dari <?php echo $data['nama']; ?> ?')">Setujui</a>
                          <a href="aksi/pinjam.php?act=kajurN&id=<?php echo $data['id_pinjam']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tolak Surat Permohonan dari <?php echo $data['nama']; ?> ?')">Tolak</a>
                        <?php  } ?>
                      <?php   } ?>
                      <?php if ($level == 2) { ?>
                        <?php if ($data["status_kajur"] == "Y" && $data["status_kalab"] == "") { ?>
                          <a href="aksi/pinjam.php?act=kalabY&id=<?php echo $data['id_pinjam']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Terima Peminjaman Barang dari <?php echo $data['nama']; ?> ?')">Terima</a>
                          <a href="aksi/pinjam.php?act=kalabN&id=<?php echo $data['id_pinjam']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tolak Peminjaman Barang dari <?php echo $data['nama']; ?> ?')">Tolak</a>
                        <?php } ?>
                      <?php  } ?>
                      <?php if ($level == 1) { ?>
                        <?php if ($data["status_kalab"] == "Y" && $data["bukti_ambil"] == "") { ?>
                          <a href="#ambil<?php echo $data['id_pinjam']; ?>" data-toggle="modal" class="btn btn-success btn-sm">Sudah Diambil</a>
                        <?php } ?>
                        <?php if ($data["bukti_ambil"] != "" && $data["bukti_antar"] == "") { ?>
                          <a href="#antar<?php echo $data['id_pinjam']; ?>" data-toggle="modal" class="btn btn-warning btn-sm">Sudah Dikembalikan</a>
                        <?php } ?>
                      <?php  } ?>

                      <?php if ($data["bukti_antar"] != "") { ?>
                        <a href="laporan/peritem.php?id=<?php echo $data['id_pinjam']; ?>" target="_blank" class="btn btn-primary btn-sm">Cetak</a>
                      <?php } ?>
                      <?php include 'aksi/pinjam_edit.php'; ?>
                    </p>
                  </td>
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
</div>