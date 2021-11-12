<div class="row">
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group"><label>Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group"><label>Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class="form-group"><label>Telp <?php echo form_error('telp') ?></label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
        </div>
	    <div class="form-group"><label>Spesialis <?php echo form_error('spesialis') ?></label>
            <input type="text" class="form-control" name="spesialis" id="spesialis" placeholder="Spesialis" value="<?php echo $spesialis; ?>" />
        </div>
	    <input type="hidden" name="id_dokter" value="<?php echo $id_dokter; ?>" /> 
	    <div class="form-group"><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('dokter') ?>" class="btn btn-default">Cancel</a></div>
	
    </form>
    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->