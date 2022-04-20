<style type="text/css">
	.modal-footer{
		display: none;
	}

	#qrcode img{
		/*border: solid 1px;*/
		outline: 2px solid black;
	  	outline-offset: 5px;
	}
</style>

<div class="h2 text-center">Transaction Details</div>


<form id="mainForm">
	<div class="">

		<div class="text-center text-primary">Scan this qr code to view transaction details</div>
		<div class="thumbnail d-flex justify-content-center m-3 pt-3 pb-3 img-thumbnail">
			<div id="qrcode"></div>
		</div>

		<div class="row">
			<div class="col-md-2 font-weight-bold"><b>Transaction type:</b></div>	
			<div class="col-md" id="typeContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-2 font-weight-bold"><b>Status:</b></div>	
			<div class="col-md" id="statusContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-2 font-weight-bold"><b>From:</b></div>	
			<div class="col-md" id="fromContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-2 font-weight-bold"><b>To:</b></div>	
			<div class="col-md" id="toContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-2 font-weight-bold"><b>Amount:</b></div>	
			<div class="col-md" id="amountContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-2 font-weight-bold"><b>Token:</b></div>	
			<div class="col-md" id="tokenNameContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-2 font-weight-bold"><b>Timestamp:</b></div>	
			<div class="col-md" id="timestampContainer"></div>	
		</div>
	</div>

	<hr>

	<div class="d-flex flex-row float-right">
		<a class="btn btn-success" id="viewInTronScan" href="" target="_blank">View in Tronscan.org</a>
		<!-- https://tronscan.org/#/transaction/6588a04ca8bff78053d824f561c451f01d04a004da74fce357b8423f2e91497e -->
		<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
	</div>
</form>

<script type="text/javascript">

	if (SelectedtransactionDetails.network == 'trx') {
		SelectedtransactionDetails = ajaxShortLinkNoParse('https://apilist.tronscan.org/api/transaction-info?hash='+SelectedtransactionDetails.transactionHash);
		
		console.log(SelectedtransactionDetails);


		var fromAddress;
		var toAddress;
		var transactionType;

		if (typeof SelectedtransactionDetails['trc20TransferInfo'] !== 'undefined') {
			$("#amountContainer").text(roundTron(SelectedtransactionDetails['trc20TransferInfo'][0].amount_str));
			$("#tokenNameContainer").text(SelectedtransactionDetails['trc20TransferInfo'][0].name);

			fromAddress = SelectedtransactionDetails['trc20TransferInfo'][0].from_address;
			toAddress = SelectedtransactionDetails['trc20TransferInfo'][0].to_address;

			if (SelectedtransactionDetails['trc20TransferInfo'][0].from_address ==currentUser['address']) {
				transactionType = 'Withrawal/Sending';
			}else{
				transactionType = 'Deposit/Receiving';
			}
		}else{
			$("#amountContainer").text(roundTron(SelectedtransactionDetails['contractData'].amount));
			$("#tokenNameContainer").text('TRX');

			fromAddress = SelectedtransactionDetails['contractData'].owner_address;
			toAddress = SelectedtransactionDetails['contractData'].to_address;

			if (SelectedtransactionDetails['contractData'].owner_address==currentUser['address']) {
				transactionType = 'Withrawal/Sending';
			}else{
				transactionType = 'Deposit/Receiving';
			}
		}

		new QRCode(document.getElementById("qrcode"),'https://tronscan.org/#/transaction/'+SelectedtransactionDetails['hash']);
		
		$("#fromContainer").text(fromAddress);
		$("#toContainer").text(toAddress);
		$('#typeContainer').text(transactionType);
		$("#viewInTronScan").attr('href','https://tronscan.org/#/transaction/'+SelectedtransactionDetails['hash']);
		$("#timestampContainer").text(unixTimeToDate13Char(SelectedtransactionDetails['timestamp']));
		$("#statusContainer").text(SelectedtransactionDetails['contractRet']);
	}else if(SelectedtransactionDetails.network == 'bsc'){
		var bscAddress = [];

		if(typeof selectedData == undefined){
			bscAddress[0] = {'address':selectedData.bsc_wallet};
		}else{
		 	bscAddress = ajaxPostLink('getAddressBSC',{'currentUser':currentUser['userID']});
		}

		new QRCode(document.getElementById("qrcode"),'https://bscscan.com/tx/'+SelectedtransactionDetails.transactionHash);
		$("#viewInTronScan").attr('href','https://bscscan.com/tx/'+SelectedtransactionDetails.transactionHash);

		$("#timestampContainer").text(unixTimeToDate13Char(SelectedtransactionDetails.timestamp));
		$("#statusContainer").text(SelectedtransactionDetails.result);
		$("#amountContainer").text(SelectedtransactionDetails.amount);
		$("#tokenNameContainer").parent('div.row').toggle();

		SelectedtransactionDetails = ajaxPostLink('getBscWalletTransactionDetails',{
			'transactionHash':SelectedtransactionDetails.transactionHash
		});

		$("#viewInTronScan").text('View in bscscan.com');

		$("#fromContainer").text(SelectedtransactionDetails.from);
		$("#toContainer").text(SelectedtransactionDetails.to);

		if (SelectedtransactionDetails.to==bscAddress[0].address) {
			$('#typeContainer').text("Deposit/Receiving");
		}else{
			$('#typeContainer').text("Withrawal/Sending");
		}

		console.log(SelectedtransactionDetails);
	}else if(SelectedtransactionDetails.network == 'ERC20'){
		var transactionType;
		new QRCode(document.getElementById("qrcode"),'https://etherscan.io/tx/'+SelectedtransactionDetails['hash']);

		var result = SelectedtransactionDetails['isDeposit'].includes("IN");

		if (result) {
			transactionType = 'Deposit/Receiving';
		}else{
			transactionType = 'Withrawal/Sending';
		}

		console.log(result);
		console.log(SelectedtransactionDetails);

		$("#viewInTronScan").attr('href','https://etherscan.io/tx/'+SelectedtransactionDetails.transactionHash);

		$("#viewInTronScan").text('View in Etherscan.io');


		$("#fromContainer").text(SelectedtransactionDetails.from);
		$("#toContainer").text(SelectedtransactionDetails.to);
		$("#timestampContainer").text(unixTimeToDate13Char(SelectedtransactionDetails['timestamp']));
		$('#typeContainer').text(transactionType);
		$("#statusContainer").toggle(); 
		$("#amountContainer").text(SelectedtransactionDetails.amount);
		$("#tokenNameContainer").text(SelectedtransactionDetails.token);

		// token
		// amount

	}


	$("#closeBtn").on('click',function(){
    	$('.bootbox.modal').modal('hide')
	});

</script>