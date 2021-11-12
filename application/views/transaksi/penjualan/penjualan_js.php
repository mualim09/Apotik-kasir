
<script src="<?=base_url()?>assets/js/jquery.hotkeys.js"></script>
<script>
var inc_penjualan = 0;
var load_detail = <?= isset($penjualan_detail) ? $penjualan_detail : json_encode([]) ?>;

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
  var id_penjualan = $('#id_penjualan').val();
  
  if(load_detail !== ''){
    var form = '';var formServ = '';
    $.each(load_detail, function( key, value ) {

      tambah(value);
      sub_total(inc_penjualan);
    });

    $('.numeric').maskNumber({integer: true});
    grandtotal();
  }
});

$( "#pembayaran" ).on('shown.bs.modal', function(){
    bayar_change($('#bayar').val());
});

function tambah(value){
  
    inc_penjualan = inc_penjualan+1;

    var form = '<tr id="record_'+inc_penjualan+'"><td><a style="font-size:24px;color:red" href="JavaScript:void(0);" onClick="remove('+inc_penjualan+')"><i class="mdi mdi-table-row-remove"></i></a></td>'+
          '<td><input value="'+value.barang_id+'" type="hidden" name="barang[]" id="barang_'+inc_penjualan+'"/>'+
          '    <input value="'+value.barang+'" type="text" class="form-control" id="barang_search" id_alias="'+inc_penjualan+'" placeholder="Barang" />'+
          '</td>'+

          '<td>'+
          '<input value="'+value.jumlah+'" type="number" class="form-control text-right" name="jumlah[]" id="jumlah_'+inc_penjualan+'" onChange="sub_total('+inc_penjualan+')" placeholder="jumlah" />'+
          '<input type="hidden" name="stokakhir[]" id="stokakhir_'+inc_penjualan+'" />'+
          '</td>'+

          '<td><input value="'+value.satuan_id+'" type="hidden" value="" id="satuan_'+inc_penjualan+'" name="satuan[]"/>'+
          '     <input value="'+value.rasio+'" type="hidden" value="" id="rasio_'+inc_penjualan+'" name="rasio[]"/>'+
          '    <input value="'+value.satuan+'" type="text" class="form-control satuan_search" id="satuannama_'+inc_penjualan+'" id_alias="'+inc_penjualan+'" placeholder="Satuan" />'+
          '</td>'+

          '<td><input value="'+value.hrg_beli_log+'" type="hidden" name="hrg_beli[]" id="hrgbeli_'+inc_penjualan+'">'+
          '<input value="'+value.hrg_jual+'" type="text" class="form-control numeric text-right" name="hrg_jual[]" id="hrgjual_'+inc_penjualan+'" onChange="sub_total('+inc_penjualan+')" placeholder="Harga Jual" /></td>'+

          '<td><input value="'+value.diskon+'" type="number" class="form-control numeric text-right" name="diskon[]" id="diskon_'+inc_penjualan+'" onChange="sub_total('+inc_penjualan+')" placeholder="Diskon" /></td>'+
          
          '<td class="text-right"><h5 class=" text-right" id="subtotals_'+inc_penjualan+'"></h5><input type="hidden" id="subtotal_'+inc_penjualan+'" name="subtotal[]"></td>'+
          '<td></td>'+
          '<tr>';
            
    $('#item').append(form);
    $('.numeric').maskNumber({integer: true});

    setTimeout(() => {
      $('#record_'+inc_penjualan).find("#barang_search").focus();
    }, 10);
};

function remove(rec){
  $('#record_'+rec).remove();
  
  grandtotal();
}

