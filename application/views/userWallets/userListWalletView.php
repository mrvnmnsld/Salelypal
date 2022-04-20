<div class="pagetitle">
  <h1>User Wallet View</h1>
  <sub>Viewing of main wallet settings</sub>
</div>

<div id="main_modal_container">
	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">User ID:</label>
	  	<div class="col-md-9" id="userId_container">TEST </div>
	</div>	

	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Email:</label>
	  	<div class="col-md-9" id="email_container">TEST </div>
	</div>	

	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Strict Status:</label>
	  	<div class="col-md-9" id="strictStatus_container">TEST </div>
	</div>	

	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Tron Mainet wallet:</label>

	  	<div class="col-md-9">
	    	<div class="input-group-prepend">
		    	<input type="text" class="form-control form-control-sm" id="tron_wallet_container">
	      		<button class="btn btn-primary btn-sm" id="copy_tron_btn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Copy</button>
	    	</div>
		</div>
	</div>	

	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">BSC wallet:</label>

	  	<div class="col-md-9">
	    	<div class="input-group-prepend">
		    	<input type="text" class="form-control form-control-sm" id="bsc_wallet_container">
	      		<button class="btn btn-primary btn-sm" id="copy_bsc_btn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Copy</button>
	    	</div>
		</div>
	</div>

	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">ERC20 wallet:</label>

	  	<div class="col-md-9">
	    	<div class="input-group-prepend">
		    	<input type="text" class="form-control form-control-sm" id="erc20_wallet_container">
	      		<button class="btn btn-primary btn-sm" id="copy_erc20_btn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Copy</button>
	    	</div>
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
	  <!-- <button class="btn btn-primary"></div> -->
	</div>
</div>

<div id="second_page_modal_container" style="display:none">
	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-1 col-form-label fw-bold">TRX:</label>
	  	<div class="col-md pt-1" id="trx_balance_container">TEST </div>
	</div>	

	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-1 col-form-label fw-bold">USDT:</label>
	  	<div class="col-md pt-1" id="usdt_balance_container">TEST </div>
	</div>	

	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-1 col-form-label fw-bold">BNB:</label>
	  	<div class="col-md pt-1" id="bnb_balance_container">TEST </div>
	</div>	

	<!-- <div class="form-group">
  	<label for="inputEmail3" class="col-form-label fw-bold">Select which token to load:</label>
		<select class="form-control form-control-sm">
			<option>Select ...</option>
			<option>Token1</option>
			<option>Token1</option>
			<option>Token1</option>
		</select>
	</div> -->

	<!-- 	<div class="row mb-2">
	  	<label for="inputEmail3" class="col-sm-3 col-form-label fw-bold">Token selected:</label>
	  	<div class="col-md-9" id="selected_balance_container">TEST </div>
	</div>

	<div class="mb-1 font-weight-bold text-center">Options:</div> -->

	<div class="d-flex flex-column">
	  <button class="btn btn-success btn-sm mt-1" id="back_btn">Back to overview</button>
	  <!-- <button class="btn btn-primary"></div> -->
	</div>
</div>

<div id="third_page_modal_container" style="display:none">
	<div class="h2 text-center">Transaction history</div>
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
	  <button class="btn btn-success btn-sm mt-1" id="back_btn_transactions">Back to overview</button>
	  <!-- <button class="btn btn-primary"></div> -->
	</div>
</div>

<script type="text/javascript">
	console.log(selectedData);

	$("#userId_container").text(selectedData["userID"]);
	$("#email_container").text(selectedData["email"]);
	$("#tron_wallet_container").val(selectedData["bsc_wallet"]);
	$("#bsc_wallet_container").val(selectedData["trc20_wallet"]);
	$("#erc20_wallet_container").val(selectedData["erc20_wallet"]);

	if (selectedData["isStrict"] == 1) {
		$('#block_btn').addClass('disabled');
		$('#strictStatus_container').addClass('text-danger font-weight-bold');
		$('#strictStatus_container').text('Yes');
	}else{
		$('#strictStatus_container').text('No');
		$('#unblock_btn').addClass('disabled');
	}

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

	$("#view_balance_btn").on('click',function(){
		$("#loading").toggle()

		setTimeout(function(){
			$.when(loadBalances()).then(function(){
				$("#main_modal_container").toggle();
				$("#second_page_modal_container").toggle();
				$("#loading").toggle();
			});
		}, 1000);
	
		function loadBalances(){
			var trxValueNow = ajaxShortLink("main/getCurrentPrice",{'token':'TRX','currency':'USD'}).USD;
			var usdtValueNow = ajaxShortLink("main/getCurrentPrice",{'token':'USDT','currency':'USD'}).USD;
			var bnbValueNow = ajaxShortLink("main/getCurrentPrice",{'token':'BNB','currency':'USD'}).USD;

			var walletDetails = postShortLink('getAddressDetails',{'address':selectedData.trc20_wallet});
			var bnbBalance = weiToBnb(ajaxPostLink('getBscBalance',{'currentUser':selectedData.bsc_wallet}).result);
			var trxBalance = roundTron(searchObjectByValue(walletDetails['tokens'],'trx')['balance']).toFixed(2);
			var usdtBalance;

			
			console.log(walletDetails);

			if (searchObjectByValue(walletDetails['tokens'],"Tether USD")) {
				usdtBalance = roundTron(searchObjectByValue(walletDetails['tokens'],"Tether USD")['balance']).toFixed(2);
			}else{
				usdtBalance = 0.00;
			}

			console.log(trxBalance,usdtBalance,bnbBalance);

			$("#trx_balance_container").text(trxBalance+' With value of '+parseFloat(trxBalance*trxValueNow).toFixed(2));
			$("#usdt_balance_container").text(usdtBalance+' With value of '+parseFloat(usdtBalance*usdtValueNow).toFixed(2));
			$("#bnb_balance_container").text(bnbBalance+' With value of '+parseFloat(bnbBalance*bnbValueNow).toFixed(2));
		}
	});

	$("#back_btn").on('click', function(){
		$("#main_modal_container").toggle();
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