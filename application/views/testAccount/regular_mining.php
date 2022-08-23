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
	    border: #1ca245!important;
	}

	input:checked + label {
	    /*background: red;*/
	    background: #94abef!important;
	    color: black;
	}

	label.btn{
		font-size: .7em;
	}

	.dark-mode label.btn{
	    color: white;
	}

	.dataTables_filter input {
	    width: 70%!important; 
	}
</style>

<div id="title_container" class="text-center" style="display:block">
	<div class="mt-3">
		<h5>Mine and Claim now!</h5>
	</div>
	<div class="text-muted mt-2 " style="font-size:.7em">
		<i onclick="how_compute_btn()" class="fa fa-question-circle"aria-hidden="true"></i>
		How do we compute this?
	</div>
</div>

<div id="token_mining_container" class="p-4"></div>

<style type="text/css">
    table.dataTable td, table.dataTable th{
      font-size: 0.8em;
    }

    .dataTables_paginate {
        float: ;
    }
    /*.dataTables_filter {
        float: left;
        display: none;
    }*/
    .dataTables_length {
        float:left;
    }
    .dataTables_info {
        float:;
    }
</style>

<div class="px-4">
	<div class="card main-card-ui p-2 rounded shadow-lg">
	    <div class="text-center">
	        <h4>Mining History</h4>
	    </div>

	    <table id="tableContainer" class="" style="width: 100%!important;">  
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

