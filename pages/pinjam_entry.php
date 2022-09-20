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
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Entry Peminjaman</h3>
            </div>
            <div class="col text-right">
              <a href="?page=pinjam" class="btn btn-warning btn-sm">Kembali</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <div class="widget-content nopadding">
            <?php include "include/alert.php" ?>
            <form action="aksi/pinjam.php?act=entry" method="POST" class="form-horizontal">
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-2">
                    <div class="form-group form-group-default">
                      <label>PILIH BARANG</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <select class="form-control" name="id_barang" required>
                        <?php
                        $query1 = mysqli_query($konek, "SELECT * from barang WHERE stok>'0' ORDER BY nama");
                        while ($f = mysqli_fetch_assoc($query1)) {
                          echo "<option value='$f[id_barang]'>$f[nama] (stok : $f[stok] $f[satuan])</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <input type="number" name="jlh" min="1" class="form-control" placeholder="Jumlah Yang Akan Dipinjam" required />
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group form-group-default">
                      <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Data Peminjaman</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table id="sampleTable" class="table align-items-center table-flush">
            <thead>
              <tr>
                <th width="7%">No</th>
                <th>Nama Barang</th>
                <th width="15%">Jumlah</th>
                <th width="7%">Aksi</th>
              </tr>
            </thead>
            <?php
            $no = 1;
            $query  = mysqli_query($konek, "SELECT * from tempo INNER JOIN barang USING(id_barang) WHERE id_user='$id_user' order by id_tempo ASC");
            while ($data = mysqli_fetch_array($query)) {
            ?>
              <tbody>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data["nama"]; ?></td>
                  <td><?php echo $data["jlh"]; ?></td>
                  <td>
                    <a href="aksi/pinjam.php?act=delete&id_tempo=<?php echo $data['id_tempo']; ?>" onclick="return confirm('Hapus <?php echo $data['nama']; ?> ?')" class="btn btn-dark btn-sm"> Hapus</a>
                  </td>
                </tr>
              <?php
              $no++;
            }
              ?>
              </tbody>
          </table>
          <p align="center"><a href="#selesai" class="btn btn-success" data-toggle="modal">Simpan</a></p>
        </div>
      </div>
    </div>
  </div>
</div>


<form class="form-horizontal" method="POST" action="aksi/pinjam.php?act=selesai" enctype="multipart/form-data">
  <div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Lengkapi Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            Nama
            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" readonly>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              Dari
              <input type="date" name="dari" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
              Sampai
              <input type="date" name="sampai" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            Surat
            <input type="file" class="form-control" name="surat">
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