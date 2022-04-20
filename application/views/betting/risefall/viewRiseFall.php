<style type="text/css">
	.modal-footer{
		display: none;
	}

	.error{
		color: red;
	}
</style>

<div class="pagetitle">
  <h1>Rise Fall Position Details</h1>
</div>

<hr>

<div id="main_modal_container">
		<div class="row">
			<div class="col-md-12">
				<b>ID:</b>
				<label id="id_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>status:</b>
				<label id="status_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>tradePair:</b>
				<label id="tradePair_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>Income:</b>
				<label id="Income_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>timeStamp:</b>
				<label id="timeStamp_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>amount:</b>
				<label id="amount_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>buyType:</b>
				<label id="buyType_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>currentPrice:</b>
				<label id="currentPrice_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>resolvedPrice:</b>
				<label id="resolvedPrice_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>User:</b>
				<label id="email_container">test</label>
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<b>Timestamp:</b>
				<label id="dateCreated_container">test</label>
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
	</form>

	<div>
		<span id="condition_contaier"></span><br>
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
		$("#Income_container").text(selectedData["income"]);
		$("#timeStamp_container").text(selectedData["timeStamp"]);
		$("#amount_container").text(selectedData["amount"]);
		$("#buyType_container").text(selectedData["buyType"]);
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
			var currentPriceInner = parseFloat(selectedData.currentPrice);
			var min;
			var max;

			if (selectedData.buyType == "rise") {
				var min = currentPriceInner+currentPriceInner*.0005;
			}else if (selectedData.buyType == "fall") {
				var min = currentPriceInner-currentPriceInner*.0005;
			}

			$("#main_modal_container").toggle();
			$("#price_set_container").toggle();

			$('#resolvedPrice_input').attr("min",min)
			$('#resolvedPrice_input').removeAttr("max")
			$('#resolvedPrice_input').val(min)

			$('#condition_contaier').text("Minimum: "+min)
			$('#currentPrice_container_2nd').text(currentPriceInner);
			statusSet = "WIN";
		});

		$("#set_lose_btn").on('click', function(){
			var currentPriceInner = parseFloat(selectedData.currentPrice);
			var min;
			var max;

			if (selectedData.buyType == "rise") {
				var max = currentPriceInner-currentPriceInner*.0005;
			}else if (selectedData.buyType == "fall") {
				var max = currentPriceInner+currentPriceInner*.0005;
			}

			$("#main_modal_container").toggle();
			$("#price_set_container").toggle();

			$('#resolvedPrice_input').attr("max",max)
			$('#resolvedPrice_input').removeAttr("min")
			$('#resolvedPrice_input').val(max)

			$('#condition_contaier').text("Maximum: "+max)
			$('#currentPrice_container_2nd').text(currentPriceInner);
			statusSet = "LOSE";
		});

		$("#confirm_btn").on('click', function(){
			var resolvedPrice = $("#resolvedPrice_input").val();
			var isValid = $("#resolveForm").valid();
			var newIncome = selectedData.amount*(selectedData.income/100);

			if (isValid) {
				var res = ajaxShortLink('userWallet/future/resolveRiseFallPosition', {
					'id':selectedData.id,
					'resolvedPrice':resolvedPrice,
					'status':statusSet
				});

				if (statusSet=="WIN") {
					// test-platform
						amountUsdt = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress', {
							'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
						}).balance;

						var resWinPosition = ajaxShortLink('test-platform/risefall/winPosition', {
							'newIncome':newIncome,
							'amountStaked':selectedData.amount,
							'amountUsdt':amountUsdt,
						});
					// test-platform

					console.log(amountUsdt,newIncome);
				}

				

				loadDatatable('userWallet/riseFall/admin/getAllRiseFall');
				bootbox.hideAll();
			}

		});
	//btn Events
</script>