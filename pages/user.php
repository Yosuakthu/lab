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
              <h3 class="mb-0">User</h3>
            </div>
            <div class="col text-right">
              <a href="#tambah" data-toggle="modal" class="btn btn-primary">Tambah</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table id="sampleTable" class="table align-items-center table-flush">
            <thead>
              <tr>
                <th style="width: 7%">NO</th>
                <th>NAMA</th>
                <th>USERNAME</th>
                <th>LEVEL</th>
                <th style="width: 17%">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($konek, "SELECT * FROM user WHERE status='1' ORDER BY id_user ASC");
              while ($data = mysqli_fetch_assoc($query)) {
                $level1 = $data["level"];
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data["nama"]; ?></td>
                  <td><?php echo $data["username"]; ?></td>
                  <td>
                    <?php
                    if ($level1 == 1) {
                      echo "Laboran";
                    } elseif ($level1 == 2) {
                      echo "Kepala Laboratorium";
                    } elseif ($level1 == 3) {
                      echo "Ketua Jurusan";
                    } else {
                      echo "Peminjam";
                    }
                    ?>
                  </td>
                  <td>
                    <?php if ($data["id_user"] != $id_user) { ?>
                      <a href="#edit<?php echo $data['id_user']; ?>" data-toggle="modal" class="btn btn-info"> Edit</a>
                      <a href="aksi/user.php?act=delete&id=<?php echo $data['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus user <?php echo $data['nama']; ?> ?')"> Hapus</a>
                      <?php include 'aksi/user_edit.php'; ?>
                    <?php } ?>
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

<form method="POST" action="aksi/user.php?act=insert">
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
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
          </div>
          <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" Placeholder="Password" required>
          </div>
          <div class="form-group">
            <select name="level" class="form-control">
              <option value="">Pilih Level</option>
              <option value="1">Laboran</option>
              <option value="2">Kepala Laboratorim</option>
              <option value="3">Ketua Jurusan</option>
            </select>
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