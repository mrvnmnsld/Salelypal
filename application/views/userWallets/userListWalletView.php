<style type="text/css">
	.modal-footer{
		display: none;
	}
	.is-invalid{
		text-align:center;
	}
	.icon-size{
		font-size: 1.33em;
		max-width: 2em;
		max-height: 1.78em;
	}
	.form-group{
		background: rgba(0, 0, 0, .1);
	}
	#pagetitle_background{
		background: #293038;
		color: white;
		text-align: center; 
		font-size: 1.5em;
		padding:.5em;
	}
	#main_modal_container{
		background: rgba(0, 0, 0, .1);
	}
	#success_page_modal_container {
		padding: 1em;
	}
</style>

<div id="pagetitle_background" class="pagetitle">
		<label>User Wallet View</label>
		<p style="font-size: 0.5em;">Viewing of Main Wallet Settings</p>
</div>

<div id="main_modal_container">
	<div style="padding: 20px;">
 
		<div class="row text-left">
			<div class="col-sm-3 fw-bold">User ID:</div>
			<div id="userId_container" class="col"></div>
		</div>

		<div class="row text-left">
			<div class="col-sm-3 fw-bold">Email:</div>
			<div id="email_container" class="col"></div>
		</div>

		<div class="row text-left">
			<div class="col-sm-3 fw-bold">Transaction:</div>
			<div id="strictStatus_container" class="col"></div>
		</div>

		<hr>

		<div class="row text-left">
			<div class="col-sm-3 mt-1 fw-bold">Tron Mainet Wallet:</div>
			<div class="input-group-prepend col">
				<input type="text" class="form-control form-control-sm" id="tron_wallet_container">
				<button class="btn btn-secondary btn-sm" id="copy_tron_btn" type="button">copy</button>
			</div>
		</div><br>

		<div class="row text-left">
			<div class="col-sm-3 mt-1 fw-bold">BSC Wallet:</div>
			<div class="input-group-prepend col">
				<input type="text" class="form-control form-control-sm" id="bsc_wallet_container">
				<button class="btn btn-secondary btn-sm" id="copy_bsc_btn" type="button">copy</button>
			</div>
		</div><br>

		<div class="row text-left">
			<div class="col-sm-3 mt-1 fw-bold">ERC20 Wallet:</div>
			<div class="input-group-prepend col">
				<input type="text" class="form-control form-control-sm" id="erc20_wallet_container">
				<button class="btn btn-secondary btn-sm" id="copy_erc20_btn" type="button">copy</button>
			</div>
		</div>

		<hr>

		<div class="mb-1 font-weight-bold text-center">Options:</div>

		<div class="d-flex flex-column">
		  <button class="btn btn-danger btn-sm mt-1" id="strict_btn">Toggle Strict Mode</button>
		  <!-- <button class="btn btn-danger btn-sm mt-1" id="block_btn">Freeze/Block User</button> -->
		  <button class="btn btn-success btn-sm mt-1" id="unblock_btn">UnFreeze/UnBlock User</button>
		  <!-- <button class="btn btn-primary btn-sm mt-1" disabled>View Purchased Crypto</button> -->
		  <button class="btn btn-primary btn-sm mt-1" id="view_transactions_btn">View Transactions</button>
		  <button class="btn btn-primary btn-sm mt-1" id="view_balance_btn">View Balance</button>
		  <button class="btn btn-danger btn-sm mt-1" id="close_modal_btn">Close</button>
		  <!-- <button class="btn btn-primary"></div> -->
		</div>
	</div>	
</div>

