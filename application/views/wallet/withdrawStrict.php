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
  		font-size: 0.9em;
	}

	div.dataTables_paginate {text-align: center}
</style>

<div id="innerContainer" class="p-3">
	<!-- <div class="h3 text-danger text-center animate__flash animate__animated animate__infinite">Strict Mode Active</div> -->
	<div class="text-center mb-3 main-color-text display-4 mt-2">Withdrawal</div>

	<div id="successContainer" class="text-center" style="display: none;">
		<i style="font-size:150px" class="fa fa-check-circle-o text-success" aria-hidden="true"></i><br>
		<span style="font-size:30px" class="text-success">Success!</span>
		<br>

		<span>Transaction for withdrawal pending</span>

		<br>

		<span>Please wait while we review your withdrawal transactions for your asset's safety</span>
		
		<br>
		<hr>

		<button type="button" class="btn btn-block btn-danger" id="closeBtn_transaction">Close</button>

	</div>

	<form id="mainForm" style="display:;">
		<div class="mt-2">
	  		<small class="font-weight-bold main-color-text" style="font-size:1rem;">Available Amount on wallet: <span id="availableAmountContainer"></span></small>

			<div>
				<span class="font-weight-bold">Network:</span>
				<span id="network_container" class="main-color-text"></span>
			</div>

			<div class="form-group pt-2">

				<div class="main-color-text"><b>Select Token to withdraw:</b></div>

				<select class="form-control main-color-text" id="tokenContainerSelect" name="tokenContainerSelect">
					<option value="">Select Token...</option>
				</select>	
		  	</div>

			<div class="form-group">
				<div><b>Recieving Address:</b></div>

				<div class="input-group mb-3">
				  	<input class="form-control" id="addressToInput" name="addressToInput" placeholder="Enter Address">

				  	<div class="input-group-append">
				  		<button class="btn secondary-color-bg" type="button" id="scanner_btn" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;z-index: 0; color:white;">
				  			<i class="fa fa-qrcode" aria-hidden="true"></i>
				  		</button>
				  	</div>
				</div>
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

		<div class="row">
			<button type="submit" class="col-md-12 btn btn-success btn-block mx-3" id="confirmBtn">Send Widthrawal</button>
			<!-- <button type="button" class="col-md-12 btn btn-primary btn-block" id="view_pending_btn">View Pending Withdrawals</button> -->
		</div>
	</form>
</div>

<div class="px-3">
	<div class="card main-card-ui p-2 rounded shadow-lg">
	    <div class="text-center">
	        <h4>Pending Withdrawals</h4>
	        <small>Click row to view details</small>
	    </div>
	    <br>

	    <table id="tableContainer_pending" class="" style="width: 100%!important;">  
	        <thead>
	            <tr>
	                <th scope="col">ID</th>
	                <th scope="col">Token</th>
	                <th scope="col">Amount</th>
	                <!-- <th scope="col">Type</th> -->
	                <th scope="col">Date</th>
	            </tr>
	        </thead>
	    </table>
	</div>
</div>

<br>


<div class="px-3">
	<div class="card main-card-ui p-2 rounded shadow-lg">
	    <div class="text-center">
	        <h4>Withdrawal History</h4>
	        <small>Click row to view details</small>
	    </div>
	    <br>

	    <table id="tableContainer" class="" style="width: 100%!important;">  
	        <thead>
	            <tr>
	                <th scope="col">TX</th>
	                <th scope="col">Token</th>
	                <th scope="col">Amount</th>
	                <!-- <th scope="col">Type</th> -->
	                <th scope="col">Date</th>
	            </tr>
	        </thead>
	    </table>
	</div>
</div>

