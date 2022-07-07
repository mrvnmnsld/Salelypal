<style type="text/css">
	.material-switch > input[type="checkbox"] {
	    display: none;   
	}

	.material-switch > label {
	    cursor: pointer;
	    height: 0px;
	    position: relative; 
	    width: 40px;  
	}

	.material-switch > label::before {
	    background: rgb(0, 0, 0);
	    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
	    border-radius: 8px;
	    content: '';
	    height: 16px;
	    margin-top: -8px;
	    position:absolute;
	    opacity: 0.3;
	    transition: all 0.4s ease-in-out;
	    width: 40px;
	}
	.material-switch > label::after {
	    background: rgb(255, 255, 255);
	    border-radius: 16px;
	    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
	    content: '';
	    height: 24px;
	    left: -4px;
	    margin-top: -8px;
	    position: absolute;
	    top: -4px;
	    transition: all 0.3s ease-in-out;
	    width: 24px;
	}
	.material-switch > input[type="checkbox"]:checked + label::before {
	    background: inherit;
	    opacity: 0.5;
	}
	.material-switch > input[type="checkbox"]:checked + label::after {
	    background: inherit;
	    left: 20px;
	}

	input[type="checkbox"]:disabled {
	  background: white!important;
	}
</style>

<div class="p-2">
	<div class="main-color-text mb-2 font-weight-bold h5">Security</div>
	<button id="security_btn" style="margin-left:3px" class="btn custom-2nd-text btn-block text-left">
		<i class="fa fa-shield" aria-hidden="true"></i>
		<span style="font-size: 18px;margin-left:2px">&nbsp;Reset Password</span>
	</button>
</div>	

<div class="p-2">
	<div class="main-color-text mb-2 font-weight-bold h5">Preference</div>
	<button id="display_currency_btn" class="btn custom-2nd-text btn-block text-left">
		<i class="fa fa-money" aria-hidden="true"></i>
		<span class="" style="font-size: 18px;">&nbsp;Display Currency</span>
	</button>

	<button id="language_btn" class="btn custom-2nd-text  btn-block text-left">
		<i class="fa fa-language" aria-hidden="true"></i>
		<span class="" style="font-size: 18px;">&nbsp;Language</span>
	</button>
	
	<button id="theme_btn" class="btn custom-2nd-text btn-block text-left d-flex">
		<div class="flex-fill">
			<i class="fa fa-paint-brush" aria-hidden="true"></i>
			<span class="" style="font-size: 18px;">&nbsp;Dark Mode</span>
		</div>

		<div class="flex-fill">
			<div class="ml-auto material-switch pull-right">
			<input id="theme_switch" name="themeSwitchToggle" type="checkbox">
			<label for="theme_switch" class="label-default secondary-color-bg"></label>
			</div>
		</div>
		
	</button>

	
</div> 
	
	<!-- <button id="price_alert_btn" class="btn text-muted  btn-block text-left">
		<i class="fa fa-bell" aria-hidden="true"></i>
		<span class="" style="font-size: 15px;">&nbsp;Price Alerts</span>
	</button>

	<button id="exportWallet_btn" class="btn text-muted  btn-block text-left">
		<i class="fa fa-exchange" aria-hidden="true"></i>
		<span class="" style="font-size: 15px;">&nbsp;Export Wallet</span>
	</button> -->



<div class="p-2">
	<div class="main-color-text mb-2 font-weight-bold h5">Follow Us</div>

	<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-facebook-square" aria-hidden="true"></i>
		<span class="">&nbsp;Facebook</span>
	</button>

	<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-telegram" aria-hidden="true"></i>
		<span class="">&nbsp;Telegram</span>
	</button>

	<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-twitter-square" aria-hidden="true"></i>
		<span class="">&nbsp;Twitter</span>
	</button>

	<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-youtube-play" aria-hidden="true"></i>
		<span class="">&nbsp;Youtube</span>
	</button>

	<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 18px;">
		<i class="fa fa-reddit" aria-hidden="true"></i>
		<span class="">&nbsp;Reddit</span>
	</button>
</div>

<div class="p-2">

	<div class="main-color-text mb-2 font-weight-bold h5">Support</div>
	<button class="btn custom-2nd-text  btn-block text-left" disabled style="font-size: 20px;margin-left:3px">
		<i class="fa fa-question" aria-hidden="true"></i>
		<span class="" style="font-size: 18px;margin-left:2px">&nbsp;FAQ/Help Center</span>
	</button>

	<hr>
	
	<button id="logOut_btn" type="button" class="btn btn-block btn-danger" style="font-size: 20px;">LOGOUT</button>
	
</div>

	

<script type="text/javascript">

	
	if(isDarkMode==1){
		$("#theme_switch").attr("checked",true)
	}else{
		$("#theme_switch").attr("checked",false)
	}

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

	$('#display_currency_btn').on('click',function(){
		addBreadCrumbs("wallet/settings/currency");

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#assets_container').css("display","none");
		$("#container").fadeOut(animtionSpeed, function() {
			$("#profile_btn").css('display',"none")
			$("#top_back_btn").css('display',"block")

  			$("#container").empty();
  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/currency'}));
  			$("#container").fadeIn(animtionSpeed);
		});
	});

	

	$('#security_btn').on('click',function(){
		addBreadCrumbs("wallet/settings/security");

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#assets_container').css("display","none");
		$("#container").fadeOut(animtionSpeed, function() {
			$("#profile_btn").css('display',"none")
			$("#top_back_btn").css('display',"block")

  			$("#container").empty();
  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/security'}));
  			$("#container").fadeIn(animtionSpeed);
		});
	});

	$('#theme_switch').on('change',function(){
		 var $this = $(this);
		 console.log($this.is(":checked"));

		if($this.is(":checked")){
			isDarkMode = 1;
			chartTheme = 'dark';
			setLocalStorageByKey("isDarkMode",1);
			$("body").removeClass( "light-mode" ).addClass( "dark-mode" );
			
		}else{
			isDarkMode = 0;
			chartTheme = 'light';
			setLocalStorageByKey("isDarkMode",0);
			$("body").removeClass( "dark-mode" ).addClass( "light-mode" );
		}
	});

	$('#price_alert_btn').on('click',function(){
		addBreadCrumbs("wallet/settings/priceAlert");
		

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#assets_container').css("display","none");
		$("#container").fadeOut(animtionSpeed, function() {
			$("#profile_btn").css('display',"none")
			$("#top_back_btn").css('display',"block")

  			$("#container").empty();
  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/priceAlert'}));
  			$("#container").fadeIn(animtionSpeed);
		});
	});

	$('#language_btn').on('click',function(){
		addBreadCrumbs("wallet/settings/language");

		$("html, body").animate({ scrollTop: 0}, "slow");
		$('#assets_container').css("display","none");
		$("#container").fadeOut(animtionSpeed, function() {
			$("#profile_btn").css('display',"none")
			$("#top_back_btn").css('display',"block")

  			$("#container").empty();
  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/settings/language'}));
  			$("#container").fadeIn(animtionSpeed);
		});
	});

	$('#logOut_btn').on('click',function(){
		$.confirm({
			theme:'dark',
			icon: 'fa fa-sign-out',
			title: 'Logging out?',
			columnClass: 'col-md-6 col-md-offset-6',
			content: 'Are you sure you want to <b>logout</b>?',
			buttons: {
				confirm: function () {
					deleteLocalStorageByKey('currentUser');
					window.location.href = 'test-account';//local
				},
				cancel: function () {

				},
			}
		});
	});
</script>