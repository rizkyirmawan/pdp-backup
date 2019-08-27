<!-- Add Crew -->
<div class="modal fade" id="addCrew" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Tambah Crew</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('admin/add_crew/'.$show->kode); ?>
      <div class="modal-body">
        <!-- Form -->
        <div class="form-group">
          <div class="col">
            <label for="id_crew">Kru:</label>
            <select name="id_crew[]" id="id_crew" title="Pilih Kru" class="selectpicker form-control" data-hide-disabled="true" multiple data-actions-box="true"  data-live-search="true" multiple>
              <?php foreach ($list_crew as $contrib): ?>
                <option value="<?php echo $contrib->id ?>"><?php echo $contrib->nama.' ('.$contrib->specs.')' ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

