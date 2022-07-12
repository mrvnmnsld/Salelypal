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

	table td, table th{
  		font-size: 0.8em;
	}

	.dropdown-menu{
		z-index: 9999999999;
	}
</style>

<div id="innerContainer" class="pl-3 pr-3 main-color-text">
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
		<div class="mt-5">
	  		<small class="font-weight-bold main-color-text" style="font-size:1rem;">Available Amount on wallet: <span id="availableAmountContainer"></span></small>

			<div>
				<span class="font-weight-bold">Network:</span>
				<span id="network_container" class="main-color-text"></span>
			</div>


			<div class="form-group pt-5">

				<div class="main-color-text"><b>Select Token to withdraw:</b></div>

				<select class="form-control main-color-text" id="tokenContainerSelect" name="tokenContainerSelect">
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
					<button class="btn secondary-color-bg" type="button" id="maxBtn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;z-index: 0; color:white;">Max</button>
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
			<button type="submit" class="col-md-12 btn btn-success light-color btn-block m-2 mx-3" id="confirmBtn">Send Widthrawal</button>
		</div>
	</form>

	<hr>
</div>


<div class="p-1" id="test_table">
	<div class="text-center">
		<h4>Transaction History</h4>
	</div>

	<table class="table table-sm table-borderless text-center main-color-text">
	  <thead>
	    <tr>
	      <th scope="col">Token</th>
	      <th scope="col">Amount</th>
	      <!-- <th scope="col">Type</th> -->
	      <th scope="col">Date</th>
	    </tr>
	  </thead>
	  <tbody id="transactionContainer">
	  </tbody>
	</table>
</div>

