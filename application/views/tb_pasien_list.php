
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            
            <h4 class="card-title">
                <?php echo anchor('pasien/create/','Create',array('class'=>'btn btn-primary btn-sm'));?>
            </h4><div class="table-responsive">
        <table class="table table-hover" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama</th>
		    <th>Alamat</th>
		    <th>Telp</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($pasien_data as $pasien)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $pasien->nama ?></td>
		    <td><?php echo $pasien->alamat ?></td>
		    <td><?php echo $pasien->telp ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('pasien/update/'.$pasien->id_pasien),'<i class="mdi mdi-tooltip-edit"></i>',array('title'=>'edit','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('pasien/delete/'.$pasien->id_pasien),'<i class="mdi mdi-delete"></i>','title="delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
			?>
		    </td>
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