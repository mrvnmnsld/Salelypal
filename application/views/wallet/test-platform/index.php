<!-- Author: Marvin Monsalud -->
<!-- Startdate: Dec 16 2021 -->
<!-- Email: marvin.monsalud.mm@gmail.com -->
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[LOCAL TEST] Security Wallet</title>

	<link rel="icon" type="image/png" href="assets/imgs/logo_main_no_text.png"/>
</head>

<!-- libraries needed -->
	<script src="assets/js/common.js"></script>
	<script src="assets/js/admin/common.js"></script>

	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link href="assets/css/simple-sidebar.css" rel="stylesheet">

	<link href="assets/lib/DataTables/datatables.css" rel="stylesheet">
	<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
	<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
	<link href="assets/lib/DataTables/buttons.dataTables.min.css" rel="stylesheet">

	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="assets/lib/DataTables/datatables.js"></script>
	<script src="assets/lib/DataTables/datatables.min.js"></script>
	<script src="assets/lib/DataTables/dataTables.responsive.min.js"></script>
	<script src="assets/lib/DataTables/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>


	<script src="assets/lib/js-toast-master/toast.min.js"></script>
	
	<script src="assets/lib/Chart.js/Chart.bundle.js"></script>

	<script src="assets/vendor/bootbox/bootbox.min.js"></script>

	<script src="assets/vendor/jquery-confirm/confirm.js"></script>
	<link href="assets/vendor/jquery-confirm/confirm.css" rel="stylesheet">

	<link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://use.fontawesome.com/568e202d1f.js"></script>

	<link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
	<script src="assets/vendor/bootstrap-select/dist/js/bootstrap-select.js"></script>

	<script src="assets/vendor/jquery/jquery.validate.min.js"></script>

	<script src="assets/vendor/jquery-toast-plugin-master/src/jquery.toast.js"></script>
	<link href="assets/vendor/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">

	<script src="assets/vendor/qrCode/qrcode.js"></script>

	<script src="https://www.paypal.com/sdk/js?client-id=Ae1RO9QQfdAmJZrIxgXzcETFNsdWxQj7LBAx8XCbA8JJ4mnwgyWvq9q7A5fVn_5m9NP9kQ3c2XwACrhr&disable-funding=credit,paylater"></script>


	<link rel="stylesheet" type="text/css" href="assets/vendor/slick-1.8.1/slick/slick.css"/>
	<script type="text/javascript" src="assets/vendor/slick-1.8.1/slick/slick.min.js"></script>
					
	

<!-- libraries needed -->

<!-- custom libraries -->
	<script src="assets/js/common.js"></script>
	<script src="assets/js/admin/common.js"></script>

	<link href="assets/css/sidenav.css" rel="stylesheet">
	<link href="assets/css/main_securitywalet.css" rel="stylesheet">

<!-- custom libraries -->

<!-- css -->
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');

		@font-face {
		  font-family: tron;
		  src: url('assets/fonts/tron.ttf')  format('truetype');
		}

		@font-face {
		  font-family:Agelast;
		  src: url('assets/fonts/Agelast.otf');
		}

		.btn-circle.btn-sm {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            font-size: 8px;
            text-align: center;
        }

        .btn-circle.btn-md {
            width: 50px;
            height: 50px;
            padding: 7px 10px;
            border-radius: 25px;
            font-size: 10px;
            text-align: center;
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 12px;
            text-align: center;
        }

        .btn:focus {
        	/*outline: none;*/
        	box-shadow: 0 0 0 0;
        }
	</style>
<!-- css -->

