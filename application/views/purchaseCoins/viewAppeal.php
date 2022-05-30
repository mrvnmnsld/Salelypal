<style type="text/css">
	.modal-footer{
		display: none;
	}
	.is-invalid{
		text-align: center;
	}
	#pagetitle_background{
		background: #293038;
		color: white;
	}
	#mainQuestionModal{
		background: rgba(0, 0, 0, .1);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="text-center">
		<label class="h2 mt-2">Appeal Details</label>
</div>

<div id="mainQuestionModal">

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Email:</b></div>	
		<div class="col-md" id="email_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Name:</b></div>	
		<div class="col-md" id="fullname_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Token:</b></div>	
		<div class="col-md" id="token_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Value:</b></div>	
		<div class="col-md" id="value_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Amount:</b></div>	
		<div class="col-md" id="amount_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Paid(USD):</b></div>	
		<div class="col-md" id="paid_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Date Purchased:</b></div>	
		<div class="col-md" id="date_purchased_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Date Purchased:</b></div>	
		<div class="col-md" id="date_submitted_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Status:</b></div>	
		<div class="col-md" id="status_container"></div>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Message:</b></div>	
		<textarea class="col-md" id="msg_container" style="width:80%" rows="3" disabled></textarea>	
	</div>

	<div class="row m-1">
		<div class="col-md-3 pl-3"><b>Reply:</b></div>	
		<textarea class="col-md" id="reply_container" style="width:80%" rows="3"></textarea>	
	</div>

	<hr>

	<div class="d-flex flex-row-reverse">
		<button class="btn btn-danger ml-2" id="closeBtn">Close</button>
		<button class="btn btn-success " id="flag_btn">Send Reply & flag as Resolve</button>
	</div>

</div>

<script type="text/javascript">
	$("#email_container").append(selectedData["email"]);
	$("#fullname_container").append(selectedData["fullname"]);
	$("#token_container").append(selectedData["token"]);
	$("#value_container").append(selectedData["tokenValue"]);
	$("#amount_container").append(selectedData["amountBought"]);
	$("#paid_container").append(selectedData["amountPaid"]);
	$("#date_purchased_container").append(selectedData["dateCreated"]);
	$("#date_submitted_container").append(selectedData["date"]);
	$("#msg_container").val(selectedData["msg"]);
	$("#reply_container").val(selectedData["adminResponse"]);

	console.log(selectedData);

	$("#status_container").append(selectedData["status"]);

	if (selectedData["status"] == 0) {
		$('#status_container').addClass('text-danger font-weight-bold');
		$('#status_container').text('Viewed');
	}else{
		$('#status_container').text('Responded');
		$("#reply_container").css
	}

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#flag_btn").on('click', function(){
		$.confirm({
			icon: 'bi bi-reply-all',
		    title: 'Responding?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>reply</b> to this appeal and <b>flag it as resolved</b>?',
		    buttons: {
		        confirm: function () {
		        	var res = ajaxShortLink('userWallet/purchaseCoins/flagAppeal',{'appealID':selectedData['id'],'adminResponse':$("#reply_container").val()});
		        	bootbox.hideAll();

		        	if (res) {
			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successfully Responded to the Appeal!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })

		        		loadDatatable('userWallet/getAllAppeals');
		        	}else{
		        		
		        	}

		        	
		        },
		        cancel: function () {

		        },
		    }
		});
	});

</script>
<script type="text/javascript">
	console.log(selectedData)
</script>