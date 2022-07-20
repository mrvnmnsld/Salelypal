<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>

<div class="h2 text-center">Pending Details</div>


<form id="mainForm">
	<div class="">
		<div class="ml-1 row">
			<div class="font-weight-bold"><b>Status: &nbsp;</b></div>	
			<div class="" id="statusContainer">Pending</div>	
		</div>

		<div class="ml-1 row">
			<div class="font-weight-bold"><b>To: &nbsp;</b></div>	
			<div class="" id="toContainer"></div>	
		</div>

		<div class="ml-1 row">
			<div class="font-weight-bold"><b>Amount: &nbsp;</b></div>	
			<div class="" id="amountContainer"></div>	
		</div>

		<div class="ml-1 row">
			<div class="font-weight-bold"><b>Token: &nbsp;</b></div>	
			<div class="" id="tokenNameContainer"></div>	
		</div>

		<div class="ml-1 row">
			<div class="font-weight-bold"><b>Timestamp: &nbsp;</b></div>
			<div class="" id="timestampContainer"></div>	
		</div>
	</div>

	<hr>

	<div class="d-flex flex-row float-right">
		<button type="button" class="btn btn-warning ml-2" id="cancelBtn">Cancel</button>
		<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
	</div>
</form>

<script type="text/javascript">
	
	$("#closeBtn").on('click',function(){
		bootbox.hideAll();
	});

	$("#cancelBtn").on('click',function(){
		$.confirm({
			theme:"dark",
			icon: 'fa fa-pencil',
		    title: 'Canceling',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to cancel this transaction?',
		    	buttons: {
		        confirm: function () {
		        	ajaxPostLink("userWallet/strictMode/declineWithdrawal",{
		        		'id':selectedData.id
		        	});
		        	
		        	loadDatatablePending()
					bootbox.hideAll();

		        },cancel: function () {
		        	// $("#top_back_btn").click();
		        },
		    }
		});
	});

	

	$("#toContainer").text(selectedData.to);
	$("#amountContainer").text(selectedData.amount);
	$("#tokenNameContainer").text(selectedData.token.toUpperCase());
	$("#timestampContainer").text(selectedData.timestamp);


</script>