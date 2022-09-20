<?php
$edit  = mysqli_query($konek, "SELECT * FROM barang WHERE id_barang='" . $data['id_barang'] . "'");
$data2 = mysqli_fetch_array($edit);
?>

<form method="post" action="aksi/barang.php?act=update&id=<?php echo $data2['id_barang']; ?>" enctype="multipart/form-data">
  <div class="modal fade" id="edit<?php echo $data2['id_barang']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
            Nama
            <input type="text" name="nama" class="form-control" value="<?php echo $data2['nama']; ?>" placeholder="Nama Lengkap" required>
          </div>
          <div class="form-group">
            Stok
            <input type="text" name="stok" class="form-control" value="<?php echo $data2['stok']; ?>" placeholder="Stok" required>
          </div>
          <div class="form-group">
            Deskripsi
            <textarea name="deskripsi" rows="10" class="form-control" placeholder="Deskripsi" required><?php echo $data2['deskripsi']; ?></textarea>
          </div>
          <div class="form-group">
            Foto
            <input type="file" name="foto" class="form-control">
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

<div class="modal fade" id="lihat<?php echo $data2['id_barang']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div style="max-width:100%;">
          <img src="images/barang/<?php echo $data["foto"]; ?>" width="100%">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="detail<?php echo $data2['id_barang']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          Nama
          <input type="text" name="nama" class="form-control" value="<?php echo $data2['nama']; ?>" placeholder="Nama Lengkap" readonly>
        </div>
        <div class="form-group">
          Stok
          <input type="text" name="stok" class="form-control" value="<?php echo $data2['stok']; ?>" placeholder="Stok" readonly>
        </div>
        <div class="form-group">
          Deskripsi
          <textarea name="deskripsi" rows="10" class="form-control" placeholder="Deskripsi" readonly><?php echo $data2['deskripsi']; ?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>