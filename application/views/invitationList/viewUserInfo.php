<script defer src="assets/lib/faceapi/face-api.min.js"></script>
<!-- <script defer src="assets/lib/faceapi/script.js"></script> -->

<style type="text/css">
	.modal-footer{
		display: none;
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

	#main_modal_container, #wallet_transactions_modal_container, #contract_transactions_modal_container, #topup_transactions_modal_container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
		padding: 30px;
	}

</style>

<div id="pagetitle_background" class="pagetitle">
	<label class="h2 mt-2 fw-bold">User Details</label>
</div>

<div id="main_modal_container">

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Email:</b></div>	
		<div class="col-md" id="emailContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Name:</b></div>	
		<div class="col-md" id="fullnameContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Date Joined:</b></div>	
		<div class="col-md" id="dateContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Birthday:</b></div>	
		<div class="col-md" id="birthdayContainer"></div>	
	</div>

	<div class="row mt-1">
		<div class="col-md-3 pl-3"><b>Mobile:</b></div>	
		<div class="col-md" id="mobileNumberContainer"></div>	
	</div>

	<div class="row mt-1 mb-2">
		<div class="col-md-3 pl-3"><b>Last login:</b></div>	
		<div class="col-md" id="lastLoginContainer"></div>	
	</div>

	<hr>

	<div>
		<button class="btn-block btn btn-sm btn-primary mt-1" id="wallet_transactions_btn">View Wallet Transactions</button>
		<button class="btn-block btn btn-sm btn-primary mt-1" id="contract_transactions_btn">View Contract Transactions</button>
		<button class="btn-block btn btn-sm btn-primary mt-1" id="topUp_transactions_btn">View Top Up Transactions</button>
		<button class="btn-block btn btn-sm btn-danger mt-1" id="closeBtn">Close</button>
	</div>
</div>

<div id="wallet_transactions_modal_container" style="display:none">
	<div class="h2 text-center fw-bold">Transaction History</div>
	<div>NOTE: Click row to view transaction details</div>
	<hr>

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

	<hr>

	<div class="d-flex flex-column">
	  <button class="btn btn-danger btn-sm mt-1" id="back_btn_transactions">Back to Overview</button>
	  <!-- <button class="btn btn-primary"></div> -->
	</div>
</div>

<div id="contract_transactions_modal_container" style="display:none">
	<div class="h2 text-center fw-bold">Long/Short Positions</div>
	<div>NOTE: Click row to view transaction details</div>
	<hr>

	<table class="table table-striped table-bordered table-sm datatable" id="longshort_tbl">
	  <thead>
	    <tr>
	      <th scope="col">Token</th>
	      <th scope="col">Amount</th>
	      <th scope="col">Type</th>
	      <th scope="col">Date</th>
	    </tr>
	  </thead>
	</table>

	<hr>

	<div class="h2 text-center fw-bold">Rise/Fall Positions</div>
	<div>NOTE: Click row to view transaction details</div>
	<hr>

	<table class="table table-striped table-bordered table-sm datatable" id="riseFall_tbl">
	  <thead>
	    <tr>
	      <th scope="col">Token</th>
	      <th scope="col">Amount</th>
	      <th scope="col">Type</th>
	      <th scope="col">Date</th>
	    </tr>
	  </thead>
	</table>

	<hr>

	<div class="d-flex flex-column">
	  <button class="btn btn-danger btn-sm mt-1" id="back_btn_contract">Back to Overview</button>
	  <!-- <button class="btn btn-primary"></div> -->
	</div>
</div>

<div id="topup_transactions_modal_container" style="display:none">
	<div class="h2 text-center fw-bold">Top Up History</div>
	<div>NOTE: Click row to view transaction details</div>
	<hr>

	<table class="table table-striped table-bordered table-sm datatable" id="topUp_tbl">
	  <thead>
	    <tr>
	      <th scope="col">Token</th>
	      <th scope="col">Amount</th>
	      <th scope="col">USD Amount</th>
	      <th scope="col">Date</th>
	    </tr>
	  </thead>
	</table>

	<hr>

	<div class="d-flex flex-column">
	  <button class="btn btn-danger btn-sm mt-1" id="back_btn_topup">Back to Overview</button>
	  <!-- <button class="btn btn-primary"></div> -->
	</div>
	
