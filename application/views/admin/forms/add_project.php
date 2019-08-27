<!-- Add Modal -->
<div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Tambah Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <?php echo form_open_multipart('admin/add_project'); ?>
      <div class="modal-body">
        <!-- Form -->
        <input type="hidden" name="kode" value="<?php echo $kode_project ?>">
        <input type="hidden" name="id_manager" value="<?php echo $this->session->userdata('id'); ?>">
        <div class="form-row mb-2">
          <div class="col">
            <label for="judul">Judul:</label>
            <input type="text" class="form-control" id="judul" name="judul" maxlength="100" value="<?php echo set_value('judul'); ?>" required>
          </div>
          <div class="col">
            <label for="tempat">Tempat:</label>
            <input type="text" class="form-control" id="tempat" name="tempat" maxlength="200" value="<?php echo set_value('tempat'); ?>" required>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="kode_client">Client:</label>
            <select name="kode_client" id="kode_client" class="form-control selectpicker" data-live-search="true" title="Pilih Client" required>
              <?php foreach ($list_client as $list): ?>
                <option value="<?php echo $list->kode ?>"><?php echo $list->client ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col">
            <label for="kode_kategori">Kategori:</label>
            <select name="kode_kategori" id="kode_kategori" class="form-control selectpicker" data-live-search="true" title="Pilih Kategori" required>
              <?php foreach ($list_kategori as $list): ?>
                <option value="<?php echo $list->kode ?>"><?php echo $list->kategori ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="start">Dari Tanggal:</label>
            <input type="date" id="start" name="start" class="form-control start" min="<?php echo date('Y-m-d'); ?>" value="<?php echo set_value('start'); ?>" required>
          </div>
          <div class="col">
            <label for="end">Sampai Tanggal:</label>
            <input type="date" id="end" name="end" class="form-control end" value="<?php echo set_value('end'); ?>" required>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col mb-2">
            <label for="id_crew">Kru:</label>
            <select name="id_crew[]" id="id_crew" title="Pilih Kru" class="selectpicker form-control" data-hide-disabled="true" multiple data-actions-box="true"  data-live-search="true" multiple required>
              <?php foreach ($list_kontributor as $list): ?>
                <option value="<?php echo $list->id ?>"><?php echo $list->nama.' (<i>'.$list->specs.'</i>)' ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col">
            <label for="budget">Rencana Budget:</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text">Rp.</div>
              </div>
              <input type="text" value="<?php echo set_value('budget'); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control budget" name="budget" maxlength="20">
            </div>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col">
            <label for="content">Konten:</label>
            <textarea name="content" class="form-control editor" cols="50" rows="10"><?php echo set_value('content'); ?></textarea>
          </div>
        </div>
        <!-- End Form -->
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <input type="submit" class="btn btn-primary" value="Simpan">
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>


