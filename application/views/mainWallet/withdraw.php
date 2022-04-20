<style type="text/css">
	.modal-footer{
		display: none;
	}

	#qrcode img{
		/*border: solid 1px;*/
		outline: 2px solid black;
	  	outline-offset: 5px;
	}

	.filter-option-inner-inner .mainTokenSelectedLogo img{
		width: 10%!important;
	}

	.filter-option-inner-inner .mainTokenSelectedLogo{
		text-align: left!important;
	}

	.bootbox-close-button{
		display: none;
	}
</style>

<div class="h2 text-center">Withdrawal</div>


<div id="successContainer" class="text-center" style="display: none;">
	<i style="font-size:150px" class="fa fa-check-circle-o text-success" aria-hidden="true"></i><br>
	<span style="font-size:30px" class="text-success">Success!</span>
	<br>

	<span>Transaction for withdrawal successfully submited</span>

	<div class="text-left" style="font-size:17px">
		<div><b>Amount: </b><span id="amountSendContainer">1</span></div>
		<div><b>Address sent: </b><span id="addressSendContainer">1</span></div>
		<div><b>Transaction address: </b><br><input id="txidSendContainer" type="text" class="form-control"></div>
	</div>

	<br>

	<span>You can view your complete transaction details in by clicking <a href="#" id="txidLinkSendContainer" target="_blank">tronscan.org</a> (It might take a few seconds to register the transaction)</span>
	
	<br>
	<hr>

	<button type="button" class="btn btn-block btn-danger" id="closeBtn_transaction">Close</button>

</div>

<form id="mainForm" style="display:;">
	<div class="p-2">
  		<small class="font-weight-bold text-success">Available Amount on wallet: <span id="availableAmountContainer">Not Set</span></small>

  		<div>
  			<b>Token:</b>
  			<span id="token_container">Not Set</span>
  		</div>

		<div>
			<b>Network:</b>
			<span id="network_container">Not Set</span>
		</div>

		<hr>

		<div class="form-group">
			<div><b>Recieving Address:</b></div>
			<input class="form-control mt-2" id="addressToInput" name="addressToInput" placeholder="Enter Address">
	  	</div>

  		<div class="form-group">
  			<div><b>Amount:</b></div>

  			<!-- <div class="input-group mb-3"> -->
			<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="amountInput" name="amountInput" placeholder="Enter amount" />

			<!-- <div class="input-group-append">
				<button class="btn btn-primary" type="button" id="maxBtn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;">Max</button>
			</div> -->
  	  	</div>

	  		<div class="form-group">
	  			<div><b>Account Password:</b></div>
	  			<input type="password" class="form-control mt-2" id="accountPassword" name="accountPassword" placeholder="Enter password">
	  	  	</div>
	</div>

	<div id="errorReporter" class="text-center text-danger"></div>
	<div id="warningReported" class="text-center"></div>

	<div class="d-flex flex-row-reverse">
		<button type="button" class="btn btn-danger m-1" id="closeBtn">Cancel</button>
		<button type="submit" class="btn btn-success m-1" id="confirmBtn">Confirm</button>
	</div>
</form>


