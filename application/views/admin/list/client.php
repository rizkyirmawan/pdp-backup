<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="<?php if($this->session->userdata('role') == 'Admin') { 
                                                  echo base_url('admin'); 
                                                } elseif($this->session->userdata('role') == 'Manager') {
                                                  echo base_url('crew/manager'); 
                                                } else {
                                                  echo base_url('crew/kontributor');
                                                }
                                          ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Client</li>
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
  
  <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Client</h6>
        <div class="dropdown no-arrow">
          <button href="#" class="btn btn-primary btn-icon-split btn-sm" data-target="#addModal" data-toggle="modal">
            <span class="icon text-white-50">
              <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Client</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Awal Kerjasama</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php $no = 1; foreach ($list as $show): ?>
                <td><?php echo $no ?>.</td>
                <td><?php echo $show->client ?></td>
                <td><?php echo $show->alamat ?></td>
                <td><?php echo $show->no_telp ?></td>
                <td><?php echo TanggalIndo($show->contract) ?></td>
                <td>
                  <div class="dropdown mb-2">
                    <button class="btn btn-sm bg-gradient-success dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                      Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <div class="dropdown-header">Pilih Aksi:</div>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo base_url('admin/detail_client/'.$show->kode) ?>">
                        <i class="fas fa-mask fa-sm fa-fw mr-2 text-gray-400"></i>
                      Detail
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" data-target="#updateModal<?php echo $show->kode ?>" data-toggle="modal">
                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                      Update
                      </a>
                      <div class="dropdown-divider"></div>
                      <button class="dropdown-item" href="#" data-target="#deleteModal<?php echo $show->kode ?>" data-toggle="modal">
                        <i class="fas fa-trash-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Delete
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
              
              <?php require APPPATH.'views/admin/forms/update_client.php'; ?>

              <!-- Delete Modal -->
              <div class="modal fade" id="deleteModal<?php echo $show->kode ?>" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLabel">Hapus Data</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Hapus data client atas nama: <?php echo $show->client ?>?</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                      <a class="btn btn-primary" href="<?php echo base_url('admin/delete_client/'.$show->kode) ?>">Ya</a>
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

    <?php $this->load->view('admin/forms/add_client'); ?>
    
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

