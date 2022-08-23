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


<div class="px-3">
	<div class="">
	    <div class="text-center">
	        <h4>Transaction History</h4>
	        <small>Click row to view details</small>
	    </div>

	    <br>

	    <table id="tableContainer" class="text-center" style="width: 100%!important;">  
	        <thead>
	            <tr>
	                <th scope="col">TX</th>
	                <th scope="col">Token</th>
	                <th scope="col">Amount</th>
	                <th scope="col">Deposit</th>
	                <th scope="col">Date</th>
	            </tr>
	        </thead>
	    </table>

	    <div id="inner_loading" class="text-center mt-5">
	    	<div class="spinner-border" role="status">
	    	  <span class="sr-only">Loading...</span>
	    	</div>

	    	<div class="mt-2">Updating Transactions...</div>
	    </div>
	</div>
</div>

<script type="text/javascript">
	var localTransactionsHistory = JSON.parse(getLocalStorageByKey("transactionsHistory"));

	if (localTransactionsHistory!=null) {
		$("#table_container").toggle();
		loadDatatable(localTransactionsHistory);
	}

	console.log(localTransactionsHistory);

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
		try{
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
							if (transactions[i].ownerAddress == 'TJwxuryQQPKrE5pVisRkpDmY1X5hRCucpL') {
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

							if (trc20Transaction['from_address'] == 'TJwxuryQQPKrE5pVisRkpDmY1X5hRCucpL') {
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

				// allTransactionArray = allTransactionArray.slice(0,10);

				allTransactionArray.forEach(function(item, index){
					var options = {
						month: '2-digit',
						year: 'numeric',
					 	day:'2-digit',
					 	hour:   '2-digit',
				 	    minute: '2-digit',
				 	    second: '2-digit',
					};

					allTransactionArray[index].timestamp = allTransactionArray[index].timestamp.toLocaleDateString('en-US', options);
				});

				console.log(bscTransactions,transactions,erc20_transactions);
				setLocalStorageByKey("transactionsHistory",JSON.stringify(allTransactionArray));

				$("#inner_loading").toggle();

				$("#table_container").css("display",'block');
				loadDatatable(allTransactionArray)
			},2000);
			
		}catch(error){
			alert("There seems to be a problem. Try loading the transaction later");
		}
			
		function loadDatatable(dataInner){
	        $('#tableContainer').DataTable().destroy();

	        $('#tableContainer').DataTable({
	            data: dataInner,
		        "ordering": false,
		        "searching": true,
		        "bLengthChange": false,
	            "bFilter": true,
	            columns: [
	                { data:'transactionHash'},
	                { data:'token'},
	                { data:'amount',},
	                { data:'isDeposit'},
	                { data:'timestamp'},
	            ],
	            "columnDefs": [
	                // { "width": "50%", "targets": 0 },
	                // { "width": "5%", "targets": 2 },
	                // { "width": "5%", "targets": 3 },
	                // { "width": "5%", "targets": 1 },
	                // {"className": "text-center", "targets": 2}
	            ],"createdRow": function( row, data, dataIndex){
	                if (data['status'] == "WIN") {
	                    $(row).find('td:nth-child(3)').addClass('bg-success');
	                }
	            },
		        // "autoWidth": true,
		        // "order": [[ 0, "desc" ]],
		        // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>'

		        // var options = {
				// 		month: '2-digit',
				// 		year: 'numeric',
				// 	 	day:'2-digit'
				// 	};

				// 	$("#transactionContainer").append(
				// 		'<tr id="transaction_hash_'+allTransactionArray[index].transactionHash+'">'+
				// 			'<td>'+allTransactionArray[index].token+'</td>'+
				// 			'<td>'+allTransactionArray[index].amount+'</td>'+
				// 			'<td>'+allTransactionArray[index].isDeposit+'</td>'+
				// 			'<td>'+allTransactionArray[index].timestamp.toLocaleDateString('en-US', options)+'</td>'+
				// 		'</tr>'
				// 	);
		    }).column( 0 ).visible(false);
	    }

       	$('#tableContainer').on('click', 'tbody tr', function () {
    	   	selectedData = $('#tableContainer').DataTable().row($(this)).data();
    	   	console.log(selectedData);
    	   	
    	   	if (selectedData!=undefined) {
    		    var transactionHash = selectedData.transactionHash;
    		    console.log($(this).index());

    		    SelectedtransactionDetails = selectedData;

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
    	   	}
         	
       	});
	// transaction load

	$("#buy_btn_option_token_info").on('click',function(){
		clearTimeout(loadTransactionTimeOut);
		addBreadCrumbs("wallet/buyCrypto");

		window.scrollTo(0, 0);

		addBreadCrumbs("wallet/tokenMoreInfo");

		$("#container_main").empty();
		$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/buyCrypto'}));
	});

	$("#withdraw_btn_option_token_info").on('click',function(){
		clearTimeout(loadTransactionTimeOut);

		if (typeof tokenPriceInterval  != 'undefined') {
			clearInterval(tokenPriceInterval);
		}

		if (typeof loadTransactionTimeOut  != 'undefined') {
			clearInterval(loadTransactionTimeOut);
		}

		if (currentUser.isStrict == "1") {
			addBreadCrumbs("wallet/withdrawStrict");

			window.scrollTo(0, 0);

			$("#container_main").empty();
			$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdrawStrict'}));
		}else{
			addBreadCrumbs("wallet/withdraw");

			window.scrollTo(0, 0);

			addBreadCrumbs("wallet/tokenMoreInfo");

			$("#container_main").empty();
			$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdraw'}));
		}
	});

	$("#deposit_btn_option_token_info").on('click',function(){
		window.scrollTo(0, 0);

		clearTimeout(loadTransactionTimeOut);

		addBreadCrumbs("wallet/deposit");

		$("#container_main").empty();
		$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/deposit'}));
	});

	$("#info_btn_option_token_info").on('click',function(){
		window.scrollTo(0, 0);
		
		clearTimeout(loadTransactionTimeOut);
		
		addBreadCrumbs("wallet/tokenMoreInfo");

		$("#container_main").empty();
		$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/tokenMoreInfo'}));
	});

	// deposit_btn_option_token_info
	// withdraw_btn_option_token_info
	// buy_btn_option_token_info
	// 

</script>
