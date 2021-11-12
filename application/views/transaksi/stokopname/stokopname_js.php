<script>
var inc_detail = 0;
var load_detail = <?= isset($stokopname_detail) ? $stokopname_detail : json_encode([]) ?>;

$(document).ready(function(){
  var id = $('#id').val();
  
  if(id == '' && id == 'undefined'){
    console.log('kosong');
    inc_detail = inc_detail+1;
    var rec = inc_detail;

    var form = '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input autofocus type="hidden" name="barang[]" id="barang_'+inc_detail+'"/>'+
          '    <input type="text" class="form-control" id="barang_search" id_alias="'+inc_detail+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input readonly type="number" class="form-control numeric text-right" name="stok_sistem[]" id="stok_sistem_'+inc_detail+'" placeholder="Stok Sistem" /></td>'+
          '<td><input onChange="hitung_selisih('+inc_detail+')" type="number" class="form-control numeric text-right" name="stok_fisik[]" id="stok_fisik_'+inc_detail+'" placeholder="Stok Fisik" /></td>'+
          '<td><input readonly type="number" class="form-control numeric text-right" name="selisih[]" id="selisih_'+inc_detail+'" placeholder="Selisih" /></td>'+
          '<td></td>'+
          '<tr>';
          
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});

    /**------------------------------------ */
    
  }else{
    console.log('ada '+id);

    if(load_detail !== ''){
      var form = '';var formServ = '';
			$.each(load_detail, function( key, value ) {

        inc_detail = inc_detail+1;
        var rec = inc_detail;

        form = 
                '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" value="'+value.barang_id+'" id="barang_'+inc_detail+'"/>'+
          '    <input autofocus type="text" class="form-control" id="barang_search" value="'+value.barang+'" id_alias="'+inc_detail+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input readonly value="'+value.stok_sistem+'" type="number" class="form-control numeric text-right" name="stok_sistem[]" id="stok_sistem_'+inc_detail+'" placeholder="Stok Sistem" /></td>'+
          '<td><input onChange="hitung_selisih('+inc_detail+')" value="'+value.stok_fisik+'" type="number" class="form-control numeric text-right" name="stok_fisik[]" id="stok_fisik_'+inc_detail+'" placeholder="Stok Fisik" /></td>'+
          '<td><input readonly value="'+value.selisih+'" type="number" class="form-control numeric text-right" name="selisih[]" id="selisih_'+inc_detail+'" placeholder="Selisih" /></td>'+
          '<td></td>'+
          '<tr>';
                
        if(form !== ''){$('#item').append(form);}
        
			});
      $('.numeric').maskNumber({integer: true});


    }
  }

});


function tambah(){
  
    inc_detail = inc_detail+1;
    var rec = inc_detail;

    var form = '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" id="barang_'+inc_detail+'"/>'+
          '    <input autofocus type="text" class="form-control" id="barang_search" id_alias="'+inc_detail+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input readonly type="number" class="form-control numeric text-right" name="stok_sistem[]" id="stok_sistem_'+inc_detail+'" placeholder="Stok Sistem" /></td>'+
          '<td><input onChange="hitung_selisih('+inc_detail+')" type="number" class="form-control numeric text-right" name="stok_fisik[]" id="stok_fisik_'+inc_detail+'" placeholder="Stok Fisik" /></td>'+
          '<td><input readonly type="number" class="form-control numeric text-right" name="selisih[]" id="selisih_'+inc_detail+'" placeholder="Selisih" /></td>'+
          '<td></td>'+
          '<tr>';
            
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});
};

function hitung_selisih($id){
  var selisih = parseInt($('#stok_sistem_'+$id).val()) - parseInt($('#stok_fisik_'+$id).val());
  $('#selisih_'+$id).val(selisih);
}

function remove(rec){
  $('#record_'+rec).remove();
}

function replace_name(id,nama){
  window.setTimeout( function(){$('input[id_alias="'+id+'"]').val(nama);}, 100 );
}

$('#penyimpanan').change(function(){
  $('#item').empty();
});

$(document).on("focus",'#barang_search',function(e) {
    console.log('penyimpanan '+$('#penyimpanan option:selected').val());
    if ( !$(this).data("autocomplete") ) { // If the autocomplete wasn't called yet:
        $(this).autocomplete({             //   call it
          source: function(request, response) {
            $.getJSON(
                "<?php echo base_url('transaksi/stokopname/get_barang/?');?>",
                { term:request.term, penyimpanan:$('#penyimpanan option:selected').val() }, 
                response
            );
        },
        minLength: 2,
          select: function (event, ui) {
            if(ui.item.id != null && ui.item.id != ''){
              console.log('hasil '+ui.item.id+'| id alias '+$(this).attr('id_alias')+'|'+ui.item.stok_akhir);
              
              var id_alias = $(this).attr('id_alias');
              $('#barang_'+id_alias).val(ui.item.id);
              $('#stok_sistem_'+id_alias).val(ui.item.stok_akhir);

            }
          },
          open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
          }
        });
    }
});

$("form").submit(function(){
  
  if($('#peyimpanan').val() == ''){
    $('#peyimpanan').focus();
    event.preventDefault();
  }
    
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