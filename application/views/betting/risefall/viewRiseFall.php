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
			<b>Current Price During Betting:</b>
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
		<button class="btn btn-success ml-2" id="resolve_position_btn" disabled>Resolve Position</button>
	</div>
</div>

<div id="price_set_container" style="display:none">
	<form id="resolveForm">

		<div class="form-group">
			<label>Please Set Status</label>
			<select class="form-control form-control-sm" id="status_input" name="status_input">
				<option>WIN</option>
				<option>LOSE</option>
			</select>
		</div>

		<div class="form-group">
			<label>Please Indicate Resolved Price</label>
			<input type="number" class="form-control form-control-sm" id="resolvedPrice_input" name="resolvedPrice_input">
		</div>

		<div>
			<span id="condition_contaier"></span><br>
			<b>Current Price During Betting: </b><span id="currentPrice_container_2nd"></span><br>
			<b>Buy type: </b><span id="buyType_container_2nd"></span>
		</div>

		<div class="float-right">
			<button type="submit"	class="btn btn-success" id="confirm_btn">Confirm</button>
			<button type="button" class="btn btn-danger back_btn">Back</button>
		</div>
		
	</form>

	
</div>

<script type="text/javascript">
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
			$("#resolve_position_btn").removeAttr('disabled');
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

		$("#resolve_position_btn").on('click', function(){
			$("#main_modal_container").toggle();
			$("#price_set_container").toggle();
			$('#currentPrice_container_2nd').text(parseFloat(selectedData.currentPrice));
			$('#buyType_container_2nd').text(selectedData.buyType);

			$("#status_input").val("WIN").change();
		});
	//btn Events

	$("#resolveForm").validate({
	  	errorClass: 'error',
	  	rules: {
				status_input: "required",
				resolvedPrice_input: "required",
	  	},
	  	submitHandler: function(form){
		    var resolvedPrice = $("#resolvedPrice_input").val();
		    var statusSet = $("#status_input").val();
		    var newIncome = selectedData.amount*(selectedData.income/100);

	    	console.log(selectedData.id,resolvedPrice,newIncome,statusSet);
	    	var res = ajaxShortLink('userWallet/future/resolveRiseFallPosition', {
	    		'id':selectedData.id,
	    		'resolvedPrice':resolvedPrice,
	    		'status':statusSet
	    	});

	    	var setRes = ajaxShortLink('userWallet/future/setRiseFallPosition', {
	    		'id':selectedData.id,
	    		'userID':selectedData.userID,
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

	$("#status_input").on('change', function(){
		var statusInputValue = $(this).val();
		var min;
		var max;
		var currentPriceInner = parseFloat(selectedData.currentPrice);

		$('#resolvedPrice_input').removeAttr("max");
		$('#resolvedPrice_input').removeAttr("min");

		if(statusInputValue == "WIN"){

			if (selectedData.buyType == "rise") {
				min = currentPriceInner+currentPriceInner*.0005;
			}else if (selectedData.buyType == "fall") {
				min = currentPriceInner-currentPriceInner*.0005;
			}

			$('#resolvedPrice_input').attr("min",min);
			$('#resolvedPrice_input').val(min);
			$('#condition_contaier').html("<b>Minimum: </b>"+min);

		}else if(statusInputValue == "LOSE"){

			if (selectedData.buyType == "rise") {
				max = currentPriceInner-currentPriceInner*.0005;
			}else if (selectedData.buyType == "fall") {
				max = currentPriceInner;
			}

			$('#resolvedPrice_input').attr("max",max);
			$('#resolvedPrice_input').val(max);

			$('#condition_contaier').html("<b>Maximum: </b>: "+max);

		}
	});
</script>