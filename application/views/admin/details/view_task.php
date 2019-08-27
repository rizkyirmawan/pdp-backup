<!-- View Task -->
<div class="modal fade" id="viewTask<?php echo $list->id_crew ?>" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Task List: <?php echo '<b>'.$list->nama_kru.'</b>'; ?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
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
        
          <ul class="list-group">
            <?php if (!empty($task)) { foreach ($task as $tasks): 
                  if ($tasks->id_crew == $list->id_crew) { ?>
            <li class="list-group-item"><?php echo $tasks->task;
              if ($show->status == 'Ongoing' || $show->status == 'Done') { 
                echo '<span class="float float-right"><i>'.$tasks->task_status; } 
                if ($tasks->task_status == 'Accomplished') {
                  echo '<a href="#" data-toggle="tooltip" data-placement="right" title="Tersubmit pada '.TanggalIndo($tasks->submitted).' pukul '.$tasks->on.'" class="badge badge-pill badge-secondary float float-right ml-2">
                          <i class="fas fa-info fa-sm"></i>
                        </a>';
                } ?>
              <?php if ($show->status == 'Just Added') { ?>
              <a href="<?php echo base_url('admin/delete_task/'.$tasks->id_task) ?>" 
                class="btn btn-sm btn-danger btn-circle shadow-sm float-right mr-2" title="Delete Task">
                <i class="fas fa-trash-alt fa-sm"></i>
              </a>
              <?php } ?>
            </li>
            <?php } endforeach; } else { echo 'Belum ditambahkan!'; } ?>
          </ul>
      </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
    </div>
  </div>
