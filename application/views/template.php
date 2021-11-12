<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

		<title><?= isset($header['title_page']) ? $header['title_page'] : ''?></title>

		<link rel="stylesheet" href="<?= base_url()?>assets/vendors/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="<?= base_url()?>assets/vendors/base/vendor.bundle.base.css">
		<!-- endinject -->
		<!-- plugin css for this page -->
		<link rel="stylesheet" href="<?= base_url()?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
		<!-- End plugin css for this page -->
		<!-- inject:css -->
		<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendors/select2/select2.min.css" />
		<!-- endinject -->
		<link rel="shortcut icon" href="<?= base_url()?>assets/images/favicon.png" />
    </head>
   
   <style>
   
    td.details-control {
      background: url('<?= base_url()?>assets/images/details_open.png') no-repeat center center;
      cursor: pointer;
    }
    tr.shown td.details-control {
      background: url('<?= base_url()?>assets/images/details_close.png') no-repeat center center;
    }

    select.form-control, .dataTables_wrapper select {
      color: #495057;
    }

   .btn.btn-sm {
      padding: 5px!important;
    }

    .print-faktur .header td{
      padding:2px;
      border:0
    }

    .print-faktur table td{
      padding:5px 15px;
    }

    .table tr td, .table tr th{
      padding:5px 7px!important;
    }

    .print-faktur h5{
      margin-bottom:0;
    }

    .print-faktur .table.table-bordered {
      border-top: 1px solid #dee2e6;
    }

    .print-faktur .table-bordered td {
      border: 1px solid #dee2e6;
    }

    .print-faktur .table thead th {
    border-bottom: 2px solid #dee2e6;
    }

    .table-child{
      border:1px solid #71c016;
    }

    .table-child thead th {
    border-bottom: 0;
    }

    .table-child thead th{
      font-weight:700;
    }

    .table-child thead th,.table-child tbody td{
      font-size:0.8rem;
    }

    .table-child tr td{
      border-top:1px solid #71c016;
    }
    
    #mytable tr td, #mytable tr th{
      font-size : 12px;
    }

    #mytable input, .form-group input{
      padding : 7px 14px;
      height  : 30px;
    }
   </style>
    <body>
        
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row d-print-none">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="index.html"><img style="width:56px;height:auto" src="<?=base_url()?>assets/images/logo.jpg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <p><strong><?= isset($header['title_page']) ? strtoupper($header['title_page']) : '' ?></strong></p>
            <div class="d-flex">
              <a href="<?=base_url('beranda')?>"><i class="mdi mdi-home text-muted hover-cursor"></i></a>
              <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;<?= isset($header['page1']) ? $header['page1'] : '' ?>&nbsp;/&nbsp;</p>
              <p class="text-primary mb-0 hover-cursor"><?= isset($header['page2']) ? $header['page2'] : '' ?></p>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <!--<img src="images/faces/face5.jpg" alt="profile"/>-->
              <span class="nav-profile-name"><?=$this->session->userdata('user_nama')?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?=base_url('logout')?>">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
								<!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas d-print-none" id="sidebar">
        <ul class="nav">
						<?php
						$sql = 'select m.* from tb_menu m inner join tb_menu_rules mf on m.id = mf.menu_id and mf.level = ? where m.is_parent = 0 and is_active = 1 ORDER BY m.order';
						$menu = $this->db->query($sql,[$this->session->userdata('user_level')]);
						
						$ind = 0;$curr_group = '';

						echo '<li class="nav-item">
										<a class="nav-link" href="'.base_url('beranda').'">
											<i class="mdi mdi-home menu-icon"></i>
											<span class="menu-title">Beranda</span>
										</a>
									</li>';

						foreach ($menu->result() as $m) {
																
							// chek ada sub menu
							$sql = 'select m.* from tb_menu m inner join tb_menu_rules mf on m.id = mf.menu_id and mf.level = ? where m.is_parent = '.$m->id.' and is_active = 1 ORDER BY m.order ASC';
							$submenu = $this->db->query($sql,[$this->session->userdata('user_level')]);
							if($submenu->num_rows()>0){
								++$ind;
								// tampilkan submenu
								echo '<li class="nav-item">
												<a class="nav-link" data-toggle="collapse" href="#dd'.$ind.'" aria-expanded="false" aria-controls="auth">
													<i class="'.$m->icon.'"></i>
													<span class="menu-title">'.ucfirst($m->name).'</span>
													<i class="menu-arrow"></i>
												</a>
												<div class="collapse" id="dd'.$ind.'">
													<ul class="nav flex-column sub-menu">';

								foreach ($submenu->result() as $s){
										echo '<li class="nav-item"> <a class="nav-link" href="'.base_url().$s->link.'"> '.$s->name.' </a></li>';
								}
									echo"</ul>
											</div>
										</li>";
							}else{
								echo '<li class="nav-item">
												<a class="nav-link" href="'.base_url().$m->link.'">
													<i class="'.$m->icon.'"></i>
													<span class="menu-title">'.ucfirst($m->name).'</span>
												</a>
											</li>';
							}
							
						}
						?>

					</ul>
				</nav>
					
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
					
                <?php
                echo $contents;
                ?>

				<footer class="footer  d-print-none">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
		
		<!-- plugins:js -->
		<script src="<?=base_url()?>assets/vendors/base/vendor.bundle.base.js"></script>
		<!-- endinject -->
		<!-- Plugin js for this page-->
		<script src="<?=base_url()?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
		<script src="<?=base_url()?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
		<!-- End plugin js for this page-->
		<!-- inject:js -->
		<script src="<?=base_url()?>assets/js/off-canvas.js"></script>
		<script src="<?=base_url()?>assets/js/hoverable-collapse.js"></script>
		<script src="<?=base_url()?>assets/js/template.js"></script>
		<!-- endinject -->
		<!-- Custom js for this page-->
		<script src="<?=base_url()?>assets/js/dashboard.js"></script>
		<script src="<?=base_url()?>assets/js/data-table.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.dataTables.js"></script>
		<script src="<?=base_url()?>assets/js/dataTables.bootstrap4.js"></script>
		<!-- End custom js for this page-->
		<script src="<?=base_url()?>assets/js/bootstrap-datepicker.js"></script>
		<script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>
		<script src="<?=base_url()?>assets/js/jquery.masknumber.min.js"></script>
    <script src="<?=base_url()?>assets/vendors/select2/select2.full.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function () {
					$('.tanggal').datepicker({
							format: "dd-mm-yyyy",
							autoclose:true
					});

          $('#tb_barang_id').select2();
			});
      
      function detailclick(no){
        if($('#detail_'+no).is(":hidden")){
          $('#detail_'+no).attr('hidden',false);
        }else{
          $('#detail_'+no).attr('hidden',true);
        }
      }
		</script>
    </body>
</html>