<div id="second_page_modal_container" style="display: none;">
	<div  class="form-group">
		<form id="withdraw_form">
			<div style="padding: 20px;">

		    	<label class="fw-bold">Please Select Token</label>
				<div class="input-group row m-1">
					<i class="input-group-text fa fa-btc icon-size" aria-hidden="true"></i>
					<select id="token_select" name="token_select" class="js-example-basic-single form-control" data-live-search="true">
					    <optgroup id="erc20_tokens_container" label="Ethereum Mainet"></optgroup>
					    <optgroup id="bsc_tokens_container" label="Binance Smart Chain"></optgroup>
					    <optgroup id="tron_tokens_container" label="Tron Mainet"></optgroup>
					</select>
				</div>

		      	<div> 
					<label class="fw-bold">Token Name:</label>
					<span class="align-middle" id="token"></span>
				</div>

				<div> 
					<label class="fw-bold">Network:</label>
					<span class="align-middle" id="network"></span>
				</div>

				<div> 
					<label class="fw-bold">Available Balance:</label>
					<span class="align-middle" id="balance"></span>
				</div>

		      	<hr>

		      	<label class="fw-bold">Receiver's Address</label>
				<div class="input-group row m-1 mb-2">
					<i class="input-group-text fa fa-address-book-o icon-size" aria-hidden="true"></i>
				  <input type="text" class="form-control" id="toAddress" name="toAddress" placeholder="Wallet Address">
				</div>

				<label class="fw-bold">Amount</label>
				<div class="input-group row m-1 mb-2">
					<i class="input-group-text fa fa-btc icon-size"></i>
				  <input type="number" class="form-control" id="amount" name="amount" min="0.001" step="0.001" placeholder="Amount">
				</div>

				<div class="d-flex flex-row-reverse">
				  	<button type="button" class="btn btn-danger ml-2" id="back_btn">Back to Overview</button>
					<button type="submit" class="btn btn-success" id="send_withdraw_btn">Send</button>
				</div>
	      	</div>
      	</form>


  </div>
</div>

<div id="success_page_modal_container" class="text-center" style="display: none;"> 
        <i style="font-size:150px" class="fa fa-check-circle-o text-success" aria-hidden="true"></i><br>
        <span style="font-size:30px" class="text-success">Success!!</span>
        <br>

        <span>Transaction for Withdrawal Successfully Submitted</span>

        <hr>

        <div class="container">
		  <div class="row text-left">
		    <div class="col-sm-3 fw-bold">Amount:</div>
		    <div id="addressSendContainer" class="col"></div>
		  </div>

		  <div class="row text-left">
		    <div class="col-sm-3 fw-bold">Address Sent:</div>
		    <div id="addressSendContainer" class="col"></div>
		  </div>

		  <div class="row text-left">
		    <div class="col-sm-3 mt-1 fw-bold">Transaction:</div>
		    <div class="input-group-prepend col">
		    	<input type="text" class="form-control form-control-sm" id="txidSendContainer">
				<button class="btn btn-secondary btn-sm" id="copy_transaction_btn" type="button">copy</button>
		    </div>
		  </div>
		</div>

        <br>

        <span>You can view your complete transaction details in by clicking <a href="#" id="txidLinkSendContainer" target="_blank">link</a> (It might take a few seconds to register the transaction)</span>

        <br>
        <hr>

		<div class="d-flex flex-row-reverse">
	        <button type="button" class="btn btn-danger ml-2" id="closeBtn_withdrawPage">Close</button>
	        <button type="button" class="btn btn-primary" id="back_to_withdrawForm">Back to Withdraw Page</button>
		</div>        
</div>

<div id="third_page_modal_container" style="display:none">
	<div class="h2 text-center">Transaction History</div>
	<div class="text-center">NOTE: Click row to view transaction details</div>

	<table class="table table-striped table-bordered table-sm datatable" id="datatable_modal">
	  <thead>
	    <tr>
	      <th scope="col">Token</th>
	      <th scope="col">Amount</th>
	      <th scope="col">Type</th>
	      <th scope="col">Date</th>
	    </tr>
	  </thead>
	  <tbody id="transactionContainer">
	  </tbody>
	</table>

	<div class="d-flex flex-column">
	  <button class="btn btn-success btn-sm mt-1" id="back_btn_transactions">Back to Overview</button>
	  <!-- <button class="btn btn-primary"></div> -->
	</div>
