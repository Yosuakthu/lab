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
              <h3 class="mb-0">Register Baru</h3>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table id="sampleTable" class="table align-items-center table-flush">
            <thead>
              <tr>
                <th style="width: 7%">NO</th>
                <th>NIM/NIDN</th>
                <th>NAMA</th>
                <th>TELEPON</th>
                <th>ALAMAT</th>
                <th style="width: 17%">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($konek, "SELECT user.id_user,regist.nama,regist.hp,regist.alamat,regist.nomor FROM user INNER JOIN regist ON user.id_user=regist.id_regist WHERE user.status='0' ORDER BY regist.nama ASC");
              while ($data = mysqli_fetch_assoc($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $data["nomor"]; ?></td>
                  <td><?php echo $data["nama"]; ?></td>
                  <td><?php echo $data["hp"]; ?></td>
                  <td><?php echo $data["alamat"]; ?></td>
                  <td>
                    <a href="aksi/regist.php?act=Y&id=<?php echo $data['id_user']; ?>" class="btn btn-info" onclick="return confirm('Konfirmasi Terima Mahasiswa <?php echo $data['nama']; ?> ?')"> Terima</a>
                    <a href="aksi/regist.php?act=N&id=<?php echo $data['id_user']; ?>" class="btn btn-danger" onclick="return confirm('Konfirmasi TOLAK Mahasiswa <?php echo $data['nama']; ?> ?')"> Tolak</a>
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