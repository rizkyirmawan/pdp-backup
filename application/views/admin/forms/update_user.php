<!-- Update User Modal -->
<div class="modal fade" id="updateModal<?php echo $show->id ?>" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Update Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('admin/update_user/'.$show->id); ?>
      <div class="modal-body">
        <!-- Form -->
        <input type="hidden" name="id" value="<?php echo $show->id ?>">
        <div class="form-row mb-2">
          <div class="col">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" name="nama" value="<?php echo $show->nama ?>" class="form-control" id="nama">
          </div>
          <div class="col">
            <label for="no_telp">Nomor Telepon:</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="no_telp" name="no_telp" maxlength="11" value="<?php echo $show->no_telp ?>">
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="4"><?php echo $show->alamat ?></textarea>
          </div>
          <div class="col">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" maxlength="50" value="<?php echo $show->email ?>">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="password" maxlength="20">
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control">
              <option value="1" <?php if ($show->role == 'Admin') { echo 'selected'; } ?>>Admin</option>
              <option value="2" <?php if ($show->role == 'Manager') { echo 'selected'; } ?>>Manager</option>
              <option value="3" <?php if ($show->specs == 'Filmmaker') { echo 'selected'; } ?>>Kontributor (Filmmaker)</option>
              <option value="4" <?php if ($show->specs == 'Photographer') { echo 'selected'; } ?>>Kontributor (Photographer)</option>
              <option value="5" <?php if ($show->specs == 'Editor') { echo 'selected'; } ?>>Kontributor (Editor)</option>
              <option value="6" <?php if ($show->specs == 'Graphic Designer') { echo 'selected'; } ?>>Kontributor (Graphic Designer)</option>
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
        <input type="submit" class="btn btn-primary" value="Update">
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