<script type="text/javascript">

	$(document).ready(function(){
		console.log(selectedData);
		$("#availableAmountContainer").text(selectedData.balance);
		$("#network_container").text(selectedData.network);
		$("#token_container").text(selectedData.description);

		if (selectedData.network == 'trx' || selectedData.network == 'trc20') {
			$("#warningReported").html("<b>Important Note:</b><br>TRC20 token transfer may consume energy, if energy is insufficient, TRX will be burned. Please ensure you have more than enough TRX to avoid transfer failure.<br><br> You may check TRC20 TRX Fee at <a href='https://tronstation.io/calculator' target='_blank'>Tronstation.io</a>");
			$("#network_container").text("TRON Mainet");

		}else if (selectedData.network == 'bsc' || selectedData.network == 'bep20'){
			$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6)+" BNB</span>");
			$("#network_container").text("Binance Smart Chain");
		}else if (selectedData.network == 'erc20'){
			$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasEth(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6)+" ETH</span>");
			$("#network_container").text("Ethereum Mainet");
		}

		$("#closeBtn").on('click',function(){
	    	bootbox.hideAll();	
		});

		$("#closeBtn_transaction").on('click',function(){
			bootbox.hideAll();
		    $("#loading").css('display','none')
		    $("#innerContainer").css('display','block')
		    $("#footer").toggle();

			$.when(loadBalances()).then(loadDatatable,);
		});
	})

	jQuery.validator.addMethod("isTrc20", function(value, element) {
		if (selectedData.network=='trc20'||selectedData.network=='trx') {
	    	return isTrc20(value);
		}else if(selectedData.network=='bsc' || selectedData.network=='bep20'||selectedData.network=='erc20'){
			return isAddressValidBscErc(value);
		}
	}, "Address is not compatible with token network selected");

	jQuery.validator.addMethod("isAmountEnough", function(value, element) {
		// var tokenNetworkSelected = $("#tokenContainerSelect").val().split("_")[1];
		var availableAmount = selectedData.balance;

		if (selectedData.network=='trc20'||selectedData.network=='trx') {
	    	return (value<=availableAmount)
		}else if(selectedData.network=='bsc'||selectedData.network=='bep20'){
			var transactionFee = parseFloat($("#transactionFee").text());
			var valueWithFee = parseFloat(value)+transactionFee;

			console.log(transactionFee,valueWithFee);

			$("#totalFee").remove();
			$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");

			return (valueWithFee<=availableAmount)
		}else if(selectedData.network=='erc20'){
			var transactionFee = parseFloat($("#transactionFee").text());
			var valueWithFee = parseFloat(value)+transactionFee;

			console.log(transactionFee,valueWithFee);

			$("#totalFee").remove();
			$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");

			return (valueWithFee<=availableAmount)
		}

	}, "Your balance is not enough");

	jQuery.validator.addMethod("checkPassword", function(value, element) {
	    // return (value<=parseInt($("#availableAmountContainer").text()))
	    return confirmRes = ajaxShortLink(
    		url = 'mainWallet/confirmPasswordAdmin',
    		data = {
    			'password': value,
    			'currentUser': currentUser['id'],
    		}
    	);
	}, "Password doesn't match");

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			// tokenContainerSelect: "required",
			addressToInput: {
				isTrc20:true,
				required:true
			},
			amountInput: {
				isAmountEnough:true,
				required:true
			},
			accountPassword:{
				required:true,
				checkPassword:true
			}
	  	},
	  	submitHandler: function(form){
	  		var data = $('#mainForm').serializeArray();
	  		data.push(
	  			{
		  			'name':'fromBscNetwork',
		  			'value':'0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312'
	  			},{
		  			'name':'userId',
		  			'value':currentUser['id']
	  			},{
		  			'name':'network',
		  			'value':selectedData.network
	  			},{
		  			'name':'smartAddress',
		  			'value':selectedData.smartAddress
	  			},{
		  			'name':'erc20_address',
		  			'value':'0xaccef84f39a21ce8f04e9ca31c215359af0ad030'
	  			},{
		  			'name':'tokenName',
		  			'value':selectedData.tokenName
	  			},
	  			
	  		);
	  		console.log(data);

	  		var res = ajaxPostLink('mainWallet/sendWithdrawal',data);

	  		console.log(res);

	  		if (res['ok'] == true) {
	  			$('#successContainer').toggle();
	  			$('#mainForm').toggle();

	  			$('#amountSendContainer').text(res['amount']);
	  			$('#addressSendContainer').text(res['to']);
	  			$('#txidSendContainer').val(res['txid']);

	  			if (selectedData.network=='bsc') {
	  				$('#txidLinkSendContainer').attr('href','https://bscscan.com/tx/'+res['txid']);
	  				$('#txidLinkSendContainer').text('bscscan.com');
	  			}else if(selectedData.network=='trc20'||selectedData.network=='trx'){
	  				$('#txidLinkSendContainer').attr('href','https://tronscan.org/#/transaction/'+res['txid']);
	  				$('#txidLinkSendContainer').text('tronscan.com');
	  			}else if(selectedData.network=='erc20'){
	  				$('#txidLinkSendContainer').attr('href','https://etherscan.io/tx/'+res['txid']);
	  				$('#txidLinkSendContainer').text('etherscan.io.com');
	  			}
	  		}else{
	  			$.alert("Error in Withdrawal contact admin | Error#: 33122")
	  		}
		}
	});


</script>