</div>


<script type="text/javascript">
	$("#emailContainer").append(selectedData["email"]);
	$("#fullnameContainer").append(selectedData["fullname"]);
	$("#dateContainer").append(selectedData["timestamp"]);
	$("#birthdayContainer").append(selectedData["birthday"]);
	$("#mobileNumberContainer").append(selectedData["mobileNumber"]);
	// $("#ipContainer").append(selectedData["ip_lastLogin"]);
	$("#vipContainer").append("VIP "+selectedData["vip_id"]);
	
	console.log(selectedData);

	if (selectedData["lastLoginDate"] == null||selectedData["ip_lastLogin"]==null||selectedData["ip_lastLogin"]=='') {
		$('#lastLoginContainer').text("No Data");
	}else{
		$("#lastLoginContainer").append(selectedData["lastLoginDate"]+" IP: "+selectedData["ip_lastLogin"]);
	}

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#wallet_transactions_btn").on('click',function(){
		$("#loading").toggle()

		setTimeout(function(){
			$.when(loadTransaction()).then(function(){
				$("#main_modal_container").toggle();
				$("#wallet_transactions_modal_container").toggle();
				$("#loading").toggle();
			});
		}, 500);
	
		function loadTransaction(){
			var allTransactionArray = [];

			try {
				var bscTransactions = ajaxPostLink('getBscWalletTransactions',{'userAddress':selectedData['bsc_wallet']})['result'];

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

				console.log(bscTransactions);

				var transactions = ajaxShortLinkNoParse('https://apilist.tronscan.org/api/transaction?sort=-timestamp&count=true&limit=10&start=0&address='+selectedData['trc20_wallet'])['data']; 

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

				console.log(transactions);

				var erc20_transactions = ajaxShortLink("userWallet/getErc20Transactions",{'erc20_wallet':selectedData.erc20_wallet})['result']; 

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
							if(contractAddress!=""){
								token = ajaxShortLink('userWallet/checkTokenByContractAddress',
									{'smartAddress':contractAddress}
								).tokenName;
							}else{
								token = "ETH"
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

				console.log(erc20_transactions);

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
					
					// console.log(allTransactionArray[index].timestamp);

					$('#transaction_hash_'+allTransactionArray[index].transactionHash).on('click',function(){
					    var transactionHash = $(this).attr('id').split("_")[2];
					    console.log($(this).index());

					    // SelectedtransactionDetails = ajaxShortLinkNoParse('https://apilist.tronscan.org/api/transaction-info?hash='+transactionHash);

					    // console.log(SelectedtransactionDetails);

					    SelectedtransactionDetails = allTransactionArray[$(this).index()];

					    bootbox.dialog({
					        title: '',
					        message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTransaction'}),
					        size: 'large',
					        centerVertical: true,
					    });
					});
				});

				loadDatatable(allTransactionArray)
			}
			catch(err) {
			  	$("#loading").css("display",'none')

			  	$.confirm({
			      	title: 'Encountered an error!',
			      	content: 'Error in network/API is not responding well. etherscan.com/bscscan.com/tronscan.com exceeded the limit to return data',
			      	type: 'red',
			 	 	columnClass:"col-12",
			      	typeAnimated: true,
			      	buttons: {
			          	tryAgain: {
			              	text: 'Try again',
			              	btnClass: 'btn-red',
			              	action: function(){
			              		loadTransaction();
			              	}
			          	},
			          	close: function () {
			          		$("#main_modal_container").toggle();
			          		$("#wallet_transactions_modal_container").toggle();
		          		}
		      		}
		  		});

			}

			

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
					// "order": [[1, 'asc']],
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

	$("#back_btn_transactions").on('click', function(){
		$("#main_modal_container").toggle();
		$("#wallet_transactions_modal_container").toggle();
	});

	$("#contract_transactions_btn").on('click',function(){
		$("#loading").toggle();

		setTimeout(function(){
			$.when(loadTransaction()).then(function(){
				$("#main_modal_container").toggle();
				$("#contract_transactions_modal_container").toggle();
				$("#loading").toggle();
			});
		}, 1000);

		function loadTransaction(){
			var contractTransaction = ajaxShortLink("userWallet/getAllContractPositionsViaUserID",{
				"userID" : selectedData.userID
			})

			loadLongShortTable(contractTransaction[0])
			loadRiseFallTable(contractTransaction[1])


			function loadLongShortTable(dataRes){
				console.log(dataRes);

				$('#longshort_tbl').DataTable().destroy();

				var dt = $('#longshort_tbl').DataTable({
					data: dataRes,
					columns: [
						{ data:'amount'},
						{ data:'status'},
						{ data:'positionType'},
						{ data:'tradePair'},
					],
					// "order": [[1, 'asc']],
					"createdRow": function( row, data, dataIndex){
						// var options = {
						// 	month: '2-digit',
						// 	year: 'numeric',
						//  	day:'2-digit'
						// };

						// $(row).find("td:eq(3)").text(data['timestamp'].toLocaleDateString('en-US', options));

						// console.log(row, data, dataIndex);
		      		},
			    	autoWidth: false
				});
			}

			function loadRiseFallTable(dataRes){
				console.log(dataRes);

				$('#riseFall_tbl').DataTable().destroy();

				var dt = $('#riseFall_tbl').DataTable({
					data: dataRes,
					columns: [
						{ data:'amount'},
						{ data:'status'},
						{ data:'buyType'},
						{ data:'tradePair'},
					],
					// "order": [[1, 'asc']],
					"createdRow": function( row, data, dataIndex){
						// var options = {
						// 	month: '2-digit',
						// 	year: 'numeric',
						//  	day:'2-digit'
						// };

						// $(row).find("td:eq(3)").text(data['timestamp'].toLocaleDateString('en-US', options));

						// console.log(row, data, dataIndex);
		      	},
			    autoWidth: false
				});
			}
		}
	});

	$("#back_btn_contract").on('click', function(){
		$("#main_modal_container").toggle();
		$("#contract_transactions_modal_container").toggle();
	});

	$("#topUp_transactions_btn").on('click',function(){
		$("#loading").toggle();

		setTimeout(function(){
			$.when(loadTransaction()).then(function(){
				$("#main_modal_container").toggle();
				$("#topup_transactions_modal_container").toggle();
				$("#loading").toggle();
			});
		}, 1000);

		function loadTransaction(){
			var contractTransaction = ajaxShortLink("test-platform/getUserBuyHistory",{
				"userID" : selectedData.userID
			})

			loadDatatable(contractTransaction)

			function loadDatatable(dataRes){
				console.log(dataRes);

				$('#topUp_tbl').DataTable().destroy();

				var dt = $('#topUp_tbl').DataTable({
					data: dataRes,
					columns: [
						{ data:'token'},
						{ data:'amountBought'},
						{ data:'amountPaid'},
						{ data:'dateCreated'},
					],
					"order": [[3, 'desc']],
					"createdRow": function( row, data, dataIndex){
						// var options = {
						// 	month: '2-digit',
						// 	year: 'numeric',
						//  	day:'2-digit'
						// };

						// $(row).find("td:eq(3)").text(data['timestamp'].toLocaleDateString('en-US', options));

						// console.log(row, data, dataIndex);
		      		},
			    	autoWidth: false
				});
			}
		}
	});

	$("#back_btn_topup").on('click', function(){
		$("#main_modal_container").toggle();
		$("#topup_transactions_modal_container").toggle();
	});


	

	
</script>