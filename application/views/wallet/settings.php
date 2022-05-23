<div class="p-2">
	<div class="text-left text-primary mb-2">Main Settings</div>

	<button id="security_btn" style="margin-left:3px" class="btn text-dark btn-light border-bottom btn-block text-left">
		<i class="fa fa-shield" aria-hidden="true"></i>
		<span style="font-size: 20px;margin-left:2px">&nbsp;Security</span>
	</button>

	<button id="price_alert_btn" class="btn text-dark btn-light border-bottom btn-block text-left">
		<i class="fa fa-bell" aria-hidden="true"></i>
		<span class="" style="font-size: 20px;">&nbsp;Price Alerts</span>
	</button>

	<button id="exportWallet_btn" class="btn text-dark btn-light border-bottom btn-block text-left">
		<i class="fa fa-exchange" aria-hidden="true"></i>
		<span class="" style="font-size: 20px;">&nbsp;Export Wallet</span>
	</button>
</div>

<hr>

<div class="p-2">
	<div class="text-left text-primary mb-2">Join Community</div>

	<button class="btn text-dark btn-light border-bottom btn-block text-left" style="font-size: 20px;margin-left:3px">
		<i class="fa fa-question" aria-hidden="true"></i>
		<span class="" style="font-size: 20px;margin-left:2px">&nbsp;FAQ/Help Center</span>
	</button>

	<button class="btn text-dark btn-light border-bottom btn-block text-left" style="font-size: 20px;">
		<i class="fa fa-facebook-square" aria-hidden="true"></i>
		<span class="">&nbsp;Facebook</span>
	</button>

	<button class="btn text-dark btn-light border-bottom btn-block text-left" style="font-size: 20px;">
		<i class="fa fa-telegram" aria-hidden="true"></i>
		<span class="">&nbsp;Telegram</span>
	</button>

	<button class="btn text-dark btn-light border-bottom btn-block text-left" style="font-size: 20px;">
		<i class="fa fa-twitter-square" aria-hidden="true"></i>
		<span class="">&nbsp;Twitter</span>
	</button>
</div>

<div>
	<button id="logOut_btn" class="btn text-danger btn-block text-center" style="font-size: 20px;margin-left:3px;">
		<span class="" >&nbsp;Logout</span>
	</button>

	<!-- <a class="text-danger" href="#" id="">Logout</a> -->
</div>

<script type="text/javascript">
	$('#exportWallet_btn').on('click',function(){
		$("#tittle_container").text('Export Wallet');

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


</script>