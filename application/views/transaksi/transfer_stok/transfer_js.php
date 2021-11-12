<script>
var inc_transfer = 0;
var load_detail = <?= isset($transfer_detail) ? $transfer_detail : json_encode([]) ?>;

$(document).ready(function(){
  var id_transfer = $('#id_transfer').val();
  
  if(id_transfer == '' && id_transfer == 'undefined'){
    console.log('kosong');
    inc_transfer = inc_transfer+1;
    var rec = inc_transfer;

    var form = '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" id="barang_'+inc_transfer+'"/>'+
          '    <input type="text" class="form-control" id="barang_search" id_alias="'+inc_transfer+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input type="number" class="form-control numeric text-right" name="jumlah[]" id="jumlah_'+inc_transfer+'" placeholder="jumlah" /></td>'+
          '<tr>';
          
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});

    /**------------------------------------ */
    
  }else{
    console.log('ada '+id_transfer);

    if(load_detail !== ''){
      var form = '';var formServ = '';
			$.each(load_detail, function( key, value ) {

        inc_transfer = inc_transfer+1;
        var rec = inc_transfer;

        form = 
                '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" value="'+value.barang_id+'" id="barang_'+inc_transfer+'"/>'+
          '    <input type="text" class="form-control" id="barang_search" value="'+value.barang+'" id_alias="'+inc_transfer+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input type="number" class="form-control text-right" name="jumlah[]" value="'+value.jumlah+'" id="jumlah_'+inc_transfer+'" placeholder="jumlah" /></td>'+
          '<td></td>'+
          '<tr>';
                
        if(form !== ''){$('#item').append(form);}
        
			});
      $('.numeric').maskNumber({integer: true});


    }
  }

});


function tambah(){
  
    inc_transfer = inc_transfer+1;
    var rec = inc_transfer;

    var form = '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" id="barang_'+inc_transfer+'"/>'+
          '    <input type="text" class="form-control" id="barang_search" id_alias="'+inc_transfer+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input type="number" class="form-control text-right" name="jumlah[]" id="jumlah_'+inc_transfer+'" placeholder="jumlah" /></td>'+
          '<td></td>'+
          '<tr>';
            
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});
};

function remove(rec){
  $('#record_'+rec).remove();
  
}

function replace_name(id,nama){
  window.setTimeout( function(){$('input[id_alias="'+id+'"]').val(nama);}, 100 );
}

$(document).on("focus",'#barang_search',function(e) {
    if ( !$(this).data("autocomplete") ) { // If the autocomplete wasn't called yet:
        $(this).autocomplete({             //   call it
          source: "<?php echo base_url('transaksi/transfer_stok/get_barang/?');?>",
            select: function (event, ui) {
              if(ui.item.id != null && ui.item.id != ''){
                console.log('hasil '+ui.item.id+'| id alias '+$(this).attr('id_alias'));
                
                var id_alias = $(this).attr('id_alias');
                $('#barang_'+id_alias).val(ui.item.id);
                $('#jumlah_'+id_alias).val(1);

              }
            },
            open: function(event, ui) {
                      $(".ui-autocomplete").css("z-index", 1000);
                  }
        });
    }
});

function check_penyimpanan(event){
  if( $('#penyimpanan_dari').val() ===  $('#penyimpanan_ke').val() ){
    $('#penyimpanan_ke').focus();
    event.preventDefault();
  }
}

$("form").submit(function(){
  
  check_penyimpanan(event);
    
});

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

</script>