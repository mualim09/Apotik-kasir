
<!-- The Modal -->
<div class="modal" id="modal_pelanggan">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pelanggan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?=base_url('master/pelanggan/create_action')?>" type="post">
        <input type="hidden" name="ajax" value="1">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group"><label>Nama</label>
                        <input required type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                    </div>
                    <div class="form-group"><label>No Telp</label>
                        <input required type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label>Alamat</label>
                        <textarea required style="height:150px" class="form-control" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?> </textarea>
                    </div>
                </div>
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addpelanggan_submit()" >Create</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>