<body>
	<div id="loadSpinner" class="text-center text-primary" style="margin-top: 30vh;">
	  	<div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
	    	<span class="sr-only"></span>
	  	</div><br>
		<span class="font-weight-bold mt-2" id="loading_text_container" style="font-size: 30px;text-align: center;">Loading...</span>
	</div>

		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

			<!-- <a class="" href="#" id="profile_btn">Profile</a> -->
			<!-- <a class="" href="#" id="settings_btn">Settings</a> -->
			<!-- <a class="" href="#" id="buyCrypto_btn">Buy Crypto</a> -->
			<!-- <a class="" href="#" id="purchaseHistory_btn">Purchase History</a> -->
			<!-- <a class="" href="#" id="purchaseAppeals_btn">Purchase Appeals</a> -->
			<!-- <a class="" href="#" id="transactionHistory_btn">Transaction History</a> -->
			<!-- <a class="" href="#" id="deposit_btn">Deposit</a> -->
			<!-- <a class="" href="#" id="withdraw_btn">Withdraw</a> -->
			<!-- <a class="" href="#" id="exportWallet_btn">Export Wallet</a> -->
			<hr class="bg-light" style="width:60%">
	  		<!-- <a class="text-danger" href="#" id="logOut_btn">Logout</a> -->
		</div>

	<div id="topNavBar" style="display:none;">
		<span style="float: left;" onclick="backButton()"><i class="fa fa-home fa-lg" aria-hidden="true"></i></span>
		<span id="tittle_container" class="text-center font-weight-bold" data-page-url="wallet/index">Security Wallet</span>

		<span id="notif_btn" class="" style="float:right; " onclick="notif_btn()">
			<i id="notif_logo" class="fa fa-bell fa-md fa-inverse" style="color:#D9E9E8;" aria-hidden="true">
				<span id="notif_counter_number" style="font-size:.45em; right:.4em; top:1.5em; display:none" class="position-absolute badge bg-danger">0</span>
			</i>
		</span>

	</div>

	
	<div id="container" class="mb-5" style="display:none"> 
		<div class="m-2 text-left">
			<div class="h3 p-2 m-2 font-weight-bold text-center">
				<span class="h3">Total Asset in USD: </span> <br>
				<span id="totalInUsdContainer">Loading...</span>
			</div>	
		</div>

		<div id="btn_option_container" class="d-flex justify-content-center mt-1">
			<button id="deposit_btn_option" class="btn" style="background-color:transparent">
				<div class="btn btn-secondary btn-circle btn-md" style="font-size:1.5em;background-color: rgb(34 34 34);padding: 5px;">
					<i class="fa fa-arrow-circle-down fa-lg" aria-hidden="true"></i>
				</div>
				<div style="font-size:.8em">Deposit</div>
			</button>

			<button id="withdraw_btn_option" class="btn" style="background-color:transparent">
				<div class="btn btn-secondary btn-circle btn-md" style="font-size:1.5em;background-color: rgb(34 34 34);padding: 5px;">
					<i class="fa fa-arrow-circle-up fa-lg" aria-hidden="true"></i>
				</div>
				<div style="font-size:.8em">Withdraw</div>
			</button>

			<button id="buy_btn_option" class="btn" style="background-color:transparent">
				<div class="btn btn-secondary btn-circle btn-md" style="font-size:1.5em;background-color: rgb(34 34 34);padding: 5px;">
					<i class="fa fa-usd fa-lg" aria-hidden="true"></i>
				</div>
				<div style="font-size:.8em;">Purchase</div>
			</button>
		</div>
		

		<!-- <hr style="
		    height: 1.5px;
		    width: 100%;
		    background-color: #a0abaf;
		" class=""> -->

		<div id="tokenContainer">
			<div style="font-size: 2rem;;" class="text-center text-muted font-weight-bold mt-3 ">TOKENS</div>
		</div>

		<div class="d-flex justify-content-center fixed-bottom" style="border:2px solid; background: rgb(34 34 34);">
            <button id="addToken_btn" class="btn btn-outline-link btn-block text-white mt-2">
            	<i class="fa fa-sliders fa-lg" aria-hidden="true"></i>
				<div style="font-size:.8em; color:#D9E9E8;">Manage Tokens</div>
            </button>

            <button id="settings_btn" class="btn btn-outline-link btn-block text-white mt-2">
				<i class="fa fa-cog fa-lg" aria-hidden="true"></i>
				
				<div style="font-size:.8em; color:#D9E9E8;">Settings</div>
			</button>	
        </div>


	</div>			

	<script type="text/javascript">
		var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
		var animtionSpeed = 250;
		var	SelectedtransactionDetails = [];
		var totalInUsd = 0;
		// var walletDetails;
		// var trxBalance;
		// var usdtBalance;
		// var bscAddress;
		var balance = [];
		var clickContainer;
		var totalInUsd;
		var tokenLoadTimer;

		var tokensSelected = ajaxShortLink('userWallet/getAllSelectedTokensVer2',{'userID':currentUser['userID']});
		// console.log(tokensSelected);

		//initial
			var priceAlert = ajaxShortLink('userWallet/triggerPriceAlerts',{'userID':currentUser['userID']});
			var priceAlertTokensId = [];
			console.log(priceAlert);

			if(priceAlert.isAlert == 1){
				if(priceAlert.tokens!=""){
					priceAlertTokensId = priceAlert.tokens.split(',')
				}

			}	

			var initialNotifList = ajaxShortLink("getNewNotifs",{
				'userID':currentUser.userID
			});

			if(initialNotifList.length>=1){
				$("#new_notif_counter").text(initialNotifList.length);
			}

			const newNotifChecker = setInterval(function() {
			    var notifList = ajaxShortLink("getNewNotifs",{
			    	'userID':currentUser.userID
			    });

			    if(notifList.length>=1){
					$("#notif_counter_number").text(notifList.length);
					$("#notif_counter_number").addClass("animate__animated animate__heartBeat animate__repeat-2");
					$("#notif_counter_number").css("display", "block");
			    }

			    console.log(notifList);
			}, 15000);	
		//initial

		function checkValidityLocalStorageValidity(){
			console.log(currentUser.lastLoginDate);
		}

		$(document).ready(function(){
			console.time('loadTimer');

			$("#loading_text_container").text("Please wait");
			if (getLocalStorageByKey('currentUser')==null) {
				console.log("no active user");
				window.location.replace("index");
			}else{

				setTimeout(function(){
					$.when(loadSystem()).then(function(){
						$('#container').toggle();
						$('#loadSpinner').toggle();
						$('#topNavBar').toggle();

						$("#loading_text_container").text('Please Wait');
					});
				}, 500);

				setTimeout(function(){
					var i = 0;

					function myLoop() {
					  	tokenLoadTimer = setTimeout(function() {
						    if (i < tokensSelected.length) {
								loadTokenInfo(tokensSelected[i]);
								myLoop();
						    }else{
						  		$("#totalInUsdContainer").html(totalInUsd.toFixed(2));
						  		$("#totalInUsdContainer").prepend("$");
								console.timeEnd('loadTimer');
						    }

					    	i++;
					  	}, 200)
					}

					myLoop();
				}, 1000);	
			}	

				
		});

		// buttonEvents
			$('#deposit_btn, #deposit_btn_option').on('click',function(){
				clearTimeout(tokenLoadTimer);
				tokenLoadTimer
	    		//trackPages();
				$("#tittle_container").text('Deposit');

	        	$.when(closeNav()).then(function() {
	        		$('#topNavBar').toggle();
	          		$("#container").fadeOut(animtionSpeed, function() {
	        		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
	        	  			$("#container").empty();
	        	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/deposit'}));

	        		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
	        		  			$('#topNavBar').toggle();
	        		  			$("#container").fadeIn(animtionSpeed);
	        		  		});
	        	    	});
	        	  	});
	        	});
			});

			$('#withdraw_btn, #withdraw_btn_option').on('click',function(){
				clearTimeout(tokenLoadTimer);

				var res = ajaxPostLink(
					"userWallet/getCurrentUserStrictStatus",{
					'userID':currentUser.userID
				});

				if(res==1){
					$.alert({
					    icon: 'fa fa-warning',
					    title: 'Strict Mode',
					    // content: "We've flagged your wallet to strict mode. Please wait while our admins review your wallet history for your assets safety",
					    content: "We've flagged your wallet to strict mode. <br><br> All your withdrawals will be pending until all our admin approve your transactions",
					    type: 'red',
					});

					clearTimeout(tokenLoadTimer);
					$("#tittle_container").text('Withdraw');

			     	$.when(closeNav()).then(function() {
			     		$('#topNavBar').toggle();
			       		$("#container").fadeOut(animtionSpeed, function() {
			     		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
			     	  			$("#container").empty();
			     	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdrawStrict'}));

			     		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
			     		  			$('#topNavBar').toggle();
			     		  			$("#container").fadeIn(animtionSpeed);
			     		  		});
			     	    	});
			     	  	});
			     	});
				}else{
					
					$("#tittle_container").text('Withdraw');

			     	$.when(closeNav()).then(function() {
			     		$('#topNavBar').toggle();
			       		$("#container").fadeOut(animtionSpeed, function() {
			     		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
			     	  			$("#container").empty();
			     	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdraw'}));

			     		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
			     		  			$('#topNavBar').toggle();
			     		  			$("#container").fadeIn(animtionSpeed);
			     		  		});
			     	    	});
			     	  	});
			     	});
				}
			});

			$('#viewAllTransactions_btn').on('click',function(){
				clearTimeout(tokenLoadTimer);
				$("#tittle_container").text('Transaction History');
		    	$.when(closeNav()).then(function() {
		    		$('#topNavBar').toggle();
		      		$("#container").fadeOut(animtionSpeed, function() {
		    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
		    	  			$("#container").empty();
		    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewAllTransactions'}));

		    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
		    		  			$('#topNavBar').toggle();
		    		  			$("#container").fadeIn(animtionSpeed);
		    		  		});
		    	    	});
		    	  	});
		    	});
			});

			$('#buyCrypto_btn, #buy_btn_option').on('click',function(){
				$.confirm({
				    title: 'Testing Mode!',
				    content: 'Purchase is disabled due to testing mode being active in normal wallet. Please access Pro wallet to test purchase',
				    type: 'red',
				    typeAnimated: true,
				    buttons: {
				        close: function () {
				        }
				    }
				});
			});

			$('#purchaseHistory_btn').on('click',function(){
				clearTimeout(tokenLoadTimer);
				$("#tittle_container").text('Purchase History');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/purchaseHistory'}));

					  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
					  			$('#topNavBar').toggle();
					  			$("#container").fadeIn(animtionSpeed);
					  		});
				    	});
				  	});
				});
			});		

			$('#transactionHistory_btn').on('click',function(){
				// $("#tittle_container").text('Transaction History');
				clearTimeout(tokenLoadTimer);
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
					$("#container").fadeOut(animtionSpeed, function() {
						$("#loadSpinner").fadeIn(animtionSpeed,function(){
							bootbox.dialog({
							    title: '',
							    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewAllTransactions'}),
							    size: 'large',
							    centerVertical: true,
							});


							$("#loadSpinner").fadeOut(animtionSpeed,function(){
								$('#topNavBar').toggle();
								$("#container").fadeIn(animtionSpeed);
							});
					  	});
					});
				});
			});		

			$('#addToken_btn').on('click',function(){
				clearTimeout(tokenLoadTimer);
				$("#tittle_container").text('Token Management');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/addToken'}));

					  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
					  			$('#topNavBar').toggle();
					  			$("#container").fadeIn(animtionSpeed);
					  		});
				    	});
				  	});
				});
			});

			$('#purchaseAppeals_btn').on('click',function(){
				clearTimeout(tokenLoadTimer);
				$("#tittle_container").text('Purchase Appeals');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/purchaseAppeals'}));

					  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
					  			$('#topNavBar').toggle();
					  			$("#container").fadeIn(animtionSpeed);
					  		});
				    	});
				  	});
				});
			});		

			$('#future_btn').on('click',function(){
				clearTimeout(tokenLoadTimer);
				$("#tittle_container").text('Contract Trade');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/future'}));

				  			setTimeout(function(){
				  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
				  					$('#topNavBar').toggle();
				  					$("#container").fadeIn(animtionSpeed);
				  				});
				  			}, 2000);

					  		
				    	});
				  	});
				});
			});

			$('#rise_fall_btn').on('click',function(){
				clearTimeout(tokenLoadTimer);
				$("#tittle_container").text('Rise Fall');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/risefall'}));

				  			setTimeout(function(){
				  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
				  					$('#topNavBar').toggle();
				  					$("#container").fadeIn(animtionSpeed);
				  				});
				  			}, 2000);

					  		
				    	});
				  	});
				});
			});

			function notif_btn(){
				$("#notif_counter_number").text("");
				$("#notif_counter_number").removeClass("animate__animated animate__bounce animate__repeat-2");
				$("#notif_counter_number").css("display", "none");
				clearTimeout(tokenLoadTimer);
				clearTimeout(newNotifChecker);
				$("#tittle_container").text('Notification Center');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/notificationCenter'}));

				  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
				  					$('#topNavBar').toggle();
				  					$("#container").fadeIn(animtionSpeed);
				  				});
				    	});
				  	});
				});
			}

			$('#settings_btn').on('click',function(){
				clearTimeout(tokenLoadTimer);
				$("#tittle_container").text('Settings');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings'}));

			  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
			  					$('#topNavBar').toggle();
			  					$("#container").fadeIn(animtionSpeed);
			  				});
				    	});
				  	});
				});
			});

			

			
		// buttonEvents	

		function openNav(){
	  		document.getElementById("mySidenav").style.width = "102%";
	  		document.getElementById("mySidenav").style.width = "102%";
	  		document.getElementById("mySidenav").style.opacity = "1";
		}

		function closeNav(){
	  		document.getElementById("mySidenav").style.width = "0";
	  		document.getElementById("mySidenav").style.opacity = "0%";
		}

		function backButton(){
			window.location.href = 'test-platform';//local
		}

		function loadTokenInfo(tokenInfo){
			// console.time('loadTokenInfo');

			// console.log(tokenInfo);
			var differenceResponse = ajaxShortLink('userWallet/getTokenDifference',{'tokenName':tokenInfo.coingeckoTokenId});
			var valueNow = differenceResponse.market_data.current_price.usd
			var changePercentage = differenceResponse.market_data.price_change_percentage_24h;

			var balanceInner;
			var sign;
			var color;

			if (changePercentage>0) {
				sign = '+';
				color = 'text-success';
			}else if (changePercentage<0) {
				sign = '';
				color = 'text-danger';
			}else{
				sign = '';
				color = '';
			}

			if (tokenInfo.networkName == 'trx'||tokenInfo.networkName == 'trc20') {
				if (tokenInfo.tokenName.toUpperCase() === 'trx'.toUpperCase()) {
					balanceInner = ajaxShortLink('userWallet/getTronBalance',{
						'trc20Address':currentUser['trc20_wallet']
					})['balance'];			
				}else{
					balanceInner = ajaxShortLink('userWallet/getTRC20Balance',{
						'trc20Address':currentUser['trc20_wallet'],
						'contractaddress':tokenInfo.smartAddress,
					})['balance'];
				}
			}else if(tokenInfo.networkName =='bsc'){

				if(tokenInfo.tokenName.toUpperCase() === 'bnb'.toUpperCase()){

					balanceInner = ajaxShortLink('userWallet/getBinancecoinBalance',{
						'bsc_wallet':currentUser['bsc_wallet']
					})['balance'];

				}else{
					balanceInner = ajaxShortLink('userWallet/getBscTokenBalance',{
						'bsc_wallet':currentUser['bsc_wallet'],
						'contractaddress':tokenInfo.smartAddress
					})['balance'];
				}
			}else if(tokenInfo.networkName =='erc20'){

				if(tokenInfo.tokenName.toUpperCase() === 'eth'.toUpperCase()){

					balanceInner = ajaxShortLink('userWallet/getEthereumBalance',{
						'erc20_address':currentUser['erc20_wallet']
					})['balance'];

				}else{
					balanceInner = ajaxShortLink('userWallet/getErc20TokenBalance',{
						'erc20_address':currentUser['erc20_wallet'],
						'contractaddress':tokenInfo.smartAddress
					})['balance'];
				}
			}

			// console.log(tokenInfo.decimal)

			$("#"+tokenInfo.tokenName+"_amount_container").html(parseFloat(balanceInner).toFixed(tokenInfo.decimal)+' <br>'+tokenInfo.tokenName.toUpperCase());
			$("#"+tokenInfo.tokenName+"_change_container").html(valueNow.toFixed(3)+' | <span class="'+color+'">'+sign+changePercentage.toFixed(2)+'%</span>');
			
			totalInUsd = totalInUsd+(parseFloat(valueNow)*parseFloat(balanceInner));

			if (priceAlertTokensId.includes(tokenInfo.id)) {
				if (changePercentage>=5) {
					pushNewNotif("Price Alert!",tokenInfo.tokenName.toUpperCase()+" have increased "+ changePercentage.toFixed(2)+'%',currentUser.userID);
				}else if(changePercentage<0&&changePercentage<=-5){
					pushNewNotif("Price Alert!",tokenInfo.tokenName.toUpperCase()+" have decreased "+ changePercentage.toFixed(2)+'%',currentUser.userID);
				}
			}

			// console.timeEnd('loadTokenInfo');

			// console.log("---------------------");
		}

		function loadSystem(){
			for (var i = 0; i < tokensSelected.length; i++) {
				
				$("#tokenContainer").append(
					'<div id="'+tokensSelected[i].tokenName+'_container" class="flex-container">'+
						'<div class="flex-child" style="flex-basis:10%">'+
							'<img class="" style="width: 45px;" src="'+tokensSelected[i].tokenImage+'">'+
						'</div>'+

						'<div class="flex-child"  style="flex-basis:70%">'+
							'<span class="font-weight-bold">'+
								'<span id="'+tokensSelected[i].tokenName+'_name_container">'+
									tokensSelected[i].description+" ("+tokensSelected[i].networkName.toUpperCase()+")"+
								'</span>'+
							'</span>'+

							'<br>'+

							'<span class="h5">'+
								// '<span style="font-size: 15px;" id="'+tokensSelected[i].tokenName+'_change_container">'+
									// valueNow+' | <span class="'+color+'">'+changePercentage+'%</span>'+
								'<span style="font-size: 15px;" id="'+tokensSelected[i].tokenName+'_change_container">Loading...</span>'+
							'</span>'+
						'</div>'+

						'<div class="flex-child text-center" style="flex-basis:20%">'+
							'<span class="h5">'+
								// '<span style="font-size: 14px;text-align: center;" id="'+tokensSelected[i].tokenName+'_amount_container">'+
									// parseFloat(balanceInner).toFixed(3)+' '+tokensSelected[i].tokenName.toUpperCase()+

								'<span style="font-size: 14px;text-align: center;" id="'+tokensSelected[i].tokenName+'_amount_container">Loading...</span>'+
							'</span>'+
						'</div>'+
					'</div>'
				);

				// loadTokenInfo(tokensSelected[i].tokenName,tokensSelected[i].coingeckoTokenId)

				$('#'+tokensSelected[i].tokenName+'_container').on('click',function(){
						clearTimeout(tokenLoadTimer);
						$("#loading_text_container").text("Please wait while we load your recent activities");

						clickContainer = tokensSelected[$(this).index()-1];
						// clickContainer["tokenAmount"] = $("#"+clickContainer.tokenName+"_amount_container").text().split(" ")[0];
						// clickContainer["tokenAmount"] = ;

						console.log(clickContainer);

						$("#tittle_container").text('Token Information');
						$.when(closeNav()).then(function() {
							$('#topNavBar').toggle();
							$("#container").fadeOut(animtionSpeed, function() {
								$("#loadSpinner").fadeIn(animtionSpeed,function(){
									// setTimeout(function(){
							  			$("#container").empty();
							  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTokenInfo'}));

								  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
								  			$('#topNavBar').toggle();
								  			$("#container").fadeIn(animtionSpeed);
								  		});
									// }, 1000)
							  	});

							  	$("#loading_text_container").text("Please wait");
							});
						});
				});	
			}

			// $('#totalInUsdContainer').text(totalInUsd.toFixed(2));
		}
	</script>
</body>
</html>