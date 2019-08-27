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
    <li class="breadcrumb-item active" aria-current="page">Ubah Data Diri</li>
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
        <h6 class="m-0 font-weight-bold text-primary">Ubah Data Diri</h6>
      </div>
      <div class="card-body">
        <?php echo form_open_multipart('admin/cg_data/'.$this->session->userdata('id')); ?>
        <!-- Form -->
        <input type="hidden" name="id" value="<?php echo $show->id ?>">
        <div class="form-row mb-2">
          <div class="col">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" name="nama" value="<?php echo $show->nama ?>" class="form-control" id="nama">
          </div>
          <div class="col">
            <label for="no_telp">Nomor Telepon:</label>
              <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="no_telp" name="no_telp" maxlength="11" value="<?php echo $show->no_telp ?>">
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="4"><?php echo $show->alamat ?></textarea>
          </div>
          <div class="col">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" maxlength="50" value="<?php echo $show->email ?>">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" class="form-control-file" id="foto">
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