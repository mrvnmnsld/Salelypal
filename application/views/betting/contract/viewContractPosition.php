<style type="text/css">
	.modal-footer{
		display: none;
	}
	.error{
		color: red;
	}
	.modal-content{
		background: transparent;
		border: 0;
	}
	#pagetitle_background{
		background: #293038;
		color: white;
		padding: 15px;
		border-radius: 20px 20px 0px 0px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		text-align: center;
	}
	#main_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
	#resolveForm{
		background-color: #F2F4F4;
		border-radius:20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">Contract Position Details</label>
</div>

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
		<button class="btn btn-success ml-2" id="resolve_position_btn" disabled>Resolve Position</button>
	</div>

</div>

<div id="price_set_container" style="display:none">  
	<form id="resolveForm" class="form-group">
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

		<div id="errorReporter" class="error"></div>

		<div>
			<b>Risk Price: </b><span id="riskPrice_container_2nd"></span><br>
			<b>Current Price: </b><span id="currentPrice_container_2nd"></span>
		</div>

		<div class="d-flex flex-row-reverse">
			<button type="button" class="btn btn-danger back_btn ml-2">Back</button>
			<button type="submit"	class="btn btn-success" id="confirm_btn">Confirm</button>
		</div>
	</form>
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
		    var newIncome = selectedData.amount*2;

	    	console.log(selectedData.id,resolvedPrice,statusSet,newIncome);

	    	if (statusSet=="LOSE") {
					if (resolvedPrice==selectedData.riskPrice) {
						$("#errorReporter").text("Resolved Price can't be equal with Risk Price if set to losing");
					}else{
						var res = ajaxShortLink('userWallet/future/resolvePosition', {
							'id':selectedData.id,
							'resolvedPrice':resolvedPrice,
							'status':statusSet
						});

						var setRes = ajaxShortLink('userWallet/future/setContractPosition', {
			    		'id':selectedData.id,
			    		'userID':selectedData.userID,
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

					var setRes = ajaxShortLink('userWallet/future/setContractPosition', {
		    		'id':selectedData.id,
		    		'userID':selectedData.userID,
		    	});

					// console.log(amountUsdt,newIncome);

					loadDatatable('userWallet/future/admin/getAllContractPositions');
					bootbox.hideAll();
	  		}

	  		event.preventDefault();
		}
	});

	$("#status_input").on('change', function(){
		var statusInputValue = $(this).val();
		var currentPriceInner = parseFloat(selectedData.currentPrice);

		$('#resolvedPrice_input').removeAttr("max");
		$('#resolvedPrice_input').removeAttr("min");

		if(statusInputValue == "WIN"){
			$("#errorReporter").text("");
			$('#resolvedPrice_input').attr("readonly",'readonly')
			$('#resolvedPrice_input').val(selectedData.riskPrice)
			$('#riskPrice_container_2nd').text(selectedData.riskPrice)
			$('#currentPrice_container_2nd').text(currentPriceInner);
		}else if(statusInputValue == "LOSE"){
			$("#errorReporter").text("");
			$('#resolvedPrice_input').removeAttr("readonly")
			$('#resolvedPrice_input').val(currentPriceInner)
			$('#riskPrice_container_2nd').text(selectedData.riskPrice)
			$('#currentPrice_container_2nd').text(currentPriceInner);
		}
	});
</script>