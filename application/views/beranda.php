<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="mr-md-3 mr-xl-5">
          <h2>Aplikasi Manajemen Stok & Kasir</h2>
          <p class="mb-md-0">Kasir Apotik</p>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
        <?php if($this->session->userdata('user_level') == 1){ ?>
        <a href="<?=base_url()?>transaksi/pembelian/create" class="btn btn-primary mr-3 mt-2 mt-xl-0"><i class="mdi mdi-briefcase-download"></i> Pembelian</a> <?php }?>
        <a href="<?=base_url()?>transaksi/penjualan/create" class="btn btn-warning mt-2 mt-xl-0"><i class="mdi mdi-briefcase-upload"></i> Penjualan</a>
      </div>
    </div>
  </div>

  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Penjualan Barang Hari Ini</h4>
        <p class="card-description">
          <?=hari(date('Y-m-d'))?>, <?=date('d').' '.bulan(date('Y-m-d')).' '.date('Y')?>
        </p>
        <div class="table-responsive pt-3">
          <table class="table" id="mytable">
            <thead>
              <tr>
                  <th width="80px">No</th>
                  <th>Nama Barang</th>
                  <th>Kode Barang</th>
                  <th>Supplier</th>
                  <th>Alamat Supplier</th>
                  <th class="text-right">Jumlah Barang</th>
                  <th class="text-right">Total Penjualan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $start = 0; $jum = 0; $total = 0;
              if($data){
                foreach ($data as $row)
                {
                    $jum += $row->jml_brg;
                    $total += $row->penjualan;
                    ?>
                    <tr>
                <td><?php echo ++$start ?></td>
                <td><?php echo $row->barang ?></td>
                <td><?php echo $row->kode ?></td>
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
                        <td colspan="5"></td>
                        <td class="text-right"><strong><?=number_format($jum)?></strong></td>
                        <td class="text-right"><strong><?=number_format($total)?></strong></td>
                    </tr>
                </tfoot>
              <?php } else {
                echo '<td colspan="7" class="text-center" style="color:red">Belum ada penjualan hari ini.</td>';
              }
            
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>