<script type="text/javascript">
	// var tokensSelected = ajaxShortLink('getAllTokens');
	var SelectedtransactionDetails;
	var gasTokenName, transactionFee, gasSupply;
	var balanceInner;
	loadDatatable();
	loadDatatablePending();

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

	for (var i = 0; i < tokensSelected.length; i++) {
		$("#tokenContainerSelect").append(
			'<option '+ 
				'value="'+tokensSelected[i].tokenName+'_'+tokensSelected[i].networkName+'_'+tokensSelected[i].smartAddress+'"'+
				'data-content="'+
					'<div class=&apos;mainTokenSelectedLogo&apos;>'+
						'<img style=&apos;width:30px;&apos; src=&apos;'+tokensSelected[i].tokenImage+'&apos;>'+
						'<span class=&apos;ml-3 text-dark&apos;>'+tokensSelected[i].description+' ('+tokensSelected[i].tokenName.toUpperCase()+')'+'</span>'+
					'</div>'+
				'"'+
			'</option>'
		);
	}

	$("#scanner_btn").on('click',function(){
		if(typeof isCordovaAndroid != 'undefined'){
			cordova.plugins.barcodeScanner.scan(
			   	function (result) {
			   		$("#addressToInput").val(result.text).change();
			   	},
			   	function (error) {
			       alert("Scanning failed: " + error);
			   	},
			   	{
			       preferFrontCamera : false, // iOS and Android
			       showFlipCameraButton : false, // iOS and Android
			       showTorchButton : false, // iOS and Android
			       torchOn: false, // Android, launch with the torch switched on (if available)
			       saveHistory: true, // Android, save scan history (default false)
			       prompt : "Scan QR code in the given space", // Android
			       resultDisplayDuration: 100, // Android, display scanned text for X ms. 0 suppresses it entirely, default 1500
			       formats : "QR_CODE,PDF_417", // default: all but PDF_417 and RSS_EXPANDED
			       orientation : "portrait", // Android only (portrait|landscape), default unset so it rotates with the device
			       disableAnimations : true, // iOS
			       disableSuccessBeep: false // iOS and Android
			   	}
			);
		}else{
			$.confirm({
				theme:"dark",
				icon: 'fa fa-pencil',
			    title: 'Something is up',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'This feature is only available in android version',
			    	buttons: {
			        confirm: function () {
			        	// $("#top_back_btn").click();
			        },
			    }
			});
		}
		
	});

	$("#tokenContainerSelect").selectpicker();

	$("#closeBtn_transaction").on('click',function(){
		// backButton();
	});

	$("#tokenContainerSelect").on('change', function(){
		var tokenInfoWithdraw = $(this).val().split("_");
		updateGasAndBalanceTestAccount($(this).val().split("_")[1],$(this).val().split("_")[0],$(this).val().split("_")[2])
		
		console.log(tokenInfoWithdraw)
		console.log(balanceInner,tokenInfoWithdraw);

		$("#availableAmountContainer").text(parseFloat(balanceInner).toFixed(4));

		if ($(this).val().split("_")[1] == 'trc20'||$(this).val().split("_")[1] == 'trx') {
			$("#warningReported").html("<b>Important Note:</b><br>TRC20 token/Tron Coin transfers will consume energy, if energy is insufficient, TRX will be burned. Please ensure you have more than enough TRX (gas is estimated from 5-9 TRX per transaction) to avoid transfer failure.<br><br> You may check TRC20 TRX Fee at <a href='https://tronstation.io/calculator' target='_blank'>Tronstation.io</a>");
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
	    	if (tokenNetworkSelected=='trx') {
	    		return (((parseFloat(gasSupply)+5)-value)>=5)
	    	}else{
	    		return (parseFloat(gasSupply)>=5&&balanceInner>=value)

	    	}
		}else if(tokenNetworkSelected=='bsc'){
			if(tokenSelected.toUpperCase() === 'bnb'.toUpperCase()){
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6);
				var valueWithFee = parseFloat(value)+parseFloat(transactionFee);

				$("#totalFee").remove();
				$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (parseFloat(valueWithFee)<=parseFloat(balanceInner))
			}else{
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6);
				
				$("#totalFee").remove();
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (parseFloat(transactionFee)<=parseFloat(gasSupply)&&balanceInner>=value)
			}
			
		}else if(tokenNetworkSelected=='erc20'){
			if(tokenSelected.toUpperCase() === 'eth'.toUpperCase()){
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6);
				var valueWithFee = parseFloat(value)+parseFloat(transactionFee);

				$("#totalFee").remove();
				$("#warningReported").append("<div id='totalFee'><b>Total Fee: </b><span class='text-warning'>"+valueWithFee+"</span><div>");
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (parseFloat(valueWithFee)<=parseFloat(balanceInner))
			}else{
				
				var transactionFee = estimateGasBsc(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6);
				
				$("#totalFee").remove();
				$("#warningReported").html("<b>Estimated Transaction Fee: </b><span class='text-warning' id='transactionFee'>"+transactionFee+" BNB</span>");

				return (parseFloat(transactionFee)<=parseFloat(gasSupply)&&balanceInner>=value)
			}
		}

	}, "Your balance is not enough or gas is not enough");

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
				//turn on if API paid
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

	  		var res = ajaxPostLink('userWallet/saveWithdrawalStrict',data);

	  		console.log(res);

	  		if (res) {
	  			var tokenNetworkSelected = $("#tokenContainerSelect").val().split("_")[1];

	  			$('#successContainer').toggle();
	  			$('#mainForm').toggle();

	  			// $('#amountSendContainer').text(res['amount']);
	  			// $('#addressSendContainer').text(res['to']);
	  			// $('#txidSendContainer').val(res['txid']);
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

	function loadDatatable(){
		var resWithdrawals = ajaxShortLink('userWallet/loadUserWithdrawal',{
			'userID':currentUser.userID
		});

        $('#tableContainer').DataTable().destroy();

        $('#tableContainer').DataTable({
            data: resWithdrawals,
	        "ordering": false,
	        "searching": true,
	        "bLengthChange": false,
            "bFilter": true,
            columns: [
                { data:'txid'},
                { data:'token',},
                { data:'amount'},
                { data:'timestamp'},
            ],
            "columnDefs": [
                // { "width": "50%", "targets": 0 },
                { "width": "5%", "targets": 2 },
                { "width": "5%", "targets": 3 },
                { "width": "5%", "targets": 1 },
                // {"className": "text-center", "targets": 2}
            ],
	        // "autoWidth": true,
	        // "order": [[ 0, "desc" ]],
	        // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>'
	    }).column( 0 ).visible(false);
    }

   	$('#tableContainer').on('click', 'tbody tr', function () {
	   	selectedData = $('#tableContainer').DataTable().row($(this)).data();
	   	console.log(selectedData);
	   	
	   	if (selectedData!=undefined) {
		    var transactionHash = selectedData.txid;
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

	function loadDatatablePending(){
		var resWithdrawals = ajaxShortLink('userWallet/loadUserWithdrawalPending',{
			'userID':currentUser.userID
		});

        $('#tableContainer_pending').DataTable().destroy();

        $('#tableContainer_pending').DataTable({
            data: resWithdrawals,
	        "ordering": false,
	        "searching": true,
	        "bLengthChange": false,
            "bFilter": true,
            columns: [
                { data:'id'},
                { data:'token',},
                { data:'amount'},
                { data:'timestamp'},
            ],
	    }).column( 0 ).visible(false);
    }

   	$('#tableContainer_pending').on('click', 'tbody tr', function () {
	   	selectedData = $('#tableContainer_pending').DataTable().row($(this)).data();
	   	console.log(selectedData);
	   	
	   	if (selectedData!=undefined) {
	   		bootbox.dialog({
	   			onEscape: false,
	   		    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdrawal/strictModeViewPendingTransaction'}),
	   		    size: 'large',
	   		    centerVertical: true,
	   		    closeButton: false,
	   		});
	   	}
     	
   	});



</script>