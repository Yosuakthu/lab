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
          </div>
        </div>
        <div class="row">
          <?php
          $query = mysqli_query($konek, "SELECT * FROM barang ORDER BY nama ASC");
          while ($data = mysqli_fetch_assoc($query)) {
          ?>
            <div class="col-xl-2 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <p align="center"><a href="#lihat<?php echo $data['id_barang']; ?>" data-toggle="modal"><img src="images/barang/<?php echo $data["foto"]; ?>" width="100%" height="100px"></a></p>
                      <h5 align="center" class="card-title text-uppercase text-muted mb-0">Stok: <?php echo $data["stok"]; ?></h5>
                      <h2 align="center"><?php echo $data["nama"]; ?></h2>
                      <p align="center">
                        <a href="#detail<?php echo $data['id_barang']; ?>" data-toggle="modal" class="btn btn-primary btn-sm"> Detail</a>
                        <?php if ($level == 4) { ?>
                          <a href="?page=pinjam_entry" class="btn btn-success btn-sm"> Pinjam</a>
                        <?php } ?>
                        <?php include 'aksi/barang_edit.php'; ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
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