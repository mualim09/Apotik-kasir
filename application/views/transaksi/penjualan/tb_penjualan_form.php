
<form action="<?php echo $action; ?>" method="post">

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Penjualan Info</h4>
                    <div class="row">
                            <div class="form-group col-md-3"><label>No Transaksi <?php echo form_error('no_transaksi') ?></label>
                                <input readonly type="text" class="form-control  numeric" name="no_transaksi" id="no_transaksi" placeholder="Otomatis di generate" value="<?php echo $no_transaksi; ?>" />
                            </div>
                            <div class="form-group col-md-3"><label>Tanggal <?php echo form_error('tgl_transaksi') ?></label>
                                <input required type="text" class="form-control tanggal" name="tgl_transaksi" id="tgl_transaksi" placeholder="Tgl Transaksi" value="<?php echo $tgl_transaksi; ?>" />
                            </div>

                            <div class="form-group col-md-3">
                              <label>Pelanggan<?php echo form_error('pelanggan_id') ?></label>
                              <div class="input-group">
                                <input required type="text" class="form-control" name="pelanggan" id="pelanggan" placeholder="pelanggan" value="<?php echo $pelanggan; ?>" />
                                <input type="hidden" name="pelanggan_id" id="pelanggan_id" value="<?php echo $pelanggan_id; ?>" />

                                <div class="input-group-append">
                                  <button class="btn btn-sm btn-primary" type="button" id="add_pelanggan_btn">Baru</button>
                                </div>
                              </div>
                            </div>

                            <div class="form-group col-md-3"><label>Keterangan<?php echo form_error('keterangan') ?></label>
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
                <h4 class="card-title">ITEM <!--<a class="ml-3" href="<?=base_url()?>master/barang/create"><i class="mdi mdi-plus-circle"></i> <small>Item baru</small></a>--></h4>
                <div class="table-responsive">
                    <table class="table" id="mytable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Barang</th>
                          <th class="text-right">Jumlah</th>
                          <th>Satuan</th>
                          <th class="text-right">Harga Jual</th>
                          <th class="text-right">Diskon %</th>
                          <th class="text-right">SubTotal</th>
                          <th><a title="Tekan F2 untuk shortcut" href="JavaScript:void(0);" class="tambah"><i style="font-size:18px" class="mdi mdi-cart-plus"></i></a></th>
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
    
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                
                <div class="form-group">
                    <p>TOTAL <span id="total_s" style="float:right">0</span></p>
                    <input type="hidden" name="total" id="total" value="<?php echo $total; ?>" />
                </div>
                <div class="form-group">
                    <p>PPN <span id="ppn_s">0%</span>
                        <span id="ppn_nominal" style="float:right">0</span>
                    </p>
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input onclick="fcheckppn()" type="checkbox" id="checkppn" class="form-check-input">
                        Menggunakan PPN
                      <i class="input-helper"></i></label>
                    </div>
                    <input type="hidden" name="ppn" id="ppn" value="<?php echo $ppn; ?>" />
                </div>
                <div class="form-group">
                    <h5>GRANDTOTAL <span id="grand_s" style="float:right">0</span></h5>
                    <input type="hidden" name="grandtotal" id="grandtotal" value="<?php echo $grandtotal; ?>" />
                </div>
                <input type="hidden" name="id_penjualan" value="<?php echo $id_penjualan; ?>" /> 
                <div class="form-group">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pembayaran">Pembayaran</button>
                    <a href="<?php echo site_url('transaksi/penjualan') ?>" class="btn btn-default">Cancel</a>
                </div>
	
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

  <!-- Modal -->
  
<!-- The Modal -->
<div class="modal" id="pembayaran">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="grandtotal_alias" style="color:#30a5ff">GRAND TOTAL</label>
                    <input readonly value="<?=$grandtotal_alias?>" type="text" class="form-control text-right numeric" name="grandtotal_alias" id="grandtotal_alias">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bayar">Dibayar</label>
                    <input onChange="bayar_change(this.value)" value="<?=$bayar?>" type="text" class="form-control text-right numeric" name="bayar" id="bayar">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kembalian">Kembalian</label>
                    <input readonly value="<?=$sisa?>" type="text" class="form-control text-right numeric" name="kembalian" id="kembalian">
                </div>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="bayarsubmit()" >Save</button>
      </div>

    </div>
  </div>
</div>
   
</form>

<script>
  function bayarsubmit(){
    $('form').submit();
  }
</script>