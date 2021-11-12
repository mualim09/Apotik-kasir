
<div class="row">
    <div class="col-md-12 d-print-none" style="padding-top:20px">
        <a href="#" onClick="goprint()" class="btn btn-rounded btn-primary btn-sm" id="btn-print"><i class="mdi mdi-printer"></i> Print</a>
    </div>
</div>

<div class="print-faktur">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
          <table class="table header">
            <tbody>
            <tr>
              <td style="width:70%"><h5><strong><?=$profile->nama?></strong></h5></td>
              <td colspan="2" style="width:30%"><h5><strong>Supplier</strong><br><small><?=$master->sup_nama?></small></h5></td>
            </tr>
            <tr>
              <td><h5><small><?=$profile->alamat?></small></h5></td>
              <td colspan="2"><h5><small><?=$master->sup_alamat?></small></h5></td>
            </tr>
            <tr>
              <td><h5><small>Telp : <?=$profile->telp?></small></h5></td>
              <td><h5><small>No. Transaksi</small></h5></td>
              <td><h5><small>: <?=$master->no_transaksi?></small></h5></td>
            </tr>
            <tr>
              <td><h5><small>Fax : <?=$profile->fax?></small></h5></td>
              <td><h5><small>No. Faktur</small></h5></td>
              <td><h5><small>: <?=$master->no_faktur?></small></h5></td>
            </tr>
            <tr>
              <td></td>
              <td><h5><small>Jatuh Tempo</small></h5></td>
              <td><h5><small>: <?=$master->jatuh_tempo?></small></h5></td>
            </tr>
            </tbody>
          </table>
        </div><!-- /.col -->
      </div><!-- /.row -->
      
      <div class="row">
        <div class="col-md-12 grid-margin">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-left">No.</th>
                <th class="text-left">Nama barang</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Potongan harga</th>
                <th class="text-right">Harga beli</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $inc = 0;
              $count = count($detail);
              $sum_hrgbeli = $sum_diskon = 0;
                foreach($detail as $data){
                  $inc++;
                  $sum_hrgbeli += $data->hrg_beli*$data->jumlah;
                  $sum_diskon  += $data->hrg_beli*$data->diskon/100;

                  $margin = '';
                  if($count = $inc){
                    $margin = '<tr style="height:50px"></tr>';
                  }
                  ?>
                  <tr>
                    <td style=""><?=$inc?></td>
                    <td style=""><?=$data->barang?></td>
                    <td style="text-align:right"><?=number_format($data->jumlah)?></td>
                    <td style="text-align:right"><?=number_format($data->hrg_beli)?></td>
                    <td style="text-align:right"><?=number_format($data->diskon)?></td>
                    <td style="text-align:right"><?=number_format($data->hrg_beli*$data->jumlah)?></td>
                  </tr>
                  <?=$margin?>
                  <?php
                }
                
              ?>
              <tr>
                <td colspan="5"><strong>Total Harga Beli</strong></td>
                <td class="text-right"><strong><?=number_format($sum_hrgbeli)?></strong></td>
              </tr>
              <tr>
                <td colspan="5"><strong>Total Diskon</strong></td>
                <td class="text-right"><strong><?=number_format($sum_diskon)?></strong></td>
              </tr>
              <tr>
                <td colspan="5"><strong>Dasar Pengenaan Pajak</strong></td>
                <td class="text-right"><strong><?=number_format($sum_hrgbeli-$sum_diskon)?></strong></td>
              </tr>
              <tr>
                <td colspan="5"><strong>PPN = 10% x Dasar Pengenaan Pajak</strong></td>
                <td class="text-right"><strong><?=number_format(($sum_hrgbeli-$sum_diskon)*10/100)?></strong></td>
              </tr>
              <tr>
                <td colspan="5"><strong>Jumlah Harus Dibayar</strong></td>
                <td class="text-right"><strong><?=number_format(($sum_hrgbeli-$sum_diskon)+(($sum_hrgbeli-$sum_diskon)*10/100))?></strong></td>
              </tr>
            </tbody>
          </table>
    </div><!-- /.col -->
  </div><!-- /.row -->
  <div class="row">
    <div class="col-md-12">
      <h5><?='Terbilang '.ucwords(terbilang(($sum_hrgbeli-$sum_diskon)+(($sum_hrgbeli-$sum_diskon)*10/100))).' Rupiah'?></h5>
    </div>
    <div class="col-md-12 mt-3">
      <p>
        <span class="mr-3">Bank <?=$master->bank_nama?></span>
        <span class="mr-3">No.<?=$master->bank_reg?></span>
        <span>Atas Nama <?=$master->bank_an?></span>
      </p>
    </div>
  </div>

  <div class="row" style="margin-top:15px">
    <div class="offset-8 col-md-4 grid-margin stretch-card">
          <table class="table header">
            <tbody>
              <tr>
                <td class="text-center"><?=$profile->kota?>, <?=date('d').' '.bulan(date('m')).' '.date('Y')?></td>
              </tr>
              <tr>
                <td style="padding-bottom:70px" class="text-center">Apoteker Penanggung Jawab</td>
              </tr>
              <tr>
                <td class="text-center"><?=$this->session->userdata('user_nama')?></td>
              </tr>
            </tbody>
          </table>
    </div>
  </div>
</div>
<iframe  id="print-faktur" src="faktur_pembelian.pdf" style="display:none;"></iframe>

<script>
	function goprint() {
		window.print();
    /*var getMyFrame = document.getElementById('print-faktur');
    getMyFrame.focus();
    getMyFrame.contentWindow.print();*/
	}
</script>