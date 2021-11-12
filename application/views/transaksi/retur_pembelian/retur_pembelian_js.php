<script>
var inc_pembelian = 0;
var load_detail = <?= isset($retur_detail) ? $retur_detail : json_encode([]) ?>;

$(document).ready(function(){
  var id_retur = $('#id_retur_pembelian').val();
  
  if(id_retur == '' && id_retur == 'undefined'){
    console.log('kosong');
    inc_pembelian = inc_pembelian+1;
    var rec = inc_pembelian;

    var form = '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" id="barang_'+inc_pembelian+'"/>'+
          '    <input type="text" class="form-control" id="barang_search" id_alias="'+inc_pembelian+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input type="number" class="form-control text-right" name="jumlah[]" id="jumlah_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="jumlah" /></td>'+
          '<td><input type="hidden" value="" id="satuan_'+inc_pembelian+'" name="satuan[]"/>'+
          '    <input type="text" class="form-control" name="satuan_search[]" id="satuannama_'+inc_pembelian+'" placeholder="Satuan" />'+
          '</td>'+
          '<td><input  type="text" class="form-control numeric text-right" name="hrg_beli[]" id="hrgbeli_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Harga Beli" /></td>'+
          '<td><input  type="number" class="form-control numeric text-right" name="diskon[]" id="diskon_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Diskon" /></td>'+
          '<td><h5 class=" text-right" id="subtotals_'+inc_pembelian+'"></h5><input type="hidden" id="subtotal_'+inc_pembelian+'" name="subtotal[]"></td>'+
          '<td></td>'+
          '<tr>';
          
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});

    /**------------------------------------ */
    
  }else{
    console.log('ada '+id_retur);

    if(load_detail !== ''){
      var form = '';var formServ = '';
			$.each(load_detail, function( key, value ) {

        inc_pembelian = inc_pembelian+1;
        var rec = inc_pembelian;

        form = 
                '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" value="'+value.barang_id+'" id="barang_'+inc_pembelian+'"/>'+
          '    <input type="text" class="form-control" id="barang_search" value="'+value.barang+'" id_alias="'+inc_pembelian+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input type="number" class="form-control numeric text-right" name="jumlah[]" value="'+value.jumlah+'" id="jumlah_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="jumlah" /></td>'+
          '<td><input type="hidden" id="satuan_'+inc_pembelian+'" value="'+value.satuan_id+'" name="satuan[]"/>'+
          '    <input type="text" class="form-control" name="satuan_search[]" id="satuannama_'+inc_pembelian+'" value="'+value.satuan+'" placeholder="Satuan" />'+
          '</td>'+
          '<td><input type="text" class="form-control numeric text-right" name="hrg_beli[]" value="'+value.hrg_beli+'" id="hrgbeli_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Harga Beli" /></td>'+
          '<td><input type="number" class="form-control numeric text-right" name="diskon[]" value="'+value.diskon+'" id="diskon_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Diskon" /></td>'+
          '<td><h5 class=" text-right" id="subtotals_'+inc_pembelian+'"></h5><input type="hidden" id="subtotal_'+inc_pembelian+'" name="subtotal[]"></td>'+
          '<td></td>'+
          '<tr>';
                
        if(form !== ''){$('#item').append(form);}
        
      sub_total(inc_pembelian);
			});
      $('.numeric').maskNumber({integer: true});


    }
  }
  
  grandtotal();

});


function tambah(){
  
    inc_pembelian = inc_pembelian+1;
    var rec = inc_pembelian;

    var form = '<tr id="record_'+rec+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+rec+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input type="hidden" name="barang[]" id="barang_'+inc_pembelian+'"/>'+
          '    <input type="text" class="form-control" id="barang_search" id_alias="'+inc_pembelian+'" placeholder="Barang" />'+
          '</td>'+
          '<td><input type="number" class="form-control numeric text-right" name="jumlah[]" id="jumlah_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="jumlah" /></td>'+
          '<td><input type="hidden" value="" id="satuan_'+inc_pembelian+'" name="satuan[]"/>'+
          '    <input type="text" class="form-control" name="satuan_search[]" id="satuannama_'+inc_pembelian+'" placeholder="Satuan" />'+
          '</td>'+
          '<td><input type="text" class="form-control numeric text-right" name="hrg_beli[]" id="hrgbeli_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Harga Beli" /></td>'+
          '<td><input type="number" class="form-control numeric text-right" name="diskon[]" id="diskon_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Diskon" /></td>'+
          '<td><h5 class=" text-right" id="subtotals_'+inc_pembelian+'"></h5><input type="hidden" id="subtotal_'+inc_pembelian+'" name="subtotal[]"></td>'+
          '<td></td>'+
          '<tr>';
            
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});
};

