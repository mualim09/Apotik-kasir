
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            
            <h4 class="card-title">
                <?php echo anchor('dokter/create/','Create',array('class'=>'btn btn-primary btn-sm'));?>
            </h4><div class="table-responsive">
        <table class="table table-hover" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
		    <th>Nama</th>
		    <th>Alamat</th>
		    <th>Telp</th>
		    <th>Spesialis</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($dokter_data as $dokter)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $dokter->nama ?></td>
		    <td><?php echo $dokter->alamat ?></td>
		    <td><?php echo $dokter->telp ?></td>
		    <td><?php echo $dokter->spesialis ?></td>
		    <td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('dokter/update/'.$dokter->id_dokter),'<i class="mdi mdi-tooltip-edit"></i>',array('title'=>'edit','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('dokter/delete/'.$dokter->id_dokter),'<i class="mdi mdi-delete"></i>','title="delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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