<style type="text/css">
	.modal-footer{
		display: none;
	}

	.error{
		color: red;
	}

</style>

<div class="pagetitle">
  <h5>Token Mining Entry</h5>
  <sub>Please confirm the amount of the token to be staked and mined</sub>
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
			<b>Days Cycling:</b>
			<span id="cycle_container_bootbox">7 Days</span>
		</div>	
	</div>

	<div class="m-1">
		<div>
			<b>Maturity Income:</b>
			<span id="maturity_container_bootbox"></span>
		</div>	
	</div>

	<div class="m-1 form-group">
		<label><b>Amount:</b></label>

	    <input type="number" class="form-control .form-control-sm" id="amount_input_container_bootbox" placeholder="Enter amount desired" required>
	</div>	

	<div class="m-1 is-invalid" id="errorReporter" style="display:none"></div>

	<small class="form-text text-muted">
		Balance: 
		<span id="balance_container"></span>
	</small>

	<small class="form-text text-muted">
		Gas supply: 
		<span id="gas_supply_container"></span>
	</small>

	<div class="m-1" id="warningReported"></div>
</form>


<hr>

<button class="col-md-12 btn btn-success btn-block" id="save_mining_entry_btn">Save Token to Mine</button>
<button class="col-md-12 btn btn-danger btn-block" id="closeBtn">Close</button>

<script type="text/javascript">
	$("#amount_input_container_bootbox").attr("min",selectedData.minimum_entry);
	console.log(selectedData.minimum_entry,selectedData);
	var gasSupply;
	var gasTokenName;
	var balanceInner;
	var transactionFee;

	updateGasAndBalanceTestAccount(selectedData.networkName,selectedData.tokenName,selectedData.smartAddress);

	if (selectedData.tokenName == gasTokenName) {
		console.log("here");
		balanceInner = balanceInner-transactionFee;
	}


	$("#gas_supply_container").text(gasSupply+' '+gasTokenName);
	$("#tokenName_container_bootbox").text(selectedData.token_name_combo);
	$("#cycle_container_bootbox").text(selectedData.cycleSelected+" Day(s)");+
	$("#balance_container").text(balanceInner);

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
		selectedData = '';
	});

	$("#amount_input_container_bootbox").on('keyup change',function() {
	  var amount = $(this).val();
	  var apyDecimal = selectedData.apy/100;
	  var amountApy = amount*apyDecimal;
	  var maturity = ((amountApy/365)*selectedData.cycleSelected).toFixed(6);

	  $("#maturity_container_bootbox").text(maturity+" "+selectedData.token_name_combo);
	});

	$("#save_mining_entry_btn").on('click', function(){	
		var amount = $("#amount_input_container_bootbox").val();
		$("#errorReporter").css('display','none');

		

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

				$("#errorReporter").text("Gas is not enough for this transaction");

				setTimeout(function(){
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
					$("#errorReporter").css('display','block');
				}else{
					$("#save_mining_entry_btn, #closeBtn").empty().append(
						'<div style="font-size:12px;font-weight:100">'+
					   	'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
				   	 	' Submitting'+
	  				'</div>'
					).attr('disabled',true);

					setTimeout(function(){
						var saveRes = ajaxShortLink("mining/saveMiningEntry",{
							'balance':amount,
							'lock_period':selectedData.cycleSelected,
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
								pushNewNotif("Mining Entry","Successfully added "+amount+" to mining balance at "+token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",currentUser.userID)
								
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
			  			$("#container_main").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/regular_mining'}));
						}else{
							$.toast({
							    text: 'Something went downhill, please contact admin and report this err',
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

			console.log('there');

						
		}
	});

	$("#mainForm").submit(function(e){
		e.preventDefault()
	})

</script>