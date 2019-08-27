<!-- Add Modal -->
<div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Send Mail</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('report/send_mail/'.$show->kode); ?>
      <div class="modal-body">
        <!-- Form -->
        <div class="form-row mb-2">
          <div class="col">
            <label for="message">Message:</label>
            <textarea name="message" class="form-control editor" cols="50" rows="10"><?php echo set_value('message'); ?></textarea>
          </div>
        </div>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Send">
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>


