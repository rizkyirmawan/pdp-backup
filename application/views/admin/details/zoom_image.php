<!-- Add Qty -->
<div class="modal fade" id="zoomImage<?php echo $show->id ?>" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Gambar Project</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" align="center">
        <img src="<?php echo base_url('assets/img/pics/').$show->gambar ?>" class="img-thumbnail img-fluid">
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>