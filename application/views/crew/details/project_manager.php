<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="<?php if($this->session->userdata('role') == 'Manager') {
                                                  echo base_url('crew/manager'); 
                                                } else {
                                                  echo base_url('crew/kontributor');
                                                }
                                          ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('crew/project')?>">Project</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
  </ol>
</nav>

<?php 
    //Cetak Notif
    if($this->session->flashdata('berhasil')) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
      echo $this->session->flashdata('berhasil');
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">';
      echo '<span aria-hidden="true">&times;</span>';
      echo '</button> </div>';
    }

    if(date('Y-m-d') == date('Y-m-d', strtotime($show->end.' - 1 day')) && count($undone_task) > 0) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
      echo $this->session->flashdata('notif');
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">';
      echo '<span aria-hidden="true">&times;</span>';
      echo '</button> </div>';
    } else if(date('Y-m-d') >= date('Y-m-d', strtotime($show->end.' - 1 day')) && count($undone_task) > 0) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
      echo $this->session->flashdata('notif');
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">';
      echo '<span aria-hidden="true">&times;</span>';
      echo '</button> </div>';
    }

    //Validation
    echo validation_errors(
      '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"> 
          <span aria-hidden="true">&times;</span> 
          </button>', 
      '</div>'
    ); 
?>
    
    <!-- Upper Button -->
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
      
      <?php if ($show->status == 'Just Added') { ?>
      <div class="p-2 bd-highlight">
        <button href="#" class="btn btn-primary btn-icon-split btn-sm" data-target="#addCrew" data-toggle="modal">
          <span class="icon text-white-50">
            <i class="fas fa-user-astronaut"></i>
          </span>
          <span class="text">Add Crew</span>
        </button>
      </div>
      <div class="p-2 bd-highlight">
        <a href="<?php echo base_url('admin/set_project/'.$show->kode) ?>" class="btn btn-success btn-icon-split btn-sm 
          <?php if (date('Y-m-d') < date('Y-m-d', strtotime($show->start. ' - 3 days'))) { echo 'disabled'; } ?>">
          <span class="icon text-white-50">
            <i class="fas fa-pen-nib"></i>
          </span>
          <span class="text">Set Project</span>
        </a>
      </div>
      <?php } elseif ($show->status == 'Ongoing') { ?>
      <div class="p-2 bd-highlight">
        <a href="<?php echo base_url('report/project_details/'.$show->kode) ?>" class="btn btn-primary btn-icon-split btn-sm">
          <span class="icon text-white-50">
            <i class="fas fa-file-pdf"></i>
          </span>
          <span class="text">Generate PDF</span>
        </a>
      </div>
      <div class="p-2 bd-highlight">
        <a href="<?php echo base_url('admin/rollback_project/'.$show->kode) ?>" class="btn btn-secondary btn-icon-split btn-sm <?php if ($this->session->userdata('id') != $show->id_manager) { echo 'disabled'; } ?>">
          <span class="icon text-white-50">
            <i class="fas fa-undo"></i>
          </span>
          <span class="text">Rollback Project</span>
        </a>
      </div>
      <div class="p-2 bd-highlight">
        <a href="#" class="btn btn-success btn-icon-split btn-sm" data-target="#finishProject" data-toggle="modal">
          <span class="icon text-white-50">
            <i class="fas fa-ribbon"></i>
          </span>
          <span class="text">Finish Project</span>
        </a>
      </div>      
      <div class="p-2 bd-highlight">
        <a href="#" class="btn btn-warning btn-icon-split btn-sm <?php if ($this->session->userdata('id') != $show->id_manager) { echo 'disabled'; } ?>" data-target="#sendMessage" data-toggle="modal">
          <span class="icon text-white-50">
            <i class="fas fa-paper-plane"></i>
          </span>
          <span class="text">Send Mail</span>
        </a>
      </div>
      <?php } else { ?>
      <div class="p-2 bd-highlight">
        <a href="<?php echo base_url('report/project_details/'.$show->kode) ?>" class="btn btn-primary btn-icon-split btn-sm">
          <span class="icon text-white-50">
            <i class="fas fa-file-pdf"></i>
          </span>
          <span class="text">Generate PDF</span>
        </a>
      </div>
      <div class="p-2 bd-highlight">
        <a href="<?php echo base_url('report/download_file/'.$show->kode) ?>" class="btn btn-success btn-icon-split btn-sm <?php if (empty($files)) { echo 'disabled'; } ?>">
          <span class="icon text-white-50">
            <i class="fas fa-book"></i>
          </span>
          <span class="text">Download Laporan</span>
        </a>
      </div>
      <?php } ?>

    </div>

    <?php require APPPATH.'views/admin/forms/add_crew.php'; ?>
    <?php require APPPATH.'views/admin/forms/send_message.php'; ?>

    <!-- Row -->
    <div class="row">

      <div class="col-lg-6">

        <!-- Default Card Example -->
        <div class="card shadow-sm mb-4">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">The Project</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Field</th>
                    <th>Value</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><i>Judul</i></td>
                    <td>: <?php echo '<b><i>'.$show->judul.'</i></b>' ?></td>
                  </tr>
                  <tr>
                    <td><i>Kategori</i></td>
                    <td>: <?php echo $show->kategori ?></td>
                  </tr>
                  <tr>
                    <td><i>Client</i></td>
                    <td>: <?php echo $show->client ?></td>
                  </tr>
                  <tr>
                    <td><i>Manager</i></td>
                    <td>: <?php echo $show->nama_manager ?></td>
                  </tr>
                  <tr>
                    <td><i>Tempat</i></td>
                    <td>: <?php echo $show->tempat ?></td>
                  </tr>
                  <tr>
                    <td><i>Start Date</i></td>
                    <td>: <?php echo TanggalIndo($show->start) ?></td>
                  </tr>
                  <tr>
                    <td><i>End Date</i></td>
                    <td>: <?php echo TanggalIndo($show->end) ?></td>
                  </tr>
                  <tr>
                    <td><i>Project Length</i></td>
                    <td>: <?php echo ((abs(strtotime ($show->end) - strtotime ($show->start)))/(60*60*24)+1) ?> Day<?php if (((abs(strtotime ($show->end) - strtotime ($show->start)))/(60*60*24)+1) > 1) { echo 's'; } ?></td>
                  </tr>
                  <?php if ($show->budget_plan != 0) { ?>
                  <tr>
                    <td><i>Estimated Budget</i></td>
                    <td>: <?php echo 'Rp. '.strrev(implode('.',str_split(strrev(strval($show->budget_plan)), 3))); 
                                if ($show->status == 'Just Added') { ?>
                          <a href="#" class="btn btn-sm btn-warning btn-circle shadow-sm float-right mr-2" 
                            title="Update Budget" data-target="#updateBudget" data-toggle="modal">
                          <i class="fas fa-edit fa-sm"></i>
                          </a>
                          <?php } ?>
                    </td>
                  </tr>
                  <?php } if ($show->budget_real != 0) { ?>
                  <tr>
                    <td><i>Spent Budget</i></td>
                    <td>: <?php echo 'Rp. '.strrev(implode('.',str_split(strrev(strval($show->budget_real)), 3))); ?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td><i>Status</i></td>
                    <td>: <span class="badge <?php  if($show->status == 'Just Added') { 
                                                      echo 'badge-secondary'; 
                                                    } elseif($show->status == 'Done') { 
                                                      echo 'badge-success'; 
                                                    } elseif($show->status == 'Ongoing') { 
                                                      echo 'badge-info'; 
                                                    } ?>">
                        <?php echo $show->status ?>  
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-6">

        <div class="accordion shadow-sm rounded-sm mb-4" id="accordionExample">

           <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  Crews & Tasks
                </button>
              </h5>
            </div>

            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
              <div class="card-body">
                <ul class="list-group">

                  <?php foreach ($crews as $crew => $list): ?>

                  <li class="list-group-item">
                    <?php echo $list->nama_kru.' (<em>'.$list->specs.'</em>)' ?>
                    
                    <?php if ($show->status == 'Just Added') { ?>
                    <a href="<?php echo base_url('admin/remove_crew/'.$list->id_crew.'/'.$list->kode_project) ?>" class="btn btn-sm btn-danger btn-circle shadow-sm float-right" 
                    title="Remove Crew">
                      <i class="fas fa-trash-alt fa-sm"></i>
                    </a>

                    <a href="#" class="btn btn-sm btn-primary btn-circle shadow-sm float-right mr-2" 
                    title="Add Task" data-target="#addTask<?php echo $list->id_crew ?>" data-toggle="modal">
                      <i class="fas fa-plus fa-sm"></i>
                    </a> 

                    <?php require APPPATH.'views/admin/forms/add_task.php'; } ?>

                    <a href="#" class="btn btn-sm btn-success btn-circle shadow-sm float-right mr-2" 
                    title="View Task" data-target="#viewTask<?php echo $list->id_crew ?>" data-toggle="modal">
                      <i class="fas fa-tasks fa-sm"></i>
                    </a> 

                    <?php require APPPATH.'views/admin/details/view_task.php'; ?>

                  </li>
                  <?php endforeach; ?>

                </ul>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  Konten Project
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
              <div class="card-body">
                <?php echo $show->content ?>
              </div>
            </div>
          </div>
          
          <?php if (!empty($images)) { ?>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Foto Kegiatan
                </button>
              </h5>
            </div>

            <div id="collapseThree" class="collapse" aria-labelledby="headingThree">
              <div class="card-body">
                <div class="row mb-2">
                  <?php foreach ($images as $show): ?>
                  <div class="col">
                    <a href="#" data-target="#zoomImage<?php echo $show->id ?>" data-toggle="modal">
                      <img src="<?php echo base_url('assets/img/pics/').$show->gambar ?>" class="img-thumbnail img-fluid">
                    </a>

                    <?php require APPPATH.'views/admin/details/zoom_image.php'; ?>

                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

        </div>

        <!-- Buttons -->

      </div>

    </div>

    <?php require APPPATH.'views/admin/forms/update_budget.php'; ?>
    <?php require APPPATH.'views/admin/forms/finish_project.php'; ?>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

