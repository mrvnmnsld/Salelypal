<div class="p-2">
	<div class="main-color-text mb-2 font-weight-bold h5">Security</div>
	<button id="security_btn" style="margin-left:3px" class="btn text-muted border-bottom btn-block text-left">
		<i class="fa fa-shield" aria-hidden="true"></i>
		<span style="font-size: 18px;margin-left:2px">&nbsp;Reset Password</span>
	</button>
</div>	

<div class="p-2">
	<div class="main-color-text mb-2 font-weight-bold h5">Preference</div>
	<button id="display_currency_btn" disabled class="btn text-muted border-bottom btn-block text-left">
		<i class="fa fa-money" aria-hidden="true"></i>
		<span class="" style="font-size: 18px;">&nbsp;Display Currency</span>
	</button>

	<button id="language_btn" class="btn text-muted border-bottom btn-block text-left">
		<i class="fa fa-language" aria-hidden="true"></i>
		<span class="" style="font-size: 18px;">&nbsp;Language</span>
	</button>
	<button id="theme_btn" class="btn text-muted border-bottom btn-block text-left">
		<i class="fa fa-paint-brush" aria-hidden="true"></i>
		<span class="" style="font-size: 18px;">&nbsp;Theme</span>
	</button>
</div> 
	
	<!-- <button id="price_alert_btn" class="btn text-muted border-bottom btn-block text-left">
		<i class="fa fa-bell" aria-hidden="true"></i>
		<span class="" style="font-size: 15px;">&nbsp;Price Alerts</span>
	</button>

	<button id="exportWallet_btn" class="btn text-muted border-bottom btn-block text-left">
		<i class="fa fa-exchange" aria-hidden="true"></i>
		<span class="" style="font-size: 15px;">&nbsp;Export Wallet</span>
	</button> -->



<div class="p-2">
	<div class="main-color-text mb-2 font-weight-bold h5">Follow Us</div>

	<button class="btn text-muted border-bottom btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-facebook-square" aria-hidden="true"></i>
		<span class="">&nbsp;Facebook</span>
	</button>

	<button class="btn text-muted border-bottom btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-telegram" aria-hidden="true"></i>
		<span class="">&nbsp;Telegram</span>
	</button>

	<button class="btn text-muted border-bottom btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-twitter-square" aria-hidden="true"></i>
		<span class="">&nbsp;Twitter</span>
	</button>

	<button class="btn text-muted border-bottom btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-youtube-play" aria-hidden="true"></i>
		<span class="">&nbsp;Youtube</span>
	</button>

	<button class="btn text-muted border-bottom btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-reddit" aria-hidden="true"></i>
		<span class="">&nbsp;Reddit</span>
	</button>
</div>

<div class="p-2">

	<div class="main-color-text mb-2 font-weight-bold h5">Support</div>
	<button class="btn text-muted border-bottom btn-block text-left" disabled style="font-size: 20px;margin-left:3px">
		<i class="fa fa-question" aria-hidden="true"></i>
		<span class="" style="font-size: 18px;margin-left:2px">&nbsp;FAQ/Help Center</span>
	</button>

	<hr>
	
	<button id="logOut_btn" type="button" class="btn btn-block btn-danger" style="font-size: 20px;">LOGOUT</button>
	
</div>

	

<script type="text/javascript">
	$('#exportWallet_btn').on('click',function(){
		// $("#tittle_container").text('Export Wallet');

    	// $.when(closeNav()).then(function() {
    	// 	$('#topNavBar').toggle();
     //  		$("#container").fadeOut(animtionSpeed, function() {
    	// 	  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
    	//   			$("#container").empty();
    	//   			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/export'}));

    	// 	  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
    	// 	  			$('#topNavBar').toggle();
    	// 	  			$("#container").fadeIn(animtionSpeed);
    	// 	  		});
    	//     	});
    	//   	});
    	// });

    	$.confirm({
    	    title: 'Testing Mode!',
    	    content: 'Export wallet is disabled due to testing mode being active',
    	    type: 'red',
    	    typeAnimated: true,
    	    buttons: {
    	        close: function () {
    	        }
    	    }
    	});
	});

	$('#security_btn').on('click',function(){
		$("#tittle_container").text('Security');

    	$.when(closeNav()).then(function() {
    		$('#topNavBar').toggle();
      		$("#container").fadeOut(animtionSpeed, function() {
    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
    	  			$("#container").empty();
    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/security'}));

    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
    		  			$('#topNavBar').toggle();
    		  			$("#container").fadeIn(animtionSpeed);
    		  		});
    	    	});
    	  	});
    	});
	});

	$('#price_alert_btn').on('click',function(){
		$("#tittle_container").text('Price Alert');

    	$.when(closeNav()).then(function() {
    		$('#topNavBar').toggle();
      		$("#container").fadeOut(animtionSpeed, function() {
    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
    	  			$("#container").empty();
    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/priceAlert'}));

    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
    		  			$('#topNavBar').toggle();
    		  			$("#container").fadeIn(animtionSpeed);
    		  		});
    	    	});
    	  	});
    	});
	});

	$('#logOut_btn').on('click',function(){
		$.confirm({
			icon: 'fa fa-sign-out',
			title: 'Logging out?',
			columnClass: 'col-md-6 col-md-offset-6',
			content: 'Are you sure you want to <b>logout</b>?',
			buttons: {
				confirm: function () {
					deleteLocalStorageByKey('currentUser');
					window.location.href = 'index';//local
				},
				cancel: function () {

				},
			}
		});
	});

	$('#language_btn').on('click',function(){
		$("#tittle_container").text('Language ');

		    	$.when(closeNav()).then(function() {
		    		$('#topNavBar').toggle();
		      		$("#container").fadeOut(animtionSpeed, function() {
		    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
		    	  			$("#container").empty();
		    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/language'}));

		    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
		    		  			$('#topNavBar').toggle();
		    		  			$("#container").fadeIn(animtionSpeed);
		    		  		});
		    	    	});
		    	  	});
		    	});
	});

	$("#back_btn").on("click",function(){
		$('#assets_btn').click();
	});

	$('#theme_btn').on('click',function(){
		console.log('themebtn clicked');

		// var theme = 0;

		// if(theme==0){
		// 	$("body").css({
		// 	'background-color' : '#220e5d!important;',
		// 	'color' : 'white!important;',
		// 	});
		// 	$(".main-color-text").css({
		// 		'color' : 'white!important;',
		// 	});
		// 	$(".main-color-bg").css({
		// 		'background-color' : '#120731!important;',
		// 	});
		// 	$(".modal-content").css({
		// 		'background-color' : '#220e5d!important;',
		// 	});
		// 	$(".nav-tabs,.nav-item.show,.nav-link, .nav-tabs,.nav-link,.active").css({
		// 		'background-color' : 'white!important;',
		// 	});
		// 	theme = 1;
		// }else{
		// 	$("body").css({
		// 	'background-color' : 'white!important;',
		// 	});
		// 	$(".main-color-text").css({
		// 		'color' : '#3a189f!important;',
		// 	});
		// 	$(".main-color-bg").css({
		// 		'background-color' : '#5426de!important;',
		// 	});
		// 	$(".modal-content").css({
		// 		'background-color' : 'white!important;',
		// 	});
		// 	$(".nav-tabs,.nav-item.show,.nav-link, .nav-tabs,.nav-link,.active").css({
		// 		'background-color' : '#3a189f!important;',
		// 	});
		// 	theme = 0;
		// }	
	});


</script>