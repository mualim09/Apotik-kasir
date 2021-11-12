
<form action="<?php echo $action; ?>" method="post">

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Transfer Stok Detail</h4>
                    <div class="row">
                        <div class="form-group col-md-2"><label>No Transaksi <?php echo form_error('no_transaksi') ?></label>
                            <input readonly type="text" class="form-control  numeric" name="no_transaksi" id="no_transaksi" placeholder="Otomatis di generate" value="<?php echo $no_transaksi; ?>" />
                        </div>
                        <div class="form-group col-md-2"><label>Tgl Transaksi <?php echo form_error('tgl_transaksi') ?></label>
                            <input required type="text" class="form-control tanggal" name="tgl_transaksi" id="tgl_transaksi" placeholder="Tgl Transaksi" value="<?php echo $tgl_transaksi; ?>" />
                        </div>
                        <div class="form-group col-md-2"><label>Penyimpanan Dari<?php echo form_error('penyimpanan_dari') ?></label>
                            <?=form_dropdown('penyimpanan_dari',['gudang'=>'GUDANG','etalase'=>'ETALASE'],$penyimpanan_dari,' required onchange="check_penyimpanan(event)" class="form-control" id="penyimpanan_dari"');?>
                        </div>
                        <div class="form-group col-md-2"><label>Transfer Ke<?php echo form_error('penyimpanan_ke') ?></label>
                            <?=form_dropdown('penyimpanan_ke',['gudang'=>'GUDANG','etalase'=>'ETALASE'],$penyimpanan_ke,'required onchange="check_penyimpanan(event)" class="form-control" id="penyimpanan_ke"');?>
                        </div>
                        <div class="form-group col-md-2"><label>Keterangan<?php echo form_error('keterangan') ?></label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                        </div>
                    </div>
	
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ITEM</h4>
                <div class="table-responsive">
                    <table class="table" id="mytable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Barang</th>
                          <th>Jumlah</th>
                          <th><a href="JavaScript:void(0);" onClick="tambah()"><i style="font-size:18px" class="mdi mdi-cart-plus"></i></a></th>
                        </tr>
                      </thead>
                      <tbody id="item">
                      </tbody>
                    </table>
                  </div>
	
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <input type="hidden" name="id_transfer" value="<?php echo $id_transfer; ?>" /> 
        <div class="form-group"><button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('transaksi/transfer_stok') ?>" class="btn btn-default">Cancel</a></div>
    </div><!-- /.col -->
</div><!-- /.row --> 

</form>