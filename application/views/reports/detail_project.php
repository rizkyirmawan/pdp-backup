<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

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

<h5 align="center">Project Details: <?php echo $show->judul.' ('.$show->kode.')' ?></h5>

<table class="table table-bordered">
  <tbody>
    <tr>
      <td><b>Judul</b></td>
      <td>: <?php echo $show->judul ?></td>
      <td><b>Kategori</b></td>
      <td>: <?php echo $show->kategori ?></td>
    </tr>
    <tr>
      <td><b>Client</b></td>
      <td>: <?php echo $show->client ?></td>
      <td><b>Manager</b></td>
      <td>: <?php echo $show->nama_manager ?></td>
    </tr>
    <tr>
      <td><b>Start Date</b></td>
      <td>: <?php echo TanggalIndo($show->start) ?></td>
      <td><b>End Date</b></td>
      <td>: <?php echo TanggalIndo($show->end) ?></td>
    </tr>
    <?php if ($this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Manager') { ?>
    <tr>
      <td colspan="3"><b>Estimated Budget</b></td>
      <td>: <?php if ($show->budget_plan != 0) { echo 'Rp. '.strrev(implode('.',str_split(strrev(strval($show->budget_plan)), 3))); } else { echo '<i>Tidak Ada</i>'; } ?></td>
    </tr>
    <?php if ($show->budget_real != 0) { ?>
    <tr>
      <td colspan="3"><b>Real Budget</b></td>
      <td>: Rp. <?php echo strrev(implode('.',str_split(strrev(strval($show->budget_real)), 3))); ?></td>
    </tr>
    <?php } } ?>
    <tr>
      <td colspan="3"><b>Status</b></td>
      <td>: <span class="badge <?php if($show->status == 'Just Added') { 
                                                    echo 'badge-secondary'; 
                                                  } elseif($show->status == 'Done') { 
                                                    echo 'badge-success'; 
                                                  } elseif($show->status == 'Ongoing') { 
                                                    echo 'badge-info'; 
                                                  } ?>"><?php echo $show->status ?>
            </span>
      </td>
    </tr>
  </tbody>
</table>

<h6>Konten Project</h6> <hr>
<p><?php echo $show->content ?></p>

<?php if ($this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Manager') { ?>
<h6>Crews & Tasks</h6> <hr>
<table class="table table-bordered">
	<tbody>
		<?php foreach ($crews as $crew): ?>
		<tr>
			<td><?php echo '<b>'.$crew->nama_kru.'</b> (<i>'.$crew->specs.'</i>)'; ?></td>
			<td>
        <ul>
					<?php foreach ($task as $list): if ($list->id_crew == $crew->id_crew) { ?>
					<li><?php echo $list->task.' (<i>'.$list->task_status.'</i>)'; ?></li>
					<?php } endforeach; ?>
				</ul>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php } else { ?>
<h6>My Tasks</h6> <hr>
<table class="table table-bordered">
  <tbody>
    <?php if (!empty($undone_task)) {?>
    <tr>
      <td>
        <ul>
          <li>
            Unaccomplished Tasks:
            <ul>
              <?php if (!empty($undone_task)) { foreach ($undone_task as $list): ?>
              <li><?php echo $list->task ?></li>
              <?php endforeach; } else { echo '<i>All tasks accomplished!</i>'; } ?>
            </ul>
          </li>
        </ul>
      </td>
    </tr>
    <?php } ?>
    <tr>
      <td>
        <ul>
          <li>
            Accomplished Tasks:
            <ul>
              <?php if (!empty($done_task)) { foreach ($done_task as $list): ?>
              <li><?php echo $list->task ?></li>
              <?php endforeach; } else { echo '<i>Tidak/belum ada!</i>'; } ?>
            </ul>
          </li>
        </ul>
      </td>
    </tr>
    <?php if (!empty($ignored_task)) {?>
    <tr>
      <td>
        <ul>
          <li>
            Ignored Tasks:
            <ul>
              <?php if (!empty($ignored_task)) { foreach ($undone_task as $list): ?>
              <li><?php echo $list->task ?></li>
              <?php endforeach; } else { echo '<i>Tidak ada!</i>'; } ?>
            </ul>
          </li>
        </ul>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php } ?>

<?php if (!empty($images)) { ?>

<h6>Images</h6> <hr>

<?php foreach ($images as $show): ?>
  <img src="<?php echo base_url('assets/img/pics/'.$show->gambar) ?>" class="img-fluid" width="20%">
<?php endforeach; } else { ?>
  <h6><i>No Images</i></h6>
<?php } ?>

<br> <hr>

<center>Dokumen ini dicetak oleh <?php echo $this->session->userdata('nama'); ?> pada <?php echo TanggalIndo(date('Y-m-d')) ?></center>

</body>
</html>
