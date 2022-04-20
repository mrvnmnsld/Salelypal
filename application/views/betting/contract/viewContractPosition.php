<style type="text/css">
	.modal-footer{
		display: none;
	}

	.error{
		color: red;
	}
</style>

<div class="pagetitle">
  <h1>Contract Position Details</h1>
</div>

<hr>

<div id="main_modal_container">
		<div class="row">
			<div class="col-md-12">
				<b>ID:</b>
				<label id="id_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>status:</b>
				<label id="status_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>tradePair:</b>
				<label id="tradePair_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>timeStamp:</b>
				<label id="timeStamp_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>positionType:</b>
				<label id="positionType_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>amount:</b>
				<label id="amount_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>currentPrice:</b>
				<label id="currentPrice_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>riskPrice:</b>
				<label id="riskPrice_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>resolvedPrice:</b>
				<label id="resolvedPrice_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>User:</b>
				<label id="email_container"></label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>Timestamp:</b>
				<label id="dateCreated_container"></label>
			</div>	
		</div>


	<hr>

	<div class="d-flex flex-row-reverse">
		<button class="btn btn-danger ml-2 closeBtn">Close</button>
		<button class="btn btn-success ml-2" id="set_lose_btn" disabled>Set Lose</button>
		<button class="btn btn-success" id="set_win_btn" disabled>Set Win</button>
	</div>
</div>

<div id="price_set_container" style="display:none">
	<form id="resolveForm" class="form-group">
		<label>Please Indicate Resolved Price</label>
		<input type="number" class="form-control form-control-sm" id="resolvedPrice_input" required>
		<div id="errorReporter" class="error"></div>
	</form>

	
	<div>
		Risk Price: <span id="riskPrice_container_2nd"></span><br>
		Current Price: <span id="currentPrice_container_2nd"></span>
	</div>

	<div class="float-right">
		<button class="btn btn-success" id="confirm_btn">Confirm</button>
		<button class="btn btn-danger back_btn">Back</button>
	</div>
</div>

<script type="text/javascript">
	var statusSet;

	// init text setting
		$("#id_container").text(selectedData["id"]);
		$("#status_container").text(selectedData["status"]);
		$("#tradePair_container").text(selectedData["tradePair"]);
		$("#riskPrice_container").text(selectedData["riskPrice"]);
		$("#timeStamp_container").text(selectedData["timeStamp"]);
		$("#amount_container").text(selectedData["amount"]);
		$("#positionType_container").text(selectedData["positionType"]);
		$("#currentPrice_container").text(selectedData["currentPrice"]);
		$("#resolvedPrice_container").text(selectedData["resolvedPrice"]);
		$("#email_container").text(selectedData["email"]);
		$("#dateCreated_container").text(selectedData["dateCreated"]);

		if (selectedData["status"]=="PENDING") {
			$("#set_win_btn").removeAttr('disabled');
			$("#set_lose_btn").removeAttr('disabled');
		}
	// init text setting


	//btn Events
		$(".closeBtn").on('click', function(){
			bootbox.hideAll();
		});

		$(".back_btn").on('click', function(){
			$("#main_modal_container").toggle();
			$("#price_set_container").toggle();
		});

		$("#set_win_btn").on('click', function(){
			$("#errorReporter").text("");
			var currentPriceInner = parseFloat(selectedData.currentPrice);
			$("#main_modal_container").toggle();
			$("#price_set_container").toggle();

			$('#resolvedPrice_input').attr("readonly",'readonly')
			$('#resolvedPrice_input').val(selectedData.riskPrice)

			$('#riskPrice_container_2nd').text(selectedData.riskPrice)
			$('#currentPrice_container_2nd').text(currentPriceInner);
			statusSet = "WIN";
		});

		$("#set_lose_btn").on('click', function(){
			$("#errorReporter").text("");
			var currentPriceInner = parseFloat(selectedData.currentPrice);
			$("#main_modal_container").toggle();
			$("#price_set_container").toggle();

			$('#resolvedPrice_input').removeAttr("readonly")
			$('#resolvedPrice_input').val(currentPriceInner)

			$('#riskPrice_container_2nd').text(selectedData.riskPrice)
			$('#currentPrice_container_2nd').text(currentPriceInner);
			statusSet = "LOSE";
		});

		$("#confirm_btn").on('click', function(){
			var resolvedPrice = $("#resolvedPrice_input").val();
			var isValid = $("#resolveForm").valid();
			var newIncome = selectedData.amount*2;

			if (isValid) {
				if (statusSet=="LOSE") {
					if (resolvedPrice==selectedData.riskPrice) {
						console.log("dont resolve put error msg");
						$("#errorReporter").text("Resolved Price can't be equal with Risk Price if set to losing");
					}else{
						var res = ajaxShortLink('userWallet/future/resolvePosition', {
							'id':selectedData.id,
							'resolvedPrice':resolvedPrice,
							'status':statusSet
						});

						loadDatatable('userWallet/future/admin/getAllContractPositions');
						bootbox.hideAll();
					}
				}

				if (statusSet=="WIN") {
					var res = ajaxShortLink('userWallet/future/resolvePosition', {
						'id':selectedData.id,
						'resolvedPrice':resolvedPrice,
						'status':statusSet
					});

					// test-platform
						amountUsdt = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress', {
							'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
						}).balance;

						var resWinPosition = ajaxShortLink('test-platform/risefall/winPosition', {
							'newIncome':newIncome,
							'amountStaked':0,
							'amountUsdt':amountUsdt,
						});
					// test-platform

					console.log(amountUsdt,newIncome);

					loadDatatable('userWallet/future/admin/getAllContractPositions');
					bootbox.hideAll();
				}

				

				
			}

		});
	//btn Events
</script>