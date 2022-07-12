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
		border-color: transparent;
	}
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
		font-size:2em;
		opacity: 1 !important;
		-webkit-transition: color 1s, font-size .25s;
		-moz-transition: color 1s, font-size .25s;
		-o-transition: color 1s, font-size .25s;
		transition: color 1s, font-size .25s;

		border-color: transparent;
		background-color:transparent;

		padding-bottom: 5px;
		position: relative;
	}

	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active:before{
		content: "";
		position: absolute;
		width: 50%;
		height: 1px;
		bottom: 0;
		left: 25%;
		border-bottom: .2rem solid var(--minetab-color);
	}

	.dataTables_filter input {
	    width: 70%!important; 
	}
</style>

<style> /* dailymining_tab_container */
	#dailymining_tabs a{
		opacity: .5;
		-webkit-transition: color 2s, font-size .25s;
		-moz-transition: color 2s, font-size .25s;
		-o-transition: color 2s, font-size .25s;
		transition: color 2s, font-size .25s;
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
			<a id="mine_tab_id" class="nav-link active main-color-link " data-toggle="tab" href="#mine_tab">MINE</a>
		</li>

		<li class="nav-item">
			<a id="claim_tab_id" class="nav-link main-color-link " data-toggle="tab" href="#claim_tab">CLAIM</a>
		</li>
	</ul>	

	<div class="dailymining-tab-content tab-content">
		<div id="mine_tab" class="container tab-pane active"><br>

			<div id="daysBtn_container" class="container text-center mb-5" style="display:block;"></div>

			<div id="daily_mining_token_containers" style="display:none;">
				<!-- <button onclick="goback_btn()" style="color: #ff6f6f" class="btn btn-transparent" id="backbtn_container">
					<i class="fa fa-arrow-left" style="" aria-hidden="true"></i> 
					<b>Back to days</b>
				</button> -->  

				<div id="days_token_container"></div>
			</div>
		</div>

		<div id="claim_tab" class="tab-pane fade"><br>
			<!-- <div class="text-center">
				<h3>This part is still under development</h3>
			</div> -->

			<div id="claim_tokens_container" class="p-4"></div>
		</div>
	</div>
</div>

<div class="px-4">
	<div class="card main-card-ui p-2 rounded shadow-lg">
	    <div class="text-center">
	        <h4>Mining History</h4>
	    </div>

	    <table id="tableContainer" class="" style="width: 98%!important;font-size: .85em;">  
	        <thead>
	            <tr>
	                <th>ID</th>
	                <th>Token</th>
	                <th>Balance</th>
	                <th>Period</th>
	                <th>Status</th>
	            </tr>
	        </thead>
	    </table>
	</div>
</div>

