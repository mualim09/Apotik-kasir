<html>
<head>
    <title>LOGIN | Manajemen Stok & Penjualan Apotik RSRM</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- plugins:css -->
		<link rel="stylesheet" href="<?=base_url()?>assets/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/vendors/base/vendor.bundle.base.css">
		<!-- endinject -->
		<!-- plugin css for this page -->
		<!-- End plugin css for this page -->
		<!-- inject:css -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
		<!-- endinject -->
		<link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img style="display:block;margin-left:auto;margin-right:auto" src="<?=base_url()?>assets/images/logo.jpg" alt="Kasir Apotik">
              </div>
              <h4>Login... </h4>
                <?php 
                    if(!empty($this->session->flashdata('error-login'))){
                        echo $this->session->flashdata('error-login');
                    }
                ?>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input autofocus required value="<?php echo $username?>" type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input required type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" name="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
	<!-- plugins:js -->
	<script src="<?=base_url()?>assets/vendors/base/vendor.bundle.base.js"></script>
	<!-- endinject -->
	<!-- inject:js -->
	<script src="<?=base_url()?>assets/js/off-canvas.js"></script>
	<script src="<?=base_url()?>assets/js/hoverable-collapse.js"></script>
	<script src="<?=base_url()?>assets/js/template.js"></script>
</body>
</html>