<!-- Undone Task -->
<div class="modal fade" id="undoneTask" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Task Belum Selesai</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('crew/update_task/'.$show->kode); ?>
      <div class="modal-body">
        <?php 
          echo validation_errors(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"> 
                <span aria-hidden="true">&times;</span> 
                </button>', 
            '</div>'
          ); 
        ?>
        <!-- Form -->
        <?php if (!empty($undone_task)) { foreach ($undone_task as $list): ?>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="id_task[]" class="custom-control-input undoneTasks" id="check<?php echo $list->id_task ?>" value="<?php echo $list->id_task ?>">
          <label class="custom-control-label" for="check<?php echo $list->id_task ?>"><?php echo $list->task ?></label>    
        </div>
        <?php endforeach; } else { echo '<i>Tidak ada!</i>'; } ?>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <?php if (!empty($undone_task)) { ?>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="sbTask">Submit</button>
        <?php } else { ?>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <?php } ?>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

