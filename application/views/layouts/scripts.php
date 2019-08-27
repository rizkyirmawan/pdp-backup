
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script>
    let rupiah = document.querySelector('.budget');
    rupiah.addEventListener('keyup', function(e){
      rupiah.value = formatRupiah(this.value, '');
    });

   /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix){
      let number_string = angka.replace(/[^,\d]/g, '').toString(),
      split             = number_string.split(','),
      sisa              = split[0].length % 3,
      rupiah            = split[0].substr(0, sisa),
      ribuan            = split[0].substr(sisa).match(/\d{3}/gi);

      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    let rp = document.querySelector('.second-budget');
    rp.addEventListener('keyup', function(e){
      rp.value = formatRupiah(this.value, '');
    });

   /* Fungsi formatRupiah */
    function formatRupiah(angka, fixed){
      let num_string    = angka.replace(/[^,\d]/g, '').toString(),
      splice            = num_string.split(','),
      remnants          = splice[0].length % 3,
      rp                = splice[0].substr(0, remnants),
      thousands         = splice[0].substr(remnants).match(/\d{3}/gi);

      if(thousands){
        pemisah = remnants ? '.' : '';
        rp += pemisah + thousands.join('.');
      }

      rp = splice[1] != undefined ? rp + ',' + splice[1] : rp;
      return fixed == undefined ? rp : (rp ? '' + rp : '');
    }
  </script>
  <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
  </script>
  <script src="<?php echo base_url() ?>assets/js/custom.js"></script>
  <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url() ?>assets/js/demo/datatables-demo.js"></script>


