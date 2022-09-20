<?php
$edit  = mysqli_query($konek, "SELECT * FROM user WHERE id_user='" . $data['id_user'] . "'");
$data2 = mysqli_fetch_array($edit);
?>

<form method="post" action="aksi/user.php?act=update&id=<?php echo $data2['id_user']; ?>">
  <div class="modal fade" id="edit<?php echo $data2['id_user']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            Nama Lengkap
            <input type="text" name="nama" class="form-control" value="<?php echo $data2['nama']; ?>" placeholder="Nama Lengkap" required>
          </div>
          <div class="form-group">
            Username
            <input type="text" name="username" class="form-control" value="<?php echo $data2['username']; ?>" placeholder="Username" required>
          </div>
          <div class="form-group">
            Password
            <input type="password" name="password" class="form-control" Placeholder="*****************">
          </div>
          <div class="form-group">
            Hak Akses
            <select name="level" class="form-control" required>
              <option value="<?php echo $data2['level']; ?>"><?php
                                                              if ($level1 == 1) {
                                                                echo "Laboran";
                                                              } elseif ($level1 == 2) {
                                                                echo "Kepala Laboratorium";
                                                              } elseif ($level1 == 3) {
                                                                echo "Ketua Jurusan";
                                                              } else {
                                                                echo "Peminjam";
                                                              }
                                                              ?></option>
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