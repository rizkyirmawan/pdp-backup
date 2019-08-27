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
    <li class="breadcrumb-item active" aria-current="page">Laporan Project</li>
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
?>

      <!-- Card -->
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Filter by Tanggal Mulai, Kategori, Client atau Status</h6>
        </div>
        <div class="card-body">
          <?php echo form_open('report/project'); ?>
          <!-- Form -->
          <div class="form-row mb-2">
            <div class="col">
              <label for="tglmin">Dari Tanggal:</label>
              <input type="date" name="tglmin" class="form-control" id="tglmin">
            </div>
            <div class="col">
              <label for="tglmax">Sampai Tanggal:</label>
                <input type="date" name="tglmax" class="form-control" id="tglmax">
            </div>
            <div class="col">
              <label for="kode_kategori">Kategori:</label>
                <select name="kode_kategori" id="kode_kategori" class="form-control">
                    <option value="" selected>Semua</option>
                  <?php foreach ($list_kategori as $show): ?>
                    <option value="<?php echo $show->kode ?>"><?php echo $show->kategori ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
              <label for="kode_client">Client:</label>
                <select name="kode_client" id="kode_client" class="form-control">
                    <option value="" selected>Semua</option>
                  <?php foreach ($list_client as $show): ?>
                    <option value="<?php echo $show->kode ?>"><?php echo $show->client ?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
              <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option selected>Semua</option>
                    <option value="Just Added">Just Added</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Done">Done</option>
                </select>
            </div>
          </div> <hr>
          <div class="form-group float-right">
            <input type="submit" name="filter" class="btn btn-info" value="Filter"> 
            <input type="submit" name="generate" class="btn btn-primary" value="Generate PDF"> 
          </div>
          <!-- End Form -->
          <?php echo form_close(); ?>
        </div>
      </div>

      <!-- Project Card -->
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Data Project</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Kategori</th>
                  <th>Client</th>
                  <th>Manager</th>
                  <th>Tempat</th>
                  <th>Length</th>
                  <th>Status</th>
                  <?php if ($this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Manager') { ?>
                  <th>Spent Budget</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $no = 1; foreach ($list_project as $show): ?>
                  <td><?php echo $no ?>.</td>
                  <td><?php echo '<b><i>'.$show->judul.'</i></b>' ?></td>
                  <td><?php echo $show->kategori ?></td>
                  <td><?php echo $show->client ?></td>
                  <td><?php echo $show->nama_manager ?></td>
                  <td><?php echo $show->tempat ?></td>
                  <td><?php echo ((abs(strtotime ($show->end) - strtotime ($show->start)))/(60*60*24)+1) ?> Day<?php if (((abs(strtotime ($show->end) - strtotime ($show->start)))/(60*60*24)+1) > 1) { echo 's'; } ?></td>
                  <td><span class="badge <?php if($show->status == 'Just Added') { 
                                                    echo 'badge-secondary'; 
                                                  } elseif($show->status == 'Done') { 
                                                    echo 'badge-success'; 
                                                  } elseif($show->status == 'Ongoing') { 
                                                    echo 'badge-info'; 
                                                  } ?>"><?php echo $show->status ?>
                      </span>
                  </td>

                  <?php if ($this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Manager') { ?>
                  <td><?php if ($show->budget_real != 0) { echo 'Rp. '.strrev(implode('.',str_split(strrev(strval($show->budget_real)), 3))); } else { echo '<i>Tidak Ada</i>'; } ?></td>
                  <?php } ?>
                </tr>
              <?php $no++; endforeach;?>
              </tbody>
          </table>
      </div>

    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->