<script> 
	var gasTokenName,transactionFee,gasSupply,balanceInner;

	var getDaysSettings = ajaxShortLink('mining/daily/getAddDays');
	for(var i = 0;i<getDaysSettings.length;i++){
        var getPurchasableLimit = ajaxShortLink('mining/daily/getPurchasableLimit',{
				'day': getDaysSettings[i].id
        });


        var ratioLimit =(getPurchasableLimit.totalBalance/getPurchasableLimit.totalLimit)*100;
        var isRatioEnough = "";

        if(ratioLimit>=100){
        	isRatioEnough = "disabled"
        }

		$('#daysBtn_container').append(
			'<div class="card p-2 mt-2 main-card-ui rounded shadow-lg">'+
				'<div class="card-body" style="padding: 1px!important">'+	
					'<div class="d-flex justify-content-around">'+
						'<div class="flex-even text-left h3 font-weight-bold main-color-text">'+
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

					'<div class="m-2 text-left main-color-text">'+
						'<b>Purchasable Limit: </b><span id="'+getDaysSettings[i].id+'_days_purchasable_limit_container">'+getPurchasableLimit.totalBalance.toFixed(2)+'/'+getPurchasableLimit.totalLimit.toFixed(2)+'</span>'+
					'</div>'+

					'<div class="mx-2">'+
						'<div class="progress">'+
							'<div class="progress-bar secondary-color-bg text-dark" id="'+getDaysSettings[i].id+'_days_progress_bar" style="width: '+ratioLimit.toFixed(2)+'%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+ratioLimit.toFixed(2)+'%</div>'+
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

            // console.log(getDayTokens);

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
                var purchasableLimit = getTokenBalanceLimit.totalLimit-getTokenBalanceLimit.totalBalance;
        		console.log(purchasableLimit);

                if(ratioLimit>=100){
                	isRatioEnough = "disabled"
                }

	            var token_name_combo = tokenInformation.tokenName+' ('+tokenInformation.network.toUpperCase()+')';

	            $("#days_token_container").append(
	                '<div id="'+tokenInformation.tokenName+'_container" class="card shadow-lg rounded p-2 mb-3 main-card-ui">'+
						'<div class="d-flex justify-content-around">'+
							'<div class="flex-even text-left h4 main-color-text">'+
								'<img '+
									'style="width: 35px;"'+
									'src="'+tokenInformation.tokenImage+'"'+
								'> '+
								token_name_combo+
							'</div>'+
						'</div>'+

						'<div class="m-2 text-left text-muted">'+
							'<b>Purchasable Limit: </b><span>'+getTokenBalanceLimit.totalBalance+'/'+getTokenBalanceLimit.totalLimit+'</span>'+
						'</div>'+

						'<div class="mx-2">'+
							'<div class="progress">'+
								'<div class="progress-bar secondary-color-bg text-dark" style="width: '+ratioLimit.toFixed(2)+'%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+ratioLimit.toFixed(2)+'%</div>'+
							'</div>'+
						'</div>'+

						'<div class="m-2">'+
							"<button type='button' class='btn btn-success btn-block' "+isRatioEnough+" "+isRatioEnough+" onClick='"+
								'openEntryForm("'+tokenInformation.smartAddress+'","'+getDayTokens[x].id+'","'+token_name_combo+'","'+tokenInformation.network+'","'+tokenInformation.tokenName+'","'+$(this).attr('apy')+'","'+$(this).attr('days')+'","'+$(this).attr('daysID')+'","'+getDayTokens[x].minimum_entry+'","'+purchasableLimit+'",this)'+
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

	var getAllEntries = ajaxShortLink('mining/daily/getAllEntries',{
		"userID":currentUser.userID
	});

	loadDatatable('',getAllEntries)

	// console.log(getAllEntries);

	if (getTokensToClaim.length >=1) {
		for(var i = 0;i<getTokensToClaim.length;i++){
	        // var token_name_combo = tokenInformation.tokenName+' ('+tokenInformation.network.toUpperCase()+')';
	        // console.log(getTokensToClaim[i]);

	        var isDisabled = "";

	        if (new Date(getTokensToClaim[i].date_release)<=new Date()) {
	        	isDisabled = "";
	        }else{
	        	isDisabled = "disabled"
	        }

	        // console.log(getTokensToClaim[i]);

	        $("#claim_tokens_container").append(
	            '<div id="'+getTokensToClaim[i].id+'_container" class="card main-card-ui shadow-lg rounded p-2 mb-3">'+
	            	'<div class="d-flex justify-content-around">'+
	            		'<div class="flex-even text-left h4 main-color-text">'+
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

	            	'<div class="ml-2 main-color-text">'+
	            		'<div>'+
	            			'<b>Mining Balance:</b> '+parseFloat(getTokensToClaim[i].balance.replace(/,/g, '')).toFixed(getTokensToClaim[i].decimal)+
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
	            			'claimIncome("'+getTokensToClaim[i].claimAmount+'","'+getTokensToClaim[i].id+'","hehe","'+getTokensToClaim[i].balance+'","'+getTokensToClaim[i].networkName+'","'+getTokensToClaim[i].tokenName+'","'+getTokensToClaim[i].smartAddress+'",this)'+
	            		'><span id="'+getTokensToClaim[i].id+'_countdown" data-countdown="'+formatDateObject24Hours(new Date(getTokensToClaim[i].date_release))+'">Countdown to claim: </span></button>'+
	            	'</div>'+
	            '</div>'
	        );

	        if (getTokensToClaim[i].isClaimableAdmin==1) {
	        	$('#'+getTokensToClaim[i].id+'_mine_btn').text("Claim Now!").removeAttr('disabled');
	        }


	        // console.log(formatDateObject24Hours(new Date(getTokensToClaim[i].date_created)));

	        
		}
	}else{
		$("#claim_tokens_container").append("<h3 class='text-center main-color-text'>Nothing to Claim</h3>");
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
					'<div class="text-left main-color-text" style="font-size:1em;">'+
						'<i class="fa fa-question-circle fa-inverse main-color-text" aria-hidden="true"></i>'+
						'<span> Help</span>'+
					'</div>'+
				
					'<img id="instruction_img" src="assets/imgs/instruction.png" class="d-inline-block align-top" alt="" loading="lazy">'+

					'<div id="process_instruction_container" class="text-justify mt-3 main-color-text">'+
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
		}).find('.modal-content').css({'border-radius':'5%'} );
	}

	function openEntryForm(smartAddress,mining_id,token_name_combo,networkName,tokenName,apy,cycleSelected,daysID,minimum_entry,purchasableLimit,element){	
		selectedData = {
			'cycleSelected':cycleSelected,
			'smartAddress':smartAddress,
			'mining_id':mining_id,
			'token_name_combo':token_name_combo,
			'networkName':networkName,
			'tokenName':tokenName,
			'apy':apy,
			'daysID':daysID,
			"minimum_entry":minimum_entry,
			"purchasableLimit":purchasableLimit
		}

		$(element).html(
			'<span class="spinner-border spinner-border-sm" role="status">'+
			  '<span class="sr-only">Loading...</span>'+
			'</span>'+
			"&nbsp Loading..."
		).attr("disabled",true);

		setTimeout(function(){
			$(element).text(
				'Mine Now!'
			).removeAttr("disabled");

			bootbox.alert({
				message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/daily_income/saveEntry'}),
				size: 'large',
				centerVertical: true,
				closeButton: false
			});
		},500)
	}

	function claimIncome(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress,daysUnclaimed,element){
		// updateGasAndBalanceTestAccount(networkName,tokenName,smartAddress);
		// console.log(transactionFee,gasSupply,balanceInner,element);

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#container').toggle();
		$('#topNavBar').toggle();
		$('#bottomNavBar').toggle();
		$('#header_inner_container').toggle();
		$('#main_btns_container').toggle();
		$("#loadSpinner").toggle()
		$("#loading_text_container").text("Claiming");

		setTimeout(function(){
			var claimIncomeValue = parseFloat(balance.replace(',', ''))+parseFloat(income.replace(',', ''));

			var	res = ajaxShortLink(url = 'mining/daily/claimIncome', data = {
				'mining_id':mining_id,
				'income':income,
			});

	    	if(res==1){
	    		// test-platform
					var amountInput = claimIncomeValue;
					var currentUserID = currentUser.userID;
					var network = networkName;
					var userId = 'main';

					var accountPassword = 'kurusaki13';
					var fromBscNetwork = '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312';
					var erc20_address = '0xaccef84f39a21ce8f04e9ca31c215359af0ad030';
					var addressToInput;

					if (networkName == 'bsc') {
						addressToInput = currentUser.bsc_wallet
					}else if (networkName == 'erc20') {
						addressToInput = currentUser.erc20_wallet
					}else{
						addressToInput = currentUser.trc20_wallet
					}

					var res = ajaxPostLink("mainWallet/sendWithdrawal",{
				        "addressToInput":addressToInput,
				        "amountInput":amountInput,
				        "network":network,
				        "tokenName":tokenName,
				        "smartAddress":smartAddress,
				        "accountPassword":accountPassword,
				        "userId":userId,
				        "fromBscNetwork":fromBscNetwork,
				        "erc20_address":erc20_address
				    });

				    console.log(res);

					pushNewNotif("Claimed Mined Tokens","Successfully claimed "+claimIncomeValue+' '+tokenName.toUpperCase(),currentUser.userID)
	    		// test-platform

	    		$.toast({
	    		    text: 'Successfully claimed '+claimIncomeValue+' '+tokenName.toUpperCase(),
	    		    showHideTransition: 'slide',
	    		    allowToastClose: false,
	     		    hideAfter: 5000,
	    		    stack: 5,
	    		    position: 'bottom-center',
	    		    textAlign: 'center',
	    		    loader: true,
	    		    loaderBg: '#9EC600' 
	    		})

				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/dailyMining'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
	    	}else{
	    		$.toast({
	    		    text: 'Error claiming. Please contact ADMIN',
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

	    	$("html, body").animate({ scrollTop: 0 }, "slow");
	    	$('#container').toggle();
	    	$('#topNavBar').toggle();
	    	$('#bottomNavBar').toggle();
	    	$('#header_inner_container').toggle();
	    	$('#main_btns_container').toggle();
	    	$("#loadSpinner").toggle()

	    	$("#loading_text_container").text("Loading");
		},1000)
	}

	function goback_btn(){
		$('#daysBtn_container').fadeIn('fast',function(){
			$('#daily_mining_token_containers').fadeOut();
		});
	}

	function updateGasAndBalanceTestAccount(networkName,tokenName,smartAddress){
		console.log(networkName,tokenName,smartAddress);
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
			console.log("HERE");


			gasSupply = ajaxShortLink('userWallet/getTronBalance',{
				"trc20Address":currentUser.trc20_wallet,
			})["balance"]

			if (smartAddress!='null') {
				console.log("HERE",smartAddress);

				balanceInner = ajaxShortLink('userWallet/getTRC20Balance',{
					"contractaddress":smartAddress,
					"trc20Address":currentUser.trc20_wallet,
				})["balance"]

				console.log("HERE",balanceInner);

			}else{
				console.log("THERE");

				balanceInner = ajaxShortLink('userWallet/getTronBalance',{
					"trc20Address":currentUser.trc20_wallet,
				})["balance"]
			}

		}

		console.log(gasTokenName,balanceInner,gasSupply);
	}

	function loadDatatable(url,data){
	    $('#tableContainer').DataTable().destroy();

	    $('#tableContainer').DataTable({
	        data: data,
	        "ordering": false,
	        "bLengthChange": false,
            "bFilter": true,
	        columns: [
	            { data:'id'},
	            { data:'tokenName'},
	            { data:'balance'},
	            { data:'daysLock'},
	            { data:'status'},
	        ],
	        "autoWidth": true,
	        "order": [[ 0, "desc" ]],
	        "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "No Data Found",
                "info": "",
                "infoEmpty": "No records available",
                "infoFiltered": ""
            }
	        // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>'
	    }).column( 0 ).visible(false);
	}


	var mine_tab = document.getElementById('mine_tab');
		swipedetect(mine_tab, function(mine_tab_swipe){
			if (mine_tab_swipe =='left'){
				$('#claim_tab').tab('show'); 
				$('#mine_tab').removeClass('active');
				$('#mine_tab').addClass('hide');
				$('#claim_tab').addClass('active');

				$('#mine_tab_id').addClass('active');
				$('#claim_tab_id').removeClass('active');
			}
		});

	var claim_tab = document.getElementById('claim_tab');
	swipedetect(claim_tab, function(claim_tab_swipe){
		if (claim_tab_swipe =='right'){
			$('#mine_tab').tab('show'); 
			$('#claim_tab').removeClass('active');
			$('#claim_tab').addClass('hide');
			$('#mine_tab').addClass('active');

			$('#claim_tab_id').addClass('active');
			$('#mine_tab_id').removeClass('active');
		}
	});
</script>