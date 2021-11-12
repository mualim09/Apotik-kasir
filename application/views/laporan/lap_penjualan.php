
<div class="row">
    <div class="col-md-3">
        <?php
        if(null != ($periode)){
            $set_periode = $periode;
            $y2 = substr($set_periode,0,4);
            $m2 = substr($set_periode,5,strpos(substr($set_periode,5,strlen($set_periode)),'-'));
            $set = date('m-Y',strtotime("$m2/1/$y2"));
        }
        else
            {$set = date('m-Y');}
        ?>
        <form id="form_id" action="" form="get">
            <label for="periode">Periode
                <input onchange="submit()" type="text" class="periode form-control" name="periode" id="periode" placeholder="Periode" value="<?php echo $set; ?>" />
            </label>
        </form>
    </div>
	<div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center"> Laporan Penjualan Rekap</h4>
                <div class="table-responsive">
        <table class="table table-hover" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Tanggal</th>
		    <th>No Transaksi</th>
		    <th>Pelanggan</th>
            <th>Karyawan</th>
		    <th>PPN</th>
		    <th class="text-right">Total</th>
		    <th class="text-right">Grand Total</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0; $total = 0; $grand = 0;
            foreach ($data as $row)
            {
                $total += $row->total;
                $grand += $row->grandtotal;
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $row->tgl_transaksi ?></td>
		    <td><?php echo $row->no_transaksi ?></td>
		    <td><?php echo $row->pelanggan ?></td>
            <td><?php echo $row->pegawai ?></td>
		    <td><?php echo $row->ppn ?></td>
		    <td class="text-right"><?php echo number_format($row->total) ?></td>
		    <td class="text-right"><?php echo number_format($row->grandtotal) ?></td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
                <tr style="border-top:2px solid #ffffff">
                    <td colspan="6"></td>
                    <td class="text-right"><strong><?=number_format($total)?></strong></td>
                    <td class="text-right"><strong><?=number_format($grand)?></strong></td>
                </tr>
            </tfoot>
        </table>
        </div>
                    </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <script>
            function submit(){
                document.getElementById('form_id').submit();
            }
          </script>