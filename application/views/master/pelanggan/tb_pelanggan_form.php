
<form action="<?php echo $action; ?>" method="post">
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"><label>Nama <?php echo form_error('nama') ?></label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                        </div>
                        <div class="form-group"><label>No Telp <?php echo form_error('no_telp') ?></label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><label>Alamat <?php echo form_error('alamat') ?></label>
                            <textarea style="height:150px" class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?> </textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" /> 
                    <div class="form-group"><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('master/pelanggan') ?>" class="btn btn-default">Cancel</a></div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
</form>