function sub_total(id){
  var jumlah = parseInt($('#jumlah_'+id).val());
  var rasio  = $('#rasio_'+id).val();
  var stokakhir = parseInt($('#stokakhir_'+id).val());
  if(jumlah*rasio > stokakhir){

    window.alert('Stok tidak mencukupi, stok sisa :'+stokakhir);
    $('#jumlah_'+id).val('0').focus();
  }else{
      
    var disc    = $('#diskon_'+id).val();
    var hrgjual = $('#hrgjual_'+id).val().replace(/\,/g, '');

    hrgjual     = hrgjual-(hrgjual*disc/100);
    var sub     = (jumlah*rasio)*hrgjual;

    $('#subtotals_'+id).text(addCommas(sub));
    $('#subtotal_'+id).val(sub);

    grandtotal();
  }
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

function bayar_change(bayar){
  var bayar = bayar.replace(/\,/g, '');
  var kembalian = bayar - $('#grandtotal').val();
  $('#kembalian').val(addCommas(kembalian));
}

function replace_name(id,nama){
  window.setTimeout( function(){$('input[id_alias="'+id+'"]').val(nama);}, 100 );
}

var barang_autoc = {             //   call it
  source: "<?php echo base_url('transaksi/penjualan/get_barang/?');?>",
    select: function (event, ui) {
      if(ui.item.id != null && ui.item.id != ''){
        
        var id_alias = $(this).attr('id_alias');
        $('#barang_'+id_alias).val(ui.item.id);
        $('#hrgbeli_'+id_alias).val(ui.item.harga_beli);
        $('#hrgjual_'+id_alias).val(ui.item.harga_jual);
        $('#jumlah_'+id_alias).val(1);
        $('#diskon_'+id_alias).val(ui.item.diskon);
        $('#satuannama_'+id_alias).val(ui.item.satuan);
        $('#satuan_'+id_alias).val(ui.item.satuan_id);
        $('#rasio_'+id_alias).val(ui.item.rasio);
        $('#stokakhir_'+id_alias).val(ui.item.stok_akhir);
        sub_total(id_alias);
      }
    },
    open: function(event, ui) {
        $(".ui-autocomplete").css("z-index", 1001);
    },
    minLength: 0
};

$(document).on("focus","#barang_search",function(){
  $(this).autocomplete(
    barang_autoc)
    .focus(function(){
    $(this).autocomplete('search', $(this).val())
  })
});

$('#barang_search').autocomplete(
  barang_autoc)
  .focus(function(){
  $(this).autocomplete('search', $(this).val())
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

$("#pelanggan").autocomplete({             //   call it
  source: "<?php echo base_url('transaksi/penjualan/get_pelanggan/?');?>",
    select: function (event, ui) {
      if(ui.item.id != null && ui.item.id != ''){
        
        $('#pelanggan_id').val(ui.item.id);
      }
    },
    open: function(event, ui) {
        $(".ui-autocomplete").css("z-index", 1000);
    },
    minLength: 0
}).focus(function(){
        $(this).autocomplete('search', $(this).val())
});

//Pelanggan Form on Enter
$('#pelanggan').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    base.ProcessDialogKey(Keys.Tab);
    return false;  
  }
});   

//Keterangan Form on Enter
$('#keterangan').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    tambah();
    return false;  
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


$("form").submit(function(event){

  if($('#pelanggan_id').val() == ''){
    $('#pelanggan').focus();
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
  
  $('input[name^="hrg_jual"]').each(function() {
    var hrg_jual = $(this).val().replace(/\,/g, '');
    $(this).val(hrg_jual);
  });
  
  $('input[name^="hrg_beli"]').each(function() {
    var hrg_beli = $(this).val().replace(/\,/g, '');
    $(this).val(hrg_beli);
  });
  
});

function addpelanggan_submit(){
  $.ajax({
    url:"<?=base_url('master/pelanggan/create_action')?>",
    type:"POST",
    data:$('#modal_pelanggan').find('form').serializeArray(),
    success:function(data){
      var hasil = JSON.parse(data);
      if(hasil.status == '201'){
        $("#pelanggan_id").val(hasil.data.id);
        $("#pelanggan").val(hasil.data.nama);
        $("#pelanggan").focus();
      }
    }
  })
};

$("#add_pelanggan_btn").click(function(event){

  if(!$("#modal_pelanggan").length){    
    $.ajax({
      url:"<?=base_url('master/pelanggan/create_ajax')?>",
      type:"get",
      success:function(data){
        // var hasil = JSON.parse(data);
        // if(hasil.status == '200'){
        //   $("body").html(hasil.data.html);
          $("body").append(data);

        // }
      }
    })
  }else{
    $("#modal_pelanggan").find('form')[0].reset();
  }

  setTimeout(() => {
    $("#modal_pelanggan").modal('show');
  }, 300);

});

</script>