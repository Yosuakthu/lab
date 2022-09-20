<?php
$edit  = mysqli_query($konek, "SELECT * FROM pinjam WHERE id_pinjam='" . $data['id_pinjam'] . "'");
$data2 = mysqli_fetch_array($edit);
?>

<form method="post" action="aksi/pinjam.php?act=ambil&id=<?php echo $data2['id_pinjam']; ?>" enctype="multipart/form-data">
  <div class="modal fade" id="ambil<?php echo $data2['id_pinjam']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Bukti Pengambilan Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            Foto
            <input type="file" name="bukti_ambil" class="form-control" required>
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

<form method="post" action="aksi/pinjam.php?act=antar&id=<?php echo $data2['id_pinjam']; ?>" enctype="multipart/form-data">
  <div class="modal fade" id="antar<?php echo $data2['id_pinjam']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Bukti Pengembalian Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            Foto
            <input type="file" name="bukti_antar" class="form-control" required>
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

<div class="modal fade" id="lihat_ambil<?php echo $data2['id_pinjam']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div style="max-width:100%;">
          <img src="images/bukti/<?php echo $data2["bukti_ambil"]; ?>" width="100%">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="lihat_antar<?php echo $data2['id_pinjam']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
        <div style="max-width:100%;">
          <img src="images/bukti/<?php echo $data2["bukti_antar"]; ?>" width="100%">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>