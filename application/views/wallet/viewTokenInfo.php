<style type="text/css">
	#token_image_container{
		width: 50px;
	}
</style>

<div id="innerContainer" class="p-3">

	<!-- div id="widget_container">
		
	</div> -->

	<div class="m-2 text-left">
		<div class="m-2 text-left">
			<div class="h3 p-2 m-2 font-weight-bold text-center">
				<span class="h5">
					<img src="" id="token_image_container">
				</span> <br>
				<span class="h5 text-muted" id="token_name_container">TOKENNAME</span> <br>
				<span id="token_amount_container" class="font-weight-normal main-color-text">Loading...</span>
			</div>	
		</div>
	</div>

	<div id="btn_option_container" class="d-flex justify-content-center mt-1">
		<button id="deposit_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-arrow-circle-down fa-lg main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em" ><b class="main-color-text">Deposit</b></div>
		</button>

		<button id="withdraw_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-arrow-circle-up fa-lg main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em" ><b class="main-color-text">Withdraw</b></div>
		</button>

		<button id="buy_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-credit-card-alt fa-md main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em;" ><b class="main-color-text">Buy</b></div>
		</button>

		<button id="info_btn_option_token_info" class="btn" style="background-color:transparent">
			<div class="btn main-color-icon btn-md" style="font-size:2em;padding:1px;">
				<i class="fa fa-info-circle fa-lg main-color-text" aria-hidden="true"></i>
			</div>
			<div style="font-size:.8em;" ><b class="main-color-text">Information</b></div>
		</button>
	</div>
</div>

<hr>

<div class="p-1">
	<div class="text-center">
		<h4>Transaction History</h4>
	</div>

	<div id="inner_loading" class="text-center mt-5">
		<div class="spinner-border" role="status">
		  <span class="sr-only">Loading...</span>
		</div>

		<div class="mt-2">Loading Transactions...</div>
	</div>


	<div id="table_container" style="display:none">
		<table class="table table-sm table-borderless main-color-text text-center" >
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

		<div class="text-center" style="margin-top:-5px">
			<small class="">Displaying 10 latest transactions</small><br>
		</div>
		
	</div>
	
</div>

