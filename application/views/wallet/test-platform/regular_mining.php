<style type="text/css">
	.cardboxes{
		box-shadow: 3px 3px 3px 3px rgb(0 0 0 / 29%);
		background-color: rgb(0, 0, 0, 0%)!important;
		color: black;
	}

	.flex-even{
		flex: 1 1 auto;
	}

	input[type=radio] {
	    visibility:hidden;
	}

	label {
	    cursor: pointer;
	}

	input:checked + label {
	    /*background: red;*/
	    background: #343a40;
	    color: white;
	}

	.btn-outline-dark{
		font-size: .7em;
	}
</style>

<div class="p-2">
	<b>Notes on usage:</b><br>
	Claiming mined tokens are computed by (Balance× APY)÷365×Financial cycle
</div>						 

<div id="token_mining_container" class="p-2"></div>

<script type="text/javascript">
	var selectedData;
	var miningSettings = ajaxShortLink('getRegularMiningSettings');
	var miningEntries = ajaxShortLink('mining/getMyMiningEntries',{
		'userID':currentUser.userID
	});

	// console.log(miningSettings);
	// console.log(miningEntries);

	for (var i = 0; i < miningSettings.length; i++) {
		var mining_id = miningSettings[i].id;
		var smartAddress = miningSettings[i].smartAddress;
		var token_name_combo = miningSettings[i].tokenName+' ('+miningSettings[i].network.toUpperCase()+')';
		var networkName = miningSettings[i].network;
		var tokenName = miningSettings[i].tokenName;
		var foundEntry = miningEntries.find(e => e.mining_id === mining_id)

		// console.log(tokenName);
		
		if (foundEntry == null) {
			$('#token_mining_container').append(
				'<div id="'+miningSettings[i].id+'_container" class="cardboxes p-2 mt-2">'+
					'<div class="d-flex justify-content-around">'+
						'<div class="flex-even text-left h4 text-success">'+
							'<img '+
								'style="width: 35px;"'+
								'src="'+miningSettings[i].tokenImage+'"'+
							'> '+
							token_name_combo+
						'</div>'+

						'<div class="flex-even text-right h5 text-success">APY: '+miningSettings[i].apy+'%</div>'+
					'</div>'+

					'<div class="text-muted" style="font-size:.7em">'+
						'Mining annualize rate of return'+
					'</div>'+

					'<div class="font-weight-bold">'+
						'Financial Cycles:'+
					'</div>'+

					'<div class="d-flex justify-content-around mt-1">'+
						'<div class="btn-group" role="group" aria-label="Basic radio toggle button group" id="'+mining_id+'_cycle_container">'+
						'</div>'+
					'</div>'+

					'<div class="m-2">'+
						"<button type='button' class='btn btn-warning btn-block' onClick='"+
							'openEntryForm("'+smartAddress+'","'+mining_id+'","'+token_name_combo+'","'+networkName+'","'+tokenName+'")'+
						"'>Mine Now!</button>"+
					'</div>'+
				'</div>'
			);

			var cycleContainer = miningSettings[i].cycle_day.split(",");

			for (var cycleCounter = 0; cycleCounter < cycleContainer.length; cycleCounter++) {
				$('#'+miningSettings[i].id+'_cycle_container').append(
			  		'<input type="radio" class="btn-check" value="'+cycleContainer[cycleCounter]+'" name="'+mining_id+'_cycle_selector" id="'+miningSettings[i].id+'_cycle_'+cycleContainer[cycleCounter]+'" checked> '+
				  	'<label class="btn btn-sm btn-outline-dark" for="'+miningSettings[i].id+'_cycle_'+cycleContainer[cycleCounter]+'">'+cycleContainer[cycleCounter]+' Day(s)</label>'
				);
			}

			// console.log(tokenName);c
		}else{
			var date_created = new Date(foundEntry.date_created);
			var releaseDate = date_created.addDays(parseInt(foundEntry.lock_period));

			var income = ((parseFloat(foundEntry.balance)*(parseFloat(miningSettings[i].apy)/100))/365)*parseFloat(foundEntry.lock_period)

			$('#token_mining_container').append(
				'<div id="'+miningSettings[i].id+'_container" class="cardboxes p-2 mt-2">'+
					'<div class="d-flex justify-content-around">'+
						'<div class="flex-even text-left h4 text-success">'+
							'<img '+
								'style="width: 35px;"'+
								'src="'+miningSettings[i].tokenImage+'"'+
							'> '+
							miningSettings[i].tokenName+' ('+miningSettings[i].network.toUpperCase()+')'+
						'</div>'+

						'<div class="flex-even text-right h5 text-success">APY: '+miningSettings[i].apy+'%</div>'+
					'</div>'+

					'<div class="text-muted" style="font-size:.7em">'+
						'Mining annualize rate of return'+
					'</div>'+

					'<div>'+
						'<b>Mining Balance:</b> '+foundEntry.balance+
					'</div>'+

					'<div>'+
						'<b>Cycle Days: </b>'+foundEntry.lock_period+
					'</div>'+

					'<div>'+
						'<b>Claim Balance when completed: </b>'+income.toFixed(miningSettings[i].decimal)+
					'</div>'+

					'<div>'+
						'<b>Date Enter: </b>'+formatDateObject(new Date(foundEntry.date_created))+
					'</div>'+

					'<div>'+
						'<b>Date of Claiming: </b>'+formatDateObject(releaseDate)+
					'</div>'+

					'<div class="m-2">'+
						'<button type="button" class="btn btn-success btn-block" id="'+miningSettings[i].id+'_mine_btn" disabled onClick='+
							'claimIncome("'+income+'","'+mining_id+'","'+foundEntry.id+'","'+foundEntry.balance+'","'+networkName+'","'+tokenName+'","'+smartAddress+'")'+
						'>Claim</button>'+
					'</div>'+
				'</div>'
			);

			console.log(income);

			if (releaseDate <= new Date()) {
				$("#"+mining_id+"_mine_btn").removeAttr('disabled')
			}

			console.log(foundEntry.isClaimableAdmin);

			if (foundEntry.isClaimableAdmin == 1) {
				$("#"+mining_id+"_mine_btn").removeAttr('disabled')
			}

			// END CONTINUE HERE
		}
	}

	function openEntryForm(smartAddress,mining_id,token_name_combo,networkName,tokenName){		
		selectedData = {
			'cycleSelected':$('input[name="'+mining_id+'_cycle_selector"]:checked').val(),
			'smartAddress':smartAddress,
			'mining_id':mining_id,
			'token_name_combo':token_name_combo,
			'networkName':networkName,
			'tokenName':tokenName,
		}

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/regular_mining/saveEntry'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}

	function claimIncome(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress){
    	var res = ajaxShortLink(url = 'mining/claimLockTokensAndIncome', data = {
    		'entry_id':entry_id
    	});

    	var claimIncomeValue = parseFloat(balance)+parseFloat(income);

    	console.log(res,income,mining_id,entry_id,balance,networkName,tokenName,smartAddress);
    	console.log(income,balance);

    	if(res==1){
    		$.toast({
    		    heading: 'Success!',
    		    text: 'Successfully claimed '+claimIncomeValue+' '+tokenName.toUpperCase(),
    		    showHideTransition: 'slide',
    		    icon: 'success'
    		})

    		// test-platform
				var balanceInnerClaimIncome = parseFloat(getBalance(networkName,tokenName,smartAddress));


    			var resMinusBalance = ajaxShortLink(url = 'test-platform/newBalance', data = {
    				'newAmount':balanceInnerClaimIncome+claimIncomeValue,
    				'smartAddress':smartAddress,
    				'tokenName':tokenName
    			});

				pushNewNotif("Claimed Mined Tokens (TESTING)","Successfully claimed "+claimIncomeValue+' '+tokenName.toUpperCase(),15)

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
    		// test-platform
    	}else{
    		$.toast({
    		    heading: 'Error',
    		    text: 'Error claiming. Please contact ADMIN',
    		    showHideTransition: 'fade',
    		    icon: 'error'
    		})
    	}

		
	}

	// $("#token_mine_btn").on('click',function(){
	// 	var selected = $('input[name="token_cycle_selector"]:checked').val();
	// 	console.log(selected);

	// 	bootbox.alert({
	// 	    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/regular_mining/saveEntry'}),
	// 	    size: 'large',
	// 	    centerVertical: true,
	// 	    closeButton: false
	// 	});
	// })
</script>