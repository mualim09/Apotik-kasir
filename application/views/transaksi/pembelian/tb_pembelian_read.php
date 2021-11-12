

<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
        <table class="table">
	    <tr><td>No Transaksi</td><td><?php echo $no_transaksi; ?></td></tr>
	    <tr><td>Tgl Transaksi</td><td><?php echo $tgl_transaksi; ?></td></tr>
	    <tr><td>Ppn</td><td><?php echo $ppn; ?></td></tr>
	    <tr><td>Total</td><td><?php echo $total; ?></td></tr>
	    <tr><td>Grandtotal</td><td><?php echo $grandtotal; ?></td></tr>
	    <tr><td>Bayar</td><td><?php echo $bayar; ?></td></tr>
	    <tr><td>Sisa</td><td><?php echo $sisa; ?></td></tr>
	    <tr><td>Supplier Id</td><td><?php echo $supplier_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('pembelian') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->