<script type="text/javascript">

	console.log(clickContainer);

	$("#token_name_container").text(clickContainer.tokenName+" ("+clickContainer.networkName.toUpperCase()+")");
	$("#token_image_container").attr("src",clickContainer.tokenImage);

	//balance check
		if (clickContainer.networkName == 'trx'||clickContainer.networkName == 'trc20') {
			if (clickContainer.tokenName.toUpperCase() === 'trx'.toUpperCase()) {
				balanceInner = ajaxShortLink('userWallet/getTronBalance',{
					'trc20Address':currentUser['trc20_wallet']
				})['balance'];			
			}else{
				balanceInner = ajaxShortLink('userWallet/getTRC20Balance',{
					'trc20Address':currentUser['trc20_wallet'],
					'contractaddress':clickContainer.smartAddress,
				})['balance'];
			}
		}else if(clickContainer.networkName =='bsc'){

			if(clickContainer.tokenName.toUpperCase() === 'bnb'.toUpperCase()){

				balanceInner = ajaxShortLink('userWallet/getBinancecoinBalance',{
					'bsc_wallet':currentUser['bsc_wallet']
				})['balance'];

			}else{
				balanceInner = ajaxShortLink('userWallet/getBscTokenBalance',{
					'bsc_wallet':currentUser['bsc_wallet'],
					'contractaddress':clickContainer.smartAddress
				})['balance'];
			}
		}else if(clickContainer.networkName =='erc20'){

			if(clickContainer.tokenName.toUpperCase() === 'eth'.toUpperCase()){

				balanceInner = ajaxShortLink('userWallet/getEthereumBalance',{
					'erc20_address':currentUser['erc20_wallet']
				})['balance'];

			}else{
				balanceInner = ajaxShortLink('userWallet/getErc20TokenBalance',{
					'erc20_address':currentUser['erc20_wallet'],
					'contractaddress':clickContainer.smartAddress
				})['balance'];
			}
		}

		$("#token_amount_container").text(parseFloat(balanceInner).toFixed(clickContainer.decimal));
	//balance check

	// transaction load
		var loadTransactionTimeOut = setTimeout(function(){
			var allTransactionArray = [];
			var bscTransactions = ajaxPostLink('getBscWalletTransactions',{
				'userAddress':currentUser['bsc_wallet']
			})['result'];


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

				if(bscTransactions[i].to==currentUser['bsc_wallet']){
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

			var bscTransactionsTokens = ajaxPostLink('getBscWalletTransactionsTokens',{
				'userAddress':currentUser['bsc_wallet']
			})['result'];


			for (var i = 0; i < bscTransactionsTokens.length; i++) {
				var isDeposit;
				var amount = roundTron(bscTransactionsTokens[i].value);
				var isBought = 0;
				var	isError;

				console.log(bscTransactionsTokens[i]);

				if (bscTransactionsTokens[i].isError == 0) {
					isError = 'Success';
				}else{
					isError = 'Fail';
				}

				if(bscTransactionsTokens[i].to==currentUser['bsc_wallet']){
					isDeposit = '<span class="btn btn-sm btn-success font-weight-bold" disabled="true">IN</span>';
					if(bscTransactionsTokens[i].from=='0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312'){
						isBought = 1;
					}
				}else{
			    	isDeposit = '<span class="btn btn-sm btn-warning font-weight-bold" disabled="true">OUT</span>';
				}

				if (amount >= 1 && isBought == 0) {
					try {
						token = ajaxShortLink('userWallet/checkTokenByContractAddress',
							{'smartAddress':bscTransactionsTokens[i].contractAddress}
						);

						token = token.tokenName
					}
					catch(err) {
						token = "Unknown"
					}

					allTransactionArray.push({
						'token':token,
						'transactionHash':bscTransactionsTokens[i].hash,
						'amount':mweiToBnb(amount),
						'result':isError,
						'timestamp':unixTimeToDateNonFormated(bscTransactionsTokens[i].timeStamp),
						'network':'bsc',
						'isDeposit':isDeposit
					});
				}
			}

			var transactions = ajaxShortLinkNoParse('https://apilist.tronscan.org/api/transaction?sort=-timestamp&count=true&limit=10&start=0&address='+currentUser['trc20_wallet'])['data']; 

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

					if (transactions[i].ownerAddress == currentUser['trc20_wallet']) {
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


					if (trc20Transaction['from_address'] == currentUser['trc20_wallet']) {
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

			var erc20_transactions = ajaxShortLink("userWallet/getErc20Transactions",{'erc20_wallet':currentUser.erc20_wallet}); 

			if(erc20_transactions.status == 1){
				for (var i = 0; i < erc20_transactions.result.length; i++) {
					var innerTransactionContainer = erc20_transactions.result[i];
					var amount = weiToBnb(innerTransactionContainer.value);
					var isError = innerTransactionContainer.isError;
					var contractAddress = innerTransactionContainer.contractAddress;
					var token;

					var isDeposit;

					if (innerTransactionContainer.from == currentUser.erc20_wallet) {
						// if (innerTransactionContainer.from.toUpperCase() == '0xaccef84f39a21ce8f04e9ca31c215359af0ad030'.toUpperCase()) {
						// this is test

						isDeposit = '<span class="btn btn-sm btn-warning font-weight-bold" disabled="true">OUT</span>';
					}else{
						isDeposit = '<span class="btn btn-sm btn-success font-weight-bold" disabled="true">IN</span>';

						if (innerTransactionContainer.from == '0xaccef84f39a21ce8f04e9ca31c215359af0ad030') {
							isBought = 1;
						}else{
							isBought = 0;
						}
					}

					if(isError == 0){
						try {
							if(contractAddress==""){
								console.log("here");
								token = "ETH"
							}else{
								console.log("there");

								token = ajaxShortLink('userWallet/checkTokenByContractAddress',
									{'smartAddress':contractAddress}
								);

								token = token.tokenName
							}
						}
						catch(err) {
							token = "Unknown"
						}

						if (isBought==0) {
							allTransactionArray.push({
								'token':token,
								'transactionHash':innerTransactionContainer.hash,
								'amount':amount,
								'timestamp':unixTimeToDateNonFormatedVer2(innerTransactionContainer.timeStamp),
								'network':'ERC20',
								'isDeposit':isDeposit,
								'to':innerTransactionContainer.to,
								'from':innerTransactionContainer.from,
							});
						}	
					}

				}
			}

			var allTransactionArray = allTransactionArray.sort((a, b) => b.timestamp - a.timestamp);

			allTransactionArray = allTransactionArray.slice(0,10);

			allTransactionArray.forEach(function(item, index){
				var options = {
					month: '2-digit',
					year: 'numeric',
				 	day:'2-digit'
				};

				$("#transactionContainer").append(
					'<tr id="transaction_hash_'+allTransactionArray[index].transactionHash+'">'+
						'<td>'+allTransactionArray[index].token+'</td>'+
						'<td>'+allTransactionArray[index].amount+'</td>'+
						'<td>'+allTransactionArray[index].isDeposit+'</td>'+
						'<td>'+allTransactionArray[index].timestamp.toLocaleDateString('en-US', options)+'</td>'+
					'</tr>'
				);
				
				$('#transaction_hash_'+allTransactionArray[index].transactionHash).on('click',function(){
				    var transactionHash = $(this).attr('id').split("_")[2];
				    console.log($(this).index());

				    SelectedtransactionDetails = allTransactionArray[$(this).index()];

				    bootbox.dialog({
				        title: '',
				        message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTransaction'}),
				        size: 'large',
				        centerVertical: true,
				    });
				});
			});

			// console.log(bscTransactions,transactions,erc20_transactions);

			$("#inner_loading").toggle();
			$("#table_container").toggle();
		},2000);
		
	// transaction load

	$("#buy_btn_option_token_info").on('click',function(){
		clearTimeout(loadTransactionTimeOut);
		addBreadCrumbs("wallet/buyCrypto");

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#assets_container').css("display","none");
		$("#container").fadeOut(animtionSpeed, function() {
			$("#profile_btn").css('display',"none")
			$("#top_back_btn").css('display',"block")

  			$("#container").empty();
  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/buyCrypto'}));
  			$("#container").fadeIn(animtionSpeed);
  			// $("#token_select").val(clickContainer.tokenName+"_"+clickContainer.networkName+"_"+clickContainer.smartAddress+"_"+clickContainer.coingeckoTokenId).change();
		});
	});

	$("#withdraw_btn_option_token_info").on('click',function(){
		clearTimeout(loadTransactionTimeOut);

		var res = ajaxPostLink(
			"userWallet/getCurrentUserStrictStatus",{
			'userID':currentUser.userID
		});

		if(res==1){
 			addBreadCrumbs("wallet/withdrawStrict");

 			$("html, body").animate({ scrollTop: 0 }, "slow");
 			$('#assets_container').css("display","none");
 			$("#container").fadeOut(animtionSpeed, function() {
 				$("#profile_btn").css('display',"none")
 				$("#top_back_btn").css('display',"block")

 	  			$("#container").empty();
 	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdrawStrict'}));
 	  			$("#container").fadeIn(animtionSpeed);
 			});
		}else{
			addBreadCrumbs("wallet/withdraw");

			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('#assets_container').css("display","none");
			$("#container").fadeOut(animtionSpeed, function() {
				$("#profile_btn").css('display',"none")
				$("#top_back_btn").css('display',"block")

	  			$("#container").empty();
	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdraw'}));
	  			$("#container").fadeIn(animtionSpeed);
	  			$("#tokenContainerSelect").val(clickContainer.tokenName+"_"+clickContainer.networkName+"_"+clickContainer.smartAddress).change();
			});
		}
	});

	$("#deposit_btn_option_token_info").on('click',function(){
		clearTimeout(loadTransactionTimeOut);

		addBreadCrumbs("wallet/deposit");

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#assets_container').css("display","none");
		$("#container").fadeOut(animtionSpeed, function() {
			$("#profile_btn").css('display',"none")
			$("#top_back_btn").css('display',"block")

  			$("#container").empty();
  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/deposit'}));
  			$("#container").fadeIn(animtionSpeed);
		});
	});

	$("#info_btn_option_token_info").on('click',function(){
		clearTimeout(loadTransactionTimeOut);
		
		addBreadCrumbs("wallet/tokenMoreInfo");

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#assets_container').css("display","none");
		$("#container").fadeOut(animtionSpeed, function() {
			$("#profile_btn").css('display',"none")
			$("#top_back_btn").css('display',"block")

  			$("#container").empty();
  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/tokenMoreInfo'}));
  			$("#container").fadeIn(animtionSpeed);
		});
	});

	// deposit_btn_option_token_info
	// withdraw_btn_option_token_info
	// buy_btn_option_token_info
	// 

</script>