<script type="text/javascript">
	var selectedData;
	var balanceInner;
	var gasSupply;
	var gasTokenName;
	var transactionFee;

	var miningSettings = ajaxShortLink('test-account/getRegularMiningSettings');
	var miningEntries = ajaxShortLink('test-account/getMyMiningEntries',{
		'userID':currentUser.userID
	});

	var allMiningEntries = ajaxShortLink('test-account/getAllMiningEntries',{
		'userID':currentUser.userID
	});

	loadDatatable('',allMiningEntries)

	console.log(allMiningEntries);

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
				'<div id="'+miningSettings[i].id+'_container" class="card main-card-ui p-2 mt-2 rounded shadow-lg">'+
					'<div class="card-body" style="padding: 1px!important">'+
						'<div class="d-flex justify-content-around">'+
							'<div class="flex-even text-left h4 main-color-text">'+
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

						'<div class="font-weight-bold main-color-text">'+
							'Financial Cycles:'+
						'</div>'+

						'<div class="d-flex justify-content-around mt-1 main-color-text">'+
							'<div class="btn-group main-color-text" role="group" aria-label="Basic radio toggle button group" id="'+mining_id+'_cycle_container">'+
							'</div>'+
						'</div>'+

						'<div class="my-1">'+
							"<button type='button' class='btn btn-success btn-block' onClick='"+
								'openEntryForm("'+smartAddress+'","'+mining_id+'","'+token_name_combo+'","'+networkName+'","'+tokenName+'","'+miningSettings[i].apy+'","'+miningSettings[i].minimum_entry+'")'+
							"'>Mine Now!</button>"+
						'</div>'+
					'</div>'+
				'</div>'
			);

			var cycleContainer = miningSettings[i].cycle_day.split(",");

			for (var cycleCounter = 0; cycleCounter < cycleContainer.length; cycleCounter++) {
				$('#'+miningSettings[i].id+'_cycle_container').append(
			  		'<input type="radio" class="btn-check" value="'+cycleContainer[cycleCounter]+'" name="'+mining_id+'_cycle_selector" id="'+miningSettings[i].id+'_cycle_'+cycleContainer[cycleCounter]+'" checked> '+
				  	'<label class="btn btn-sm" for="'+miningSettings[i].id+'_cycle_'+cycleContainer[cycleCounter]+'">'+cycleContainer[cycleCounter]+' Day(s)</label>'
				);
			}

			// console.log(tokenName);c
		}else{
			var date_created = new Date(foundEntry.date_created);
			var releaseDate = date_created.addDays(parseInt(foundEntry.lock_period));

			var income = ((parseFloat(foundEntry.balance)*(parseFloat(miningSettings[i].apy)/100))/365)*parseFloat(foundEntry.lock_period)

			$('#token_mining_container').append(
				'<div id="'+miningSettings[i].id+'_container" class="card p-2 mt-2 rounded shadow-lg main-card-ui">'+
					'<div class="card-body" style="padding: 1px!important">'+
						'<div class="d-flex justify-content-around">'+
							'<div class="flex-even text-left h4 main-color-text">'+
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
							'<b>Claim Balance: </b>'+income.toFixed(miningSettings[i].decimal)+
						'</div>'+

						'<div>'+
							'<b>Date Enter: </b>'+formatDateObject(new Date(foundEntry.date_created))+
						'</div>'+

						'<div>'+
							'<b>Date of Claiming: </b>'+formatDateObject(releaseDate)+
						'</div>'+

						'<div class="my-1">'+
							'<button type="button" class="btn btn-success btn-block" id="'+miningSettings[i].id+'_mine_btn" disabled onClick='+
								'claimIncome("'+income+'","'+mining_id+'","'+foundEntry.id+'","'+foundEntry.balance+'","'+networkName+'","'+tokenName+'","'+smartAddress+'")'+
							'>Claim</button>'+
						'</div>'+
					'</div>'+
				'</div>'
			);

			// console.log(income);

			if (releaseDate <= new Date()) {
				$("#"+mining_id+"_mine_btn").removeAttr('disabled')
			}

			// console.log(foundEntry.isClaimableAdmin);

			if (foundEntry.isClaimableAdmin == 1) {
				$("#"+mining_id+"_mine_btn").removeAttr('disabled')
			}

			// END CONTINUE HERE
		}
	}

	function openEntryForm(smartAddress,mining_id,token_name_combo,networkName,tokenName,apy,minimum_entry){		
		selectedData = {
			'cycleSelected':$('input[name="'+mining_id+'_cycle_selector"]:checked').val(),
			'smartAddress':smartAddress,
			'mining_id':mining_id,
			'token_name_combo':token_name_combo,
			'networkName':networkName,
			'tokenName':tokenName,
			'apy' : apy,
			'minimum_entry' : minimum_entry
		}

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccount/regular_mining/saveEntry'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}

	function claimIncome(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress){
		console.log(networkName);

    	window.scrollTo(0, 0);
    	$('#container').toggle();
    	$('#topNavBar').toggle();
    	$('#bottomNavBar').toggle();
    	$('#header_inner_container').toggle();
    	$('#main_btns_container').toggle();
    	$("#loadSpinner").toggle()
    	$("#loading_text_container").text("Claiming");

    	var res = ajaxShortLink(url = 'test-account/claimLockTokensAndIncome', data = {
    		'entry_id':entry_id
    	});

    	var claimIncomeValue = parseFloat(balance)+parseFloat(income);

    	console.log(income,mining_id,entry_id,balance,networkName,tokenName,smartAddress,tokenName=="null");
    	console.log(claimIncomeValue);
    	console.log(balanceInner);
    	console.log(claimIncomeValue+parseFloat(balanceInner));

		setTimeout(function(){
	    	if(res==1){
				updateGasAndBalanceTestAccount(networkName,tokenName,smartAddress)

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

	    		// test-platform

	    			var indexToken;

					if (smartAddress=="null") {
						console.log("here");

						var minusBalance = ajaxShortLink("test-account/updateNewBalance",{
						   'userID':currentUser.userID,
						   'tokenName':tokenName,
						   'smartContract':null,
						   'balance':claimIncomeValue+parseFloat(balanceInner),
						})

						var object = tokensSelected.filter(function(item) { return item.smartAddress === null && item.tokenName === tokenName.toUpperCase(); });

						indexToken = tokensSelected.findIndex(x => x.id === object[0].id);

						console.log(object[0].id);
						console.log(indexToken);

					}else{
						console.log("there");

						var minusBalance = ajaxShortLink("test-account/updateNewBalance",{
						   'userID':currentUser.userID,
						   'tokenName':null,
						   'smartContract':smartAddress,
						   'balance':claimIncomeValue+parseFloat(balanceInner),
						})

						var object = tokensSelected.filter(function(item) { return item.smartAddress === smartAddress && item.tokenName === tokenName.toUpperCase(); });

						indexToken = tokensSelected.findIndex(x => x.id === object[0].id);

						console.log(object[0].id);
						console.log(indexToken);
					}

					if (indexToken!=-1) {
					    console.log(indexToken);
					    console.log(tokenBalance[indexToken]);
					    console.log(totalInUsd);

					    totalInUsd = totalInUsd-parseFloat(tokenBalance[indexToken])
					    console.log(totalInUsd);

					    loadTokenInfo(tokensSelected[indexToken]);
					    console.log(totalInUsd);

					    $("#totalInUsdContainer").html(numberWithCommas(totalInUsd.toFixed(2)));
					    $("#totalInUsdContainer").append(" "+displayCurrency.toUpperCase());
					}

					pushNewNotifTestAccount("Claimed Mined Tokens (TESTING)","Successfully claimed "+claimIncomeValue+' '+tokenName.toUpperCase(),currentUser.userID)

				    

					// updateGasAndBalanceTestAccount(networkName,tokenName,smartAddress)

					// if (networkName == 'erc20') {
					// 	console.log("test1");

					// 	var minusGasFee = ajaxShortLink("test-account/updateNewBalance",{
					// 	   'userID':currentUser.userID,
					// 	   'tokenName':'eth',
					// 	   'smartContract':null,
					// 	   'balance':parseFloat(gasSupply)-parseFloat(transactionFee),
					// 	})

					// }else if(networkName == 'bsc'){
					// 	var minusGasFee = ajaxShortLink("test-account/updateNewBalance",{
					// 	   'userID':currentUser.userID,
					// 	   'tokenName':'bnb',
					// 	   'smartContract':null,
					// 	   'balance':parseFloat(gasSupply)-transactionFee,
					// 	})
					// }else{
					// 	var minusGasFee = ajaxShortLink("test-account/updateNewBalance",{
					// 	   'userID':currentUser.userID,
					// 	   'tokenName':'trx',
					// 	   'smartContract':null,
					// 	   'balance':parseFloat(gasSupply)-transactionFee,
					// 	})
					// }

					$("#container").fadeOut(animtionSpeed, function() {
						$("#profile_btn").css('display',"none")
						$("#top_back_btn").css('display',"block")

			  			$("#container").empty();
			  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'testAccount/regular_mining'}));
			  			$("#container").fadeIn(animtionSpeed);
					});

					window.scrollTo(0, 0);
					$('#container').toggle();
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
					$('#header_inner_container').toggle();
					$('#main_btns_container').toggle();
					$("#loadSpinner").toggle()
					$("#loading_text_container").text("Claiming");
	    		// test-platform
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
		},1000)
    	
	}

	function how_compute_btn(){
		console.log('how_compute_btn clicked');
		bootbox.dialog({
			message: 
				'<div class="text-center">'+
					'<div class="text-left main-color-text" style="font-size:1em;">'+
						'<i class="main-color-text fa fa-question-circle fa-inverse" aria-hidden="true"></i>'+
						'<span> Usage</span>'+
					'</div>'+
				
					'<div id="process_instruction_container" class="text-justify mt-3 main-color-text">'+
							'Formula for Claiming the mined tokens:<br>'+
							'(Balance× APY)÷365×Financial cycle'+
					'</div>'+
				'</div>',

			size: 'medium',
			centerVertical: true
		}).find('.modal-content').css({'background-color': 'rgb(34 34 34)', color: '#D9E9E8','border-radius':'1%'} );
	}

	function updateGasAndBalanceTestAccount(networkName,tokenName,smartAddress){
		if (networkName == 'bsc') {
			gasTokenName="BNB";
			transactionFee=parseFloat(estimateGasBsc(21000,ajaxShortLink("userWallet/getBscGasPrice").gasprice).toFixed(6))

			gasSupply = ajaxShortLink('test-account/getBinancecoinBalance',{
				"userID":currentUser.userID,
			})["balance"]

			if (smartAddress!='null') {
				balanceInner = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
					"contractaddress":smartAddress,
					"userID":currentUser.userID,
				})["balance"]
			}else{
				balanceInner = ajaxShortLink('test-account/getBinancecoinBalance',{
					"userID":currentUser.userID,
				})["balance"]
			}

		}else if (networkName == 'erc20') {
			gasTokenName="ETH";
			transactionFee=parseFloat(estimateGasBsc(21000,ajaxShortLink("userWallet/getEthGasPrice").gasprice).toFixed(6))

			gasSupply = ajaxShortLink('test-account/getEthereumBalance',{
				"userID":currentUser.userID,
			})["balance"]

			if (smartAddress!='null') {
				balanceInner = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
					"contractaddress":smartAddress,
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

			if (smartAddress!='null') {
				balanceInner = ajaxShortLink('test-account/getTokenBalanceBySmartAddress',{
					"contractaddress":smartAddress,
					"userID":currentUser.userID,
				})["balance"]
			}else{
				balanceInner = ajaxShortLink('test-account/getTronBalance',{
					"userID":currentUser.userID,
				})["balance"]
			}

		}

		console.log(gasTokenName);
	}

	function loadDatatable(url,data){
	    $('#tableContainer').DataTable().destroy();

	    // $('#tableContainer').DataTable({
	    //     data: data,
	    //     "ordering": false,
	    //     "bLengthChange": false,
     //        "bFilter": true,
	    //     columns: [
	    //         { data:'id'},
	    //         { data:'tokenName'},
	    //         { data:'balance'},
	    //         { data:'lock_period'},
	    //         { data:'status'},
	    //     ],
	    //     "autoWidth": true,
	    //     "order": [[ 0, "desc" ]],
	    //     "language": {
	    //         "lengthMenu": "Display _MENU_ records per page",
	    //         "zeroRecords": "No Data Found",
	    //         "info": "",
	    //         "infoEmpty": "No records available",
	    //         "infoFiltered": ""
	    //     },
	    //     // "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>'
	    // }).column( 0 ).visible(false);

	    $('#tableContainer').DataTable({
	        data: data,
	        "ordering": false,
	        "searching": true,
	        "bLengthChange": false,
            "bFilter": true,
	        columns: [
	            { data:'id'},
	            { data:'tokenName'},
	            { data:'balance'},
	            { data:'lock_period'},
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

</script>