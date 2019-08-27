<!-- Add Modal -->
<div class="modal fade" id="addModal" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Tambah Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('admin/client'); ?>
      <div class="modal-body">
        <!-- Form -->
        <input type="hidden" name="kode" value="<?php echo $kode ?>">
        <div class="form-row mb-2">
          <div class="col">
            <label for="client">Nama Client:</label>
            <input type="text" name="client" value="<?php echo set_value('client'); ?>" class="form-control" id="client" max="100">
          </div>
          <div class="col">
            <label for="no_telp">Nomor Telepon:</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">+62</div>
              </div>
              <input type="text" value="<?php echo set_value('no_telp'); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="no_telp" name="no_telp" maxlength="11">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat:</label>
          <textarea class="form-control" id="alamat" name="alamat" rows="4"><?php echo set_value('alamat'); ?></textarea>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="contract">Awal Kerjasama:</label>
            <input type="date" name="contract" value="<?php echo set_value('contract'); ?>" class="form-control" id="contract">
          </div>
          <div class="col">
            <label for="logo">Logo:</label>
            <input type="file" class="form-control-file" id="logo" name="logo">
          </div>
        </div>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Simpan">
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

