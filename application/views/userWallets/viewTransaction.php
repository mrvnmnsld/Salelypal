<style type="text/css">
	.modal-footer{
		display: none;
	}
	#qrcode img{
		/*border: solid 1px;*/
		outline: 2px solid black;
	  	outline-offset: 5px;
	}
	#pagetitle_background{
		background: #293038;
		color: white;
	}
	#mainForm{
		background: rgba(0, 0, 0, .1);
		padding: 20px;
	}
</style>

<div id="pagetitle_background" class="text-center">
	<label class="h2 mt-1">Transaction Details</label><br>
	<label style="font-size: 1em;">Scan this qr code to deposit to your wallet</label>
</div>

<form id="mainForm">
	<div class="">

		<!-- <div class="text-center text-primary">Scan this qr code to view transaction details</div> -->
		<div class="thumbnail d-flex justify-content-center m-3 pt-3 pb-3">
			<div id="qrcode"></div>
		</div>

		<div class="row">
			<div class="col-md-3 font-weight-bold"><b>Transaction type:</b></div>	
			<div class="col-md" id="typeContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-3 font-weight-bold"><b>Status:</b></div>	
			<div class="col-md" id="statusContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-3 font-weight-bold"><b>From:</b></div>	
			<div class="col-md" id="fromContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-3 font-weight-bold"><b>To:</b></div>	
			<div class="col-md" id="toContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-3 font-weight-bold"><b>Amount:</b></div>	
			<div class="col-md" id="amountContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-3 font-weight-bold"><b>Token:</b></div>	
			<div class="col-md" id="tokenNameContainer"></div>	
		</div>

		<div class="row">
			<div class="col-md-3 font-weight-bold"><b>Timestamp:</b></div>	
			<div class="col-md" id="timestampContainer"></div>	
		</div>
	</div>

	<hr>

	<div class="d-flex flex-row-reverse">
		<button type="button" class="btn btn-danger ml-2" id="closeBtn">Close</button>
		<a class="btn btn-success" id="viewInTronScan" href="" target="_blank">View in Tronscan.org</a>
	</div>

</form>

<script type="text/javascript">
	if (SelectedtransactionDetails.network == 'trx') {
		SelectedtransactionDetails = ajaxShortLinkNoParse('https://apilist.tronscan.org/api/transaction-info?hash='+SelectedtransactionDetails.txid);
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

		new QRCode(document.getElementById("qrcode"),'https://bscscan.com/tx/'+SelectedtransactionDetails.txid);
		$("#viewInTronScan").attr('href','https://bscscan.com/tx/'+SelectedtransactionDetails.txid);

		$("#timestampContainer").text(unixTimeToDate13Char(SelectedtransactionDetails.timestamp));
		$("#amountContainer").text(SelectedtransactionDetails.amount);
		$("#tokenNameContainer").parent('div.row').toggle();

		SelectedtransactionDetails = ajaxPostLink('getBscWalletTransactionDetails',{
			'transactionHash':SelectedtransactionDetails.txid
		});

		if(SelectedtransactionDetails.ok == true){
			$("#statusContainer").text("Success");
		}else{
			$("#statusContainer").text("Fail");
		}



		$("#viewInTronScan").text('View in bscscan.com');
		$("#fromContainer").text(SelectedtransactionDetails.from);
		$("#toContainer").text(SelectedtransactionDetails.to);
		$('#typeContainer').text("Withrawal/Sending");
	
		console.log(SelectedtransactionDetails);
	}


	$("#closeBtn").on('click',function(){
    	$('.bootbox.modal').modal('hide');
	});

</script>