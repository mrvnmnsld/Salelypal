<!-- Author: Marvin Monsalud -->
<!-- Startdate: Dec 16 2021 -->
<!-- Email: marvin.monsalud.mm@gmail.com -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="light
	" />

	<title>[Testing Platform] Security Wallet</title>

	<link rel="icon" type="image/png" href="assets/imgs/logo_main_no_text.png"/>
</head>

<!-- libraries needed -->
	<script src="assets/js/common.js"></script>
	<script src="assets/js/admin/common.js"></script>
	<!-- <script src="cordova.js"></script> -->

	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link href="assets/css/simple-sidebar.css" rel="stylesheet">

	<link href="assets/lib/DataTables/datatables.css" rel="stylesheet">
	<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
	<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
	<link href="assets/lib/DataTables/buttons.dataTables.min.css" rel="stylesheet">
	<link href="assets/css/fontsss.css" rel="stylesheet">


	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="assets/lib/jquery-ui-1.13.1/jquery-ui.min.js"></script>
	<link href="assets/lib/jquery-ui-1.13.1/jquery-ui.css" rel="stylesheet">

	<link href="assets/lib/jquery_event_swipe-master/index.js" rel="stylesheet">


	

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

		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');

		/* Mainstyle */
			html, body {
			    max-width: 100%;
			    overflow-x: hidden;
			}
			body{
				font-family: 'Poppins', sans-serif;
			}
			.font-size-2p5em{
				font-size:2.5em;
			}
			.main-color-icon{
				color: #5426de;
			}
			.light-text{
				color:#D9E9E8;
			}
			.custom-2nd-text{
				color:#D9E9E8;
			}
			.text-muted{
				color: #94abef!important;
			}
			.secondary-color-bg{
				background-color: #94abef!important;
			}

			.dark-mode .qr-container::after{
				background-color : #120731!important;
			}

			.dark-mode .qr-container::before{
				background-color : #120731!important;;
			}

			.light-mode .qr-container::after{
				background-color : white;
			}

			.light-mode .qr-container::before{
				background-color :white;
			}

			/* dark mode */
			.dark-mode{
				background-color : #120731!important;
				color : white!important;
			}
			.dark-mode body{
				background-color : #120731!important;
			}
			.dark-mode .main-color-bg{
				/* background-color: #120731; */
				background-color: #220e5d;
			}
			.dark-mode .main-color-text{
				color: white!important;
			}
			.dark-mode .title-color-text{
				color: white!important;
			}
			.dark-mode .modal-content{
				background-color: #120731!important;
			}
			.dark-mode .btn-danger{
				background-color: #5d220e!important;
				border-color: #5d220e!important;
				color:white!important;
			}
			.dark-mode .btn-sucess{
				background-color: #23923d!important;
				border-color: #23923d!important;
				color:white!important;
			}
			.dark-mode .custom-2nd-text{
				color:#D9E9E8;
			}
			.dark-mode #asset_tabs a{
				color:white;
			}
			.dark-mode #dailymining_tabs a{
				color:white;
			}
			.dark-mode #risefall_history_container a{
				color:white;
			}
			.dark-mode #future_history_container a{
				color:white;
			}
			/* .dark-mode #risefall_history_tab_btn th{
				color:white;
			} */
			.dark-mode .main-card-ui{
				background-color:#220e5d;
				color:white!important;
			}
			

			/* light mode */
			.light-mode{
				background-color : white!important;
				color: #3a189f!important;
			}
			.light-mode .main-color-bg{
				background-color: #5426de;
			}
			.light-mode .main-color-text{
				color: #5426de !important;
			}

			.light-mode .title-color-text{
				color: white!important;
			}
			.light-mode .modal-content{
				background-color: white!important;
			}

			/* .dark-mode th{
				color: white;
			}

			.light-mode th{
				color: #120731;
			} */
			
			.light-mode .custom-2nd-text{
				color:#3a189f;
			}
			.light-mode .btn-danger{
				background-color: #dc3545!important;
				border-color: #dc3545!important;
				color:white!important;
			}
			.light-mode #asset_tabs a{
				color:#3a189f;
			}
			.light-mode #dailymining_tabs a{
				color:#3a189f;
			}
			.light-mode #risefall_history_container a{
				color:#3a189f;
			}
			.light-mode #future_history_container a{
				color:#3a189f;
			}
			.light-mode .main-card-ui{
				background-color:white;
				color:#3a189f !important;
			}

			.jq-toast-single {
		  		font-size: 16px;
			}

			.jq-toast-single:last-of-type {
		  		margin-bottom: 50px;
			}

			:root{
				--main-color:#5426de!important;
				--main-color-light:#5426de!important;
				--main-color-dark:white!important;
				--minetab-color:#5426de;
			}

			.light-mode .nav-link.tab-pane.fade.show.active:before {
				border-bottom: .2rem solid var(--main-color-light);
			}
			.dark-mode .nav-link.tab-pane.fade.show.active:before {
				border-bottom: .2rem solid var(--main-color-dark);
			}
	</style>
<!-- css -->

