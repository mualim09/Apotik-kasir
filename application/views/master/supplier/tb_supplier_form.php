
<form action="<?php echo $action; ?>" method="post">
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Diri</h4>
                <div class="form-sample">
                        <div class="form-group"><label>Nama <?php echo form_error('nama') ?></label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                        </div>
                        <div class="form-group"><label>Telp <?php echo form_error('telp') ?></label>
                            <input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
                        </div>
                        <div class="form-group"><label>Alamat <?php echo form_error('alamat') ?></label>
                            <textarea style="height:150px" class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                        </div>
                    <input type="hidden" name="id_supplier" value="<?php echo $id_supplier; ?>" /> 
                    <div class="form-group"><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('master/supplier') ?>" class="btn btn-default">Cancel</a></div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Info Lain-Lain</h4>
                <div class="form-sample">
                        <div class="form-group"><label>No. PBF <?php echo form_error('pbf') ?></label>
                            <input type="text" class="form-control" name="pbf" id="pbf" placeholder="No. PBF" value="<?php echo $pbf; ?>" />
                        </div>
                        <div class="form-group"><label>No. NPWP <?php echo form_error('npwp') ?></label>
                            <input type="text" class="form-control" name="npwp" id="npwp" placeholder="No. NPWP" value="<?php echo $npwp; ?>" />
                        </div>
                        <div class="form-group"><label>Reg. Bank <?php echo form_error('bank_reg') ?></label>
                            <input type="text" class="form-control" name="bank_reg" id="bank_reg" placeholder="Reg. Bank" value="<?php echo $bank_reg; ?>" />
                        </div>
                        <div class="form-group"><label>Nama Bank <?php echo form_error('bank_nama') ?></label>
                            <input type="text" class="form-control" name="bank_nama" id="bank_nama" placeholder="Nama Bank" value="<?php echo $bank_nama; ?>" />
                        </div>
                        <div class="form-group"><label>A/N Bank <?php echo form_error('bank_an') ?></label>
                            <input type="text" class="form-control" name="bank_an" id="bank_an" placeholder="A/N Bank" value="<?php echo $bank_an; ?>" />
                        </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
          
</form>