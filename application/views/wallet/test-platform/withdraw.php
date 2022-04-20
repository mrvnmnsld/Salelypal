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

<div id="innerContainer" class="pl-3 pr-3">
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

		<span>You can view your complete transaction details in by clicking <a href="#" id="txidLinkSendContainer" target="_blank">tronscan.org</a>(It might take a few seconds to register the transaction)</span>
		
		<br>
		<hr>

		<button type="button" class="btn btn-block btn-danger" id="closeBtn_transaction">Close</button>
	</div>

	<form id="mainForm" style="display:;">
		<div class="">
	  		<small class="font-weight-bold text-success">Available Amount on wallet: Select Token...<span id="availableAmountContainer"></span></small>

			<div>
				<b>Network:</b>
				<span id="network_container">Select Token...</span>
			</div>


			<div class="form-group">

				<div><b>Select Token to withdraw:</b></div>

				<select class="form-control" id="tokenContainerSelect" name="tokenContainerSelect">
					<option value="">Select Token...</option>
				</select>	
		  	</div>

			<div class="form-group">
				<div><b>Recieving Address:</b></div>
				<input class="form-control mt-2" id="addressToInput" name="addressToInput" placeholder="Enter Address">
		  	</div>

	  		<div class="form-group">
	  			<div><b>Amount:</b></div>
	  		</div>

  			<div class="input-group mb-3">
				<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" id="amountInput" name="amountInput" placeholder="Enter amount" />

				<div class="input-group-append">
					<button class="btn btn-primary" type="button" id="maxBtn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;z-index: 0;">Max</button>
				</div>
	  	  	</div>

	  		<div class="form-group">
	  			<div><b>Account Password:</b></div>
	  			<input type="password" class="form-control mt-2" id="accountPassword" name="accountPassword" placeholder="Enter password">
	  	  	</div>
		</div>

		<div id="errorReporter" class="text-center text-danger"></div>
		<div id="warningReported" class="text-center"></div>

		<hr>

		<div class="row">
			<button type="submit" class="col-md-12 btn btn-success btn-block m-2" id="confirmBtn">Send Widthrawal</button>
		</div>
	</form>

	<hr>
</div>


<div class="p-2" id="test_table">
	<div class="text-center">
		<h4>Transaction History</h4>
	</div>

	<table class="table table-sm table-borderless text-center">
	  <thead>
	    <tr>
	      <th scope="col">Token</th>
	      <th scope="col">Amount</th>
	      <!-- <th scope="col">Type</th> -->
	      <th scope="col">Date</th>
	    </tr>
	  </thead>
	  <tbody id="transactionContainer">
	  	<tr>
	  		<td colspan="4" class="text-center text-danger">Transaction History Not Available in Testing Mode</td>
	  	</tr>
	  </tbody>
	</table>
</div>

