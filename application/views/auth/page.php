<div class="container" align="center">

    <!-- Outer Row -->
    <br>
    <img src="<?php echo base_url('assets/img/task.svg') ?>" class="img-fluid" height="21.5%" width="21.5%">
    <div class="row justify-content-center">
      
        
      <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-4">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-4">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome to PDP <sup>BETA</sup></h1>
                  </div>

                  <?php
                      //Validasi
                      echo validation_errors(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup"> 
                            <span aria-hidden="true">&times;</span> 
                            </button>', 
                        '</div>'
                      ); 

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

                  <hr>
                  <?php echo form_open(base_url('auth'), array('class' => 'user')); ?>
                    <div class="form-group">
                      <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control form-control-user" placeholder="E-mail...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control form-control-user" placeholder="Password...">
                    </div>
                    <input type ="submit" class="btn btn-primary btn-user btn-block" value="Login">
                  <?php echo form_close(); ?>
                  <hr>
                  <div class="text-center">
                    Copyright &copy; PDP (Pengolahan Data Projek) <?php echo date('Y') ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>