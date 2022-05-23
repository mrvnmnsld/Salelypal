<div id="innerContainer" style="display:none" class="card">
	<div>TOLITSSSSSS</div>
</div>

<script>
	// var selectedData = [];

	// var res = ajaxShortLink("testing123",{
	// 	'test':123
	// });

	// console.log(res);

	$(document).ready(function() {
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

</script>