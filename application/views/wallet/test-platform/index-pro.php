<!-- Author: Marvin Monsalud -->
<!-- Startdate: Dec 16 2021 -->
<!-- Email: marvin.monsalud.mm@gmail.com -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[Testing Platform] Security Wallet</title>

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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

	<link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
	<script src="assets/vendor/bootstrap-select/dist/js/bootstrap-select.js"></script>

	<script src="assets/vendor/jquery/jquery.validate.min.js"></script>

	<script src="assets/vendor/jquery-toast-plugin-master/src/jquery.toast.js"></script>
	<link href="assets/vendor/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">

	<script src="assets/vendor/qrCode/qrcode.js"></script>

	<script src="https://www.paypal.com/sdk/js?client-id=Ae1RO9QQfdAmJZrIxgXzcETFNsdWxQj7LBAx8XCbA8JJ4mnwgyWvq9q7A5fVn_5m9NP9kQ3c2XwACrhr&disable-funding=credit,paylater"></script>


	<link rel="stylesheet" type="text/css" href="assets/vendor/slick-1.8.1/slick/slick.css"/>
	<script type="text/javascript" src="assets/vendor/slick-1.8.1/slick/slick.min.js"></script>


	<!-- NEW -->
		<script src="assets/lib/jquery.countdown-2.2.0/jquery.countdown.js"></script>
	<!-- NEW -->
					
	

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

      	/*google translate*/
    	    .goog-te-banner-frame.skiptranslate, .goog-te-gadget-icon {
    	       display: none !important;
    	    }

    	    body {
    	       top: 0px !important;

    	    }

    	    .goog-tooltip {
    	       display: none !important;
    	    }

    	    .goog-tooltip:hover {
    	       display: none !important;
    	    }

    	    .goog-text-highlight {
    	       background-color: transparent !important;
    	       border: none !important;
    	       box-shadow: none !important;
    	    }

    	    #google_translate_element{
    	        display: none !important;
    	    }

    	    #goog-gt-tt{
    	    	display: none !important;
    	    }
        /*google translate*/


	</style>
<!-- css -->

