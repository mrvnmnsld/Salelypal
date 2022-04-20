<style type="text/css">
	.modal-footer{
		display: none;
	}
</style>

<div class="pagetitle">
  <h1>Appeal Details</h1>
</div>

<hr>

<div id="mainQuestionModal">
	<div class="row m-1">
		<div class="col-md-12"><b>Email: </b>
			<span id="email_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Name: </b>
			<span id="fullname_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Token: </b>
			<span id="token_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Value: </b>
			<span id="value_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Amount: </b>
			<span id="amount_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Token: </b>
			<span id="token_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Paid(USD):: </b>
			<span id="paid_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Date Purchased: </b>
			<span id="date_purchased_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Date Submitted: </b>
			<span id="date_submitted_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Status: </b>
			<span id="status_container"></span>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Message: </b>
			<div id="msg_container" style="word-wrap: break-word;"></div>	
		</div>	
	</div>

	<div class="row m-1">
		<div class="col-md-12"><b>Reply: </b>
			<div id="reply_container" style="word-wrap: break-word;">No reply yet</div>	
		</div>	
	</div>

	<hr>

	<button class="col-md-12 btn btn-danger btn-block" id="closeBtn">Close</button>

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
	$("#msg_container").text(selectedData["msg"]);

	// console.log(selectedData);

	$("#status_container").append(selectedData["status"]);

	if (selectedData["status"] == 0) {
		$('#status_container').text('Submitted');
		$("#reply_container").addClass('text-danger font-weight-bold');
	}else{
		$('#status_container').addClass('text-success font-weight-bold');
		$("#reply_container").text(selectedData["adminResponse"]);
		$('#status_container').text('Responded');
	}

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

</script>