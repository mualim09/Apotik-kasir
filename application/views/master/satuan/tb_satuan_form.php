<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
        <form action="<?php echo $action; ?>" method="post">
        
	        <div class="form-group"><label>Barang <?php echo form_error('satuan') ?></label>
            <?=form_dropdown('tb_barang_id',$barang,$tb_barang_id,"class='form-control' id='tb_barang_id'")?>
          </div>

	        <div class="form-group"><label>Satuan <?php echo form_error('satuan') ?></label>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
          </div>

	        <div class="form-group"><label>Rasio <?php echo form_error('rasio') ?></label>
            <input type="number" min="1" class="form-control" name="rasio" id="rasio" placeholder="Rasio" value="<?php echo $rasio; ?>" />
          </div>

	        <input type="hidden" name="id_satuan" value="<?php echo $id_satuan; ?>" /> 
	        <div class="form-group"><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	        <a href="<?php echo site_url('master/satuan') ?>" class="btn btn-default">Cancel</a></div>
	
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->