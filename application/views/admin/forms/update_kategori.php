<!-- Add Modal -->
<div class="modal fade" id="updateKategori<?php echo $show->kode ?>" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Tambah Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open('admin/update_kategori/'.$show->kode); ?>
      <div class="modal-body">
        <!-- Form -->
        <input type="hidden" name="kode" value="<?php echo $show->kode ?>">
        <div class="form-group">
          <div class="col">
            <label for="kategori">Kategori:</label>
            <input type="text" name="kategori" value="<?php echo $show->kategori ?>" class="form-control" id="kategori" maxlength="50" required>
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

