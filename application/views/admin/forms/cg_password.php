<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="<?php if($this->session->userdata('role') == 'Admin') { 
                                                  echo base_url('admin');
                                                } elseif($this->session->userdata('role') == 'Manager') {
                                                  echo base_url('crew/manager');
                                                } elseif($this->session->userdata('role') == 'Kontributor') {
                                                  echo base_url('crew/kontributor');
                                                }
                                          ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah Password</li>
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

    //Validasi
    echo validation_errors(
      '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"> 
          <span aria-hidden="true">&times;</span> 
          </button>', 
      '</div>'
    ); 
  ?>

  <!-- Card -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
      </div>
      <div class="card-body">
        <?php echo form_open_multipart('admin/cg_password/'.$this->session->userdata('id')); ?>
        <!-- Form -->
        <input type="hidden" name="id" value="<?php echo $show->id ?>">
        <div class="form-row mb-2">
          <div class="col">
            <label for="password">Password Baru:</label>
            <input type="password" name="password" class="form-control" id="password">
          </div>
          <div class="col">
            <label for="passconf">Retype Password Baru:</label>
              <input type="password" name="passconf" class="form-control" id="passconf" >
          </div>
        </div>
        <div class="form-group" align="right">
          <input type="submit" class="btn btn-primary" value="OK"> 
          <input type="reset" class="btn btn-secondary" value="Reset">
        </div>
        <!-- End Form -->
        <?php echo form_close(); ?>
      </div>
    </div>
    
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->