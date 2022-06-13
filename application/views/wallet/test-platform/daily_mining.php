<style type="text/css">
	.cardboxes{
		box-shadow: 3px 3px 3px 3px rgb(0 0 0 / 29%);
		ground-color: rgb(0, 0, 0, 0%)!important;
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
	Claim or Compound your mined tokens daily
</div>						 

<div id="token_mining_container" class="p-2"></div>

<script type="text/javascript">
	var selectedData;
	var miningSettings = ajaxShortLink('mining/daily/getDailySettings');
	var miningEntries = ajaxShortLink('mining/daily/getDailyEntries',{
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
		var apy = miningSettings[i].apy

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
							'openEntryForm("'+smartAddress+'","'+mining_id+'","'+token_name_combo+'","'+networkName+'","'+tokenName+'","'+apy+'")'+
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
			var claims = ajaxShortLink('mining/daily/getClaimEntriesByEntryID',{
				'entry_id':foundEntry.id
			});

			var balance = parseFloat(foundEntry.balance);
			var date_created = new Date(foundEntry.date_created);
			var releaseDate = date_created.addDays(parseInt(foundEntry.lock_period));
			var dailyIncome = ((balance*(parseFloat(miningSettings[i].apy)/100))/365)
			var timeAvailable = getTimeOnDateObject(foundEntry.date_created);
			var lock_period = foundEntry.lock_period;
			var claimsCount = claims.length;
			
			var daysUnclaimed = parseFloat(getNumberOfDays(foundEntry.date_created,getTimeDateV2()).diffInDays-claimsCount);
			var year = 365;

			var availableClaimCount = (balance*(parseFloat(apy)/100)/year) * daysUnclaimed;
			var incomeRaw = (balance*(parseFloat(apy)/100)/year);
			var isTimeAfterRes = isTimeAfter(foundEntry.date_created,getTimeDateV2());

			// console.table(balance,(parseFloat(apy)/100),year,daysUnclaimed);
			// console.table(availableClaimCount);

			// console.log(incomeRaw);
			// console.log(availableClaimCount);

			// console.log(claimsCount);
			// console.log(daysUnclaimed);

			$('#token_mining_container').append(
				'<div id="'+miningSettings[i].id+'_container" class="cardboxes p-2 mt-1">'+
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

					'<div class="ml-2">'+
						'<div>'+
							'<b>Mining Balance:</b> '+parseFloat(foundEntry.balance).toFixed(miningSettings[i].decimal)+
						'</div>'+

						'<div>'+
							'<b>Lock Period: </b>'+foundEntry.lock_period+
						'</div>'+

						'<div>'+
							'<b>Date Entry: </b>'+formatDateObject(new Date(foundEntry.date_created))+
						'</div>'+

						'<div>'+
							'<b>End of Mining: </b>'+formatDateObject(releaseDate)+
						'</div>'+

						'<div>'+
							'<b>To Claim/Compound Balance: </b>'+availableClaimCount.toFixed(miningSettings[i].decimal)+
						'</div>'+

						'<div>'+
							'<b>Daily Claim: </b>'+dailyIncome.toFixed(miningSettings[i].decimal)+
						'</div>'+

						'<div>'+
							'<b>Countdown: </b>'+
							'<span id="'+miningSettings[i].id+'_countdown">Countdown to claim: </span>'+
						'</div>'+
					'</div>'+


					'<div class="m-2 d-flex" id="'+miningSettings[i].id+'_button_container">'+
						'<button disabled type="button" class="btn btn-success flex-fill" id="'+miningSettings[i].id+'_mine_btn"  onClick='+
							'claimIncome("'+incomeRaw+'","'+mining_id+'","'+foundEntry.id+'","'+foundEntry.balance+'","'+networkName+'","'+tokenName+'","'+smartAddress+'","'+daysUnclaimed+'")'+
						'>Claim Daily Income</button>'+

						'<button disabled type="button" class="btn btn-success flex-fill ml-1" id="'+miningSettings[i].id+'_mine_compound_btn"  onClick='+
							'compoundIncome("'+incomeRaw+'","'+mining_id+'","'+foundEntry.id+'","'+foundEntry.balance+'","'+networkName+'","'+tokenName+'","'+smartAddress+'","'+daysUnclaimed+'")'+
						'>Compound Daily Income</button>'+
					'</div>'+
				'</div>'
			);

			if (releaseDate <= new Date()) {
				$("#"+mining_id+"_mine_btn").removeAttr('disabled')
				$("#"+mining_id+"_mine_compound_btn").removeAttr('disabled')
			}

			// console.log(date_created,new Date(),getNumberOfDays(date_created,new Date()).diffInDays != 0);

			if (isTimeAfterRes == true && getNumberOfDays(date_created,new Date()).diffInDays != 0 && daysUnclaimed != 0) {
				$("#"+mining_id+"_mine_btn").removeAttr('disabled')
				$("#"+mining_id+"_mine_compound_btn").removeAttr('disabled')
				$("#"+mining_id+"_countdown").text("Available now");
			}else{
				$("#"+mining_id+"_countdown").countdown("01/01/3000 "+timeAvailable, function(event) {
				  $(this).html(event.strftime('%H:%M:%S'));
				});
			}

			// if (foundEntry.isClaimableAdmin == 1) {
			// 	$("#"+mining_id+"_mine_btn").removeAttr('disabled')
			// 	$("#"+mining_id+"_mine_compound_btn").removeAttr('disabled')
			// 	$("#"+mining_id+"_countdown").text("Available now");

			// 	$('#'+miningSettings[i].id+'_mine_btn').attr('onClick','claimIncome("'+incomeRaw+'","'+mining_id+'","'+foundEntry.id+'","'+foundEntry.balance+'","'+networkName+'","'+tokenName+'","'+smartAddress+'","1")');

			// 	$('#'+miningSettings[i].id+'_mine_compound_btn').attr('onClick','claimIncome("'+incomeRaw+'","'+mining_id+'","'+foundEntry.id+'","'+foundEntry.balance+'","'+networkName+'","'+tokenName+'","'+smartAddress+'","1")');
			// }
		}
	}

	function openEntryForm(smartAddress,mining_id,token_name_combo,networkName,tokenName,apy){		
		selectedData = {
			'cycleSelected':$('input[name="'+mining_id+'_cycle_selector"]:checked').val(),
			'smartAddress':smartAddress,
			'mining_id':mining_id,
			'token_name_combo':token_name_combo,
			'networkName':networkName,
			'tokenName':tokenName,
			'apy':apy,
		}

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daily_income/saveEntry'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}

	function claimIncome(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress,daysUnclaimed){
		var res;

		for (var i = 0; i < daysUnclaimed; i++) {
			res = ajaxShortLink(url = 'mining/daily/claimIncome', data = {
				'entry_id':entry_id,
				'income':income,
			});
		}
    	
    	if(res==1){
    		$.toast({
    		    heading: 'Success!',
    		    text: 'Successfully claimed '+parseFloat(income)*daysUnclaimed+' '+tokenName.toUpperCase(),
    		    showHideTransition: 'slide',
    		    icon: 'success'
    		})

    		// test-platform
				var balanceInnerClaimIncome = parseFloat(getBalance(networkName,tokenName,smartAddress));
				var claimIncomeValue = parseFloat(balance)+parseFloat(income);

				console.log(income,balance,claimIncomeValue);

    			var resMinusBalance = ajaxShortLink(url = 'test-platform/newBalance', data = {
    				'newAmount':balanceInnerClaimIncome+parseFloat(income)*daysUnclaimed,
    				'smartAddress':smartAddress,
    				'tokenName':tokenName
    			});

				pushNewNotif("Claimed Mined Tokens (TESTING)","Successfully claimed "+claimIncomeValue+' '+tokenName.toUpperCase(),15)

				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daily_mining'}));

				  			setTimeout(function(){
				  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
				  					$('#topNavBar').toggle();
				  					$('#bottomNavBar').toggle();
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

	function compoundIncome(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress,daysUnclaimed){

		var res;

		for (var i = 0; i < daysUnclaimed; i++) {
			res = ajaxShortLink(url = 'mining/daily/compoundIncome', data = {
	    		'entry_id':entry_id,
	    		'income':income,
	    	});
		}
    	
    	if(res==1){
    		$.toast({
    		    heading: 'Success!',
    		    text: 'Successfully compounded '+parseFloat(income)*daysUnclaimed+' '+tokenName.toUpperCase(),
    		    showHideTransition: 'slide',
    		    icon: 'success'
    		})

    		// test-platform
				pushNewNotif("Compounded Mined Tokens (TESTING)","Successfully Compounded "+parseFloat(income)*daysUnclaimed+' '+tokenName.toUpperCase(),15)

				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daily_mining'}));

				  			setTimeout(function(){
				  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
				  					$('#topNavBar').toggle();
				  					$('#bottomNavBar').toggle();
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
    		    text: 'Error Compounding. Please contact ADMIN',
    		    showHideTransition: 'fade',
    		    icon: 'error'
    		})
    	}
	}
</script>