<body style="min-height: 130%;">
	<div id="loadSpinner" class="text-center text-primary" style="margin-top: 30vh;">
	  	<div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
	    	<span class="sr-only"></span>
	  	</div><br>
		<span class="font-weight-bold mt-2" id="loading_text_container" style="font-size: 30px;text-align: center;">Loading...</span>
	</div>

	<div id="topNavBar" style="display:none;">
		<span id="profile_btn" style="float: left;" ><i class="fa fa-user fa-md" aria-hidden="true"></i><span class="ml-2" id="username_container"></span></span>
		<!-- onclick="$.alert('This function is still under development')" -->
		<span id="notif_btn" class="" style="float:right;">
			<i id="notif_logo" class="fa fa-bell fa-md fa-inverse" style="color:#D9E9E8;"  aria-hidden="true">
				<span id="notif_counter_number" style="font-size:.45em; right:.4em; top:1.5em; display:none" class="position-absolute badge bg-danger">0</span>
			</i>
		</span>
	</div>

	<div id="assets_container" style="display:none;">
		<div class="m-2 text-left">
			<div class="h3 p-2 m-2 font-weight-bold text-center">
				<span class="h3 text-muted">Total Balance:</span><br>
				<span id="totalInUsdContainer">Loading...</span><br>

				<sup id="visible_btn" style="display:none;!important">
					<i id="eye_close" class="fa fa-eye-slash mt-3" style="display:block; color:#adbab9;" aria-hidden="true"></i>
					<i id="eye_open" class="fa fa-eye" style="display:none; color:#adbab9;" aria-hidden="true"></i>
				</sup>
			</div>
		</div>

		<div id="btn_option_container" class="d-flex justify-content-center mt-1">
			<button id="deposit_btn_option" class="btn" style="background-color:transparent">
				<div class="btn btn-secondary btn-circle btn-md" style="font-size:1.5em;background-color: rgb(34 34 34);padding: 5px;">
					<i class="fa fa-arrow-circle-down fa-lg" aria-hidden="true"></i>
				</div>
				<div style="font-size:.8em"><b>Deposit</b></div>
			</button>

			<button id="withdraw_btn_option" class="btn" style="background-color:transparent">
				<div class="btn btn-secondary btn-circle btn-md" style="font-size:1.5em;background-color: rgb(34 34 34);padding: 5px;">
					<i class="fa fa-arrow-circle-up fa-lg" aria-hidden="true"></i>
				</div>
				<div style="font-size:.8em"><b>Withdraw</b></div>
			</button>

			<button id="buy_btn_option" class="btn" style="background-color:transparent">
				<div class="btn btn-secondary btn-circle btn-md" style="font-size:1.5em;background-color: rgb(34 34 34);padding: 5px;">
					<i class="fa fa-usd fa-lg" aria-hidden="true"></i>
				</div>
				<div style="font-size:.8em;"><b>Buy</b></div>
			</button>
		</div>

		<style>
			/* #asset_tab_container{
				background-color:rgba(34,34,34,.1);
				padding-bottom:5em;
			} */
			#asset_tabs a{
				color: #777;
			}
			.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
				font-size:1.3em;
				color:black!important;
				background-color:rgba(0,0,0,.03);
				border-color: transparent;
			}
		</style>

		<div id="asset_tab_container" class="mt-3">
			<ul id="asset_tabs" class="nav nav-tabs nav-justified" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#balance_tab">BALANCE</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#portfolio_tab">PORTFOLIO</a>
				</li>
			</ul>	

			<div class="asset-tab-content tab-content">
				<div id="balance_tab" class="container notranslate tab-pane active"><br>
					<div id="tokenContainer"></div>

					<div class="col-md-12 text-center pl-3 pr-3">
						<button class="btn btn-outline-link btn-block text-primary mt-2" id="addToken_btn">
							<i class="fa fa-sliders" aria-hidden="true"></i>
							Add more
						</button>
					</div>
				</div>

				<div id="portfolio_tab" class="container tab-pane fade"><br>
					<div class="text-center">
						<h3>This part is still under development</h3>
					</div>
					
					
				</div>
			</div>
		</div><!-- asset_tab_container -->
		

		<style>
			.nav-tabs {
				border-bottom: transparent;
			}
			
			.test1{
				color: #D9E9E8 !important;
			}
		</style>
	</div>

	<div id="container" class="mb-5" style="display:none;min-height: 120%;">
		
	</div>

	<br>
	<br>
	<br>
	<br>

	<!-- modal-mining -->
		<style>
			#modal_trade .modal-content{
				background:transparent;
			}

			#modal_trade .modal-header{
				padding:.3em;

			}

			#modal_trade .modal-body{
				
				padding:0em!important;

			}

			#modal_trade .btn-modal {
				background: rgb(34 34 34);

				border:.2px solid;
				border-radius : .5em;
				
				color: #D9E9E8;

				min-height: 100%;
				min-width: 100%;
				padding:2em;
			}
		</style>

		<div class="modal fade" id="modal_trade">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content" style="background-color: rgb(0 0 0 / 79%);">
				
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">
							<i class="fa fa-close fa-inverse" aria-hidden="true"></i>
						</button>
					</div>
					
					<div class="modal-body" style="">

						<div class="m-1 justify-content-center">
							<button id="rise_fall_btn" type="button" class="btn btn-modal" data-dismiss="modal">
								<!-- <img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/icons/mining1.png"> -->
								<i class="fa fa-bar-chart fa-inverse fa-lg" style="" aria-hidden="true"></i>
								Contract Rise Fall
							</button>
						</div>

						<div class="m-1 justify-content-center">
							<button id="future_btn" class="btn btn-modal" data-dismiss="modal">
								<!-- <img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/icons/mining1.png"> -->
								<i class="fa fa-bar-chart fa-inverse fa-lg" style="" aria-hidden="true"></i>
								Contract Long Short
							</button>
						</div>					

						<div class="m-1 justify-content-center">
							<button id="daily_mining_btn" type="button" class="btn btn-modal" data-dismiss="modal">
								<img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/icons/mining1.png">
								Daily Mining
							</button>
						</div>

						<div class="m-1 justify-content-center">
							<button id="regular_mining_btn" class="btn btn-modal" data-dismiss="modal">
								<img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/icons/mining1.png">
								Regular Mining
							</button>
						</div>
							
					</div>
				</div>	
			</div>
		</div>
	<!-- modal-mining -->

	<ul id="bottomNavBar" style="background:rgb(34 34 34); display:none;" class="nav fixed-bottom justify-content-center row pt-2">
		<li id="assets_btn" class="nav-item col-3 text-center">
			<i class="fa fa-money fa-inverse fa-lg" aria-hidden="true"></i>
			<a class="botnavlink nav-link active" style="font-size:.8em; color:#D9E9E8;"><span class="test1">Asset</span></a>
		</li>

		<li id="modal_mining_btn" data-toggle="modal" data-target="#modal_trade" class="nav-item col-3 text-center">
			<i class="fa fa-bar-chart fa-inverse fa-lg" style="" aria-hidden="true"></i>
			<a class="nav-link" style="font-size:.8em; color:#D9E9E8;"  href="#">Trade</a>
		</li>

		<li id="discover_btn" class="nav-item col-3 text-center">
			<i class="fa fa-globe fa-inverse fa-lg" aria-hidden="true"></i>
			<a  class="nav-link" style="font-size:.8em; color:#D9E9E8;" href="#">Discover</a>
		</li>

		<li id="settings_btn" class="nav-item col-3 text-center">
			<i class="fa fa-cogs fa-inverse fa-lg" aria-hidden="true"></i>
			<a class="nav-link" style="font-size:.8em; color:#D9E9E8;"  href="#">Settings</a>
		</li>
	</ul>

	<!-- translate -->
		<script type="text/javascript">
			function googleTranslateElementInit() {
			    // setCookie('googtrans', currentUserLanguage.lang,1);
			    new google.translate.TranslateElement({
			        pageLanguage: 'en',
			        // includedLanguages: 'en,zh-CN,zh-TW',
			        // layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
			        autoDisplay: true
			    }, 'google_translate_element');
			}
			
		</script>

		<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
	<!-- translate -->

	<script type="text/javascript">

		$.confirm({
		    title: 'Testing Mode!',
		    content: 'Testing Mode intitiated, this limits the function and all token amounts are only for testing, They dont exists in the blockchain but it exists in our own server',
		    typeAnimated: true,
		    buttons: {
		        close: function () {
		        }
		    }
		});

		// var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
		var currentUser = {'userID':"15","displayCurrency":"USD"}
		var animtionSpeed = 250;
		var	SelectedtransactionDetails = [];
		var totalInUsd = 0;
		var balance = [];
		var clickContainer;
		var totalInUsd;
		var tokenLoadTimer;
		var assetsHtmlContainer;
		var tokensSelected = ajaxShortLink('userWallet/getAllSelectedTokensVer2',{'userID':15});


		//initial
			$("#username_container").text("Marvin");
			$("#email_container").text("marvin@gmail.com");

			var priceAlert = ajaxShortLink('userWallet/triggerPriceAlerts',{'userID':
				15});
			var priceAlertTokensId = [];
			console.log(priceAlert);

			if(priceAlert.isAlert == 1){
				if(priceAlert.tokens!=""){
					priceAlertTokensId = priceAlert.tokens.split(',')
				}

			}	

			var initialNotifList = ajaxShortLink("getNewNotifs",{
				'userID':15
			});

			if(initialNotifList.length>=1){
				$("#new_notif_counter").text(initialNotifList.length);
			}

			const newNotifChecker = setInterval(function() {
			    var notifList = ajaxShortLink("getNewNotifs",{
			    	'userID':15
			    });

			    if(notifList.length>=1){
					$("#notif_counter_number").text(notifList.length);
					$("#notif_counter_number").addClass("animate__animated animate__heartBeat animate__repeat-2");
					$("#notif_counter_number").css("display", "block");
			    }

			    console.log(notifList);
			}, 30000);	
		//initial

		// function checkValidityLocalStorageValidity(){
		// 	console.log(currentUser.lastLoginDate);
		// }

		$(document).ready(function(){
			console.time('loadTimer');

			setTimeout(function(){
				$.when(loadSystem()).then(function(){
					$('#container').toggle();
					$('#assets_container').css("display","block");
					$('#loadSpinner').toggle();
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();

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
					  		$("#totalInUsdContainer").html(numberWithCommas(totalInUsd.toFixed(2)));
					  		$("#totalInUsdContainer").append(" "+currentUser.displayCurrency);
					  		$('#visible_btn').toggle();
							console.timeEnd('loadTimer');
					    }

				    	i++;
				  	}, 500)
				}

				myLoop();
			}, 1000);	
	
		});

		// buttonEvents
			// visible
				var tokenValuesContainer = []; // this is global
				var visible = 1;

				$('#visible_btn').on('click',function(){
					console.log('visible_btn click',visible);

					if(visible==1){
						tokenValuesContainer = []; // this is start of onclick event
						$("#tokenContainer > div").find("div:nth-child(3)").each(function(){
							tokenValuesContainer.push($(this).html());
							$(this).html("<h3>*****</h3>")
						})
						$('#totalInUsdContainer').html('*****');
						$('#eye_open').toggle();
						$('#eye_close').toggle();
						visible = 0;
					}else{
						$("#tokenContainer > div").find("div:nth-child(3)").each(function(i){
							$(this).html(tokenValuesContainer[i]);
							i+1
						})
						$('#totalInUsdContainer').html(numberWithCommas(totalInUsd.toFixed(2)));
						$("#totalInUsdContainer").append(" "+currentUser.displayCurrency);
						$('#eye_open').toggle();
						$('#eye_close').toggle();
						visible = 1;
					}
					
				});
			// visible

			$('#deposit_btn, #deposit_btn_option').on('click',function(){
				$.confirm({
				    title: 'Testing Mode!',
				    content: 'Deposit is disabled due to testing mode being active',
				    type: 'red',
				    typeAnimated: true,
				    buttons: {
				        close: function () {
				        }
				    }
				});
			});

			$('#withdraw_btn, #withdraw_btn_option').on('click',function(){
				$.confirm({
				    title: 'Testing Mode!',
				    content: 'Withdrawal is disabled due to testing mode being active',
				    type: 'red',
				    typeAnimated: true,
				    buttons: {
				        close: function () {
				        }
				    }
				});
			});

			$('#assets_btn').on('click',function(){
				if ($('#assets_container').css("display") == 'none') {
					$("#tittle_container").text('Purchase');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$.when(closeNav()).then(function() {
						$('#topNavBar').toggle();
						$('#bottomNavBar').toggle();
				  		$("#container").fadeOut(animtionSpeed, function() {
						  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
					  			$("#container").empty();
					  			// $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/buyCrypto'}));

					  			setTimeout(function(){
					  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
										$('#assets_container').fadeIn(animtionSpeed);
					  					$('#topNavBar').toggle();
					  					$('#bottomNavBar').toggle();
					  					$("#container").fadeIn(animtionSpeed);
					  				});
					  			}, 1000);

						  		
					    	});
					  	});
					});
				}
					
					
			});

			$('#buyCrypto_btn, #buy_btn_option').on('click',function(){
					$("#tittle_container").text('Purchase');
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$.when(closeNav()).then(function() {
						$('#assets_container').css("display","none");
						$('#topNavBar').toggle();
						$('#bottomNavBar').toggle();
				  		$("#container").fadeOut(animtionSpeed, function() {
						  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
					  			$("#container").empty();
					  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/buyCrypto'}));

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
			});

			$('#addToken_btn').on('click',function(){
				$("#tittle_container").text('Token Management');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$.when(closeNav()).then(function() {
					$('#assets_container').css("display","none");
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/addToken'}));

					  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
					  			$('#topNavBar').toggle();
					  			$('#bottomNavBar').toggle();
					  			$("#container").fadeIn(animtionSpeed);
					  		});
				    	});
				  	});
				});
			});

			$('#logOut_btn').on('click',function(){
				$.confirm({
				    title: 'Testing Mode!',
				    content: 'Loging out is disabled due to testing mode being active',
				    type: 'red',
				    typeAnimated: true,
				    buttons: {
				        close: function () {
				        }
				    }
				});
			});

			$('#future_btn').on('click',function(){
				
				$("#tittle_container").text('Contract Trade');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$.when(closeNav()).then(function() {
					$('#assets_container').css("display","none");
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/future'}));

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
			});

			$('#rise_fall_btn').on('click',function(){
				
				$("#tittle_container").text('Rise Fall');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$.when(closeNav()).then(function() {
					$('#assets_container').css("display","none");
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/risefall'}));

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
			});

			$('#profile_btn').on('click',function(){
				
				$("#username_container").text("Marvin");
				$("#email_container").text("marvin@gmail.com");
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$.when(closeNav()).then(function() {
					$('#assets_container').css("display","none");
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/user_profile/profile'}));
							console.log('profile_btn clicked');

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
			});

			$('#notif_btn').on('click',function(){
				$("#notif_counter_number").text("");
				$("#notif_counter_number").removeClass("animate__animated animate__bounce animate__repeat-2");
				$("#notif_counter_number").css("display", "none");
				
				clearTimeout(newNotifChecker);
				$("#tittle_container").text('Notification Center');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$.when(closeNav()).then(function() {
					$('#assets_container').css("display","none");
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/notificationCenter'}));

				  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
				  					$('#topNavBar').toggle();
				  					$('#bottomNavBar').toggle();
				  					$("#container").fadeIn(animtionSpeed);
				  				});
				    	});
				  	});
				});
			});
	
			$('#settings_btn').on('click',function(){
				console.log('settings_btn');
				
				$("#tittle_container").text('Settings');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$.when(closeNav()).then(function() {
					$('#assets_container').css("display","none");
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings'}));

			  				$("#loadSpinner").fadeOut(animtionSpeed,function(){
			  					$('#topNavBar').toggle();
			  					$('#bottomNavBar').toggle();
			  					$("#container").fadeIn(animtionSpeed);
			  				});
				    	});
				  	});
				});
			});

			$('#regular_mining_btn').on('click',function(){
				
				$("#tittle_container").text('Regular Income Mining');
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$.when(closeNav()).then(function() {
					$('#assets_container').css("display","none");
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
			  		$("#container").fadeOut(animtionSpeed, function() {
					  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			$("#container").empty();
				  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/regular_mining'}));

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
			});

			$('#daily_mining_btn').on('click',function(){
				// $.alert("This part is still under development")
				
				$("#tittle_container").text('Daily Income Mining');
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
			});

			$('#discover_btn').on('click',function(){
				$.alert("This part is still under development")
				// 
				// $("#tittle_container").text('Daily Income Mining');
				// $("html, body").animate({ scrollTop: 0 }, "slow");
				// $.when(closeNav()).then(function() {
					// $('#assets_container').css("display","none");
				// 	$('#topNavBar').toggle();
				// 	$('#bottomNavBar').toggle();
			 //  		$("#container").fadeOut(animtionSpeed, function() {
				// 	  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
				//   			$("#container").empty();
				//   			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daily_mining'}));

				//   			setTimeout(function(){
				//   				$("#loadSpinner").fadeOut(animtionSpeed,function(){
				//   					$('#topNavBar').toggle();
				//   					$('#bottomNavBar').toggle();
				//   					$("#container").fadeIn(animtionSpeed);
				//   				});
				//   			}, 1000);
					  		
				//     	});
				//   	});
				// });
			});
		// buttonEvents	

		function openNav(){
	  		// document.getElementById("mySidenav").style.width = "102%";
	  		// document.getElementById("mySidenav").style.width = "102%";
	  		// document.getElementById("mySidenav").style.opacity = "1";
		}

		function closeNav(){
	  		// document.getElementById("mySidenav").style.width = "0";
	  		// document.getElementById("mySidenav").style.opacity = "0%";
		}

		function backButton(){
			window.location.href = 'test-platform-pro';//local
		}

		function loadTokenInfo(tokenInfo){
			// console.time('loadTokenInfo');

			console.log(tokenInfo);
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
					balanceInner = ajaxShortLink('test-platform/getTronBalance',{
						// 'trc20Address':currentUser['trc20_wallet']
					})['balance'];			
				}else{
					balanceInner = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
						// 'trc20Address':currentUser['trc20_wallet'],
						'contractaddress':tokenInfo.smartAddress,
					})['balance'];
				}
			}else if(tokenInfo.networkName =='bsc'){

				if(tokenInfo.tokenName.toUpperCase() === 'bnb'.toUpperCase()){

					balanceInner = ajaxShortLink('test-platform/getBinancecoinBalance',{
						// 'bsc_wallet':currentUser['bsc_wallet']
					})['balance'];

				}else{
					balanceInner = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
						// 'bsc_wallet':currentUser['bsc_wallet'],
						'contractaddress':tokenInfo.smartAddress
					})['balance'];
				}
			}else if(tokenInfo.networkName =='erc20'){

				if(tokenInfo.tokenName.toUpperCase() === 'eth'.toUpperCase()){

					balanceInner = ajaxShortLink('test-platform/getEthereumBalance',{
						// 'erc20_address':currentUser['erc20_wallet']
					})['balance'];

				}else{
					balanceInner = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
						// 'erc20_address':currentUser['erc20_wallet'],
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
					pushNewNotif("Price Alert!",tokenInfo.tokenName.toUpperCase()+" have increased "+ changePercentage.toFixed(2)+'%',15);
				}else if(changePercentage<0&&changePercentage<=-5){
					pushNewNotif("Price Alert!",tokenInfo.tokenName.toUpperCase()+" have decreased "+ changePercentage.toFixed(2)+'%',15);
				}
			}

			// console.timeEnd('loadTokenInfo');

			// console.log("---------------------");
		}

		function loadSystem(){
			for (var i = 0; i < tokensSelected.length; i++) {
		
				$("#tokenContainer").append(
					'<div id="'+tokensSelected[i].tokenName+'_container" class="row border-bottom border-muted mb-2">'+
						'<div class="col-2 row" style="flex-basis:10%">'+
							'<div class="col-12 mt-2">'+
								'<img  style="width: 40px;" src="'+tokensSelected[i].tokenImage+'">'+
							'</div>'+
						'</div>'+

						'<div class="col-7 ml-4">'+
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

						'<div class="col-3 text-center font-weight-bold">'+
								// '<span style="font-size: 14px;text-align: center;" id="'+tokensSelected[i].tokenName+'_amount_container">'+
									// parseFloat(balanceInner).toFixed(3)+' '+tokensSelected[i].tokenName.toUpperCase()+

								'<span style="font-size: 13px;" id="'+tokensSelected[i].tokenName+'_amount_container">Loading...</span>'+
						'</div>'+
					'</div>'
				);

				// loadTokenInfo(tokensSelected[i].tokenName,tokensSelected[i].coingeckoTokenId)

				$('#'+tokensSelected[i].tokenName+'_container').on('click',function(){
						
						$("#loading_text_container").text("Please wait while we load your recent activities");

						clickContainer = tokensSelected[$(this).index()];

						$("#tittle_container").text('Token Information');
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$.when(closeNav()).then(function() {
							$('#assets_container').css("display","none");
							$('#topNavBar').toggle();
							$('#bottomNavBar').toggle();
							$("#container").fadeOut(animtionSpeed, function() {
								$("#loadSpinner").fadeIn(animtionSpeed,function(){
									// setTimeout(function(){
							  			$("#container").empty();
							  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/viewTokenInfo'}));

								  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
								  			$('#topNavBar').toggle();
								  			$('#bottomNavBar').toggle();
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