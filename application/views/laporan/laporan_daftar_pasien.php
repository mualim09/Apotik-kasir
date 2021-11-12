
 <style type="text/css">
     .cus-i1{
      padding: 10px;
      border:1px solid #ccc;
      color:#ccc;
      border-radius: 50px;
     }
     .cus-i2{
      padding: 10px 11px !important;
      border:1px solid #ccc !important;
      color:#ccc !important;
      border-radius: 50px !important;
     }
     .cus-i1:hover{
      border:1px solid #1c9d41;
      color:#1c9d41;
     }
     .cus-i2:hover{
      border:1px solid #d5302a !important;
      color:#d5302a !important;
     }
   </style>
<div id="page-wrapper" >
  <div id="page-inner"> 
      <div class="row">
        <div class="col-md-7">
         <h2>Laporan daftar pasien</h2>   
        </div>
        <form action="<?php echo base_url('hal/laporan_daftar_pasien/cari') ?>" method="post">  
            <div class="col-md-4"> 
              <div class="form-group"> 
                <label> Pilih poliklinik</label>
                <select class="form-control" name="pilih_bulan">  
                  <option name=""> Pilih Bulan</option>
                    <option value="01"> Januari</option>
                    <option value="02"> Februari</option>
                    <option value="03"> Maret</option>
                    <option value="04"> April</option>
                    <option value="05"> Mei</option>
                    <option value="06"> Juni</option>
                    <option value="07"> Juli</option>
                    <option value="08"> Agustus</option>
                    <option value="09"> September</option>
                    <option value="10"> Oktober</option>
                    <option value="11"> November</option>
                    <option value="12"> Desember</option>
                </select>
              </div>
            </div>
            <div class="col-md-1"> 
              <button class="btn btn-primary btn-block" style="margin-top: 24px;">  Cari</button>
            </div>
          </div>     
        </form>         
      <hr />
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary" id="panel_senin">
              <div class="panel-heading" style="text-align: center;">
               <b><?php if(empty($this->input->post('pilih_bulan'))){ echo bulan(date('m')); }else{ echo bulan($this->input->post('pilih_bulan')); } ?></b>
              </div>        
              <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th width="50px">No.</th>
                        <th>Poliklinik</th>
                        <th>Total kunjungan</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                  $no=0;
                  foreach($get_poliklinik as $get){ 
                    $no++;
                    if($this->uri->segment(3) == 'cari'){
                      $sum_total_kunjungan = $this->m_data->where('pendaftaran',array('poliklinik_id'=>$get->id_poliklinik,'month(tgl_daftar)'=>$this->input->post('pilih_bulan')))->num_rows();  
                    }else{
                      $sum_total_kunjungan = $this->m_data->where('pendaftaran',array('poliklinik_id'=>$get->id_poliklinik))->num_rows();  
                    }
                ?>
                 <tr>
                   <td style="text-align: center;"><?php echo $no ?></td>
                   <td><?php echo $get->nama_poliklinik ?></td>
                   <td><?php echo $sum_total_kunjungan ?></td>
                 </tr>
                 <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>

        </div>  
      </div>
  </div>

</div>
</div>
</div>
</div>
 

