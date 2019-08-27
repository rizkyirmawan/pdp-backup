<!-- Begin Page Content -->
<div class="container-fluid">

<?php 
    //Cetak Notif
    if($this->session->flashdata('sukses'))
    {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
      echo $this->session->flashdata('sukses');
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Tutup">';
      echo '<span aria-hidden="true">&times;</span>';
      echo '</button> </div>';
    }
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb shadow-sm">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>

<!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Your Projects</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (!empty($project)) {
                                                                          echo count($project).' Project';
                                                                        } else {
                                                                          echo '<i>Tidak Ada</i>';
                                                                        } 
                                                                  ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fab fa-quinscape fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Your Ongoing Projects</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (!empty($ongoing_project)) {
                                                                          echo count($ongoing_project).' Project';
                                                                        } else {
                                                                          echo '<i>Tidak Ada</i>';
                                                                        } 
                                                                  ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-plane-departure fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Your Completed Projects</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (!empty($completed_project)) {
                                                                          echo count($completed_project).' Project';
                                                                        } else {
                                                                          echo '<i>Tidak Ada</i>';
                                                                        } 
                                                                  ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Spent on Projects</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if ($total->total_budget != NULL) {
                                                                          echo 'Rp. '.strrev(implode('.',str_split(strrev(strval($total->total_budget)), 3)));
                                                                        } else {
                                                                          echo '<i>Tidak Ada</i>';
                                                                        } 
                                                                  ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Second Line Cards -->
    <div class="row mb-4">

      <div class="col-lg-4">

        <div class="card bg-success text-white shadow">
          <div class="card-header bg-success py-3 d-flex flex-row align-items-center justify-content-between rounded-sm">
            <h6 class="m-0 font-weight-bold text-white">Data Client</h6>
            <div class="dropdown no-arrow">
              <a href="http://localhost/mangjek/admin/client" class="btn btn-success bg-gradient-success btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fas fa-angle-right"></i>
                </span>
                <span class="text">Tinjau</span>
              </a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-4">

       <div class="card bg-info text-white shadow">
          <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between rounded-sm">
            <h6 class="m-0 font-weight-bold text-white">Data Project</h6>
            <div class="dropdown no-arrow">
              <a href="<?php echo base_url('crew/project') ?>" class="btn btn-info bg-gradient-info btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fas fa-angle-right"></i>
                </span>
                <span class="text">Tinjau</span>
              </a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-4">

       <div class="card bg-danger text-white shadow">
          <div class="card-header bg-danger py-3 d-flex flex-row align-items-center justify-content-between rounded-sm">
            <h6 class="m-0 font-weight-bold text-white">Laporan Project</h6>
            <div class="dropdown no-arrow">
              <a href="<?php echo base_url('report/project') ?>" class="btn btn-danger bg-gradient-danger btn-icon-split btn-sm">
                <span class="icon text-white-50">
                  <i class="fas fa-angle-right"></i>
                </span>
                <span class="text">Tinjau</span>
              </a>
            </div>
          </div>
        </div>

      </div>

    </div>
    
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->