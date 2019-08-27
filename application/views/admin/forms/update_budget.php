 <!-- Update Budget -->
    <div class="modal fade" id="updateBudget" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Update Budget</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <?php echo form_open_multipart('admin/update_budget/'.$show->kode); ?>
          <div class="modal-body">
            <!-- Form -->
            <div class="form-group">
              <div class="col">
                <label for="budget">Rencana Budget:</label>
                <div class="input-group mb-2 mr-sm-2">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp.</div>
                  </div>
                  <input type="text" value="<?php echo strrev(implode('.',str_split(strrev(strval($show->budget_plan)), 3))); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control budget" name="budget" maxlength="20" required>
                </div>
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