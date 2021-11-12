<script>

$(document).on("focus",'#satuan_search',function(e) {
    if ( !$(this).data("autocomplete") ) { // If the autocomplete wasn't called yet:
        $(this).autocomplete({             //   call it
          source: "<?php echo base_url('master/barang/get_satuan/?');?>",
            select: function (event, ui) {
              if(ui.item.id != null && ui.item.id != ''){
                
                $('#satuan_id').val(ui.item.id);
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

$('#harga_beli').maskNumber({integer: true});
$('#harga_jual').maskNumber({integer: true});
$('#diskon').maskNumber({integer: true});

$("form").submit(function(){
  
    var harga_beli = $('#harga_beli').val().replace(/\,/g, '');
    if (harga_beli == null){
      harga_beli = 0;
    }
    $('#harga_beli').val(harga_beli);
    
    var harga_jual = $('#harga_jual').val().replace(/\,/g, '');
    if (harga_jual == null){
      harga_jual = 0;
    }
    $('#harga_jual').val(harga_jual);
});

</script>