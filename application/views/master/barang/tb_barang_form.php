
<form action="<?php echo $action; ?>" method="post">
<input type="hidden" name="action_from" id="action_from" value="<?=$action_from?>">
<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi</h4>
                <div class="row">
                    <div class="form-group col-md-4"><label>Kode <?php echo form_error('kode') ?></label>
                        <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" />
                    </div>
                    <div class="form-group col-md-4"><label>Nama <?php echo form_error('nama') ?></label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label>Supplier <?php echo form_error('suplier_id') ?></label>
                        <?=form_dropdown('supplier_id',$supplier_list, $supplier_id, 'class="form-control" id="supplier_id"')?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4"><label>Kandungan <?php echo form_error('kandungan') ?></label>
                        <input type="text" class="form-control" name="kandungan" id="kandungan" placeholder="Kandungan" value="<?php echo $kandungan; ?>" />
                    </div>
                    <div class="form-group col-md-4"><label>Dosis <?php echo form_error('dosis') ?></label>
                        <input type="text" class="form-control" name="dosis" id="dosis" placeholder="Dosis" value="<?php echo $dosis; ?>" />
                    </div>
                    <div class="form-group col-md-4"><label>Golongan <?php echo form_error('golongan') ?></label>
                        <?=form_dropdown('golongan', $golongan_list, $golongan,'class="form-control" id="golongan"')?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4"><label>Kelas Terapi <?php echo form_error('kelas_terapi') ?></label>
                        <?=form_dropdown('kelas_terapi', $terapi_list, $kelas_terapi,'class="form-control" id="kelas_terapi"')?>
                    </div>
                    <div class="form-group col-md-4"><label>Bentuk Sediaan <?php echo form_error('bentuk_sediaan') ?></label>
                        <?=form_dropdown('bentuk_sediaan', $sediaan_list, $bentuk_sediaan,'class="form-control" id="bentuk_sediaan"')?>
                    </div>
                    <div class="form-group col-md-4"><label>Jenis <?php echo form_error('jenis') ?></label>
                        <?=form_dropdown('jenis', $jenis_list, $jenis,'class="form-control" id="jenis"')?>
                    </div>
                </div>
        
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Satuan & Harga</h4>
                <div class="form-group"><label>Satuan <?php echo form_error('satuan') ?></label>
                    <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
                </div>
                <div class="form-group"><label>Harga Beli <?php echo form_error('harga_beli') ?></label>
                    <input type="text" class="form-control numeric" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>" />
                </div>
                <div class="form-group"><label>Harga Jual <?php echo form_error('harga_jual') ?></label>
                    <input type="text" class="form-control numeric" name="harga_jual" id="harga_jual" placeholder="Harga Jual" value="<?php echo $harga_jual; ?>" />
                </div>
                <div class="form-group"><label>Diskon % <?php echo form_error('diskon') ?></label>
                    <input type="text" class="form-control numeric" name="diskon" id="diskon" placeholder="Diskon" value="<?php echo $diskon; ?>" />
                </div>
        
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    
    <div class="col-md-12">
        <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" /> 
        <div class="form-group"><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('master/barang') ?>" class="btn btn-default">Cancel</a></div>
    </div>
</div><!-- /.row -->
</form>