<body style="min-height: 130%;" class="light-mode">
	<div id="topNavBar" class="main-color-bg light-text notranslate" style="display:none; color:white!important;">
		<span id="profile_btn" style="float: left;" ><i class="fa fa-user-o fa-md" aria-hidden="true"></i><span class="ml-2" id="username_container"></span></span>

		<span id="top_back_btn" style="float: left;display: none;" ><i class="fa fa-angle-left fa-md" aria-hidden="true"></i></span>

		<span id="notif_btn" class="" style="float:right;">
			<i id="notif_logo" class="fa fa-bell-o fa-md fa-inverse" style="color:white!important;"  aria-hidden="true">
				<span id="notif_counter_number" style="font-size:.45em; right:.4em; top:1.5em; display:none" class="position-absolute badge bg-danger">0</span>
			</i>
		</span>
	</div>

	<div id="loadSpinner" class="text-center text-primary" style="margin-top: 30vh;display: none;">
	  	<div class="spinner-border main-color-text" role="status" style="width: 5rem; height: 5rem;">
	    	<span class="sr-only"></span>
	  	</div><br>
		<span class="font-weight-bold mt-2 main-color-text" id="loading_text_container" style="font-size:30px; text-align: center;">Loading...</span>
	</div>

	<div id="assets_container" style="display:none;">
		<div id="header_inner_container" class="main-color-bg py-2" style="display:none;">
			<div class="font-weight-bold text-center">
				<span class="h6 text-muted" style="color:white;">TOTAL BALANCE 
					<span id="visible_btn" style="display:none;">
						<i id="eye_close" class="fa fa-eye-slash mt-2 text-muted" style="display:inline-block;" aria-hidden="true"></i>
						<i id="eye_open" class="fa fa-eye text-muted" style="display:none;" aria-hidden="true"></i>
					</span>
					<br>
					<span id="totalInUsdContainer" class="font-size-2p5em title-color-text notranslate">Loading...</span>
				</div>

				<div id="main_btns_container" style="display:none;">
					<div id="btn_option_container" class="d-flex justify-content-center mt-1">
					
						<button id="deposit_btn_option" class="btn" style="background-color:transparent">
							<div class="btn btn-md" style="font-size:1.5em;padding:1px;">
								<i class="fa fa-arrow-circle-down fa-lg fa-inverse" aria-hidden="true"></i>
								<!-- <img style="width:50px;height:50px;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/icons8-deposit-64.png"> -->
							</div>
							<div style="font-size:.8em;" class="text-light">Deposit</div>
						</button>

						<button id="withdraw_btn_option" class="btn" style="background-color:transparent">
							<div class="btn btn-md" style="font-size:1.5em;padding:1px;">
								<i class="fa fa-arrow-circle-up fa-lg fa-inverse" aria-hidden="true"></i>
								<!-- <img style="width:50px;height:50px;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/icons8-withdraw-64.png"> -->
							</div>
							<div style="font-size:.8em;" class="text-light">Withdraw</div>
						</button>

						<button id="buy_btn_option" class="btn" style="background-color:transparent">
							<div class="btn btn-md" style="font-size:1.5em;padding:1px;">
								<i class="fa fa-credit-card-alt fa-md fa-inverse" aria-hidden="true"></i>
								<!-- <img style="width:50px;height:50px;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%); width: 1.5em: ;" src="assets/imgs/app-icons/menu-icons/icons8-top-64.png"> -->
							</div>
							<div style="font-size:.8em;;" class="text-light">Buy</div>
						</button>
					</div>
				</div>
			</div>

			<style>
				#asset_tabs a{
					/* color: #94abef; */
					opacity: .5;
					-webkit-transition: color 2s, font-size .25s;
					-moz-transition: color 2s, font-size .25s;
					-o-transition: color 2s, font-size .25s;
					transition: color 2s, font-size .25s;
				}

				.nav-link.tab-pane.fade.show.active{
					font-size:1.8em;
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

				.nav-link.tab-pane.fade.show.active:before{
					content: "";
					position: absolute;
					width: 50%;
					height: 1px;
					bottom: 0;
					left: 25%;
				}

			</style>

			<div id="asset_tab_container" class="mt-3">
				<ul id="asset_tabs" class="nav nav-tabs nav-justified" role="tablist">
					<li class="nav-item">
						<a id="balance_tab_id" class="nav-link active tab-pane fade show main-color-link" data-toggle="tab" href="#balance_tab">BALANCE</a>
					</li>
					<li class="nav-item">
						<a id="portfolio_tab_id" class="nav-link tab-pane fade show main-color-link" data-toggle="tab" href="#portfolio_tab">PORTFOLIO</a>
					</li>
				</ul>

				<div class="asset-tab-content tab-content">
					<div id="balance_tab" class="px-4 notranslate tab-pane active notranslate tab-pane active"><br>
						<div id="tokenContainer"></div>

						
						<div class="row">
							<div class="col-6 text-center">
								<button class="btn btn-outline-link btn-block main-color-text mt-2 text-muted" disabled id="addToken_btn">
									<i class="fa fa-sliders" aria-hidden="true"></i>
									Add more
								</button>
							</div>

							<div class="col-6 text-center">
								<button class="btn btn-outline-link btn-block main-color-text mt-2 text-muted" disabled id="refresh_btn">
									<i class="fa fa-refresh" aria-hidden="true"></i>
									Refresh
								</button>
							</div>
						</div>
						
					</div>

					<div id="portfolio_tab" class="container tab-pane fade"><br>
						<div class="text-center" id="pnl_loading">
							<h3>
								<div class="spinner-grow main-color-text" role="status">
								  <span class="sr-only">Loading...</span>
								</div>

								Loading...

							</h3>
						</div>

						<div id="pnl_main" class="main-card-ui rounded shadow-lg" style="display:none">

							<div class="row p-3">
								<div class="col-6">
									<b>Today's Earnings (Trading):</b><br>
									<span id="todaysEarning">
										0 USD
									</span>
								</div>
								
								<div class="col-6">
									<b>Yesterdays PNL:</b><br>
									<span id="yesterdayPnl">
										0% Change
									</span>
								</div>
							</div>

							<div class="row p-3">
								<div class="col-6">
									<b>7 Days PNL:</b><br>
									<span id="allDaysPnl">
										0% Change
									</span>
									
								</div>

								<div class="col-6">
									<b>14 Days PNL:</b><br>
									<span id="14DaysPnl">
										0% Change
									</span>
								</div>
							</div>


								
							<div class="p-3">
								7 Days PNL Chart

								<div id="graph-container-pnl">
									<canvas id="pnl_chart_container" width="400" height="200"></canvas >
								</div>

								
							</div>

							<div class="p-3">
								14 Days PNL Chart

								<div id="graph-container-pnl-14">
									<canvas id="pnl_14_chart_container" width="400" height="200"></canvas >
								</div>

								
							</div>

							<div class="p-3">
								Assets Distribution

								<div id="graph-container-assets">
									<canvas id="assets_chart_container" width="600" height="400"></canvas >
								</div>

							</div>
						</div>

					</div>


				</div>
			</div><!-- asset_tab_container -->
			
			<style>
				.nav-tabs {
					border-bottom: transparent;
				}
			</style>
	</div>

	<div id="container" class="mb-5" style="display:none;min-height: 120%;"></div>

	<br>
	<br>
	<br>
	<br>

	<!-- modal-mining -->
		<style>
			#modal_trade .modal-header{
				padding:.3em;
			}
			#modal_trade .modal-body{
				border-radius : .5em;
				padding:0em!important;
			}
			#modal_trade .btn-modal {
				min-height: 100%;
				min-width: 100%;
				padding:.5em;
				box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
				margin:.5em 0;
			}
			#modal_trade .btn-modal:hover {
				background-color:#94abef;
				font-size:1.5em;
			}
			.modal-header{
				border-bottom: 0px solid #dee2e6!important;
			}
		</style>

		<div class="modal fade" id="modal_trade">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content p-4">
					<div class="modal-body">
						<div class="m-1 justify-content-center">
							<button id="rise_fall_btn" type="button" class="btn btn-modal main-color-bg" data-dismiss="modal">
								<!-- <i class="fa fa-bar-chart fa-inverse fa-lg" style="" aria-hidden="true"></i> -->
								<img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/icons8-strategy-64.png">
								<small class="text-light">Rise Fall Contract</small>
							</button>
						</div>
						<div class="m-1 justify-content-center main-color-text">
							<button id="future_btn" class="btn btn-modal main-color-bg" data-dismiss="modal">
								<!-- <i class="fa fa-bar-chart fa-inverse fa-lg" style="" aria-hidden="true"></i> -->
								<img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/icons8-chart-64.png">
								<small class="text-light">Long Short Contract</small>
							</button>
						</div>	
						<div class="m-1 justify-content-center main-color-text">
							<button id="daily_mining_btn" type="button" class="btn btn-modal main-color-bg" data-dismiss="modal">
								<img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/icons8-mining1-64.png">
								<small class="text-light">Daily Mining</small>
							</button>
						</div>

						<div class="m-1 justify-content-center">
							<button id="regular_mining_btn" class="btn btn-modal main-color-bg" data-dismiss="modal">
								<img style="width:1.2em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/icons8-mining-64.png">
								<small class="text-light">Regular Mining</small>
							</button>
						</div>

						<div class="m-1 justify-content-center">
							<button type="button" class="btn btn-modal main-color-bg" data-dismiss="modal">
								<i class="fa fa-close" style="width:1.4em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" aria-hidden="true"></i>
								<small class="text-light">Cancel</small>
							</button>
						</div>

						
					</div>
				</div>	
			</div>
		</div>
	<!-- modal-mining END -->

	<style>
		.botnav-icon{
			font-size:2.2rem;
		}
		.botnav-icon:hover{
			color: #94abef;
		}
	</style>

	<ul id="bottomNavBar" style="display:none;" class="nav fixed-bottom main-color-bg justify-content-center row">
		<li id="assets_btn" class="nav-item bottom-nav-item col-3 text-center bottom-nav-item-active">
			<!-- <i class="fa fa-bank fa-inverse botnav-icon" alt="Asset" aria-hidden="true"></i> -->
			<img style="width:1.8em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/logo_safetypal_bottom_text.png">
			<!-- <a class="nav-link" style="font-size:.7em; color:#D9E9E8;"  href="#">Assets</a> -->
		</li>

		<li id="modal_mining_btn" data-toggle="modal" data-target="#modal_trade" class="nav-item col-3 text-center bottom-nav-item">
			<!-- <i class="fa fa-bar-chart fa-inverse botnav-icon" alt="Trade" aria-hidden="true"></i> -->
			<img style="width:1.8em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/icons8-trading-64.png">
			<!-- <a class="nav-link" style="font-size:.7em; color:#D9E9E8;"  href="#">Trade</a> -->
		</li>

		<li id="discover_btn" class="nav-item col-3 text-center bottom-nav-item">
			<!-- <i class="fa fa-globe fa-inverse botnav-icon" style="width:1.5em;" alt="Discover" aria-hidden="true"></i> -->
			<img style="width:1.8em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/compass.png">
			<!-- <a  class="nav-link" style="font-size:.7em; color:#D9E9E8;" href="#">Discover</a> -->
		</li>

		<li id="settings_btn" class="nav-item col-3 text-center bottom-nav-item">
			<!-- <i class="fa fa-cogs fa-inverse botnav-icon" alt="Settings" aria-hidden="true"></i> -->
			<img style="width:1.8em;filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(297deg) brightness(102%) contrast(101%);" src="assets/imgs/app-icons/menu-icons/settings.png">
			<!-- <a class="nav-link" style="font-size:.7em; color:#D9E9E8;"  href="#">Settings</a> -->
		</li>
	</ul>
