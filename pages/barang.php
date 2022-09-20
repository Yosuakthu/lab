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
              <h3 class="mb-0">Barang</h3>
            </div>
            <div class="col text-right">
              <a href="#tambah" data-toggle="modal" class="btn btn-primary">Tambah</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table id="sampleTable" class="table align-items-center table-flush">
            <thead>
              <tr>
                <th style="width: 3%">No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Stok</th>
                <th style="width: 12%">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($konek, "SELECT * FROM barang ORDER BY nama ASC");
              while ($data = mysqli_fetch_assoc($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td>
                    <a href="#lihat<?php echo $data['id_barang']; ?>" data-toggle="modal"><img src="images/barang/<?php echo $data["foto"]; ?>" width="50px" height="50px"></a>
                  </td>
                  <td>
                    <a href="#detail<?php echo $data['id_barang']; ?>" data-toggle="modal"><?php echo $data["nama"]; ?></a>
                  </td>
                  <td><?php echo $data["stok"]; ?></td>
                  <td>
                    <div class="form-button-action">
                      <a href="#edit<?php echo $data['id_barang']; ?>" data-toggle="modal" class="btn btn-info"> Edit</a>
                      <a href="aksi/barang.php?act=delete&id=<?php echo $data['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus barang <?php echo $data['nama']; ?> ?')"> Hapus</a>
                      <?php include 'aksi/barang_edit.php'; ?>
                    </div>
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

<form method="POST" action="aksi/barang.php?act=insert" enctype="multipart/form-data">
  <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="nama" class="form-control" placeholder="Nama Barang" required>
          </div>
          <div class="form-group">
            <input type="number" name="stok" class="form-control" placeholder="Stok" required>
          </div>
          <div class="form-group">
            <textarea name="deskripsi" rows="3" class="form-control" placeholder="Deskripsi" required></textarea>
          </div>
          <div class="form-group">
            Foto
            <input type="file" name="foto" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>