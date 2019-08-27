<!-- Undone Task -->
<div class="modal fade" id="ignoredTask" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Task Diabaikan</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if (!empty($ignored_task)) { ?>
        <ul class="list-group">
          <?php foreach ($ignored_task as $list): ?>
          <li class="list-group-item"><?php echo $list->task ?> 
            <span class="float float-right"><?php echo '<i>'.$list->task_status.'</i>' ?></span>
          </li>
          <?php endforeach; } else { echo '<i>Tidak ada</i>😊'; } ?>
        </ul>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

