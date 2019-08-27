<!-- Update Modal -->
<div class="modal fade" id="updateProject<?php echo $show->kode ?>" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Update Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('admin/update_project/'.$show->kode); ?>
      <div class="modal-body">
        <!-- Form -->
        <input type="hidden" name="kode" value="<?php echo $show->kode ?>">
        <div class="form-row mb-2">
          <div class="col">
            <label for="judul">Judul:</label>
            <input type="text" class="form-control" id="judul" name="judul" maxlength="100" value="<?php echo $show->judul ?>" required>
          </div>
          <div class="col">
            <label for="tempat">Tempat:</label>
            <input type="text" class="form-control" id="tempat" name="tempat" maxlength="200" value="<?php echo $show->tempat ?>" required>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="kode_client">Client:</label>
            <select name="kode_client" id="kode_client" class="form-control" data-live-search="true" title="Pilih Client" required>
              <?php foreach ($list_client as $list): ?>
                <option value="<?php echo $list->kode ?>" <?php if($list->kode == $show->kode_client) { echo 'selected'; } ?>><?php echo $list->client ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col">
            <label for="kode_kategori">Kategori:</label>
            <select name="kode_kategori" id="kode_kategori" class="form-control" data-live-search="true" title="Pilih Kategori" required>
              <?php foreach ($list_kategori as $list): ?>
                <option value="<?php echo $list->kode ?>" <?php if($list->kode == $show->kode_kategori) { echo 'selected'; } ?>><?php echo $list->kategori ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="start">Dari Tanggal:</label>
            <input type="date" id="start" name="start" class="form-control start" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $show->start ?>" required>
          </div>
          <div class="col">
            <label for="end">Sampai Tanggal:</label>
            <input type="date" id="end" name="end" class="form-control end" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $show->end ?>" required>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="content">Konten:</label>
            <textarea name="content" class="form-control editor" cols="50" rows="10"><?php echo $show->content ?></textarea>
          </div>
        </div>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Update">
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
