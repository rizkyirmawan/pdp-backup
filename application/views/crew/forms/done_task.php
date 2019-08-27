<!-- Undone Task -->
<div class="modal fade" id="doneTask" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Task Sudah Selesai</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if (!empty($done_task)) { ?>
        <ul class="list-group">
          <?php foreach ($done_task as $list): ?>
          <li class="list-group-item"><?php echo $list->task ?> 
            <span class="float float-right"><?php echo '<i>'.$list->task_status.'</i>
            <a href="#" data-toggle="tooltip" data-placement="right" title="Tersubmit pada '.TanggalIndo($list->submitted).' pukul '.$list->on.'" class="badge badge-pill badge-secondary float float-right ml-2">
              <i class="fas fa-info fa-sm"></i>
            </a>' ?></span>
          </li>
          <?php endforeach; } else { echo '<i>Belum ada</i>😔'; } ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

