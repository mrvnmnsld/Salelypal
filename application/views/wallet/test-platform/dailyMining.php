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

	#instruction_img{
		height:100%;
		width:100%;
		margin-top:2em;
	}

	#dailymining_tabs a{
				color: #777;
			}
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
		font-size:1.3em;
		color:black!important;
		background-color:rgba(0,0,0,.03);
		border-color: transparent;
	}


</style>

<div id="title_container" class="text-center" style="display:block">
	<div class="mt-3">
		<h5>Obtain rewards or earn interest!</h5>
	</div>
	<div class="text-muted mt-2 " style="font-size:.7em">
		<i onclick="instruction_btn()" class="fa fa-question-circle"aria-hidden="true"></i>
		Click here for detailed instructions
	</div>
</div>


<div id="dailymining_tab_container" class="mt-3">
	<ul id="dailymining_tabs" class="nav nav-tabs nav-justified" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#mine_tab">MINE</a>
		</li>

		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#claim_tab">CLAIM</a>
		</li>
	</ul>	

	<div class="dailymining-tab-content tab-content">
		<div id="mine_tab" class="container tab-pane active"><br>

			<div id="daysBtn_container" class="container text-center mb-5" style="display:block;"></div>

			<div id="daily_mining_token_containers" style="display:none;">
				<button onclick="goback_btn()" style="color: #ff6f6f" class="btn btn-transparent" id="backbtn_container">
					<i class="fa fa-arrow-left" style="" aria-hidden="true"></i> 
					<b>Previous page</b>
				</button>  

				<div id="days_token_container"></div>
			</div>
		</div>

		<div id="claim_tab" class="container tab-pane fade"><br>
			<!-- <div class="text-center">
				<h3>This part is still under development</h3>
			</div> -->

			<div id="claim_tokens_container"></div>
		</div>
	</div>
</div>

