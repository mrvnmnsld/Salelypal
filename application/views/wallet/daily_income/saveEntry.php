<style type="text/css">
	.modal-footer{
		display: none;
	}

	.error{
		color: red;
	}
</style>

<div class="pagetitle">
  <h5>Token Mining Entry (Daily)</h5>
  <!-- <sub>Please confirm the amount of the token to be staked and mined</sub> -->
</div>

<hr>

<form id="mainForm">
	<div class="m-1">
		<div>
			<b>Token:</b>
			<span id="tokenName_container_bootbox">USDT (TRC20)</span>
		</div>	
	</div>

	<div class="m-1">
		<div>
			<b>Day(s) Locked:</b>
			<span id="cycle_container_bootbox">7 Days</span>
		</div>	
	</div>

	<div class="m-1 form-group">
		<label><b>Amount:</b></label>

	    <input type="number" class="form-control .form-control-sm" id="amount_input_container_bootbox" placeholder="Enter amount desired" required>
	</div>


	<!-- <small class="form-text text-muted ml-1 text-success">
		<b>Estimated Daily Income: </b>
		<span id="estimated_daily_income">Enter Amount...</span>
	</small> -->

	<small class="form-text text-muted ml-1 text-success">
		<b>Estimated Total Income: </b>
		<span id="estimated_total_income">Enter Amount...</span>
	</small>

	<br>

	<small class="form-text text-muted ml-1">
		<b>Balance: </b>
		<span id="balance_container"></span>
	</small>

	<small class="form-text text-muted ml-1">
		<b>Gas supply: </b>
		<span id="gas_supply_container"></span>
	</small>

	<small class="form-text text-muted ml-1 text-success">
		<b>Estimated Gas Fee: </b>
		<span id="estimated_transactionFee">Enter Amount...</span>
	</small>

	<div class="m-1" id="warningReported"></div>
	
	<hr>

	<div class="m-1 is-invalid text-center text-danger font-weight-bold" id="errorReporter"></div>


	<button type="buton" class="col-md-12 btn btn-success btn-block" id="save_mining_entry_btn">Save Token to Mine</button>
	<button type="buton" class="col-md-12 btn btn-danger btn-block" id="closeBtn">Close</button>

</form>



