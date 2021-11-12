

<script src="<?=base_url()?>assets/js/jquery.hotkeys.js"></script>
<script>
var inc_pembelian = 0;
var load_detail = <?= isset($pembelian_detail) ? $pembelian_detail : json_encode([]) ?>;

$(document).bind('keydown', 'f2', function assets() {
  tambahItem();
});

$(document).on('click', '.tambah', function assets() {
  tambahItem();
});

function tambahItem(){

  var data = {
      isppn    : '0',
      barang    : '',
      barang_id : 'none',
      jumlah    : '1',
      kode      : '',
      no_batch  : '',
      kadaluarsa: '',
      jumlah    : 0,
      satuan_id : 'none',
      satuan    : '',
      hrg_beli  : 0,
      hrg_jual  : 0,
      diskon    : 0,
      diskon_jual    : 0,
    }
    tambah(data);
    return false;
}

$(document).ready(function(){
  var id_pembelian = $('#id_pembelian').val();
  
  if(load_detail !== ''){
    var form = '';var formServ = '';
    $.each(load_detail, function( key, value ) {
      
      if(value.no_batch == null)
        value.no_batch = '';
      if(value.kadaluarsa == null)
        value.kadaluarsa = '';
      
      tambah(value);
    });
  }
  grandtotal();

});

$( "#pembayaran" ).on('shown.bs.modal', function(){
    bayar_change($('#bayar').val());
});

function tambah(value){
  
    inc_pembelian = inc_pembelian+1;
    var isppn = value.isppn == "1" ? "checked" : "";

    var form = '<tr id="record_'+inc_pembelian+'">'+
          '<td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+inc_pembelian+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+

          '<td><input type="hidden" name="isppn[]" id="isppn_'+inc_pembelian+'"/>'+
            '<div class="form-check form-check-flat form-check-primary">'+
              '<label class="form-check-label">'+
                '<input '+isppn+' onclick="barangppn(this,'+inc_pembelian+')" type="checkbox" class="form-check-input">'+
              '<i class="input-helper"></i><i class="input-helper"></i></label>'+
            '</div>'+
          '</td>'+

          '<td><input value="'+value.barang_id+'" type="hidden" name="barang[]" id="barang_'+inc_pembelian+'"/>'+
          '    <input value="'+value.barang+'" type="text" class="form-control" id="barang_search" id_alias="'+inc_pembelian+'" placeholder="Barang" />'+
          '</td>'+

          '<td><input value="'+value.no_batch+'" type="text" class="form-control" name="nobatch[]" id="nobatch_'+inc_pembelian+'" placeholder="No. Batch" /></td>'+

          '<td><input value="'+value.kadaluarsa+'" type="text" class="form-control tanggal" name="kadaluarsa[]" id="kadaluarsa_'+inc_pembelian+'" placeholder="Kadaluarsa" /></td>'+

          '<td><input value="'+value.jumlah+'" type="number" class="form-control text-right" name="jumlah[]" id="jumlah_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="jumlah" /></td>'+

          '<td><input value="'+value.satuan_id+'" type="hidden" value="" id="satuan_'+inc_pembelian+'" name="satuan[]"/>'+
          '     <input value="'+value.rasio+'" type="hidden" value="" id="rasio_'+inc_pembelian+'" name="rasio[]"/>'+
          '    <input value="'+value.satuan+'" type="text" class="form-control satuan_search" id="satuannama_'+inc_pembelian+'" id_alias="'+inc_pembelian+'" placeholder="Satuan" />'+
          '</td>'+

          '<td><input value="'+addCommas(value.hrg_beli)+'" type="text" class="form-control numeric text-right" name="hrg_beli[]" id="hrgbeli_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Harga Beli" /></td>'+

          '<td><input value="'+value.diskon+'" type="number" class="form-control numeric text-right" name="diskon[]" id="diskon_'+inc_pembelian+'" onChange="sub_total('+inc_pembelian+')" placeholder="Diskon" /></td>'+          

          '<td><input value="'+addCommas(value.hrg_jual)+'" type="text" class="form-control numeric text-right" name="hrg_jual[]" id="hrgjual_'+inc_pembelian+'" placeholder="Harga Jual" /></td>'+

          '<td><input value="'+value.diskon_jual+'" type="number" class="form-control numeric text-right" name="diskon_jual[]" id="diskonjual_'+inc_pembelian+'" placeholder="Set diskon penjualan" /></td>'+

          '<td><h5 class=" text-right" id="subtotals_'+inc_pembelian+'"></h5><input type="hidden" id="subtotal_'+inc_pembelian+'" name="subtotal[]"></td>'+
          '<td></td>'+
          '<tr>';
            
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});
    $('.tanggal').datepicker({
        format: "dd-mm-yyyy",
        autoclose:true
    });
    // setTimeout(() => {
      $('input[id_alias="'+inc_pembelian+'"][id="barang_search"]').focus();
      sub_total(inc_pembelian);
    // }, 10);

};

