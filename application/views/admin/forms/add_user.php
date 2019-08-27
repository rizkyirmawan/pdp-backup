<!-- Add User Modal -->
<div class="modal fade" id="addPersonalia" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Tambah Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('admin/add_kru'); ?>
      <div class="modal-body">
        <!-- Form -->
        <div class="form-row mb-2">
          <div class="col">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" name="nama" value="<?php echo set_value('nama'); ?>" class="form-control" id="nama">
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
        <div class="form-row mb-2">
          <div class="col">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="4"><?php echo set_value('alamat'); ?></textarea>
          </div>
          <div class="col">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" maxlength="50">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="password" maxlength="20" value="<?php echo set_value('email'); ?>">
          </div>
        </div>
        <div class="form-row mb-4">
          <div class="col">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control">
              <option value="1">Admin</option>
              <option value="2">Manager</option>
              <option value="3">Kontributor (Filmmaker)</option>
              <option value="4">Kontributor (Photographer)</option>
              <option value="5">Kontributor (Editor)</option>
              <option value="6">Kontributor (Graphic Designer)</option>
            </select>
          </div>
          <div class="col">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" class="form-control-file" id="foto">
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