<script> 

	var getDaysSettings = ajaxShortLink('mining/daily/getAddDays');
	for(var i = 0;i<getDaysSettings.length;i++){

        var getPurchasableLimit = ajaxShortLink('mining/daily/getPurchasableLimit',{
				'day': getDaysSettings[i].id
        });

        // console.log(getPurchasableLimit);

        var ratioLimit =(getPurchasableLimit.totalBalance/getPurchasableLimit.totalLimit)*100;
        var isRatioEnough = "";

        if(ratioLimit>=100){
        	isRatioEnough = "disabled"
        }

		$('#daysBtn_container').append(
			'<div class="card p-2 mt-2 bg-light rounded shadow-lg">'+
				'<div class="card-body" style="padding: 1px!important">'+	
					'<div class="d-flex justify-content-around">'+
						'<div class="flex-even text-left h3 font-weight-bold text-dark">'+
							+getDaysSettings[i].days+' Days'+
						'</div>'+

						'<div class="flex-even text-right font-weight-bold text-success">APY: '+
							getDaysSettings[i].apy+'%'+
						'</div>'+
					'</div>'+

					'<div class="text-muted text-left" style="font-size:.7em">'+
						'Mining annualize rate of return'+
					'</div>'+

					'<hr class="w-100">'+

					'<div class="m-2 text-left">'+
						'<b>Purchasable Limit: </b><span id="'+getDaysSettings[i].id+'_days_purchasable_limit_container">'+getPurchasableLimit.totalBalance.toFixed(2)+'/'+getPurchasableLimit.totalLimit.toFixed(2)+'</span>'+
					'</div>'+

					'<div class="mx-2">'+
						'<div class="progress">'+
							'<div class="progress-bar" id="'+getDaysSettings[i].id+'_days_progress_bar" style="width: '+ratioLimit.toFixed(2)+'%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+ratioLimit.toFixed(2)+'%</div>'+
						'</div>'+
					'</div>'+

					'<div class="m-2">'+
						'<button id="'+getDaysSettings[i].id+'_days_btn" apy="'+getDaysSettings[i].apy+'" daysId="'+getDaysSettings[i].id+'" days="'+getDaysSettings[i].days+'" type="button" class="btn btn-success btn-block btn-sm" style="min-width:12em;">'+
						'Participate now!</button>'+
					'</div>'+
				'</div>'+
			'</div>'
		);
	    
	    $('#'+getDaysSettings[i].id+'_days_btn').on('click',function(){

	        var getDayTokens = ajaxShortLink('mining/daily/getDayTokens',{
					'day': $(this).attr('daysId')
	        });

	        // console.log('TOKENS of daysId: '+$(this).attr('daysId'),getDayTokens);
	        
	        $('#daysBtn_container').fadeOut('fast',function(){
       	 		$('#daily_mining_token_containers').fadeIn();
	        });

	        $("#days_token_container").empty()

            console.log($(this).attr('apy'),$(this).attr('days'));


	        for(var x = 0;x<getDayTokens.length;x++){

	            var tokenInformation = ajaxShortLink('main/getTokenInfoViaID',{
	                    'tokenID': getDayTokens[x].token_id
	            });

                var getTokenBalanceLimit = ajaxShortLink('mining/daily/getTokenBalanceLimit',{
    				'day': $(this).attr('daysId'),
    				'mining_id': getDayTokens[x].id,
                });

                var ratioLimit =(getTokenBalanceLimit.totalBalance/getTokenBalanceLimit.totalLimit)*100;
                var isRatioEnough = '';

                if(ratioLimit>=100){
                	isRatioEnough = "disabled"
                }


	            var token_name_combo = tokenInformation.tokenName+' ('+tokenInformation.network.toUpperCase()+')';

	            $("#days_token_container").append(
	                '<div id="'+tokenInformation.tokenName+'_container" class="card shadow-lg rounded p-2 mb-3">'+
						'<div class="d-flex justify-content-around">'+
							'<div class="flex-even text-left h4 text-success">'+
								'<img '+
									'style="width: 35px;"'+
									'src="'+tokenInformation.tokenImage+'"'+
								'> '+
								token_name_combo+
							'</div>'+
						'</div>'+

						'<div class="m-2 text-left">'+
							'<b>Purchasable Limit: </b><span>'+getTokenBalanceLimit.totalBalance+'/'+getTokenBalanceLimit.totalLimit+'</span>'+
						'</div>'+

						'<div class="mx-2">'+
							'<div class="progress">'+
								'<div class="progress-bar" style="width: '+ratioLimit.toFixed(2)+'%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+ratioLimit.toFixed(2)+'%</div>'+
							'</div>'+
						'</div>'+

						'<div class="m-2">'+
							"<button type='button' class='btn btn-success btn-block' "+isRatioEnough+" "+isRatioEnough+" onClick='"+
								'openEntryForm("'+tokenInformation.smartAddress+'","'+getDayTokens[x].id+'","'+token_name_combo+'","'+tokenInformation.network+'","'+tokenInformation.tokenName+'","'+$(this).attr('apy')+'","'+$(this).attr('days')+'","'+$(this).attr('daysID')+'")'+
							"'>Mine Now!</button>"+
						'</div>'+
					'</div>'
	            );
	        }
    	});
	}

	var getTokensToClaim = ajaxShortLink('mining/daily/getTokensToClaim',{
		"userID":currentUser.userID
	});

	console.log(getTokensToClaim);


	for(var i = 0;i<getTokensToClaim.length;i++){
        // var token_name_combo = tokenInformation.tokenName+' ('+tokenInformation.network.toUpperCase()+')';
        console.log(getTokensToClaim[i]);

        var isDisabled = "";

        if (new Date(getTokensToClaim[i].date_release)<=new Date()) {
        	isDisabled = "";
        }else{
        	isDisabled = "disabled"
        }

        $("#claim_tokens_container").append(
            '<div id="'+getTokensToClaim[i].id+'_container" class="card shadow-lg rounded p-2 mt-3">'+
            	'<div class="d-flex justify-content-around">'+
            		'<div class="flex-even text-left h4 text-success">'+
            			'<img '+
            				'style="width: 35px;"'+
            				'src="'+getTokensToClaim[i].tokenImage+'"'+
            			'> '+
            			getTokensToClaim[i].tokenName+' ('+getTokensToClaim[i].networkName.toUpperCase()+')'+
            		'</div>'+

            		'<div class="flex-even text-right h5 text-success">APY: '+getTokensToClaim[i].apy+'%</div>'+
            	'</div>'+

            	'<div class="text-muted" style="font-size:.7em">'+
            		'Mining annualize rate of return'+
            	'</div>'+

            	'<div class="ml-2">'+
            		'<div>'+
            			'<b>Mining Balance:</b> '+parseFloat(getTokensToClaim[i].balance).toFixed(getTokensToClaim[i].decimal)+
            		'</div>'+

            		'<div>'+
            			'<b>Lock Period: </b>'+getTokensToClaim[i].daysLock+
            		'</div>'+

            		'<div>'+
            			'<b>Date Entry: </b>'+formatDateObject24Hours(new Date(getTokensToClaim[i].date_created))+
            		'</div>'+

            		'<div>'+
            			'<b>End of Mining: </b>'+formatDateObject24Hours(new Date(getTokensToClaim[i].date_release))+
            		'</div>'+

            		'<div>'+
            			'<b>To Claim/Compound Balance: </b>'+parseFloat(getTokensToClaim[i].claimAmount).toFixed(getTokensToClaim[i].decimal)+
            		'</div>'+
            	'</div>'+


            	'<div class="m-2 d-flex" id="'+getTokensToClaim[i].id+'_button_container">'+
            		'<button '+isDisabled+' type="button" class="btn btn-success btn-sm flex-fill" id="'+getTokensToClaim[i].id+'_mine_btn"  onClick='+
            			'claimIncome("'+getTokensToClaim[i].claimAmount+'","'+getTokensToClaim[i].id+'","hehe","'+getTokensToClaim[i].balance+'","'+getTokensToClaim[i].networkName+'","'+getTokensToClaim[i].tokenName+'","'+getTokensToClaim[i].smartAddress+'")'+
            		'><span id="'+getTokensToClaim[i].id+'_countdown" data-countdown="'+formatDateObject24Hours(new Date(getTokensToClaim[i].date_release))+'">Countdown to claim: </span></button>'+
            	'</div>'+
            '</div>'
        );

        console.log(formatDateObject24Hours(new Date(getTokensToClaim[i].date_created)));

        
	}

	$('[data-countdown]').each(function() {
	    var $this = $(this), finalDate = $(this).data('countdown');
	    // console.log(new Date(finalDate),new Date(),new Date(finalDate)>=new Date());
	    if(new Date(finalDate)>=new Date()){
	    	$this.countdown(finalDate, function(event) {
	    	    $this.html(event.strftime('Claim after %D day(s) and %H:%M:%S'));
	    	});
	    }else{
	    	$(this).parent("button").text("Claim Now!")
	    	// $(this).parent("button").empty()
	    	// $this.text("NOW!");
	    }

	});


	function instruction_btn(){
		console.log('instruction_btn clicked');
		bootbox.dialog({
			message: 
				'<div class="container text-center">'+
					'<div class="text-left" style="font-size:1em;">'+
						'<i class="fa fa-question-circle fa-inverse" aria-hidden="true"></i>'+
						'<span> Help</span>'+
					'</div>'+
				
					'<img id="instruction_img" src="assets/imgs/instruction.png" class="d-inline-block align-top" alt="" loading="lazy">'+

					'<div id="process_instruction_container" class="text-justify mt-3">'+
						'<span>Process for daily mining</span>'+
						'<ul>'+
							'<li>step 1 : choose prefered days</li>'+
							'<li>step 2 : choose desired token to mine</li>'+
							'<li>step 3 : participate</li>'+
						'</ul>'+
					'</div>'+
				'</div>',
				
			size: 'medium',
			centerVertical: true
		}).find('.modal-content').css({'background-color': 'rgb(34 34 34)', color: '#D9E9E8','border-radius':'5%'} );
	}

	function openEntryForm(smartAddress,mining_id,token_name_combo,networkName,tokenName,apy,cycleSelected,daysID){	
		selectedData = {
			'cycleSelected':cycleSelected,
			'smartAddress':smartAddress,
			'mining_id':mining_id,
			'token_name_combo':token_name_combo,
			'networkName':networkName,
			'tokenName':tokenName,
			'apy':apy,
			'daysID':daysID,
		}

		// console.log(smartAddress,mining_id,token_name_combo,networkName,tokenName,apy,cycleSelected);

		bootbox.alert({
			message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daily_income/saveEntry'}),
			size: 'large',
			centerVertical: true,
			closeButton: false
		});
	}

	function claimIncome(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress,daysUnclaimed){

		console.log(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress,daysUnclaimed);

		var	res = ajaxShortLink(url = 'mining/daily/claimIncome', data = {
			'mining_id':mining_id,
			'income':income,
		});
    	
    	if(res==1){
    		// test-platform
				var balanceInnerClaimIncome = parseFloat(getBalance(networkName,tokenName,smartAddress));
				var claimIncomeValue = parseFloat(balance.replace(',', ''))+parseFloat(income.replace(',', ''));

    			var resMinusBalance = ajaxShortLink(url = 'test-platform/newBalance', data = {
    				'newAmount':balanceInnerClaimIncome+claimIncomeValue,
    				'smartAddress':smartAddress,
    				'tokenName':tokenName
    			});

    			console.log(claimIncomeValue);

				pushNewNotif("Claimed Mined Tokens (TESTING)","Successfully claimed "+claimIncomeValue+' '+tokenName.toUpperCase(),15)
    		// test-platform

    		$.toast({
    		    heading: 'Success!',
    		    text: 'Successfully claimed '+claimIncomeValue+' '+tokenName.toUpperCase(),
    		    showHideTransition: 'slide',
    		    icon: 'success'
    		})

			$("html, body").animate({ scrollTop: 0 }, "slow");
			$.when(closeNav()).then(function() {
				$('#assets_container').css("display","none");
				$('#topNavBar').toggle();
				$('#bottomNavBar').toggle();
		  		$("#container").fadeOut(animtionSpeed, function() {
				  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
			  			$("#container").empty();
			  			// $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daily_mining'}));
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
    	}else{
    		$.toast({
    		    heading: 'Error',
    		    text: 'Error claiming. Please contact ADMIN',
    		    showHideTransition: 'fade',
    		    icon: 'error'
    		})
    	}
	}

	function goback_btn(){

		$('#daysBtn_container').fadeIn('fast',function(){
			$('#daily_mining_token_containers').fadeOut();
		});
	}

</script>