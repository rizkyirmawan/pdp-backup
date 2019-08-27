<!-- Add Task -->
<div class="modal fade" id="addTask<?php echo $list->id_crew ?>" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Tambah Task: <?php echo '<b>'.$list->nama_kru.'</b> (<i>'.$list->specs.'</i>)' ?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close" id="close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open('admin/add_task/'.$list->kode_project); ?>
      <div class="modal-body">
        <!-- Form -->
        <input type="hidden" name="kode_project" value="<?php echo $list->kode_project ?>">
        <input type="hidden" name="id_crew" value="<?php echo $list->id_crew ?>">
        <input type="hidden" name="nama" value="<?php echo $list->nama_kru ?>">
        <div class="form-group task-form">
          <div class="input-group mb-3">
            <input type="text" name="add-task" class="form-control" id="task" maxlength="50" aria-label="Task" placeholder="Task">
            <div class="input-group-append appended">
              <button class="btn btn-primary" type="button" id="btAddTask">Tambah Task</button>
            </div>
          </div>
          Task List<hr id="hrTaskList">
        </div>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancel">Batal</button>
        <button type="submit" class="btn btn-primary submitButton">Tambah</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

