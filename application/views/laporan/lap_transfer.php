
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
                <h4 class="card-title text-center"> Laporan Transfer Stok Rekap</h4>
                <div class="table-responsive">
        <table class="table table-hover" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Tanggal</th>
		    <th>No Tranasksi</th>
		    <th>Penyimpanan Asal</th>
		    <th>Penyimpanan Tujuan</th>
		    <th>Keterangan</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($data as $row)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $row->tgl_transaksi ?></td>
		    <td><?php echo $row->no_transaksi ?></td>
		    <td><?php echo $row->penyimpanan_dari ?></td>
		    <td><?php echo $row->penyimpanan_ke ?></td>
		    <td><?php echo $row->keterangan ?></td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
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