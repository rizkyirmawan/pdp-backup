<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Project</li>
  </ol>
</nav>

<?php 
    //Cetak Notif
    if($this->session->flashdata('berhasil'))
    {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
      echo $this->session->flashdata('berhasil');
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">';
      echo '<span aria-hidden="true">&times;</span>';
      echo '</button> </div>';
    }

    //Validation Errors
    echo validation_errors(
      '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"> 
          <span aria-hidden="true">&times;</span> 
          </button>', 
      '</div>'
    ); 
?>
    <!-- Upper Button -->
    <div class="d-flex flex-row bd-highlight mb-3">
      
      <div class="p-2 bd-highlight">
        <a href="#" onclick="history.go(0)" class="btn btn-secondary btn-icon-split btn-sm">
          <span class="icon text-white-50">
            <i class="fas fa-undo"></i>
          </span>
          <span class="text">Reset Kategori Filter</span>
        </a>
      </div>

    </div>

    <!-- Row -->
    <div class="row">

      <div class="col-lg-4">

        <!-- Type Card -->
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
            <div class="dropdown no-arrow">
              <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-target="#addKategori" data-toggle="modal">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php $no = 1; foreach ($list_kategori as $show): ?>
                <td><?php echo $no ?>.</td>
                <td><a href="<?php echo base_url('admin/project/'.$show->kode) ?>"><?php echo $show->kategori ?></a></td>
                <td align="center">
                  <a href="#" data-target="#updateKategori<?php echo $show->kode ?>" data-toggle="modal" title="Update">
                    <i class="fas fa-pencil-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  </a> 
                  <a href="#" data-target="#deleteKategori<?php echo $show->kode ?>" data-toggle="modal" title="Delete">
                    <i class="fas fa-trash-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  </a>
                </td>
              </tr>
              
              <?php require APPPATH.'views/admin/forms/update_kategori.php'; ?>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteKategori<?php echo $show->kode ?>" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Hapus Data</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Hapus data kategori project dengan nama: <?php echo $show->kategori ?>?</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                      <a class="btn btn-primary" href="<?php echo base_url('admin/delete_kategori/'.$show->kode) ?>">Ya</a>
                    </div>
                  </div>
                </div>
              </div>

              <?php $no++; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

      </div>

      <div class="col-lg-8">

        <!-- Asset Card -->
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Project</h6>
            <div class="dropdown no-arrow">
              <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-target="#addProject" data-toggle="modal">
                <span class="icon text-white-50">
                  <i class="fas fa-plus"></i>
                </span>
                <span class="text">Rencanakan Project</span>
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Project</th>
                    <th>Manager</th>
                    <th>Length</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php $no = 1; foreach ($list_project as $show): ?>
                    <td><?php echo $no ?>.</td>
                    <td><?php echo $show->judul ?></td>
                    <td><?php echo $show->nama_manager ?></td>
                    <td><?php echo ((abs(strtotime ($show->end) - strtotime ($show->start)))/(60*60*24)+1) ?> Hari</td>
                    <td>
                      <span class="badge <?php if($show->status == 'Just Added') { 
                                                    echo 'badge-secondary'; 
                                                  } elseif($show->status == 'Done') { 
                                                    echo 'badge-success'; 
                                                  } elseif($show->status == 'Ongoing') { 
                                                    echo 'badge-info'; 
                                                  } ?>"><?php echo $show->status ?>
                      </span>
                    </td>
                    <td align="center">
                      <div class="dropdown mb-2">
                        <button class="btn btn-sm bg-gradient-success dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                          Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <div class="dropdown-header">Pilih Aksi:</div>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?php echo base_url('admin/detail_project/'.$show->kode) ?>">
                            <i class="fas fa-mask fa-sm fa-fw mr-2 text-gray-400"></i>
                          Detail
                          </a>
                          <div class="dropdown-divider"></div>
                          <button class="dropdown-item" href="#" data-target="#updateProject<?php echo $show->kode ?>" data-toggle="modal">
                            <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                          Update
                          </button>
                          <div class="dropdown-divider"></div>
                          <button class="dropdown-item" href="#" data-target="#deleteProject<?php echo $show->kode ?>" data-toggle="modal">
                            <i class="fas fa-trash-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                          Delete
                          </button>
                        </div>
                      </div>
                    </td>
                  </tr>

              <?php require APPPATH.'views/admin/forms/update_project.php'; ?>
              
              <!-- Delete Modal -->
              <div class="modal fade" id="deleteProject<?php echo $show->kode ?>" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Hapus Data</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Hapus data project dengan judul: <?php echo $show->judul ?>?</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                      <a class="btn btn-primary" href="<?php echo base_url('admin/delete_project/'.$show->kode) ?>">Ya</a>
                    </div>
                  </div>
                </div>
              </div>

              <?php $no++; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

      </div>

    </div>

    <?php $this->load->view('admin/forms/add_kategori'); ?>
    <?php $this->load->view('admin/forms/add_project'); ?>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