</body>

<!-- translate -->
	<!-- <script type="text/javascript">
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

	<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script> -->
<!-- translate -->

<script type="text/javascript">
		var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));

		if (getLocalStorageByKey('currentUser')!=null) {
			
			currentUser = ajaxShortLink('userWallet/getProfileDetails',{'userID':currentUser.userID})[0];

			if (currentUser==undefined) {
				$.confirm({
					theme: 'dark',
				    title: 'Account Deleted Due to Security Measure!',
				    content: 'We have noticed something wrong with your wallet. Please wait while we check your account. Thank you!',
				    typeAnimated: true,
				    buttons: {
				        close: function () {
				        	logOutClearStorage();
				        }
				    }
				});
			}else{
				if (currentUser.isBlocked==1) {
					$.confirm({
						theme: 'dark',
					    title: 'Account Blocked Due to Security Measure!',
					    content: 'We have noticed something wrong with your wallet. Please wait while we check your account. Thank you!',
					    typeAnimated: true,
					    buttons: {
					        close: function () {
					        	logOutClearStorage();
					        }
					    }
					});	
				}else{
					if (currentUser.isPro==1) {
						console.log("%cContinue!!","color: red; font-family:monospace; font-size: 30px");
					}else{
						window.location.href = 'homeView';

					}

				    var notifList = ajaxShortLink("getNewNotifs",{
				    	'userID':currentUser.userID
				    });

					

				    if(notifList.length>=1){
						$("#notif_counter_number").text(notifList.length);
						$("#notif_counter_number").addClass("animate__animated animate__heartBeat animate__repeat-2");
						$("#notif_counter_number").css("display", "block");
				    }
				}
			}
		}else{
			window.location.href = 'index';
		}

		var animtionSpeed = 250;
		var	SelectedtransactionDetails = [];
		var totalInUsd = 0;
		var balance = [];
		var clickContainer;
		var totalInUsd;
		var tokenLoadTimer;
		var assetsHtmlContainer;
		var tokensSelected = ajaxShortLink('userWallet/getAllSelectedTokensVer2',{'userID':currentUser.userID});
		var breadCrumbs = ['assets'];
		var tokenNames = [];
		var tokenBalance = [];

		var tokenPairArray = {
		    'tokenPairID':'BTCUSDT',
		    'tokenPairDescription':'BTC/USDT'
		}; // for mining

		var coinIds = [];

		//initial
			
			$("#username_container").text(currentUser.fullname.split(" ")[0]);

			var priceAlert = ajaxShortLink('userWallet/triggerPriceAlerts',{'userID':
				currentUser.userID});
			var priceAlertTokensId = [];
			console.log(priceAlert);

			if(priceAlert.isAlert == 1){
				if(priceAlert.tokens!=""){
					priceAlertTokensId = priceAlert.tokens.split(',')
				}
			}	

			var isDarkMode = getLocalStorageByKey("isDarkMode");
			var chartTheme;
			if(isDarkMode==1){
				$("body").removeClass( "light-mode" ).addClass( "dark-mode" );
				chartTheme = 'dark';
			}else{
				$("body").removeClass( "dark-mode" ).addClass( "light-mode" );
				chartTheme = 'light';
			}

			var displayCurrency = getLocalStorageByKey("displayCurrency");
			if(displayCurrency==null){
				displayCurrency = "usd"
				setLocalStorageByKey("displayCurrency",'usd')
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

				if($("#totalInUsdContainer").text().split(" ")[0].includes("Loading")==false){
					ajaxShortLink("saveLastAllTokenValue",{
			    		'userID': currentUser.userID,
			    		'value': $("#totalInUsdContainer").text().split(" ")[0],
			    		'currency': displayCurrency,
			    	});
				}
			}, 30000);	

			
			//swipe detect
				function swipedetect(el, callback){

					var touchsurface = el,
					swipedir,
					startX,
					startY,
					distX,
					distY,
					threshold = 150, //required min distance traveled to be considered swipe
					restraint = 100, // maximum distance allowed at the same time in perpendicular direction
					allowedTime = 300, // maximum time allowed to travel that distance
					elapsedTime,
					startTime,
					handleswipe = callback || function(swipedir){}

					touchsurface.addEventListener('touchstart', function(e){
						var touchobj = e.changedTouches[0]
						swipedir = 'none'
						dist = 0
						startX = touchobj.pageX
						startY = touchobj.pageY
						startTime = new Date().getTime() // record time when finger first makes contact with surface
						// e.preventDefault()
					}, false)

					// touchsurface.addEventListener('touchmove', function(e){
					// 	e.preventDefault() // prevent scrolling when inside DIV
					// }, false)

					touchsurface.addEventListener('touchend', function(e){
						var touchobj = e.changedTouches[0]
						distX = touchobj.pageX - startX // get horizontal dist traveled by finger while in contact with surface
						distY = touchobj.pageY - startY // get vertical dist traveled by finger while in contact with surface
						elapsedTime = new Date().getTime() - startTime // get time elapsed
							if (elapsedTime <= allowedTime){ // first condition for awipe met
								if (Math.abs(distX) >= threshold && Math.abs(distY) <= restraint){ // 2nd condition for horizontal swipe met
									swipedir = (distX < 0)? 'left' : 'right' // if dist traveled is negative, it indicates left swipe
								}
								else if (Math.abs(distY) >= threshold && Math.abs(distX) <= restraint){ // 2nd condition for vertical swipe met
									swipedir = (distY < 0)? 'up' : 'down' // if dist traveled is negative, it indicates up swipe
								}
						}
						handleswipe(swipedir)
						// e.preventDefault()
					}, false)
				}


				var balance_tab = document.getElementById('balance_tab');
				swipedetect(balance_tab, function(balance_tab_swipe){
					if (balance_tab_swipe =='left'){
						$('#portfolio_tab').tab('show'); 
						$('#balance_tab').removeClass('active');
						$('#balance_tab').addClass('hide');
						$('#portfolio_tab').addClass('active');

						$('#portfolio_tab_id').addClass('active');
						$('#balance_tab_id').removeClass('active');
					}
				});

				var portfolio_tab = document.getElementById('portfolio_tab');
				swipedetect(portfolio_tab, function(portfolio_tab_swipe){
					if (portfolio_tab_swipe =='right'){
						$('#portfolio_tab').removeClass('active');
						$('#portfolio_tab').addClass('hide');
						$('#balance_tab').addClass('active');
						$('#balance_tab').tab('show'); 

						$('#balance_tab_id').addClass('active');
						$('#portfolio_tab_id').removeClass('active');
					}
				});

			// swipe detect
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
					// $('#loadSpinner').toggle();
					$('#topNavBar').toggle();
					$('#bottomNavBar').toggle();
					$('#header_inner_container').toggle();
					$('#main_btns_container').toggle();

					$("#loading_text_container").text('Please Wait');
				});
			}, 500);

			setTimeout(function(){
				var i = 0;

				function myLoop() {
				  	tokenLoadTimer = setTimeout(function() {
					    if (i < tokensSelected.length) {
					    	coinIds.push(tokensSelected[i].coingeckoTokenId);
					    	// coinIds
							loadTokenInfo(tokensSelected[i]);
							myLoop();
					    }else{
					  		$("#totalInUsdContainer").html(numberWithCommas(totalInUsd.toFixed(2)));
					  		$("#totalInUsdContainer").append(" "+displayCurrency.toUpperCase());
					  		
					  		$('#visible_btn').toggle();
					  		$('#refresh_btn').removeAttr("disabled");
					  		$('#addToken_btn').removeAttr("disabled");


					  		// chart PNL
						  		$("#pnl_loading").toggle();
						  		$("#pnl_main").toggle();


			  			  		var date = new Date();

			  			  		var year = date.getFullYear();
			  			  		var month = String(date.getMonth() + 1);
			  			  		var day = String(date.getDate());
			  			  		var joined = [month,day,year,].join('/');

			  			  		console.log(joined);

			  			  		var getTodayContractProfit = ajaxShortLink("userWallet/getTodayContractProfit",{
			  		  				"userID":currentUser.userID,
			  		  				"date":joined
			  		  			})

			  		  			console.log(getTodayContractProfit);

			  		  			$("#todaysEarning").text(getTodayContractProfit+" USD");

			  		  			if (parseFloat(getTodayContractProfit)>=1) {
			  		  				$("#todaysEarning").addClass("text-success").text("+"+getTodayContractProfit+" USD");
			  		  			}else{
			  		  				$("#todaysEarning").addClass("text-danger").text(getTodayContractProfit+" USD");
			  		  			}

  				  				var yValues = ajaxShortLink("userWallet/getToken24HourChange",{
  					  				"coinIds":coinIds.toString()
  					  			})

  					  			var last7days = yValues.slice(yValues.length - 7);

  						  		var totalInUsdInner = parseFloat($('#totalInUsdContainer').text().split(" ")[0].replace(/,/g, ''));
  						  		var changePercentageIn1Day = parseFloat(yValues[yValues.length-1]);

  				  				var xValues = getDaysDate(6);

  				  				var average = yValues.reduce((a, b) => a + b, 0) / yValues.length;
  				  				var average7Days = last7days.reduce((a, b) => a + b, 0) / last7days.length;

  				  				console.log(last7days);
  				  				console.log(yValues);
  				  				console.log(average);
  				  				console.log(changePercentageIn1Day);
  				  				console.log((changePercentageIn1Day/100)*totalInUsdInner);
  				  				console.log(totalInUsdInner);
  				  				console.log(changePercentageIn1Day/100);

  				  				if(parseFloat(yValues[yValues.length-1]) < 0) {
  				  					$("#yesterdayPnl").addClass("text-danger").html((totalInUsdInner*(changePercentageIn1Day/100)).toFixed(2)+" <br><small>"+changePercentageIn1Day.toFixed(2)+"% Change </small>");
  				  				}else{
  				  					$("#yesterdayPnl").addClass("text-success").html("+"+(totalInUsdInner*(changePercentageIn1Day/100)).toFixed(2)+" <br><small>"+changePercentageIn1Day.toFixed(2)+"% Change </small>");
  				  				}

  				  				if(average7Days < 0) {
  				  					$("#allDaysPnl").addClass("text-danger").html((totalInUsdInner*(average7Days/100)).toFixed(2)+" <small>"+average7Days.toFixed(2)+"% Change</small>");
  				  				}else{
  				  					$("#allDaysPnl").addClass("text-success").html("+"+(totalInUsdInner*(average7Days/100)).toFixed(2)+" <small>"+average7Days.toFixed(2)+"% Change</small>");
  				  				}

  				  				if(average < 0) {
  				  					$("#14DaysPnl").addClass("text-danger").html((totalInUsdInner*(average/100)).toFixed(2)+"<br> <small>"+average.toFixed(2)+"% Change</small>");
  				  				}else{
  				  					$("#14DaysPnl").addClass("text-success").html("+"+(totalInUsdInner*(average/100)).toFixed(2)+" <br><small>"+average.toFixed(2)+"% Change</small>");
  				  				}

				  				new Chart("pnl_chart_container", {
				  				  	type: "line",
				  				  	data: {
				  				    	labels: xValues,
				  			    		datasets: [{
				  						      // backgroundColor: "rgba(0,0,0,1.0)",
				  						      fill: false,
				  						      label: false,
				  						      borderColor: "#94abef",
				  						      data: yValues
				  					    }]
				  					},
				  				  	options:{
				  				  		responsive: true,
			  				        	legend: {
			  				          		position: 'top',
			  				          		display: false
			  				        	},
			  				        	title: {
			  			          			display: false,
			  			          			// text: 'Chart.js Line Chart'
			  				       	 	},
				  		      		    tooltips: {
				  		      		        callbacks: {
				  		      		           label: function(tooltipItem) {
				  		      		                  return tooltipItem.yLabel;
				  		      		           }
				  		      		        }
				  		      		    }
				  				  	}
				  				});

				  				var xValues = getDaysDate(13);

				  				new Chart("pnl_14_chart_container", {
				  				  	type: "line",
				  				  	data: {
				  				    	labels: xValues,
				  			    		datasets: [{
				  						      // backgroundColor: "rgba(0,0,0,1.0)",
				  						      fill: false,
				  						      label: false,
				  						      borderColor: "#94abef",
				  						      data: yValues
				  					    }]
				  					},
				  				  	options:{
				  				  		responsive: true,
			  				        	legend: {
			  				          		position: 'top',
			  				          		display: false
			  				        	},
			  				        	title: {
			  			          			display: false,
			  			          			// text: 'Chart.js Line Chart'
			  				       	 	},
				  		      		    tooltips: {
				  		      		        callbacks: {
				  		      		           label: function(tooltipItem) {
				  		      		                  return tooltipItem.yLabel;
				  		      		           }
				  		      		        }
				  		      		    }
				  				  	}
				  				});

				  				var xValues = tokenNames;
				  				var yValues = tokenBalance;


				  				var barColors = getRandomColorIteration(xValues.length);

				  				new Chart("assets_chart_container", {
				  				  	type: "pie",
				  				  	data: {
					  				    labels: xValues,
					  				    datasets: [{
					  				      	backgroundColor: barColors,
				  				      		data: yValues
					  				    }]
				  				  	},
				  				  	options: {
					  				    title: {
				  				      		display: false,
				  				      		// text: "World Wide Wine Production 2018"
					  				    },
					  				    legend: {
				  				      		display: true
					  				    }
				  				  }
				  				});

								ajaxShortLink("saveLastAllTokenValue",{
									'userID': currentUser.userID,
									'value': $("#totalInUsdContainer").text().split(" ")[0],
									'currency': displayCurrency,
								});

					  		// chart PNL

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
						$("#totalInUsdContainer").append(" "+displayCurrency.toUpperCase());
						$('#eye_open').toggle();
						$('#eye_close').toggle();
						visible = 1;
					}
					
				});
			// visible

			$('#deposit_btn, #deposit_btn_option').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/deposit");

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/deposit'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});

			$('#withdraw_btn, #withdraw_btn_option').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/withdraw");

				if (currentUser.isStrict == "1") {
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$('#assets_container').css("display","none");
					$("#container").fadeOut(animtionSpeed, function() {
						$("#profile_btn").css('display',"none")
						$("#top_back_btn").css('display',"block")

			  			$("#container").empty();
			  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdrawStrict'}));
			  			$("#container").fadeIn(animtionSpeed);
					});
				}else{
					$("html, body").animate({ scrollTop: 0 }, "slow");
					$('#assets_container').css("display","none");
					$("#container").fadeOut(animtionSpeed, function() {
						$("#profile_btn").css('display',"none")
						$("#top_back_btn").css('display',"block")

			  			$("#container").empty();
			  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/withdraw'}));
			  			$("#container").fadeIn(animtionSpeed);
					});
				}

				
			});

			$('#buyCrypto_btn, #buy_btn_option').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}


				addBreadCrumbs("wallet/buyCrypto");

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/buyCrypto'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});
			
			$('#refresh_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}


				tokenNames = [];
				tokenBalance = [];

				$('#refresh_btn').attr("disabled");
				$('#visible_btn').toggle();

		  		$("#pnl_loading").toggle();
		  		$("#pnl_main").toggle();


				$("#tokenContainer > div").find("div:nth-child(3)").find("span").each(function(){
					$(this).text("Loading...")
				})
				$('#totalInUsdContainer').text('Loading...');

				totalInUsd = 0

				setTimeout(function(){
					var i = 0;

					function myLoop() {
					  	tokenLoadTimer = setTimeout(function() {
						    if (i < tokensSelected.length) {
								loadTokenInfo(tokensSelected[i]);
								myLoop();
						    }else{
						  		$("#totalInUsdContainer").html(numberWithCommas(totalInUsd.toFixed(2)));
						  		$("#totalInUsdContainer").append(" "+displayCurrency.toUpperCase());
						  		$('#visible_btn').toggle();
						  		$('#refresh_btn').removeAttr("disabled");
						  		$('#addToken_btn').removeAttr("disabled");

	  		    		  		// chart PNL
				  			  		var date = new Date();

				  			  		var year = date.getFullYear();
				  			  		var month = String(date.getMonth() + 1);
				  			  		var day = String(date.getDate());
				  			  		var joined = [month,day,year,].join('/');

				  			  		console.log(joined);

				  			  		var getTodayContractProfit = ajaxShortLink("userWallet/getTodayContractProfit",{
				  		  				"userID":currentUser.userID,
				  		  				"date":joined
				  		  			})

				  		  			console.log(getTodayContractProfit);

				  		  			$("#todaysEarning").text(getTodayContractProfit+" USD");

				  		  			if (parseFloat(getTodayContractProfit)>=1) {
				  		  				$("#todaysEarning").addClass("text-success").text("+"+getTodayContractProfit+" USD");
				  		  			}else{
				  		  				$("#todaysEarning").addClass("text-danger").text(getTodayContractProfit+" USD");
				  		  			}

				    	  				var yValues = ajaxShortLink("userWallet/getToken24HourChange",{
						  				"coinIds":coinIds.toString()
						  			})
				    		  							  			
						    		var totalInUsdInner = parseFloat($('#totalInUsdContainer').val().split(" ")[0]);
						    		var changePercentageIn1Day = parseFloat(yValues[yValues.length-1]);

					    		  		$("#pnl_chart_container").empty();
					    		  		$("#pnl_14_chart_container").empty();
					    		  		$("#assets_chart_container").empty();

				    			  		$("#pnl_loading").toggle();
				    			  		$("#pnl_main").toggle();

				    			  		$("#pnl_chart_container").remove();
				    			  		$("#assets_chart_container").remove();
				    			  		$("#pnl_14_chart_container").remove();

				    			  		$('#graph-container-pnl').append('<canvas width="400" height="200" id="pnl_chart_container"></canvas>');
				    			  		$('#graph-container-assets').append('<canvas width="600" height="400" id="assets_chart_container"></canvas>');
				    			  		$('#graph-container-pnl-14').append('<canvas width="600" height="400" id="pnl_14_chart_container"></canvas>');

				    	  				

						  			var last7days = yValues.slice(yValues.length - 7);

							  		var totalInUsdInner = parseFloat($('#totalInUsdContainer').text().split(" ")[0].replace(/,/g, ''));
							  		var changePercentageIn1Day = parseFloat(yValues[yValues.length-1]);

					  				var xValues = getDaysDate(6);

					  				const average = yValues.reduce((a, b) => a + b, 0) / yValues.length;
					  				const average7Days = last7days.reduce((a, b) => a + b, 0) / last7days.length;

					  				console.log(last7days);
					  				console.log(yValues);
					  				console.log(average);
					  				console.log(changePercentageIn1Day);
					  				console.log((changePercentageIn1Day/100)*totalInUsdInner);
					  				console.log(totalInUsdInner);
					  				console.log(changePercentageIn1Day/100);

					  				if(parseFloat(yValues[yValues.length-1]) < 0) {
					  					$("#yesterdayPnl").addClass("text-danger").html((totalInUsdInner*(changePercentageIn1Day/100)).toFixed(2)+" <small>"+changePercentageIn1Day.toFixed(2)+"% Change </small>");
					  				}else{
					  					$("#yesterdayPnl").addClass("text-success").html("+"+(totalInUsdInner*(changePercentageIn1Day/100)).toFixed(2)+" <small>"+changePercentageIn1Day.toFixed(2)+"% Change </small>");
					  				}

					  				if(average7Days < 0) {
					  					$("#allDaysPnl").addClass("text-danger").html((totalInUsdInner*(average7Days/100)).toFixed(2)+" <small>"+average7Days.toFixed(2)+"% Change</small>");
					  				}else{
					  					$("#allDaysPnl").addClass("text-success").html("+"+(totalInUsdInner*(average7Days/100)).toFixed(2)+" <small>"+average7Days.toFixed(2)+"% Change</small>");
					  				}

					  				if(average < 0) {
					  					$("#14DaysPnl").addClass("text-danger").html((totalInUsdInner*(average/100)).toFixed(2)+" <small>"+average.toFixed(2)+"% Change</small>");
					  				}else{
					  					$("#14DaysPnl").addClass("text-success").html("+"+(totalInUsdInner*(average/100)).toFixed(2)+" <small>"+average.toFixed(2)+"% Change</small>");
					  				}

					  				new Chart("pnl_chart_container", {
					  				  	type: "line",
					  				  	data: {
					  				    	labels: xValues,
					  			    		datasets: [{
					  						      // backgroundColor: "rgba(0,0,0,1.0)",
					  						      fill: false,
					  						      label: false,
					  						      borderColor: "#94abef",
					  						      data: last7days
					  					    }]
					  					},
					  				  	options:{
					  				  		responsive: true,
				  				        	legend: {
				  				          		position: 'top',
				  				          		display: false
				  				        	},
				  				        	title: {
				  			          			display: false,
				  			          			// text: 'Chart.js Line Chart'
				  				       	 	},
					  		      		    tooltips: {
					  		      		        callbacks: {
					  		      		           label: function(tooltipItem) {
					  		      		                  return tooltipItem.yLabel;
					  		      		           }
					  		      		        }
					  		      		    }
					  				  	}
					  				});

					  				var xValues = getDaysDate(13);

					  				new Chart("pnl_14_chart_container", {
					  				  	type: "line",
					  				  	data: {
					  				    	labels: xValues,
					  			    		datasets: [{
					  						      // backgroundColor: "rgba(0,0,0,1.0)",
					  						      fill: false,
					  						      label: false,
					  						      borderColor: "#94abef",
					  						      data: yValues
					  					    }]
					  					},
					  				  	options:{
					  				  		responsive: true,
				  				        	legend: {
				  				          		position: 'top',
				  				          		display: false
				  				        	},
				  				        	title: {
				  			          			display: false,
				  			          			// text: 'Chart.js Line Chart'
				  				       	 	},
					  		      		    tooltips: {
					  		      		        callbacks: {
					  		      		           label: function(tooltipItem) {
					  		      		                  return tooltipItem.yLabel;
					  		      		           }
					  		      		        }
					  		      		    }
					  				  	}
					  				});

					  				var xValues = tokenNames;
					  				var yValues = tokenBalance;

					  				var barColors = getRandomColorIteration(xValues.length);

					  				new Chart("assets_chart_container", {
					  				  	type: "pie",
					  				  	data: {
						  				    labels: xValues,
						  				    datasets: [{
						  				      	backgroundColor: barColors,
					  				      		data: yValues
						  				    }]
					  				  	},
					  				  	options: {
						  				    title: {
					  				      		display: false,
					  				      		// text: "World Wide Wine Production 2018"
						  				    },
						  				    legend: {
					  				      		display: true
						  				    }
					  				  }
					  				});

			    		  		// chart PNL
						  		
								console.timeEnd('loadTimer');
						    }

		    		  		

					    	i++;
					  	}, 500)
					}

					myLoop();
				}, 1000);
			});
			
			$('#assets_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				console.log($('#assets_container').css("display"));
				if ($('#assets_container').css("display") == 'none') {
					addBreadCrumbs("assets_container")

					$("html, body").animate({ scrollTop: 0 }, "slow");
		  			$("#container").empty();

					$("#profile_btn").css('display',"block")
					$("#top_back_btn").css('display',"none")

			  		$("#container").fadeOut(animtionSpeed, function() {
					  	// $("#loadSpinner").fadeIn(animtionSpeed,function(){
				  			// $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/buyCrypto'}));

				  			// setTimeout(function(){
				  				// $("#loadSpinner").fadeOut(animtionSpeed,function(){
									$('#assets_container').fadeIn(animtionSpeed);
									// $('#topNavBar').toggle();
				  					// $('#bottomNavBar').toggle();
				  					$("#container").fadeIn(animtionSpeed);
				  				// });
				  			// }, 1000);
					  		
				    	// });
				  	});
				}
			});

			$('#addToken_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/addToken")
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/addToken'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});

			$('#profile_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/test-platform/user_profile/profile");

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/user_profile/profile'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});

			$('#notif_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/notificationCenter");

				$("#notif_counter_number").text("");
				$("#notif_counter_number").removeClass("animate__animated animate__bounce animate__repeat-2");
				$("#notif_counter_number").css("display", "none");
				
				clearTimeout(newNotifChecker);

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/notificationCenter'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});
	
			$('#settings_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/settings");

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings'}));
		  			$("#container").fadeIn(animtionSpeed);
		  			// $("#container").show("slide", { direction: "left" }, animtionSpeed);
				});
			});

			$('#discover_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/test-platform/discover");

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/discover'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});

			$('#rise_fall_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/riseFall")

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/riseFall'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});

			$('#future_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/future")

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/future'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});

			$('#regular_mining_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/regular_mining");
				
				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/regular_mining'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
			});

			$('#daily_mining_btn').on('click',function(){
				if (typeof tokenPriceInterval  != 'undefined') {
					clearInterval(tokenPriceInterval);
				}

				if (typeof loadTransactionTimeOut  != 'undefined') {
					clearInterval(loadTransactionTimeOut);
				}

				addBreadCrumbs("wallet/dailyMining");

				$("html, body").animate({ scrollTop: 0 }, "slow");
				$('#assets_container').css("display","none");
				$("#container").fadeOut(animtionSpeed, function() {
					$("#profile_btn").css('display',"none")
					$("#top_back_btn").css('display',"block")

		  			$("#container").empty();
		  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/dailyMining'}));
		  			$("#container").fadeIn(animtionSpeed);
				});
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
			window.location.href = 'index';//local
		}

		function loadTokenInfo(tokenInfo){
			var differenceResponse = ajaxShortLink('userWallet/getTokenDifference',{'tokenName':tokenInfo.coingeckoTokenId});

			var valueNow = differenceResponse.market_data.current_price[displayCurrency]
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

			tokenNames.push(tokenInfo.tokenName);
			tokenBalance.push(balanceInner);

			console.log($("#"+tokenInfo.id+"_amount_container"))

			$("#"+tokenInfo.id+"_amount_container").html(parseFloat(balanceInner).toFixed(tokenInfo.decimal)+' <br>'+tokenInfo.tokenName.toUpperCase());
			$("#"+tokenInfo.id+"_change_container").html(valueNow.toFixed(3)+' | <span class="'+color+'">'+sign+changePercentage.toFixed(2)+'%</span>');
			
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
			tokenNames = [];
			tokenBalance = [];
			// console.log(tokensSelected);
			
			for (var i = 0; i < tokensSelected.length; i++) {
		
				$("#tokenContainer").append(
					'<div id="'+tokensSelected[i].id+'_container" class="row mb-2">'+
						'<div class="col-2 row" style="flex-basis:10%">'+
							'<div class="col-12 mt-2">'+
								'<img  style="width: 40px;height:40px;" src="'+tokensSelected[i].tokenImage+'">'+
							'</div>'+
						'</div>'+

						'<div class="col-7 ml-4">'+
							'<span >'+
								'<span class="main-color-text" id="'+tokensSelected[i].id+'_name_container">'+
									tokensSelected[i].description+" ("+tokensSelected[i].networkName.toUpperCase()+")"+
								'</span>'+
							'</span>'+

							'<br>'+

							'<span class="h5">'+
								// '<span style="font-size: 15px;" id="'+tokensSelected[i].tokenName+'_change_container">'+
									// valueNow+' | <span class="'+color+'">'+changePercentage+'%</span>'+
								'<span class="text-muted" style="font-size:.65em;" id="'+tokensSelected[i].id+'_change_container">Loading...</span>'+
							'</span>'+
						'</div>'+

						'<div class="col-3 text-center">'+
								// '<span style="font-size: 14px;text-align: center;" id="'+tokensSelected[i].tokenName+'_amount_container">'+
									// parseFloat(balanceInner).toFixed(3)+' '+tokensSelected[i].tokenName.toUpperCase()+

								'<span class="main-color-text" style="font-size: 13px;" id="'+tokensSelected[i].id+'_amount_container">Loading...</span>'+
						'</div>'+
					'</div>'
				);

				// loadTokenInfo(tokensSelected[i].tokenName,tokensSelected[i].coingeckoTokenId)

				$('#'+tokensSelected[i].id+'_container').on('click',function(){
						if (typeof tokenPriceInterval  != 'undefined') {
							clearInterval(tokenPriceInterval);
						}

						if (typeof loadTransactionTimeOut  != 'undefined') {
							clearInterval(loadTransactionTimeOut);
						}

						addBreadCrumbs("wallet/viewTokenInfo");

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
									setTimeout(function(){
							  			$("#container").empty();
							  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTokenInfo'}));
							  			$("#profile_btn").css('display',"none")
							  			$("#top_back_btn").css('display',"block ")

								  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
								  			$('#topNavBar').toggle();
								  			$('#bottomNavBar').toggle();
								  			$("#container").fadeIn(animtionSpeed);
								  		});
									}, 1000)
							  	});

							  	$("#loading_text_container").text("Please wait");
							});
						});
				});	
				
			}
			// $('#totalInUsdContainer').text(totalInUsd.toFixed(2));
		}

		function addBreadCrumbs(page){
			// console.log(breadCrumbs[breadCrumbs.length-1],page,breadCrumbs[breadCrumbs.length-1]!=page);
			console.log(page.includes("riseFall"));
			$(".bottom-nav-item").removeClass("bottom-nav-item-active");

			if(page.includes("assets")){
				$("#assets_btn").addClass("bottom-nav-item-active");
			}

			if(page.includes("discover")){
				console.log("here");
				$("#discover_btn").addClass("bottom-nav-item-active");
			}

			if(page.includes("settings")){
				console.log("there");
				$("#settings_btn").addClass("bottom-nav-item-active");
			}

			if(page.includes("riseFall") || page.includes("future") || page.includes("regular_mining") || page.includes("dailyMining")){
				console.log("there");
				$("#modal_mining_btn").addClass("bottom-nav-item-active");
			}

			if (breadCrumbs[breadCrumbs.length-1]!=page) {
				breadCrumbs.push(page);
			}
		}

		$("#top_back_btn").on("click",function(){

			$(".bottom-nav-item").removeClass("bottom-nav-item-active");
			
			if(breadCrumbs[breadCrumbs.length-2].includes("assets")){
				$("#assets_btn").addClass("bottom-nav-item-active");
			}

			if(breadCrumbs[breadCrumbs.length-2].includes("discover")){
				console.log("here");
				$("#discover_btn").addClass("bottom-nav-item-active");
			}

			if(breadCrumbs[breadCrumbs.length-2].includes("settings")){
				console.log("there");
				$("#settings_btn").addClass("bottom-nav-item-active");
			}

			if(breadCrumbs[breadCrumbs.length-2].includes("riseFall") || breadCrumbs[breadCrumbs.length-2].includes("future") || breadCrumbs[breadCrumbs.length-2].includes("regular_mining") || breadCrumbs[breadCrumbs.length-2].includes("dailyMining")){
				console.log("there");
				$("#modal_mining_btn").addClass("bottom-nav-item-active");
			}
			
			if (typeof tokenPriceInterval  != 'undefined') {
				clearInterval(tokenPriceInterval);
			}

			if (typeof chatDetailsChecker  != 'undefined') {
				clearInterval(chatDetailsChecker);
			}

			if (typeof updateChatHistoryInterval  != 'undefined') {
				clearInterval(updateChatHistoryInterval);
			}

			if (typeof loadTransactionTimeOut  != 'undefined') {
				clearInterval(loadTransactionTimeOut);
			}

			if (breadCrumbs[breadCrumbs.length-1].includes("dailyMining") && $("#daily_mining_token_containers").css('display')!='none') {
				$("#bottomNavBar").css("display","flex");

				goback_btn();
				console.log('here');
			}else if(breadCrumbs[breadCrumbs.length-1].includes('wallet/settings/chat')){
				$.confirm({
					theme:'dark',
					icon: 'fa fa-sign-out',
					title: 'Disconnecting?',
					columnClass: 'col-md-6 col-md-offset-6',
					content: 'Are you sure you want to <b>close this ticket</b>? This will disconnect you with the current representative and put you back on queue',
					buttons: {
						confirm: function () {
							var updateChatTicket = ajaxShortLink('admin/updateChatTicket',{
								'id':createNewTicket,
								'status':"CLOSED"
							});
							
							$("#bottomNavBar").css("display","flex");
							breadCrumbs.pop()

							$("html, body").animate({ scrollTop: 0 }, "slow");
							$('#assets_container').css("display","none");
							$("#container").fadeOut(animtionSpeed, function() {
					  			$("#container").empty();
					  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':breadCrumbs[breadCrumbs.length-1]}));
					  			$("#container").show("slide", { direction: "left" }, animtionSpeed);
							  	$("#loading_text_container").text("Please wait");
							});
						},
						cancel: function () {

						},
					}
				});
			}else{
				$("#bottomNavBar").css("display","flex");

				breadCrumbs.pop()

				if(breadCrumbs[breadCrumbs.length-1]=="assets"||breadCrumbs[breadCrumbs.length-1]=="assets_container"){
					$("#assets_btn").click();
				}else if(breadCrumbs[breadCrumbs.length-1]==undefined){
					$.toast({
					    text: "Can't go back, already on the first page", // Text that is to be shown in the toast
					    icon: 'info', // Type of toast icon
					    showHideTransition: 'slide', // fade, slide or plain
					    allowToastClose: true, // Boolean value true or false
					    hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
					    stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
					    position: 'bottom-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
					    textAlign: 'left',  // Text alignment i.e. left, right or center
					    loader: true,  // Whether to show loader or not. True by default
					    loaderBg: '#9EC600',  // Background color of the toast loader
					});
				}else{
					console.log('there');

					$("html, body").animate({ scrollTop: 0 }, "slow");
					$('#assets_container').css("display","none");
					$("#container").fadeOut(animtionSpeed, function() {
			  			$("#container").empty();
			  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':breadCrumbs[breadCrumbs.length-1]}));
			  			$("#container").show("slide", { direction: "left" }, animtionSpeed);
					  	$("#loading_text_container").text("Please wait");
					});
				}

			}

			// console.log(breadCrumbs[breadCrumbs.length-1]);
		});

	</script>
</body>
</html>