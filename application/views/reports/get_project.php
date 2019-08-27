<!DOCTYPE html>
<html>
<head>
	<!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
  
<center>
  <img src="<?php echo base_url('assets/img/header.jpg') ?>">
</center>


<hr>

<h5 align="center">Laporan Project</h5>

<table class="table table-bordered">
  <tr>
    <th>Start Date</th>
    <td>: <?php if (!empty($this->input->post('tglmin')) && !empty($this->input->post('tglmax'))) {
                  echo TanggalIndo($this->input->post('tglmin')).' - '.TanggalIndo($this->input->post('tglmax'));
                } else {
                  echo '<i>Tidak Difilter</i>';
                }
          ?>
      
    </td>
  </tr>
  <tr>
    <th>Kategori</th>
    <td>: <?php if (!empty($this->input->post('kode_kategori'))) {
                  echo $get_kategori->kategori;
                } else {
                  echo '<em>Semua</em>';
                }
          ?>
      
    </td>
  </tr>
  <tr>
    <th>Client</th>
    <td>: <?php if (!empty($this->input->post('kode_client'))) {
                  echo $get_client->client;
                } else {
                  echo '<em>Semua</em>';
                }
          ?>
      
    </td>
  </tr>
  <tr>
    <th>Status</th>
    <td>: <?php if (!empty($this->input->post('status'))) {
                  echo $this->input->post('status');
                } else {
                  echo '<em>Semua</em>';
                }
          ?>
      
    </td>
  </tr>
</table>

<br>

<table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Start Date</th>
        <th>Kategori</th>
        <th>Client</th>
        <th>Manager</th>
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
        <td><?php echo TanggalIndo($show->start) ?></td>
        <td><?php echo $show->kategori ?></td>
        <td><?php echo $show->client ?></td>
        <td><?php echo $show->nama_manager ?></td>
        <?php if ($this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Manager') { ?>
        <td><?php if ($show->budget_real != 0) { echo 'Rp. '.strrev(implode('.',str_split(strrev(strval($show->budget_real)), 3))); } else { echo '<i>Tidak Ada</i>'; } ?></td>
        <?php } ?>
      </tr>
    <?php $no++; endforeach;?>
    </tbody>
</table>

<br> <hr>

<center>Dokumen ini dicetak oleh <?php echo $this->session->userdata('nama'); ?> pada <?php echo TanggalIndo(date('Y-m-d')) ?></center>

</body>
</html>
