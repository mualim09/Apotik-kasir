
<form id="form_id" action="" form="get">
<div class="row">
    <div class="form-group col-md-3">
        <label for="periode">Penyimpanan
            <?=form_dropdown('penyimpanan',[''=>'Semua Penyimpanan','gudang'=>'Gudang','etalase'=>'Etalase'], $penyimpanan,'class="form-control" id="penyimpanan" style="width:100%" onchange="submit()"')?>
        </label>
    </div>
</div>
</form>

<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center"> Laporan Stok Barang Terakhir</h4>
                <div class="table-responsive">
        <table class="table table-hover" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Kode Barang</th>
		    <th>Nama</th>
		    <th>Satuan</th>
		    <th>Penyimpanan</th>
		    <th class="text-right">Stok Akhir</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0; $grand = 0;
            foreach ($data as $row)
            {
                $grand += $row->stok_akhir;
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $row->kode ?></td>
		    <td><?php echo $row->nama ?></td>
		    <td><?php echo $row->satuan ?></td>
		    <td><?php echo $row->penyimpanan ?></td>
		    <td class="text-right"><?php echo number_format($row->stok_akhir) ?></td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
                <tr style="border-top:2px solid #ffffff">
                    <td colspan="5"></td>
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