function remove(rec){
  $('#record_'+rec).remove();
  
  grandtotal();
}

function sub_total(id){
  var disc    = $('#diskon_'+id).val();
  var hrgbeli = $('#hrgbeli_'+id).val().replace(/\,/g, '');

  hrgbeli     = hrgbeli-(hrgbeli*disc/100);
  var sub     = $('#jumlah_'+id).val()*hrgbeli;

  $('#subtotals_'+id).text(addCommas(sub));
  $('#subtotal_'+id).val(sub);

  grandtotal();
}

function grandtotal(){
  var total = 0;

  $('input[name^="subtotal"]').each(function() {
    var subtotal = parseFloat($(this).val());
    total = total + (isNaN(subtotal) ? 0 : subtotal);
  });


  $('#total_s').text(addCommas(total));
  $('#total').val(total);
}

function bayar_change(bayar){
  var bayar = bayar.replace(/\,/g, '');
  var kembalian = bayar - $('#grandtotal').val();
  $('#kembalian').val(addCommas(kembalian));
}

function replace_name(id,nama){
  window.setTimeout( function(){$('input[id_alias="'+id+'"]').val(nama);}, 100 );
}

$(document).on("focus",'#barang_search',function(e) {
    if ( !$(this).data("autocomplete") ) { // If the autocomplete wasn't called yet:
        $(this).autocomplete({             //   call it
          source: "<?php echo base_url('transaksi/pembelian/get_barang/?');?>",
            select: function (event, ui) {
              if(ui.item.id != null && ui.item.id != ''){
                console.log('hasil '+ui.item.id+'| id alias '+$(this).attr('id_alias'));
                
                var id_alias = $(this).attr('id_alias');
                $('#barang_'+id_alias).val(ui.item.id);
                $('#hrgbeli_'+id_alias).val(ui.item.harga_beli);
                $('#jumlah_'+id_alias).val(1);
                $('#diskon_'+id_alias).val(ui.item.diskon);
                $('#satuannama_'+id_alias).val(ui.item.satuan);
                $('#satuan_'+id_alias).val(ui.item.satuan_id);

                sub_total(id_alias);
              }
            },
            open: function(event, ui) {
                      $(".ui-autocomplete").css("z-index", 1000);
                  }
        });
    }
});

$(document).on("focus",'#supplier',function(e) {
    if ( !$(this).data("autocomplete") ) { // If the autocomplete wasn't called yet:
        $(this).autocomplete({             //   call it
          source: "<?php echo base_url('transaksi/pembelian/get_supplier/?');?>",
            select: function (event, ui) {
              if(ui.item.id != null && ui.item.id != ''){
                
                $('#supplier_id').val(ui.item.id);
              }
            },
            open: function(event, ui) {
                      $(".ui-autocomplete").css("z-index", 1000);
                  }
        });
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


$("form").submit(function(){
  
  if($('#supplier_id').val() == ''){
    $('#supplier').focus();
    event.preventDefault();
  }
  
  var total = 0;
  $('input[name^="subtotal"]').each(function() {
    var subtotal = parseFloat($(this).val());
    total = total + (isNaN(subtotal) ? 0 : subtotal);
  });
  if(total === 0){
    event.preventDefault();
  }
  
  var kembalian = $('#kembalian').val().replace(/\,/g, '');
  if (kembalian == null){kembalian = 0}
  $('#kembalian').val(kembalian);
  
  var bayar = $('#bayar').val().replace(/\,/g, '');
  if (bayar == null){bayar = 0}
  $('#bayar').val(bayar);
  
  $('input[name^="hrg_beli"]').each(function() {
    var hrg_beli = $(this).val().replace(/\,/g, '');
    $(this).val(hrg_beli);
  });
  
});

</script>