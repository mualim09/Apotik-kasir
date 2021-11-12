<!-- Main content -->
<!-- Main content -->
<div class='row'>
  <div class='offset-md-2 col-md-8'>
      <div class='section-block' id='basicform'>
          <h3 class='section-title'>Form Pengguna</h3>
      </div>
      <div class='card'>
            <div class="card-header">
                <?='<p style="color:#dc3545">'.$this->session->flashdata('message').'</p>'?>
            </div>
              <div class='card-body'>
        <form action="<?php echo $action; ?>" method="post">
        <table class='table' id='table'>
	    <tr><td style="width:150px">Password <?php echo form_error('password') ?></td>
            <td>
                <div class="input-group">
                    <?php if(strtolower($button) === 'update'){?>
                        <div class="input-group"><label class="custom-control custom-checkbox"><span style="vertical-align: -webkit-baseline-middle;color:#ffc108">Ubah Password</span>
                            <input type="checkbox" class="custom-control-input" name="pass_change" id="pass_change" value="1" />
                            <span class="custom-control-label"></span>
                        </label></div>
                    <?php }?>

                    <div id="show_pass" class="form-group" style="margin-right:30px">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>">
                    </div>
                    
                    <div id="show_pass2" class="form-group">
                        <label for="password2">Password Confirm</label>
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="Password Conf." value="<?php echo $password; ?>">
                    </div>
                </div>
        </td></tr>
	    <tr><td>Username <?php echo form_error('username') ?></td>
            <td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </td>
	    <tr><td>Nama Lengkap <?php echo form_error('nama_lengkap') ?></td>
            <td><input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="nama_lengkap" value="<?php echo $nama_lengkap; ?>" />
        </td>
	    <tr><td>Level <?php echo form_error('level') ?></td>
            <td>
            <?=form_dropdown('level',$level_list,$level,'class="form-control" id="level"')?>
        </td>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <tr><td colspan='2'><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('master/pengguna') ?>" class="btn btn-default">Cancel</a></td></tr>
	
    </table></form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row --><!-- /.content -->