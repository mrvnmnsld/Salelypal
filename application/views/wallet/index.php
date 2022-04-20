<!-- Author: Marvin Monsalud -->
<!-- Startdate: Dec 16 2021 -->
<!-- Email: marvin.monsalud.mm@gmail.com -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[LOCAL TEST]Security Wallet</title>

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
	

<!-- libraries needed -->

<!-- custom libraries -->
	<script src="assets/js/common.js"></script>
	<script src="assets/js/admin/common.js"></script>

	<link href="assets/css/sidenav.css" rel="stylesheet">
	<link href="assets/css/main_securitywalet.css" rel="stylesheet">


<!-- custom libraries -->

<!-- font -->
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

	</style>
<!-- font -->

<body>
	<div id="loadSpinner" class="text-center text-danger" style="margin-top: 30vh;">
	  	<div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
	    	<span class="sr-only"></span>
	  	</div><br>
		<span class="font-weight-bold mt-2" style="font-size: 50px;">Loading...</span>
	</div>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<a class="" href="#" id="buyCrypto_btn">Buy Crypto</a>
		<a class="" href="#" id="purchaseHistory_btn">Purchase History</a>
		<a class="" href="#" id="transactionHistory_btn">Transaction History</a>
		<a class="" href="#" id="deposit_btn">Deposit</a>
		<a class="" href="#" id="withdraw_btn">Withdraw</a>
		<a class="" href="#" id="exportWallet_btn">Export Wallet</a>
		<hr class="bg-light" style="width:60%">
  		<a class="text-danger" href="#" id="exportWallet_btn">Logout</a>
	</div>

	<div id="topNavBar" style="display:none;">
		<span style="float: left;" onclick="backButton()"><i class="fa fa-home" aria-hidden="true"></i></span>
		<span id="tittle_container" class="text-center font-weight-bold" data-page-url="wallet/index">Dashboard</span>
		<span style="float: right;" onclick="openNav()">&#9776;</span>
	</div>

	<div id="container" class="mb-5" style="display:none"> 
		<div class="h3 mt-3 ml-5">Welcome to Security Wallet</div>
		<hr style="height: 1px; width: 70%;" class="bg-dark">

		<div class="text-center">
			Announcement: <span id="announcement_container">This is a sample announcement</span>
		</div>

		<div id="tokenContainer">
			<!-- <div class="h3 mt-2 text-center font-weight-bold">Assets</div> -->
			<!-- <hr style="height: 1px;width: 70%;" class="bg-dark"> -->
			
			<div id="trx_container" class="flex-container m-3 cardboxes">
				<div class="flex-child" style="flex-basis: 20%;">
					<img class="img-thumbnail border border-secondary" src="https://coin.top/production/logo/trx.png">
				</div>

				<div class="flex-child" style="flex-basis: 50%;margin-left: 4px;">
					<span class="h5">
						<!-- <b>Name: </b> -->
						<span id="trx_name_container">
							TRX(TRON)
						</span>
					</span>

					<br>

					<span class="h5">
						<b>Balance: </b>
						<span id="trx_amount_container">

						</span>
					</span>

					<br><br>

					<small class="value_container">
						<b>Amount in USD: </b>
						<span id="trx_value_container" >

						</span><br>
					</small>
				</div>
			</div>

			<div id="usdt_container" class="flex-container m-3 cardboxes">
				<div class="flex-child" style="flex-basis: 20%;">
					<img class="img-thumbnail border border-secondary" src="https://coin.top/production/logo/usdtlogo.png">
				</div>

				<div class="flex-child" style="flex-basis: 50%;margin-left: 4px;">
					<span class="h5">
						<!-- <b>Name: </b> -->
						<span id="usdt_name_container">
							USDT(tether)
						</span>
					</span>

					<br>

					<span class="h5">
						<b>Balance: </b>
						<span id="usdt_amount_container">
							50.00
						</span>
					</span>

					<br><br>

					<small class="value_container">
						<b>Amount in USD: </b>
						<span id="usdt_value_container" >
							50.00
						</span>
					</small>
				</div>
			</div>

			<div id="bnb_container" class="flex-container m-3 cardboxes">
				<div class="flex-child" style="flex-basis: 20%;">
					<img class="img-thumbnail border border-secondary" src="assets/imgs/icons/bsc_logo.png">
				</div>

				<div class="flex-child" style="flex-basis: 50%;margin-left: 4px;">
					<span class="h5">
						<!-- <b>Name: </b> -->
						<span id="bnb_name_container">
							BNB(Binance Coin)
						</span>
					</span>

					<br>

					<span class="h5">
						<b>Balance: </b>
						<span id="bnb_amount_container">

						</span>
					</span>

					<br><br>

					<small class="value_container">
						<b>Amount in USD: </b>
						<span id="bnb_value_container" >

						</span><br>
					</small>
				</div>
			</div>
		</div>

		<div class="m-2 text-left">
			<div class="h5 cardboxes p-2 m-2 font-weight-bold text-center">
				All Asssets in USD: 
				<span id="totalInUsdContainer"></span>
			</div>	
		</div>

		<div id="widget_container" class="p-3">
			<h3 class="text-dark text-center">Crypto News Updates</h4>

			<script type="text/javascript">
				baseUrl = "https://widgets.cryptocompare.com/";
				var scripts = document.getElementsByTagName("script");
				var embedder = $("#widget_container")[0];
				// var cccTheme = {"General":{"background":"rgb(0, 0, 0, 50%)","borderColor":"#000"},"PoweredBy":{"textColor":"#EEE","linkColor":"#ffcc66"},"Data":{"priceColor":"#FFF","infoValueColor":"#00ff00","borderColor":"#333"},"NewsItem":{"color":"#FFF","borderColor":"#444"},"Conversion":{"background":"#000","color":"#00ff00"}};

				var cccTheme = {"General":{"background":"rgb(0, 0, 0, 50%)","borderColor":"#000","borderRadius":"4px 4px 4px 4px"},"PoweredBy":{"textColor":"#EEE","linkColor":"#ffcc66"},"Data":{"priceColor":"#FFF","infoValueColor":"#FFF","borderColor":"#333"},"NewsItem":{"color":"#FFF","borderColor":"#444"},"Trend":{"colorUp":"#00ff00"},"Conversion":{"background":"#000","color":"#CCC"}};

				(function (){
				var appName = encodeURIComponent(window.location.hostname);
				if(appName==""){appName="local";}
				var s = document.createElement("script");
				s.type = "text/javascript";
				s.async = true;
				var theUrl = baseUrl+'serve/v1/coin/feed?fsym=TRX&tsym=USD';
				s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
				embedder.append(s)

					setTimeout(function(){
						console.log('hide');
						$("a[title='TRX Price and market cap']").removeAttr("target");
						$("a[title='TRX Price and market cap']").removeAttr("href");
						$("a[href='https://www.cryptocompare.com/dev/widget/wizard/']").remove();
					}, 6000)	
				})()


			</script>
		</div>
	</div>		

	<script type="text/javascript">
		var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
		var animtionSpeed = 250;
		var	SelectedtransactionDetails = [];
		var totalInUsd = 0;
		var walletDetails;
		var trxBalance;
		var usdtBalance;
		var bscAddress;
		var balance;
		var pageTrack = [];

		$(document).ready(function(){
			setTimeout(function(){
				$.when(loadSystem()).then(function(){
					$('#container').toggle();
					$('#loadSpinner').toggle();
					$('#topNavBar').toggle();
				});
			}, 500)
		});

		// buttonEvents
			$('#deposit_btn').on('click',function(){
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

			$('#withdraw_btn').on('click',function(){
		 		//trackPages();
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
			});

			$('#exportWallet_btn').on('click',function(){
				//trackPages();
				$("#tittle_container").text('Export Wallet');

		    	$.when(closeNav()).then(function() {
		    		$('#topNavBar').toggle();
		      		$("#container").fadeOut(animtionSpeed, function() {
		    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
		    	  			$("#container").empty();
		    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/export'}));

		    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
		    		  			$('#topNavBar').toggle();
		    		  			$("#container").fadeIn(animtionSpeed);
		    		  		});
		    	    	});
		    	  	});
		    	});
			});

			$('#viewAllTransactions_btn').on('click',function(){
				//trackPages();
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

			// $('#searchTransactions_btn').on('click',function(){
			// 	closeNav();

			//     bootbox.dialog({
			//         title: '',
			//         message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/searchTransactions'}),
			//         size: 'large',
			//         centerVertical: true,
			//     });
			// });	

			$('#buyCrypto_btn').on('click',function(){
				//trackPages();
				$("#tittle_container").text('Buy Crypto');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/buyCrypto'}));

					  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
					  			$('#topNavBar').toggle();
					  			$("#container").fadeIn(animtionSpeed);
					  		});
				    	});
				  	});
				});
			});

			$('#purchaseHistory_btn').on('click',function(){
				//trackPages();
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

			$('#tokenContainer > div').on('click',function(){
				$("#tittle_container").text('Token Information');
				$.when(closeNav()).then(function() {
					$('#topNavBar').toggle();
					$("#container").fadeOut(animtionSpeed, function() {
						$("#loadSpinner").fadeIn(animtionSpeed,function(){
							setTimeout(function(){
					  			$("#container").empty();
					  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTokenInfo'}));

						  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
						  			$('#topNavBar').toggle();
						  			$("#container").fadeIn(animtionSpeed);
						  		});
							}, 3000)

							
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
			window.location.href = 'homeView';//local
		}

		function loadSystem(){
			walletDetails = postShortLink('getAddressDetails',{'address':currentUser['address']});
			trxBalance = roundTron(searchObjectByValue(walletDetails['tokens'],'trx')['balance']).toFixed(2);
			// usdtBalance = roundTron(searchObjectByValue(walletDetails['tokens'],"Tether USD")['balance']).toFixed(2);

			if (searchObjectByValue(walletDetails['tokens'],"Tether USD")) {
				usdtBalance = roundTron(searchObjectByValue(walletDetails['tokens'],"Tether USD")['balance']).toFixed(2);
			}else{
				usdtBalance = 0.00;
			}

			if (getLocalStorageByKey('currentUser')==null) {
				console.log("no active user");
				window.location.replace("index");
			}

			balance = {
				'trx':trxBalance,
				'usdt':usdtBalance,
			};

			var trxValueNow = ajaxShortLink("main/getCurrentPrice",{'token':'TRX','currency':'USD'});
			var usdtValueNow = ajaxShortLink("main/getCurrentPrice",{'token':'USDT','currency':'USD'});
			var bnbValueNow = ajaxShortLink("main/getCurrentPrice",{'token':'BNB','currency':'USD'});

			//BSC
				bscAddress = ajaxPostLink('getAddressBSC',{'currentUser':currentUser['userID']});

				if (bscAddress.length >= 1) {
					// $('#bscTokensContainer').toggle();

					var bscBalance = ajaxPostLink('getBscBalance',{'currentUser':bscAddress[0].address});

					$('#bnb_amount_container').text(weiToBnb(bscBalance['result']));
					$("#bnb_value_container").text((weiToBnb(bscBalance['result'])*bnbValueNow['USD'].toFixed(2)).toFixed(2));
					balance['bnb'] = weiToBnb(bscBalance['result']);

					totalInUsd = totalInUsd + weiToBnb((bscBalance['result'])*bnbValueNow['USD'].toFixed(2));
				}else{
					$('#bnb_amount_container').text(0.00);
					$("#bnb_value_container").text(0.00);
				}
			//BSC

			if (trxBalance != undefined) {
				$("#trx_amount_container").text(trxBalance);
				$("#trx_value_container").text((trxBalance*trxValueNow['USD'].toFixed(2)).toFixed(2));
				totalInUsd = totalInUsd + trxBalance*trxValueNow['USD'].toFixed(2);
			}else{
				$("#trx_amount_container").text(0.00);
				$("#trx_value_container").text(0.00);
			}

			if (usdtBalance != undefined) {
				$("#usdt_amount_container").text(usdtBalance);
				$("#usdt_value_container").text((usdtBalance*usdtValueNow['USD'].toFixed(2)).toFixed(2));
				totalInUsd = totalInUsd + usdtBalance*usdtValueNow['USD'].toFixed(2);
			}else{
				$("#usdt_amount_container").text(0.00);
				$("#usdt_value_container").text(0.00);
			}

			$('#totalInUsdContainer').text(totalInUsd.toFixed(2));
		}
	</script>
</body>
</html>