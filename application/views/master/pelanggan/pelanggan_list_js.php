
<script>
  var base_url = "<?=base_url()?>";
    function format ( d ) {
        // `d` is the original data object for the row
        return d.act_detail;
    }

	$(document).ready(function() {
    
        var table = $('#mytable').DataTable({
            
            "columns": [
                { "data": "no" },
                { "data": "nama" },
                { "data": "alamat" },
                { "data": "telp" },
                { "data": "act" }
            ],
            "order":[],
            "processing": true,
            "serverSide": true,
            "ajax":{
                "url":base_url+"master/pelanggan/pelanggan_get",
                "type": "POST",
                // "data": function ( d ) {
                //     d.status   = $("#status").val()
                // }
            }
        });
        
        // $(document).on("change","#status",function(){
        //     table.clear();
        //     table.ajax.reload();
        //     table.draw();
        // })
        
        // Add event listener for opening and closing details
        $('#mytable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
    
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        });

	});
</script>