<script type="text/javascript">
	for (var i = 0; i < tokensSelected.length; i++) {
		$("#tokenContainerSelect").append(
			'<option '+ 
				'value="'+tokensSelected[i].tokenName+'_'+tokensSelected[i].networkName+'_'+tokensSelected[i].smartAddress+'"'+
				'data-content="'+
					'<div class=&apos;mainTokenSelectedLogo&apos;>'+
						'<img style=&apos;width:30px;&apos; src=&apos;'+tokensSelected[i].tokenImage+'&apos;>'+
						'<span class=&apos;ml-3 text-dark&apos;>'+tokensSelected[i].description+' ('+tokensSelected[i].networkName.toUpperCase()+')'+'</span>'+
					'</div>'+
				'"'+
			'</option>'
		);
	}

	$("#tokenContainerSelect").selectpicker();

	$("#closeBtn_transaction").on('click',function(){
		backButton();
	});

	$("#tokenContainerSelect").on('change', function(){
		var balanceInner;
		var tokenInfoWithdraw = $(this).val().split("_");

		console.log(tokenInfoWithdraw)

		if (tokenInfoWithdraw[1] == 'trx'||tokenInfoWithdraw[1] == 'trc20') {
			if (tokenInfoWithdraw[0].toUpperCase() === 'trx'.toUpperCase()) {

				balanceInner = ajaxShortLink('userWallet/getTronBalance',{
					'trc20Address':currentUser['trc20_wallet']
				})['balance'];			

			}else{

				balanceInner = ajaxShortLink('userWallet/getTRC20Balance',{
					'trc20Address':currentUser['trc20_wallet'],
					'contractaddress':tokenInfoWithdraw[2],
				})['balance'];

			}
		}else if(tokenInfoWithdraw[1] =='bsc'){

			if(tokenInfoWithdraw[0].toUpperCase() === 'bnb'.toUpperCase()){

				balanceInner = ajaxShortLink('userWallet/getBinancecoinBalance',{
					'bsc_wallet':currentUser['bsc_wallet']
				})['balance'];

			}else{
				balanceInner = ajaxShortLink('userWallet/getBscTokenBalance',{
					'bsc_wallet':currentUser['bsc_wallet'],
					'contractaddress':tokenInfoWithdraw[2]
				})['balance'];
			}
		}else if(tokenInfoWithdraw[1] =='erc20'){
			if(tokenInfoWithdraw[0].toUpperCase() === 'eth'.toUpperCase()){

				balanceInner = ajaxShortLink('userWallet/getEthereumBalance',{
					'erc20_address':currentUser['erc20_wallet']
				})['balance'];

			}else{
				balanceInner = ajaxShortLink('userWallet/getErc20TokenBalance',{
					'erc20_address':currentUser['erc20_wallet'],
					'contractaddress':tokenInfoWithdraw[2]
				})['balance'];
			}
		}

		console.log(balanceInner,tokenInfoWithdraw);

		$("#availableAmountContainer").text(parseFloat(balanceInner).toFixed(4));

		if ($(this).val().split("_")[1] == 'trc20') {
			$("#warningReported").html("<b>Important Note:</b><br>TRC20 token transfer may consume energy, if energy is insufficient, TRX will be burned. Please ensure you have more than enough TRX to avoid transfer failure.<br><br> You may check TRC20 TRX Fee at <a href='https://tronstation.io/calculator' target='_blank'>Tronstation.io</a>");
			$("#network_container").text("TRON Mainet");
		}else if($(this).val().split("_")[1] == 'bsc'){
			$("#warningReported").html("<b>Important Note:</b><br>BSC token transfer will consume transaction fee, if BNB is insufficient the transaction will fail Please ensure you have more than enough BNB to avoid transfer failure.<br><br> <b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6)+" BNB</span>");
			$("#network_container").text("Binance Smart Chain");
		}else if ($(this).val().split("_")[1] == 'trx'){
			$("#warningReported").empty();
			$("#network_container").text("TRON Mainet");
		}else if ($(this).val().split("_")[1] == 'erc20'){
			$("#warningReported").html("<b>Important Note:</b><br>ERC20 token transfer will consume transaction fee, if ETH is insufficient the transaction will fail Please ensure you have more than enough ETH to avoid transfer failure.<br><br> <b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasEth(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6)+" ETH</span>");

			$("#network_container").text("Ethereum Mainet");
		}

	});

	$("#maxBtn").on('click',function(){
		$("#amountInput").val($("#availableAmountContainer").text());
	});

	jQuery.extend(jQuery.validator.messages, {
	    required: "Fill empty fields",
	});

	jQuery.validator.addMethod("isTrc20", function(value, element) {
		var tokenNetworkSelected = $("#tokenContainerSelect").val().split("_")[1];
		console.log(tokenNetworkSelected);

		if (tokenNetworkSelected=='trc20'||tokenNetworkSelected=='trx') {
	    	return isTrc20(value);
		}else if(tokenNetworkSelected=='bsc'){
			return isAddressValidBscErc(value);
		}else if(tokenNetworkSelected=='erc20'){
			return isAddressValidBscErc(value);
		}
	}, "Address is not compatible with token network selected");

	jQuery.validator.addMethod("isAmountEnough", function(value, element) {
		var tokenNetworkSelected = $("#tokenContainerSelect").val().split("_")[1];
		var tokenSelected = $("#tokenContainerSelect").val().split("_")[0];
		var availableAmount = parseFloat($("#availableAmountContainer").text());

		if (tokenNetworkSelected=='trc20'||tokenNetworkSelected=='trx') {
	    	return (value<=availableAmount)
		}else if(tokenNetworkSelected=='bsc'){
			if(tokenSelected.toUpperCase() === 'bnb'.toUpperCase()){
				var transactionFee = parseFloat($("#transactionFee").text());
				var valueWithFee = parseFloat(value)+transactionFee;

				$("#totalFee").remove();
				$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6)+" BNB</span>");


				return (valueWithFee<=availableAmount)
			}else{
				var transactionFee = parseFloat($("#transactionFee").text());
				
				$("#totalFee").remove();
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6)+" BNB</span>");

				// $("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");

				return (valueWithFee<=availableAmount)

			}
			
		}else if(tokenNetworkSelected=='erc20'){
			var transactionFee = parseFloat($("#transactionFee").text());
			var valueWithFee = parseFloat(value)+transactionFee;

			console.log(transactionFee,valueWithFee);

			if(tokenSelected.toUpperCase() === 'eth'.toUpperCase()){
				var valueWithFee = parseFloat(value)+transactionFee;

				$("#totalFee").remove();
				$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasEth(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6)+" ETH</span>");


				return (valueWithFee<=availableAmount)
			}else{
				
				$("#totalFee").remove();
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6)+" BNB</span>");
				
				// $("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");

				return (valueWithFee<=availableAmount)

			}

		}

	}, "Your balance is not enough");

	jQuery.validator.addMethod("checkPassword", function(value, element) {
	    // return (value<=parseInt($("#availableAmountContainer").text()))
	    return confirmRes = ajaxShortLink(
    		url = 'confirmPassword',
    		data = {
    			'password': value,
    			'currentUser': currentUser['userID'],
    		}
    	);
	}, "Password doesn't match");

	$("#mainForm").validate({
	  	errorClass: 'is-invalid text-danger',
	  	rules: {
			tokenContainerSelect: "required",
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
	  	errorLabelContainer: $('#errorReporter'),
	  	groups: {
		    mygroup: "tokenContainerSelect addressToInput amountInput accountPassword"
		},
	  	submitHandler: function(form){
	  		var data = $('#mainForm').serializeArray();
	  		data.push({
	  			'name':'fromBscNetwork',
	  			'value':currentUser.bsc_wallet
	  		});

	  		data.push({
	  			'name':'erc20_address',
	  			'value':currentUser.erc20_wallet
	  		});

	  		data.push({
	  			'name':'currentUserID',
	  			'value':currentUser.userID
	  		});

	  		console.log(data);

	  		var res = ajaxPostLink('sendWithdrawal',data);

	  		console.log(res);

	  		if (res['ok'] == true) {
	  			var tokenNetworkSelected = $("#tokenContainerSelect").val().split("_")[1];
	  			var tokenSelected = $("#tokenContainerSelect").val().split("_")[0];

	  			$('#successContainer').toggle();
	  			$('#mainForm').toggle();

	  			$('#amountSendContainer').text(res['amount']);
	  			$('#addressSendContainer').text(res['to']);
	  			$('#txidSendContainer').val(res['txid']);

	  			if (tokenNetworkSelected=='bsc') {
	  				$('#txidLinkSendContainer').attr('href','https://bscscan.com/tx/'+res['txid']);
	  				$('#txidLinkSendContainer').text('bscscan.com');
	  			}else if(tokenNetworkSelected=='erc20'){
	  				$('#txidLinkSendContainer').attr('href','https://etherscan.io/tx/'+res['txid']);
	  				$('#txidLinkSendContainer').text('etherscan.com');
	  			}else{
	  				$('#txidLinkSendContainer').attr('href','https://tronscan.org/#/transaction/'+res['txid']);
	  				$('#txidLinkSendContainer').text('tronscan.com');
	  			}

	  			pushNewNotif("Withdrawal Successful(TESTING)","Withdrew "+res['amount']+" "+tokenSelected+" to"+ res['to'],currentUser.userID)
	  		}else{
	  			$.alert("Error in Withdrawal contact admin | Error#: 33122")
	  		}
		}
	});

</script>