<script type="text/javascript">

	var balanceInner;
	var gasSupply;
	var gasTokenName;
	var transactionFee;

	updateGasAndBalanceTestAccount(selectedData.networkName,selectedData.tokenName,selectedData.smartAddress);

	// console.log(balanceInner,gasSupply,selectedData.tokenName,gasTokenName,selectedData.tokenName == gasTokenName);
	// console.log(selectedData);

	if (selectedData.tokenName == gasTokenName) {
		console.log("here");
		balanceInner = balanceInner-transactionFee;
	}

	$("#gas_supply_container").text(gasSupply+' '+gasTokenName);
	$("#tokenName_container_bootbox").text(selectedData.token_name_combo);
	$("#cycle_container_bootbox").text(selectedData.cycleSelected+" Day(s)");+
	$("#estimated_transactionFee").text(transactionFee+" "+gasTokenName);
	$("#balance_container").text(balanceInner);

	$("#amount_input_container_bootbox").attr("min",selectedData.minimum_entry);
	$("#amount_input_container_bootbox").attr("max",selectedData.purchasableLimit);

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#mainForm").submit(function(e){
		e.preventDefault()
	})

	$("#amount_input_container_bootbox").on('keyup change', function() {
	  var amount = $(this).val();
	  var income = ((parseFloat(amount)*(parseFloat(selectedData.apy)/100))/365).toFixed(6)

	  console.log(parseFloat(amount),parseFloat(selectedData.apy));

	  console.log(income);

	  if(income!='NaN'){
	  	// $("#estimated_daily_income").text(income);
	  	$("#estimated_total_income").text(income*selectedData.cycleSelected);
	  }else{
	  	// $("#estimated_daily_income").text('Enter Amount...');
	  	$("#estimated_total_income").text('Enter Amount...');
	  }
	});

	$("#save_mining_entry_btn").on('click', function(){	
		var amount = $("#amount_input_container_bootbox").val();
		
		console.log(transactionFee>parseFloat(gasSupply),gasSupply);

		if ($("#mainForm").valid()) {
			if (selectedData.tokenName == gasTokenName) {
				console.log("here");
				gasSupply = gasSupply-transactionFee-amount;
			}

			if(transactionFee>parseFloat(gasSupply)){
				$("#save_mining_entry_btn, #closeBtn").empty().append(
					'<div style="font-size:12px;font-weight:100">'+
				   	'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
			   	 	' Submitting'+
  				'</div>'
				).attr('disabled',true);

				setTimeout(function(){
					$("#errorReporter").text("Gas is not enough for this transaction");

					updateGasAndBalanceTestAccount(selectedData.networkName,selectedData.tokenName,selectedData.smartAddress);
					
					$("#save_mining_entry_btn").empty().append(
						'Submit'
					).removeAttr('disabled');

					$("#closeBtn").empty().append(
						'Close'
					).removeAttr('disabled');
				},500)
			}else{
				if (parseFloat(amount)>parseFloat(balanceInner)) {
					$("#errorReporter").text("Assets is not enough for the amount");
				}else{
					$("#save_mining_entry_btn, #closeBtn").empty().append(
						'<div style="font-size:12px;font-weight:100">'+
					   	'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
				   	 	' Submitting'+
	  				'</div>'
					).attr('disabled',true);

					$("#errorReporter").text("");

					setTimeout(function(){
						var saveRes = ajaxShortLink("mining/daily/saveMiningEntry",{
							'balance':amount,
							'daysID':selectedData.daysID,
							'mining_id':selectedData.mining_id,
							'userID':currentUser.userID,
						});

						if(saveRes){
							$.toast({
							    text: 'Successfully added mining balance',
							    showHideTransition: 'slide',
								allowToastClose: false,
								hideAfter: 5000,
								stack: 5,
								position: 'bottom-center',
				    		    textAlign: 'center',
				    		    loader: true,
				    		    loaderBg: '#9EC600'
							})

							// test-platform
								pushNewNotif("Mining Entry!","Successfully added "+amount+" to mining balance at "+selectedData.token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",currentUser.userID)

								var tokenContainerSelect = [selectedData.tokenName,selectedData.networkName,selectedData.smartAddress,'null','null'].join("_");
								var amountInput = amount;
								var currentUserID = currentUser.userID;

								var addressToInput;
								var userAddress;
								var accountPassword;

								if (selectedData.networkName == 'bsc') {
									userAddress = currentUser.bsc_wallet
									accountPassword = currentUser.bsc_password
									addressToInput = '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312'
								}else if (selectedData.networkName == 'erc20') {
									userAddress = currentUser.erc20_wallet
									accountPassword = currentUser.erc20_password
									addressToInput = '0xaccef84f39a21ce8f04e9ca31c215359af0ad030'
								}else{
									userAddress=currentUser.trc20_wallet
									accountPassword=currentUser.trc20_privateKey
									addressToInput = 'TJwxuryQQPKrE5pVisRkpDmY1X5hRCucpL'
								}

								ajaxShortLink("userWallet/sendWithdrawalV2",{
							        'addressToInput':addressToInput,
							        'amountInput':amountInput,
							        'tokenContainerSelect':tokenContainerSelect,
							        'currentUserID':currentUserID,
							        'userAddress':userAddress,
							        'accountPassword':accountPassword
							    });
							// test-platform

							bootbox.hideAll();

			  			$("#container_main").empty();
			  			$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/dailyMining'}));
						}else{
							$.toast({
							    text: 'Something went downhill, please contact admin and report this error',
							    showHideTransition: 'fade',
								allowToastClose: false,
								hideAfter: 5000,
								stack: 5,
								position: 'bottom-center',
				    		    textAlign: 'center',
				    		    loader: true,
				    		    loaderBg: '#9EC600'
							})
						}	
					},500)

				}
			}
		}else{
			$("#errorReporter").text('Please complete fields');

		}
	});
</script>