function remove(rec){
  $('#record_'+rec).remove();
  
  grandtotal();
}

function sub_total(id){
  var disc    = $('#diskon_'+id).val();
  var hrgbeli = $('#hrgbeli_'+id).val().replace(/\,/g, '');

  hrgbeli     = hrgbeli-(hrgbeli*disc/100);
  jumlah     = $('#jumlah_'+id).val();
  rasio     = $('#rasio_'+id).val();
  var sub     = (jumlah*hrgbeli)*rasio;
  console.log('sub : '+sub);

  $('#subtotals_'+id).text(addCommas(sub));
  $('#subtotal_'+id).val(sub);

  grandtotal();
}

function grandtotal(){
  var total = 0;var grandtotal = 0;

  var checkBox    = document.getElementById("checkppn");
  var ppn_persen  = checkBox.checked == true ? 10 : 0;
  var ppn         = 0;

  $('input[name^="subtotal"]').each(function() {
    var subtotal = parseFloat($(this).val());
    total = total + (isNaN(subtotal) ? 0 : subtotal);
  });

  ppn         = ppn_persen*total/100;
  grandtotal  = Math.round(total + ppn);

  $('#total_s').text(addCommas(total));
  $('#ppn_nominal').text(addCommas(ppn));
  $('#ppn_s').text(ppn_persen+'%');
  $('#grand_s').text(addCommas(grandtotal));  
  $('#grandtotal_alias').val(addCommas(grandtotal));  

  $('#total').val(total);
  $('#ppn').val(ppn);
  $('#grandtotal').val(grandtotal);  

}

function fcheckppn(){
  grandtotal();
}

function barangppn(obj, id){
  var value  = obj.checked == true ? 1 : 0;
  $('#isppn_'+id).val(value);
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
                if(ui.item.id == 'none'){
                  setTimeout(() => {
                    $(this).focus();
                  }, 10);
                }else{
                    
                  $('#barang_'+id_alias).val(ui.item.id);
                  $('#hrgbeli_'+id_alias).val(ui.item.harga_beli);
                  $('#jumlah_'+id_alias).val(1);
                  $('#diskon_'+id_alias).val(ui.item.diskon);
                  $('#satuannama_'+id_alias).val(ui.item.satuan);
                  $('#satuan_'+id_alias).val(ui.item.satuan_id);
                  $('#rasio_'+id_alias).val(ui.item.rasio);
                  $('#hrgjual_'+id_alias).val(ui.item.hrg_jual);
                  $('#diskonjual_'+id_alias).val(ui.item.diskon_jual);
                  console.log(ui.item);

                }
                sub_total(id_alias);
              }
            },
            open: function(event, ui) {
                      $(".ui-autocomplete").css("z-index", 1000);
                  }
        });
    }
});

$(document).on("focus",'.satuan_search',function(e) {
    if ( !$(this).data("autocomplete") ) { // If the autocomplete wasn't called yet:
        var id_alias = $(this).attr('id_alias');
        var barang = $('#barang_'+id_alias).val();
        var source = "<?php echo base_url('transaksi/pembelian/get_satuan/?');?>"+"barang_id="+barang+"&";
        $(this).autocomplete({             //   call it
          source: source,
            select: function (event, ui) {
              if(ui.item.id != null && ui.item.id != ''){
                
                $('#satuan_'+id_alias).val(ui.item.id);
                $('#rasio_'+id_alias).val(ui.item.rasio);

                sub_total(id_alias);
              }
            },
            open: function(event, ui) {
                      $(".ui-autocomplete").css("z-index", 2000);
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

    event.preventDefault();
    $('#supplier').focus();

  }else{

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

    $('input[name^="hrg_jual"]').each(function() {
      var hrg_jual = $(this).val().replace(/\,/g, '');
      $(this).val(hrg_jual);
    });
    
  }
  
});

</script>