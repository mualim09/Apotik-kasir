
<form id="form_id" action="" form="get">
<div class="row">
    <div class="form-group col-md-3">
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
        <label for="periode">Periode
            <input onchange="submit()" type="text" class="periode form-control" name="periode" id="periode" placeholder="Periode" value="<?php echo $set; ?>" />
        </label>
    </div>
    <div class="form-group col-md-3">
        <label for="periode">Golongan
            <?=form_dropdown('golongan',$golongan_list, $golongan,'class="form-control" id="golongan" style="width:100%" onchange="submit()"')?>
        </label>
    </div>
</div>
</form>

<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center"> Laporan Penjualan Per Barang</h4>
                <div class="table-responsive">
                    <table class="table table-hover" id="mytable">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Nama Barang</th>
                                <th>Golongan</th>
                                <th>Kandungan</th>
                                <th>Dosis</th>
                                <th>Bentuk Sediaan</th>
                                <th>Supplier</th>
                                <th>Alamat Supplier</th>
                                <th class="text-right">Jumlah Barang</th>
                                <th class="text-right">Total Penjualan</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php
                        $start = 0; $jum = 0; $total = 0;
                        foreach ($data as $row)
                        {
                            $jum += $row->jml_brg;
                            $total += $row->penjualan;
                            ?>
                            <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $row->barang ?></td>
                        <td><?php echo $row->golongan ?></td>
                        <td><?php echo $row->kandungan ?></td>
                        <td><?php echo $row->dosis ?></td>
                        <td><?php echo $row->bentuk_sediaan ?></td>
                        <td><?php echo $row->supplier ?></td>
                        <td><?php echo $row->supplier_alamat ?></td>
                        <td class="text-right"><?php echo number_format($row->jml_brg) ?></td>
                        <td class="text-right"><?php echo number_format($row->penjualan) ?></td>
                        </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr style="border-top:2px solid #ffffff">
                                <td colspan="8"></td>
                                <td class="text-right"><strong><?=number_format($jum)?></strong></td>
                                <td class="text-right"><strong><?=number_format($total)?></strong></td>
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