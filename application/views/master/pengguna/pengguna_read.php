
        <!-- Main content -->
        <div class='row'>
        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12'>
            <div class='section-block' id='basicform'>
                <h3 class='section-title'>Detail Pengguna</h3>
            </div>
            <div class='card'>
                    <div class='card-body'>
        <table class="table">
	    <tr><td>Nama lengkap</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td><?php echo  $jenis_kelamin !== 'l' ? 'Wanita' : 'Pria' ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Telp</td><td><?php echo $no_telp; ?></td></tr>
	    <tr><td>Pendidikan</td><td><?php echo $pendidikan; ?></td></tr>
	    <tr><td>Asatidz</td><td><?php echo !isset($asatidz) || $asatidz !== '0' ? '<i class="fa fa-check"></i>' : '' ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pengurus') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row --><!-- /.content -->