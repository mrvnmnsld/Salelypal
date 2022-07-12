<link href="assets/lib/DataTables/datatables.css" rel="stylesheet">
<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
<link href="assets/lib/DataTables/buttons.dataTables.min.css" rel="stylesheet">
<script src="assets/lib/DataTables/datatables.js"></script>
<script src="assets/lib/DataTables/datatables.min.js"></script>
<script src="assets/lib/DataTables/dataTables.responsive.min.js"></script>

<style type="text/css">
	button:focus { outline-style: none; }

	.box {
	  float: left;
	  height: 20px;
	  width: 20px;
	  margin-bottom: 15px;
	  border: 1px solid black;
	  clear: both;
	}

	.alert1{
		background-color: #FFC04C;
	}

	.alert2{
		background-color: #00b300;
	}

	.btn-secondary {
		margin-left: 3px!important;
	}

</style>

<div class="h2 text-center">Transaction history</div>
<div class="text-center">NOTE: Click row to view transaction details</div>

<table class="table table-striped table-bordered table-sm">
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

<script type="text/javascript">

	// ajaxShortLinkNoParse("https://api.etherscan.io/api?module=account&action=txlist&address=0xaccef84f39a21ce8f04e9ca31c215359af0ad030&startblock=0&endblock=99999999&page=1&offset=10&sort=asc&apikey=7AJHKDFIW1X4P795SGFNZPWH6XMW4TMCKH")

	// weiToBnb("103000351566000")

	

	// create bsc not only bnb token
	// set token base if contract address is not null from: "0xaccef84f39a21ce8f04e9ca31c215359af0ad030"


	var allTransactionArray = [];
	
	// $(document).ready(function(){

	var bscTransactions = ajaxPostLink('getBscWalletTransactions',{'userAddress':currentUser['bsc_wallet']})['result'];

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
			allTransactionArray.push({
				'token':bscTransactionsTokens[i].tokenSymbol,
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

	var erc20_transactions = ajaxShortLink("userWallet/getErc20Transactions",{'erc20_wallet':currentUser.erc20_wallet}); 
	// var erc20_transactions = ajaxShortLink("userWallet/getErc20Transactions",{
	// 	'erc20_wallet':'0xaccef84f39a21ce8f04e9ca31c215359af0ad030'
	// }); 
	// this is test

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
	// })


</script>
