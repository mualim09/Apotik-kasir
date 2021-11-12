
<script src="<?=base_url()?>assets/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('.periode').datepicker({
			format: "mm-yyyy",
			viewMode: "months", 
			minViewMode: "months",
			autoclose:true
		});
	});

</script>