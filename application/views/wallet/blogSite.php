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
		<script src="assets/lib/lodash.min.js"></script>
		
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

	</style>
<!-- css -->
<body style="min-height: 130%;" class="light-mode">
	<style type="text/css">
		.font-sm{
			font-size: 1rem!important;
		}
		.font-xsm{
			font-size: .9rem!important;
		}
		.font-md{
			font-size: 1.3rem!important;
		}
		.font-lg{
			font-size: 1.6rem!important;
		}
		.font-xlg{
			font-size: 2rem!important;
		}
		.text-semibold{
			font-weight: 400;
		}
		.text-bold{
			font-weight: bold;
		}
		.text-bolder{
			font-weight: bolder;
		}
		.cardshad{
			box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px!important;
		}
		.cardshad1{
			box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
		}
		#instruction_invites{
			line-height: 1;
		}
    	.icon_kyc{
	        font-size:1rem!important;
	        color:#5426de!important;
    	}
    	.line1{
    		line-height: 1;
    	}
	</style>

	<div class="card px-2 pt-5 pb-4 mt-2 rounded shadow-lg main-card-ui m-2 cardshad">
		<h4 class="text-center mb-3 font-lg text-bold">Welcome to SafelyPal</h4>

		<div>
			<div id="news_container"></div>
		</div>
		<hr>
		<div>
			<div id="tabbed_container"></div>
		</div>
		<hr>
		<div>
			<div id="converter_container"></div>
		</div>


		<div id="newsLoading">
			<h3>
				<div class="spinner-grow main-color-text" role="status">
				  <span class="sr-only">Loading Latest News...</span>
				</div>

				Loading Latest News...
			</h3>
		</div>

		<script type="text/javascript">
			baseUrl = "https://widgets.cryptocompare.com/";
			var scripts = document.getElementsByTagName("script");
			var embedder = $("#news_container")[0];

			(function (){
				var appName = encodeURIComponent(window.location.hostname);
				if(appName==""){appName="local";}
				var s = document.createElement("script");
				s.type = "text/javascript";
				s.async = true;
				var theUrl = baseUrl+'serve/v1/coin/feed?fsym=TRX&tsym=USD&feedType=cryptoglobe';
				s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
				
				embedder.append(s)
				$("#newsLoading").toggle();
			})();

			setTimeout(function(){
				var containerATag = $("#news_container a")[1];
				$(containerATag).remove();

				$("#news_container a").attr("href",'#');
				$("#news_container a").attr("target",'');
			},1000)
		</script>

		<script type="text/javascript">
			baseUrl = "https://widgets.cryptocompare.com/";
			var scripts = document.getElementsByTagName("script");
			var embedder = $("#tabbed_container")[0];

			(function (){
				var appName = encodeURIComponent(window.location.hostname);
				if(appName==""){appName="local";}
				var s = document.createElement("script");
				s.type = "text/javascript";
				s.async = true;
				var theUrl = baseUrl+'serve/v1/coin/multi?fsyms=BTC,ETH,XMR,LTC,DASH&tsyms=USD,EUR,CNY,GBP';
				s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
				embedder.parentNode.appendChild(s);
			})();
		</script>

		<script type="text/javascript">
			baseUrl = "https://widgets.cryptocompare.com/";
			var scripts = document.getElementsByTagName("script");
			var embedder = $("#converter_container")[0];

			(function (){
			var appName = encodeURIComponent(window.location.hostname);
			if(appName==""){appName="local";}
			var s = document.createElement("script");
			s.type = "text/javascript";
			s.async = true;
			var theUrl = baseUrl+'serve/v1/coin/converter?fsym=BTC&tsyms=EUR,CNY,GBP,USD';
			s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
			embedder.parentNode.appendChild(s);
			})();
		</script>




	</div>
</body>
</html>