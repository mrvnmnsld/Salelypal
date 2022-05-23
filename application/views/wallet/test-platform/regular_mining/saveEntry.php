<style type="text/css">
	.modal-footer{
		display: none;
	}

	.is-invalid{
		text-align: center;
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
	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#save_mining_entry_btn").on('click', function(){	
		var amount = $("#amount_input_container_bootbox").val();
		$("#errorReporter").css('display','none');

		if ($("#mainForm").valid()) {
			if (selectedData.networkName == 'bsc' || selectedData.networkName == 'erc20') {
				var transactionFee = parseFloat($('#transactionFee').text())

				if(transactionFee>parseFloat(gasSupply.amount)){
					$("#errorReporter").text("Gas is not enough for this transaction");
				}else{
					if (parseFloat(amount)>parseFloat(balanceInner)) {
						$("#errorReporter").text("Assets is not enough for the amount");
						$("#errorReporter").css('display','block');
					}else{
						var saveRes = ajaxShortLink("mining/saveMiningEntry",{
							'balance':amount,
							'lock_period':selectedData.cycleSelected,
							'mining_id':selectedData.mining_id,
							'userID':currentUser.userID,
						});

						if(saveRes){
							$.toast({
							    heading: 'Success!',
							    text: 'Successfully added mining balance',
							    showHideTransition: 'slide',
							    icon: 'success'
							})
						}else{
							$.toast({
							    heading: 'Encountered an error!',
							    text: 'Something went downhill, please contact admin and report this err',
							    showHideTransition: 'fade',
							    icon: 'error'
							})
						}

						// test-platform
							pushNewNotif("Mining Entry(TESTING)","Successfully added "+amount+" to mining balance at "+token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",15)

							var minusBalanceRes = ajaxShortLink("test-platform/minusBalance",{
								'tokenName':selectedData.tokenName.toLowerCase(),
								'smartAddress':selectedData.smartAddress,
								'newAmount':parseFloat(balanceInner)-parseFloat(amount),
							})

							gasSupply = getGasSupplyTestPlatform(selectedData.networkName)

							if (selectedData.networkName == 'erc20') {
								var minusGasFee = ajaxShortLink("test-platform/minusBalance",{
									'tokenName':'eth',
									'smartAddress':null,
									'newAmount':parseFloat(gasSupply.amount)-transactionFee,
								})
							}else{
								var minusGasFee = ajaxShortLink("test-platform/minusBalance",{
									'tokenName':'bnb',
									'smartAddress':null,
									'newAmount':parseFloat(gasSupply.amount)-transactionFee,
								})
							}

						// test-platform


						bootbox.hideAll();

						$.when(closeNav()).then(function() {
							$('#topNavBar').toggle();
					  		$("#container").fadeOut(animtionSpeed, function() {
							  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
						  			$("#container").empty();
						  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/regular_mining'}));

						  			setTimeout(function(){
						  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
						  					$('#topNavBar').toggle();
						  					$("#container").fadeIn(animtionSpeed);
						  				});
						  			}, 2000);
							  		
						    	});
						  	});
						});
					}
				}

				console.log('there');

			}else if (selectedData.networkName == 'trx' || selectedData.networkName == 'trc20'){
				console.log('here');

				if (parseFloat(amount)>parseFloat(balanceInner)) {
					$("#errorReporter").text("Assets is not enough for the amount");
						$("#errorReporter").css('display','block');
				}else{
					var saveRes = ajaxShortLink("mining/saveMiningEntry",{
						'balance':amount,
						'lock_period':selectedData.cycleSelected,
						'mining_id':selectedData.mining_id,
						'userID':currentUser.userID,
					});

					if(saveRes){
						$.toast({
						    heading: 'Success!',
						    text: 'Successfully added mining balance',
						    showHideTransition: 'slide',
						    icon: 'success'
						})
					}else{
						$.toast({
						    heading: 'Encountered an error!',
						    text: 'Something went downhill, please contact admin and report this err',
						    showHideTransition: 'fade',
						    icon: 'error'
						})
					}

					// test-platform
						pushNewNotif("Mining Entry(TESTING)","Successfully added "+amount+" to mining balance at "+token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",15)

						var minusBalanceRes = ajaxShortLink("test-platform/minusBalance",{
							'tokenName':selectedData.tokenName.toLowerCase(),
							'smartAddress':selectedData.smartAddress,
							'newAmount':parseFloat(balanceInner)-parseFloat(amount),
						})


						// setTimeout(function(){
							gasSupply = getGasSupplyTestPlatform(selectedData.networkName)

							var minusGasFee = ajaxShortLink("test-platform/minusBalance",{
								'tokenName':'trx',
								'smartAddress':null,
								'newAmount':parseFloat(gasSupply.amount)-5,
							})
						// },1000)

						
					// test-platform

					bootbox.hideAll();

					$.when(closeNav()).then(function() {
						$('#topNavBar').toggle();
				  		$("#container").fadeOut(animtionSpeed, function() {
						  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
					  			$("#container").empty();
					  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/regular_mining'}));

					  			setTimeout(function(){
					  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
					  					$('#topNavBar').toggle();
					  					$("#container").fadeIn(animtionSpeed);
					  				});
					  			}, 2000);
					    	});
					  	});
					});
				}
			}
		}
	});


	var balanceInner = getBalance(selectedData.networkName,selectedData.tokenName,selectedData.smartAddress);
	var gasSupply = getGasSupplyTestPlatform(selectedData.networkName);

	$("#gas_supply_container").text(gasSupply.amount+' '+gasSupply.gasTokenName);
	$("#tokenName_container_bootbox").text(selectedData.token_name_combo);
	$("#cycle_container_bootbox").text(selectedData.cycleSelected+" Day(s)");+
	$("#balance_container").text(balanceInner);

	console.log(selectedData);
	console.log(gasSupply,balanceInner);





</script>