</div>

<script type="text/javascript">
	$("#userId_container").text(selectedData["userID"]);
	$("#email_container").text(selectedData["email"]);
	$("#tron_wallet_container").val(selectedData["trc20_wallet"]);
	$("#bsc_wallet_container").val(selectedData["bsc_wallet"]);
	$("#erc20_wallet_container").val(selectedData["erc20_wallet"]);

	var walletPasswordContainerGlobal;
	var userAddressGlobal;
	var selectedNetworkGlobal;

	var allTokens = ajaxShortLink('userWallet/getAllTokensV2');

	for (var i = 0; i < allTokens.length; i++) {
	    if(allTokens[i].networkName=="erc20"){
	        $("#erc20_tokens_container").append(
	            '<option data-subtext="'+allTokens[i].networkName+'" value="'+allTokens[i].tokenName+'_'+allTokens[i].networkName+'_'+allTokens[i].smartAddress+'_'+allTokens[i].coingeckoTokenId+'_'+allTokens[i].id+'">'+
	                allTokens[i].tokenName+' ('+allTokens[i].description+')'+
	            '</option>'
	        );
	    }

	    if(allTokens[i].networkName=="bsc"){
	        $("#bsc_tokens_container").append(
	            '<option data data-subtext="'+allTokens[i].networkName+'" value="'+allTokens[i].tokenName+'_'+allTokens[i].networkName+'_'+allTokens[i].smartAddress+'_'+allTokens[i].coingeckoTokenId+'_'+allTokens[i].id+'">'+
	                allTokens[i].tokenName+' ('+allTokens[i].description+')'+
	            '</option>'
	        );
	    }

	    if(allTokens[i].networkName=="trx"||allTokens[i].networkName=="trc20"){
	        $("#tron_tokens_container").append(
	            '<option data-subtext="'+allTokens[i].networkName+'" value="'+allTokens[i].tokenName+'_'+allTokens[i].networkName+'_'+allTokens[i].smartAddress+'_'+allTokens[i].coingeckoTokenId+'_'+allTokens[i].id+'">'+
	                allTokens[i].tokenName+' ('+allTokens[i].description+')'+
	            '</option>'
	        );
	    }
	}

	$('#token_select').selectpicker({
	    style: 'border',
	    size: 8,
	    showSubtext :true
	});

	setTimeout(function(){
		$("#token_select").change();
	},1000)

	if (selectedData["isStrict"] == 1) {
		$('#block_btn').addClass('disabled');
		$('#strictStatus_container').addClass('text-danger font-weight-bold');
		$('#strictStatus_container').text('Yes');
	}else{
		$('#strictStatus_container').text('No');
		$('#unblock_btn').addClass('disabled');
	}

	$("#view_balance_btn").on('click',function(){
		$("#main_modal_container").toggle();
		$("#second_page_modal_container").toggle();

		// console.log("test");
		// edit here
	});

	$("#token_select").on('change', function(){

        var tokenInfoWithdraw = $(this).val().split("_");
		
		var tokenNameContainer = tokenInfoWithdraw[0];
		var networkNameContainer = tokenInfoWithdraw[1];
		var smartAddressContainer = tokenInfoWithdraw[2];
		var coingeckoTokenIdContainer = tokenInfoWithdraw[3];
		var descriptionContainer = tokenInfoWithdraw[4];

        var tokenIndex = $(this).prop('selectedIndex');
        var selectedTokenInfo = allTokens[tokenIndex]; 

        var availBalance;

		function balanceDisplay(){
			$('#balance').text(parseFloat(availBalance).toFixed(selectedTokenInfo.decimal)); 
		}

		function walletDetailsDisplay(){
			$('#token').text(tokenNameContainer); 
			$('#network').text(networkNameContainer.toUpperCase());
			// $("#amount").rules( "remove", "min max" );
			// $( "#amount" ).rules( "add", {
			// min: 5
			// });
		}

		function walletDetailsConsolelog(){
			console.log('------------------------------------');
			console.log('USER SELECTED');
			console.log('Selected network :' + tokenNameContainer );
			console.log('Selected token: ' + networkNameContainer);
			console.log('Balance: ' + availBalance);
			console.log('------------------------------------');
		}

        if (networkNameContainer == 'trx'||networkNameContainer == 'trc20') {
            if (tokenNameContainer.toUpperCase() === 'trx'.toUpperCase()) {
                availBalance = ajaxShortLink('userWallet/getTronBalance',{
					'trc20Address' : selectedData["trc20_wallet"]
				})['balance'];

				balanceDisplay();
				walletDetailsConsolelog();
				walletDetailsDisplay();

            }else{
                availBalance = ajaxShortLink('userWallet/getTRC20Balance',{
					'contractaddress':smartAddressContainer,
					'trc20Address' : selectedData["trc20_wallet"]
				})['balance'];
				balanceDisplay();
				walletDetailsConsolelog();
				walletDetailsDisplay();
            }	

            walletPasswordContainerGlobal = selectedData["trc20_privateKey"];
            userAddressGlobal = selectedData["trc20_wallet"];
			selectedNetworkGlobal = networkNameContainer;
        

        }else if(networkNameContainer =='bsc'){
            if(tokenNameContainer.toUpperCase() === 'bnb'.toUpperCase()){
                availBalance = ajaxShortLink('userWallet/getBinancecoinBalance',{
					'bsc_wallet' : selectedData["bsc_wallet"]
				})['balance'];
				balanceDisplay();
				walletDetailsConsolelog();
				walletDetailsDisplay();
            }else{
                availBalance = ajaxShortLink('userWallet/getBscTokenBalance',{
					'contractaddress' : smartAddressContainer,
					'bsc_wallet' : selectedData["bsc_wallet"]
				})['balance'];
				balanceDisplay();
				walletDetailsConsolelog();
				walletDetailsDisplay();
            }

            walletPasswordContainerGlobal = selectedData["bsc_password"];	
            userAddressGlobal = selectedData["bsc_wallet"];
			selectedNetworkGlobal = networkNameContainer;


        }else if(networkNameContainer =='erc20'){

            if(tokenNameContainer.toUpperCase() === 'eth'.toUpperCase()){
                availBalance = ajaxShortLink('userWallet/getEthereumBalance',{
					'erc20_address' : selectedData["erc20_wallet"]
				})['balance'];
				balanceDisplay();
				walletDetailsConsolelog();
				walletDetailsDisplay();
            }else{
                availBalance = ajaxShortLink('userWallet/getErc20TokenBalance',{
					'contractaddress' : smartAddressContainer,
					'erc20_address' : selectedData["erc20_wallet"]
				})['balance'];
				balanceDisplay();
				walletDetailsConsolelog();
				walletDetailsDisplay();
            }

            walletPasswordContainerGlobal = selectedData["erc20_password"];	
            userAddressGlobal = selectedData["erc20_wallet"];
			selectedNetworkGlobal = networkNameContainer;

        }
  	});

	jQuery.validator.addMethod("checkIfValidAddress", function(value, element) {
			var tokenSelected = $("#token_select").val().split("_");

			if(tokenSelected[1] == 'trx' || tokenSelected[1] == 'trc20'){
				return(isTrc20(value));
			}else{
				return(isAddressValidBscErc(value))
			}

	}, "Address is not valid for the network");

	jQuery.validator.addMethod("isAmountEnough", function(value, element) {
			var balance = $("#balance").text();

			console.log(balance,value,parseFloat(value)<=parseFloat(balance));

			if (parseFloat(value)<=parseFloat(balance)) {
				return true;
			}else{
				return false;
			}

	}, "User balance is not enough");

	jQuery.validator.addMethod("setForceMinimum", function(value, element) {
			return parseFloat(value)>=0.00;
	}, "Minimum amount is 0.001");

	// jQuery.validator.addMethod("onlyNumber", function(value, element) {
	// 		return  /^[0-9.]*$/.test(value);
	// }, "Only input numbers starting from 0.001");

	$("#withdraw_form").validate({
		errorClass: 'is-invalid',
		rules: {
			toAddress: {
				required:true,
				checkIfValidAddress:true
			},
		amount: {
			min: 0.001,
			setForceMinimum:true,
			isAmountEnough:true,
			required:true,
		},
			token_select:"required"
		},
		submitHandler: function(form){
			var toSend = {
				"addressToInput": $("#toAddress").val(), 
				"amountInput": $("#amount").val(),
				"tokenContainerSelect":$("#token_select").val(),
				"currentUserID":selectedData.userID,
				"accountPassword": walletPasswordContainerGlobal,
				"userAddress":userAddressGlobal	
			}

		    var res = ajaxShortLink('userWallet/sendWithdrawalV2',toSend);
			console.log(toSend,res);

			if(res.ok==true){
				if (selectedNetworkGlobal=='bsc') {
					$('#txidLinkSendContainer').attr('href','https://bscscan.com/tx/'+ res['txid']);
					$('#txidLinkSendContainer').text('bscscan.com');
				}else if(selectedNetworkGlobal=='erc20'){
					$('#txidLinkSendContainer').attr('href','https://etherscan.io/address/'+ res['txid']);
					$('#txidLinkSendContainer').text('etherscan.com');
				}else{
					$('#txidLinkSendContainer').attr('href','https://tronscan.org/#/transaction/'+ res['txid']);
					$('#txidLinkSendContainer').text('tronscan.com');
				}

				$('#amountSendContainer').text(res['amount']);
				$('#addressSendContainer').text(res['to']);
				$('#txidSendContainer').val(res['txid']);
				

				$("#second_page_modal_container").toggle();
				$("#success_page_modal_container").toggle();
				$("#pagetitle_modal_background").toggle();
			}else{
				$.alert("Error in withdrawal. Please contact System Admin")
			}

			
  		}
	});

	$("#copy_transaction_btn").on('click',function(){
		$('#txidSendContainer').select();
		document.execCommand("copy");
		document.getSelection().removeAllRanges();

		$.toast({
		    heading: '<h6>Copied your Transaction address</h6>',
		    text: 'You can now paste your Transaction address',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-center'
		})
	});

	$("#copy_tron_btn").on('click',function(){
		$('#tron_wallet_container').select();
		document.execCommand("copy");
		document.getSelection().removeAllRanges();

		$.toast({
		    heading: '<h6>Copied your Address</h6>',
		    text: 'You can now paste your address',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-center'
		})
	});

	$("#copy_bsc_btn").on('click',function(){
		$('#bsc_wallet_container').select();
		document.execCommand("copy");
		document.getSelection().removeAllRanges();

		$.toast({
		    heading: '<h6>Copied your Address</h6>',
		    text: 'You can now paste your address',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-center'
		})
	});

	$("#unblock_btn").on('click', function(){
		$.confirm({
			icon: 'fa fa-ban',
		    title: 'Blocking?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to <b>UNBLOCK</b> this user?',
		    buttons: {
		        confirm: function () {
		        	ajaxShortLink('admin/userlist/unblockuser',{'userID':selectedData['userID']});
		        	loadDatatable('userWallet/loadUserWallets')
		        	bootbox.hideAll();

		        	$.toast({
    			        heading: '<h6>Success!</h6>',
    			        text: 'Successfully unblocked the user!',
    			        showHideTransition: 'slide',
    			        icon: 'success',
    			        position: 'bottom-left'
    			        // position: 'bottom-center'
    			    })
		        },
		        cancel: function () {

		        },
		    }
		});
	});

	$("#strict_btn").on('click', function(){
		$.confirm({
			icon: 'fa fa-ban',
		    title: 'Blocking?',
		    columnClass: 'col-md-6 col-md-offset-6',
		    content: 'Are you sure you want to toggle <b>strict mode</b> this user?',
		    buttons: {
		        confirm: function () {
		        	var res = ajaxShortLink('userWallet/strictModeToggle',{'userID':selectedData['userID'],'isStrict':selectedData["isStrict"]});
		        	console.log(res);

		        	if (res===1) {
			        	loadDatatable('userWallet/loadUserWallets')
			        	bootbox.hideAll();

			        	$.toast({
	    			        heading: '<h6>Success!</h6>',
	    			        text: 'Successfully Toggled!',
	    			        showHideTransition: 'slide',
	    			        icon: 'success',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })
		        	}else{
			        	$.toast({
	    			        heading: '<h6>ERROR!</h6>',
	    			        text: 'Please contact ADMIN!',
	    			        showHideTransition: 'slide',
	    			        icon: 'error',
	    			        position: 'bottom-left'
	    			        // position: 'bottom-center'
	    			    })
		        	}


		        	
		        },
		        cancel: function () {

		        },
		    }
		});
	});

	
	$("#back_to_withdrawForm").on('click', function(){
		$("#success_page_modal_container").toggle();
		$("#second_page_modal_container").toggle();
		$("#balance").text("");
		$("#token").text("");
		$("#network").text("");
		$("#withdraw_form").trigger("reset");
		$("#token_select").change();
		// $("#pagetitle_modal_background").toggle();
	});

	$("#back_btn").on('click', function(){
		$("#main_modal_container").toggle();
		$("#second_page_modal_container").toggle();
	});

	$("#close_modal_btn").on('click', function(){
		bootbox.hideAll();
	});

	$("#closeBtn_withdrawPage").on('click', function(){
		bootbox.hideAll();
	});

	$("#withdraw_back_btn").on('click', function(){
		$("#withdraw_modal_container").toggle();
		$("#second_page_modal_container").toggle();
	});

	$("#back_btn_transactions").on('click', function(){
		$("#main_modal_container").toggle();
		$("#third_page_modal_container").toggle();
	});

	$("#view_transactions_btn").on('click',function(){
		$("#loading").toggle()

		setTimeout(function(){
			$.when(loadTransaction()).then(function(){
				$("#main_modal_container").toggle();
				$("#third_page_modal_container").toggle();
				$("#loading").toggle();
			});
		}, 1000);
	
		function loadTransaction(){
			var transactions = ajaxShortLinkNoParse('https://apilist.tronscan.org/api/transaction?sort=-timestamp&count=true&limit=10&start=0&address='+selectedData.trc20_wallet)['data'];
			var allTransactionArray = [];

			var bscTransactions = ajaxPostLink('getBscWalletTransactions',{'userAddress':selectedData.bsc_wallet})['result'];

			for (var i = 0; i < bscTransactions.length; i++) {
				var isDeposit;
				var amount = roundTron(bscTransactions[i].value);
				var isBought = 0;

				var	isError;

				if (bscTransactions[i].isError == 0) {
					isError = 'Success';
				}else{
					isError = 'Fail';
				}

				if(bscTransactions[i].to==selectedData.bsc_wallet){
					isDeposit = '<span class="btn btn-sm btn-success font-weight-bold" disabled="true">IN</span>';
					if(bscTransactions[i].from=='0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312'){
						isBought = 1;
					}
				}else{
			    	isDeposit = '<span class="btn btn-sm btn-warning font-weight-bold" disabled="true">OUT</span>';
				}

				if (amount >= 1 && isBought == 0) {
					allTransactionArray.push({
						'token':'BNB',
						'transactionHash':bscTransactions[i].hash,
						'amount':mweiToBnb(amount),
						'result':isError,
						'timestamp':unixTimeToDateNonFormated(bscTransactions[i].timeStamp),
						'network':'bsc',
						'isDeposit':isDeposit
					});
				}
			}

			for (var i = 0; i < transactions.length; i++) {
				var trueAmount = transactions[i].amount;
				var amount = roundTron(transactions[i].amount);
				var isDeposit;
				var token;
				var isBought = 0;
				
				// console.log(transactions[i]);
				// console.log(trueAmount);

				if (trueAmount >= 1) {
					token = "TRX";

					if (transactions[i].ownerAddress == currentUser['address']) {
						isDeposit = '<span class="btn btn-sm btn-warning font-weight-bold" disabled="true">OUT</span>';
					}else{
						isDeposit = '<span class="btn btn-sm btn-success font-weight-bold" disabled="true">IN</span>';
						if (transactions[i].ownerAddress == 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS') {
							isBought = 1;
						}else{
							isBought = 0;
						}
					}
				}else{
					var trc20Transaction = ajaxShortLinkNoParse('https://apilist.tronscan.org/api/transaction-info?hash='+transactions[i].hash)['trc20TransferInfo'][0];
					token = trc20Transaction['symbol'];
					amount = trc20AmountToRealAmount(parseInt(trc20Transaction['amount_str']));


					if (trc20Transaction['from_address'] == currentUser['address']) {
						isDeposit = '<span class="btn btn-sm btn-warning font-weight-bold" disabled="true">OUT</span>';
					}else{
						isDeposit = '<span class="btn btn-sm btn-success font-weight-bold" disabled="true">IN</span>';

						if (trc20Transaction['from_address'] == 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS') {
							isBought = 1;
						}else{
							isBought = 0;
						}
					}
				}

				// console.log(isBought);

				if (isBought==0) {
					allTransactionArray.push({
						'token':token,
						'transactionHash':transactions[i].hash,
						'amount':amount,
						'result':cleanOutPutString(transactions[i].result),
						'timestamp':unixTimeToDate13CharNonFormated(transactions[i].timestamp),
						'network':'trx',
						'isDeposit':isDeposit
					});
				}	
			}

			var allTransactionArray = allTransactionArray.sort((a, b) => b.timestamp - a.timestamp);
			loadDatatable(allTransactionArray)

			function loadDatatable(dataRes){
				console.log(dataRes);

				$('#datatable_modal').DataTable().destroy();

				var dt = $('#datatable_modal').DataTable({
					data: dataRes,
					columns: [
						{ data:'token'},
						{ data:'amount'},
						{ data:'isDeposit'},
						{ data:'timestamp'},
					],
					"order": [[1, 'asc']],
					"createdRow": function( row, data, dataIndex){
						var options = {
							month: '2-digit',
							year: 'numeric',
						 	day:'2-digit'
						};

						$(row).find("td:eq(3)").text(data['timestamp'].toLocaleDateString('en-US', options));

						// console.log(row, data, dataIndex);
		      },
			    autoWidth: false
				});
			}
		}
	});

	$('#datatable_modal tbody').on( 'click', 'tr', function () {
		var table = $('#datatable_modal').DataTable();
	    SelectedtransactionDetails = table.row( this ).data() ;
	    console.log();

			$("#loading").toggle()

	    setTimeout(function(){
	    	$.when(loadViewTransaction()).then(function(){
	    		// $("#main_modal_container").toggle();
	    		// $("#third_page_modal_container").toggle();
	    		$("#loading").toggle();
	    	});
	    }, 1000);

	    function loadViewTransaction(){
	    	bootbox.dialog({
	    	    title: '',
	    	    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTransaction'}),
	    	    size: 'large',
	    	    centerVertical: true,
	    	});
	    }
	});
	
</script>