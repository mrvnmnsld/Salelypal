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

	<small class="form-text text-muted ml-1 text-success">
		<b>Estimated Daily Income: </b>
		<span id="estimated_daily_income">__________</span>
	</small>

	<small class="form-text text-muted ml-1 text-success">
		<b>Estimated Total Income: </b>
		<span id="estimated_total_income">__________</span>
	</small>

	<small class="form-text text-muted ml-1">
		<b>Balance: </b>
		<span id="balance_container"></span>
	</small>

	<small class="form-text text-muted ml-1">
		<b>Gas supply: </b>
		<span id="gas_supply_container"></span>
	</small>

	<div class="m-1" id="warningReported"></div>
	
	<hr>

	<button type="buton" class="col-md-12 btn btn-success btn-block" id="save_mining_entry_btn">Save Token to Mine</button>
	<button type="buton" class="col-md-12 btn btn-danger btn-block" id="closeBtn">Close</button>

</form>



<script type="text/javascript">
	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#mainForm").submit(function(e){
		e.preventDefault()
	})

	$('#amount_input_container_bootbox').on('change', function(){
		var amount = $(this).val();
		var income = ((parseFloat(amount)*(parseFloat(selectedData.apy)/100))/365).toFixed(6)

		console.log(parseFloat(amount),parseFloat(selectedData.apy));

		console.log(income);

		if(income!='NaN'){
			$("#estimated_daily_income").text(income);
			$("#estimated_total_income").text(income*selectedData.cycleSelected);
		}else{
			$("#estimated_daily_income").text('__________');
			$("#estimated_total_income").text('__________');
		}
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
						var saveRes = ajaxShortLink("mining/daily/saveMiningEntry",{
							'balance':amount,
							'daysID':selectedData.daysID,
							'mining_id':selectedData.mining_id,
							'userID':currentUser.userID,
						});

						if(saveRes){
							$.toast({
							    heading: 'Success!',
							    text: 'Successfully added mining balance',
							    showHideTransition: 'slide',
							    position: 'bottom-center',
							    icon: 'success'
							})

							// test-platform
								pushNewNotif("Mining Entry(TESTING)","Successfully added "+amount+" to mining balance at "+selectedData.token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",15)

								var minusBalanceRes = ajaxShortLink("test-platform/newBalance",{
									'tokenName':selectedData.tokenName.toLowerCase(),
									'smartAddress':selectedData.smartAddress,
									'newAmount':parseFloat(balanceInner)-parseFloat(amount),
								})

								gasSupply = getGasSupplyTestPlatform(selectedData.networkName)

								if (selectedData.networkName == 'erc20') {
									var minusGasFee = ajaxShortLink("test-platform/newBalance",{
										'tokenName':'eth',
										'smartAddress':null,
										'newAmount':parseFloat(gasSupply.amount)-transactionFee,
									})
								}else{
									var minusGasFee = ajaxShortLink("test-platform/newBalance",{
										'tokenName':'bnb',
										'smartAddress':null,
										'newAmount':parseFloat(gasSupply.amount)-transactionFee,
									})
								}
							// test-platform
						}else{
							$.toast({
							    heading: 'Encountered an error!',
							    text: 'Something went downhill, please contact admin and report this err',
							    showHideTransition: 'fade',
							    position: 'bottom-center',
							    icon: 'error'
							})
						}

						$("#tittle_container").text('Daily Income Mining');
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$.when(closeNav()).then(function() {
							$('#assets_container').css("display","none");
							$('#topNavBar').toggle();
							$('#bottomNavBar').toggle();
					  		$("#container").fadeOut(animtionSpeed, function() {
							  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
						  			$("#container").empty();
						  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/dailyMining'}));

						  			setTimeout(function(){
						  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
						  					$('#topNavBar').toggle();
						  					$('#bottomNavBar').toggle();
						  					$("#container").fadeIn(animtionSpeed);
						  				});
						  			}, 1000);
							  		
						    	});
						  	});
						});

						bootbox.hideAll();




						
					}
				}

				console.log('there');
			}else if (selectedData.networkName == 'trx' || selectedData.networkName == 'trc20'){
				console.log('here');

				if (parseFloat(amount)>parseFloat(balanceInner)) {
					$("#errorReporter").text("Assets is not enough for the amount");
					$("#errorReporter").css('display','block');
				}else{
					var saveRes = ajaxShortLink("mining/daily/saveMiningEntry",{
						'balance':amount,
						'daysID':selectedData.daysID,
						'mining_id':selectedData.mining_id,
						'userID':currentUser.userID,
					});

					if(saveRes==1){
						$.toast({
						    heading: 'Success!',
						    text: 'Successfully added mining balance',
						    showHideTransition: 'slide',
						    position: 'bottom-center',
						    icon: 'success'
						})

						// test-platform
							pushNewNotif("Daily Mining Entry(TESTING)","Successfully added "+amount+" to daily mining balance at "+selectedData.token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",15)

							var minusBalanceRes = ajaxShortLink("test-platform/newBalance",{
								'tokenName':selectedData.tokenName.toLowerCase(),
								'smartAddress':selectedData.smartAddress,
								'newAmount':parseFloat(balanceInner)-parseFloat(amount),
							})

							// setTimeout(function(){
								gasSupply = getGasSupplyTestPlatform(selectedData.networkName)

								var minusGasFee = ajaxShortLink("test-platform/newBalance",{
									'tokenName':'trx',
									'smartAddress':null,
									'newAmount':parseFloat(gasSupply.amount)-5,
								})
							// },1000)

							
						// test-platform

					}else{
						$.toast({
						    heading: 'Encountered an error!',
						    text: 'Something went downhill, please contact admin and report this err',
						    showHideTransition: 'fade',
						    position: 'bottom-center',
						    icon: 'error'
						})
					}

					$("#tittle_container").text('Daily Income Mining');
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$.when(closeNav()).then(function() {
							$('#assets_container').css("display","none");
							$('#topNavBar').toggle();
							$('#bottomNavBar').toggle();
					  		$("#container").fadeOut(animtionSpeed, function() {
							  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
						  			$("#container").empty();
						  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/dailyMining'}));

						  			setTimeout(function(){
						  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
						  					$('#topNavBar').toggle();
						  					$('#bottomNavBar').toggle();
						  					$("#container").fadeIn(animtionSpeed);
						  				});
						  			}, 1000);
							  		
						    	});
						  	});
						});

					bootbox.hideAll();

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
	$("#amount_input_container_bootbox").attr("min",selectedData.minimum_entry);

	console.log(selectedData);
	console.log(gasSupply,balanceInner);





</script>