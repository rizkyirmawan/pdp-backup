<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/kru') ?>">Kru</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
  </ol>
</nav>

<?php 
    echo validation_errors(
      '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"> 
          <span aria-hidden="true">&times;</span> 
          </button>', 
      '</div>'
    ); 
?>
  
    <!-- Row -->
    <div class="row">

      <div class="col-lg-7">

        <!-- Default Card Example -->
        <div class="card shadow mb-4">
          <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
          </div>
          <div class="card-body">
            <center>
              <?php if ($show->foto != '') { ?>
                <img src="<?php echo base_url('assets/img/users/'.$show->foto) ?>" class="img-fluid">
              <?php } else { ?>
                <img src="<?php echo base_url('assets/img/no_data.svg') ?>" class="img-fluid" height="50%" width="50%">
              <?php } ?>
            </center>
          </div>
        </div>

      </div>

      <div class="col-lg-5">

        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
          <!-- Card Header - Accordion -->
          <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Biodata</h6>
          </a>
          <!-- Card Content - Collapse -->
          <div class="collapse show" id="collapseCardExample">
            <div class="card-body">
              <center>
                <table border="0">
                  <tr>
                    <td><strong>Nama</strong></td>
                    <td>: <?php echo $show->nama ?></td>
                  </tr>
                  <tr>
                    <td><strong>Alamat</strong></td>
                    <td>: <?php echo $show->alamat ?></td>
                  </tr>
                  <tr>
                    <td><strong>Telepon</strong></td>
                    <td>: <?php echo $show->no_telp ?></td>
                  </tr>
                  <tr>
                    <td><strong>Posisi</strong></td>
                    <td>: <?php echo $show->role ?></td>
                  </tr>
                </table>
              </center>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

