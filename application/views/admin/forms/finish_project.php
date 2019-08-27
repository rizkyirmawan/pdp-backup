<!-- Add Task -->
<div class="modal fade" id="finishProject" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Penyelesaian Project</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('admin/finish_project/'.$show->kode); ?>
      <div class="modal-body">
        <!-- Form -->
        <input type="hidden" name="kode" value="<?php echo $show->kode ?>">
        <div class="form-row mb-2">
          <div class="col">
            <label for="estimated">Estimated Budget:</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">Rp.</div>
              </div>
              <input type="text" value="<?php echo strrev(implode('.',str_split(strrev(strval($show->budget_plan)), 3))); ?>" class="form-control" id="estimated" name="estimated" readonly>
            </div>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="budget">Spent Budget:</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">Rp.</div>
              </div>
              <input type="text" value="<?php echo set_value('budget'); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control second-budget" name="budget" maxlength="20">
            </div>
          </div>
          <div class="col">
            <label for="file">Laporan Kegiatan:</label>
            <input type="file" name="file" class="form-control-file" id="file">
          </div>
        </div>
          <div class="form-row mb-2">
            <div class="col">
              <div class="custom-file">
                <label class="custom-file-label" for="gambar">Foto Kegiatan:</label>
                <input type="file" name="gambar[]" class="form-control custom-file-input" id="gambar" multiple>
              </div>
            </div>
          </div>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Finish">
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

