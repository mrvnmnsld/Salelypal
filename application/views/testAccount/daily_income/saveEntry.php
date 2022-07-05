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
		<span id="estimated_daily_income">Enter Amount...</span>
	</small>

	<small class="form-text text-muted ml-1 text-success">
		<b>Estimated Total Income: </b>
		<span id="estimated_total_income">Enter Amount...</span>
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

	var balanceInner;
	var gasSupply;
	var gasTokenName;
	var transactionFee;

	updateGasAndBalanceTestAccount()
	console.log(balanceInner,gasSupply);
	console.log(selectedData);

	$("#gas_supply_container").text(gasSupply+' '+gasTokenName);
	$("#tokenName_container_bootbox").text(selectedData.token_name_combo);
	$("#cycle_container_bootbox").text(selectedData.cycleSelected+" Day(s)");+
	$("#balance_container").text(balanceInner);
	$("#amount_input_container_bootbox").attr("min",selectedData.minimum_entry);

	$("#closeBtn").on('click', function(){
		bootbox.hideAll();
	});

	$("#mainForm").submit(function(e){
		e.preventDefault()
	})

	$("#amount_input_container_bootbox").on('keyup change', _.debounce(function() {
	  var amount = $(this).val();
	  var income = ((parseFloat(amount)*(parseFloat(selectedData.apy)/100))/365).toFixed(6)

	  console.log(parseFloat(amount),parseFloat(selectedData.apy));

	  console.log(income);

	  if(income!='NaN'){
	  	$("#estimated_daily_income").text(income);
	  	$("#estimated_total_income").text(income*selectedData.cycleSelected);
	  }else{
	  	$("#estimated_daily_income").text('Enter Amount...');
	  	$("#estimated_total_income").text('Enter Amount...');
	  }
	}, 250));

	$("#save_mining_entry_btn").on('click', function(){	
		var amount = $("#amount_input_container_bootbox").val();
		$("#errorReporter").css('display','none');

		if ($("#mainForm").valid()) {
			if (selectedData.networkName == 'bsc' || selectedData.networkName == 'erc20') {

				if(transactionFee>parseFloat(gasSupply.amount)){
					$("#errorReporter").text("Gas is not enough for this transaction");
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
							var saveRes = ajaxShortLink("test-account/daily/saveMiningEntry",{
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
									pushNewNotif("Mining Entry(TESTING)","Successfully added "+amount+" to mining balance at "+selectedData.token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",currentUser.userID)

									if (selectedData.smartAddress==null||selectedData.smartAddress=="null") {
										var minusBalance = ajaxShortLink("test-account/updateNewBalance",{
										   'userID':currentUser.userID,
										   'tokenName':selectedData.tokenName.toLowerCase(),
										   'smartContract':null,
										   'balance':parseFloat(balanceInner)-parseFloat(amount),
										})
										console.log("THERE");

									}else{
										var minusBalance = ajaxShortLink("test-account/updateNewBalance",{
										   'userID':currentUser.userID,
										   'tokenName':null,
										   'smartContract':selectedData.smartAddress,
										   'balance':parseFloat(balanceInner)-parseFloat(amount),
										})

										console.log("HERE");
									}

									updateGasAndBalanceTestAccount()

									if (selectedData.networkName == 'erc20') {
										console.log("test1");

										var minusGasFee = ajaxShortLink("test-account/updateNewBalance",{
										   'userID':currentUser.userID,
										   'tokenName':'eth',
										   'smartContract':null,
										   'balance':parseFloat(gasSupply)-parseFloat(transactionFee),
										})

									}else if(selectedData.networkName == 'bsc'){
										var minusGasFee = ajaxShortLink("test-account/updateNewBalance",{
										   'userID':currentUser.userID,
										   'tokenName':'bnb',
										   'smartContract':null,
										   'balance':parseFloat(gasSupply)-transactionFee,
										})
									}
								// test-platform

								bootbox.hideAll();

						  		$("#container").fadeOut(animtionSpeed, function() {
						  			$("#container").empty();
						  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'testAccount/dailyMining'}));
				  					$("#container").fadeIn(animtionSpeed);
							  	});
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
			}else if (selectedData.networkName == 'trx' || selectedData.networkName == 'trc20'){

				if(transactionFee>parseFloat(gasSupply.amount)){
					$("#errorReporter").text("Gas is not enough for this transaction");
					$("#errorReporter").css('display','block');
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
							var saveRes = ajaxShortLink("test-account/daily/saveMiningEntry",{
								'balance':amount,
								'daysID':selectedData.daysID,
								'mining_id':selectedData.mining_id,
								'userID':currentUser.userID,
							});

							if(saveRes==1){
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
									pushNewNotif("Daily Mining Entry(TESTING)","Successfully added "+amount+" to daily mining balance at "+selectedData.token_name_combo+" for "+selectedData.cycleSelected+" Day(s)",currentUser.userID)

									if (selectedData.smartAddress==null||selectedData.smartAddress=="null") {
										var minusBalance = ajaxShortLink("test-account/updateNewBalance",{
										   'userID':currentUser.userID,
										   'tokenName':selectedData.tokenName.toLowerCase(),
										   'smartContract':null,
										   'balance':parseFloat(balanceInner)-parseFloat(amount),
										})
										console.log("THERE");

									}else{
										var minusBalance = ajaxShortLink("test-account/updateNewBalance",{
										   'userID':currentUser.userID,
										   'tokenName':null,
										   'smartContract':selectedData.smartAddress,
										   'balance':parseFloat(balanceInner)-parseFloat(amount),
										})

										console.log("HERE");
									}
									
									updateGasAndBalanceTestAccount()

									var minusGasFee = ajaxShortLink("test-account/updateNewBalance",{
									   'userID':currentUser.userID,
									   'tokenName':'trx',
									   'smartContract':null,
									   'balance':parseFloat(gasSupply)-parseFloat(transactionFee),
									})

									bootbox.hideAll();

							  		$("#container").fadeOut(animtionSpeed, function() {
							  			$("#container").empty();
							  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'testAccount/dailyMining'}));
					  					$("#container").fadeIn(animtionSpeed);
								  	});
									
								// test-platform

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

				
			}
		}
	});

	function updateGasAndBalanceTestAccount(){
		if (selectedData.networkName == 'bsc') {
			gasTokenName="BNB";
			transactionFee=parseFloat(estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6))

			gasSupply = ajaxShortLink('test-account/getBinancecoinBalance',{
				"userID":currentUser.userID,
			})["balance"]

			if (selectedData.smartAddress!='null') {
				balanceInner = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
					"contractaddress":selectedData.smartAddress,
					"userID":currentUser.userID,
				})["balance"]
			}else{
				balanceInner = ajaxShortLink('test-account/getBinancecoinBalance',{
					"userID":currentUser.userID,
				})["balance"]
			}

		}else if (selectedData.networkName == 'erc20') {
			gasTokenName="ERC20";
			transactionFee=parseFloat(estimateGasBsc(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6))

			gasSupply = ajaxShortLink('test-account/getEthereumBalance',{
				"userID":currentUser.userID,
			})["balance"]

			if (selectedData.smartAddress!='null') {
				balanceInner = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
					"contractaddress":selectedData.smartAddress,
					"userID":currentUser.userID,
				})["balance"]
			}else{
				balanceInner = ajaxShortLink('test-account/getEthereumBalance',{
					"userID":currentUser.userID,
				})["balance"]
			}

		}else{
			gasTokenName="TRX";
			transactionFee=5;

			gasSupply = ajaxShortLink('test-account/getTronBalance',{
				"userID":currentUser.userID,
			})["balance"]

			if (selectedData.smartAddress!='null') {
				balanceInner = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
					"contractaddress":selectedData.smartAddress,
					"userID":currentUser.userID,
				})["balance"]
			}else{
				balanceInner = ajaxShortLink('test-account/getTronBalance',{
					"userID":currentUser.userID,
				})["balance"]
			}

		}
	}





</script>