<script type="text/javascript">
	var gasTokenName, transactionFee, gasSupply;
	var balanceInner;

	var getVolumeControl = ajaxShortLink("getVolumeControl");

	var getTotalTopUpAndTotalContractBets = ajaxShortLink("getTotalTopUpAndTotalContractBets",{
		"userID":currentUser.userID,
	});

	if (getVolumeControl[0].isOn == 1) {
		var volumeControlValue = (getVolumeControl[0].percentage/100)*getTotalTopUpAndTotalContractBets[0];
		console.log(volumeControlValue);

		if (volumeControlValue>getTotalTopUpAndTotalContractBets[1]) {
			$.confirm({
				theme:"dark",
				icon: 'fa fa-pencil',
			    title: 'Something is up',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'You still need to use your <b>'+(volumeControlValue-getTotalTopUpAndTotalContractBets[1])+" USDT</b> to enable the withdrawal",
			    buttons: {
			        confirm: function () {
			        	$("#top_back_btn").click();
			        },
			    }
			});
			console.log("cant withdraw",getTotalTopUpAndTotalContractBets[0]-getTotalTopUpAndTotalContractBets[1]);
		}

		console.log(getVolumeControl,getTotalTopUpAndTotalContractBets);
	}

	

	// var tokensSelected = ajaxShortLink('getAllTokens');

	for (var i = 0; i < tokensSelected.length; i++) {
		$("#tokenContainerSelect").append(
			'<option '+ 
				'value="'+tokensSelected[i].tokenName+'_'+tokensSelected[i].networkName+'_'+tokensSelected[i].smartAddress+'"'+
				'data-content="'+
					'<div class=&apos;mainTokenSelectedLogo&apos;>'+
						'<img style=&apos;width:30px;&apos; src=&apos;'+tokensSelected[i].tokenImage+'&apos;>'+
						'<span class=&apos;ml-3 text-dark&apos;>'+tokensSelected[i].tokenName.toUpperCase()+" - "+tokensSelected[i].description+' ('+tokensSelected[i].networkName+')</span>'+
					'</div>'+
				'"'+
			'</option>'
		);
	}

	$("#tokenContainerSelect").selectpicker();

	var resWithdrawals = ajaxShortLink('userWallet/loadUserWithdrawal',{
		'userID':currentUser.userID
	});

	// console.log(resWithdrawals);

	resWithdrawals.forEach(function(item, index){
		// console.log(resWithdrawals[index].txid);
		$("#transactionContainer").append(
			'<tr id="transaction_hash_'+resWithdrawals[index].txid+'">'+
				'<td>'+resWithdrawals[index].token.toUpperCase()+'</td>'+
				'<td>'+resWithdrawals[index].amount+'</td>'+
				// '<td>'+allTransactionArray[index].isDeposit+'</td>'+
				'<td>'+resWithdrawals[index].timestamp+'</td>'+
			'</tr>'
		);
		
		$('#transaction_hash_'+resWithdrawals[index].txid).on('click',function(){
		    var transactionHash = $(this).attr('id').split("_")[2];
		    console.log($(this).index());

		    SelectedtransactionDetails = resWithdrawals[$(this).index()];

		    if(SelectedtransactionDetails.network=="trx"||SelectedtransactionDetails.network=="trc20"){
		    	SelectedtransactionDetails.network = 'trx';
		    }

	    	SelectedtransactionDetails['transactionHash'] = transactionHash;

		    console.log(SelectedtransactionDetails);

		    bootbox.dialog({
		        title: '',
		        message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTransaction'}),
		        size: 'large',
		        centerVertical: true,
		    });
		});
	});

	// transactionContainer

	// $("#availableAmountContainer").text(balance[$("#tokenContainerSelect").val().split("_")[0]]);

	$("#closeBtn_transaction").on('click',function(){
		// backButton();
		$("#successContainer").toggle();
		$("#mainForm").toggle();
	});

	$("#tokenContainerSelect").on('change', function(){
		var tokenInfoWithdraw = $(this).val().split("_");
		updateGasAndBalanceTestAccount($(this).val().split("_")[1],$(this).val().split("_")[0],$(this).val().split("_")[2])
		
		console.log(tokenInfoWithdraw)
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

		if (tokenNetworkSelected=='trc20'||tokenNetworkSelected=='trx') {
	    	return (gasSupply<=5)
		}else if(tokenNetworkSelected=='bsc'){
			if(tokenSelected.toUpperCase() === 'bnb'.toUpperCase()){
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6);
				var valueWithFee = parseFloat(value)+parseFloat(transactionFee);

				$("#totalFee").remove();
				$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (valueWithFee<=balanceInner)
			}else{
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6);
				
				$("#totalFee").remove();
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (transactionFee<=gasSupply)
			}
			
		}else if(tokenNetworkSelected=='erc20'){
			if(tokenSelected.toUpperCase() === 'eth'.toUpperCase()){
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6);
				var valueWithFee = parseFloat(value)+parseFloat(transactionFee);

				$("#totalFee").remove();
				$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (valueWithFee<=balanceInner)
			}else{
				
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6);
				
				$("#totalFee").remove();
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (transactionFee<=gasSupply)
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

	  			pushNewNotif("Withdrawal Successful","Withdrew "+res['amount']+" "+tokenSelected+" to"+ res['to'],currentUser.userID)

	  			var resWithdrawals = ajaxShortLink('userWallet/loadUserWithdrawal',{
	  				'userID':currentUser.userID
	  			});

	  			$("#transactionContainer").empty();

	  			resWithdrawals.forEach(function(item, index){
	  				$("#transactionContainer").append(
	  					'<tr id="transaction_hash_'+resWithdrawals[index].transactionHash+'">'+
	  						'<td>'+resWithdrawals[index].token+'</td>'+
	  						'<td>'+resWithdrawals[index].amount+'</td>'+
	  						// '<td>'+allTransactionArray[index].isDeposit+'</td>'+
	  						'<td>'+resWithdrawals[index].timestamp+'</td>'+
	  					'</tr>'
	  				);
	  				
	  				$('#transaction_hash_'+resWithdrawals[index].transactionHash).on('click',function(){
	  				    var transactionHash = $(this).attr('id').split("_")[2];
	  				    console.log($(this).index());

	  				    SelectedtransactionDetails = resWithdrawals[$(this).index()];

	  				    bootbox.dialog({
	  				        title: '',
	  				        message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTransaction'}),
	  				        size: 'large',
	  				        centerVertical: true,
	  				    });
	  				});
	  			});
	  		}else{
	  			$.alert("Error in Withdrawal contact admin | Error#: 33122")
	  		}
		}
	});

	function updateGasAndBalanceTestAccount(networkName,tokenName,smartAddress){
		if (networkName == 'bsc') {
			gasTokenName="BNB";
			transactionFee=parseFloat(estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6))

			gasSupply = ajaxShortLink('userWallet/getBinancecoinBalance',{
				"bsc_wallet":currentUser.bsc_wallet,
			})["balance"]

			if (smartAddress!='null') {
				balanceInner = ajaxShortLink('userWallet/getBscTokenBalance',{
					"contractaddress":smartAddress,
					"bsc_wallet":currentUser.bsc_wallet
				})["balance"]
			}else{
				balanceInner = ajaxShortLink('userWallet/getBinancecoinBalance',{
					"bsc_wallet":currentUser.bsc_wallet
				})["balance"]
			}
		}else if (networkName == 'erc20') {
			gasTokenName="ETH";
			transactionFee=parseFloat(estimateGasBsc(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6))

			gasSupply = ajaxShortLink('userWallet/getEthereumBalance',{
				"erc20_address":currentUser.erc20_wallet,
			})["balance"]

			if (smartAddress!='null') {
				balanceInner = ajaxShortLink('userWallet/getErc20TokenBalance',{
					"contractaddress":smartAddress,
					"erc20_address":currentUser.erc20_wallet,
				})["balance"]
			}else{
				balanceInner = ajaxShortLink('userWallet/getEthereumBalance',{
					"erc20_address":currentUser.erc20_wallet,
				})["balance"]
			}

		}else{
			gasTokenName="TRX";
			transactionFee=5;

			gasSupply = ajaxShortLink('userWallet/getTronBalance',{
				"trc20Address":currentUser.trc20_wallet,
			})["balance"]

			if (smartAddress!='null') {

				balanceInner = ajaxShortLink('userWallet/getTRC20Balance',{
					"contractaddress":smartAddress,
					"trc20Address":currentUser.trc20_wallet,
				})["balance"]

			}else{

				balanceInner = ajaxShortLink('userWallet/getTronBalance',{
					"trc20Address":currentUser.trc20_wallet,
				})["balance"]
			}

		}

	}

</script>