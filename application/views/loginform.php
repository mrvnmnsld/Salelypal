<div id="container">
	<div class="h2 text-center" style="margin-top: 6vh;font-family: 'Roboto Condensed', sans-serif;">
		<!-- <div class="circle" style="margin: auto"> -->
			<img style="margin-top: 10%;width:30%;" src="assets/imgs/logo_main.png">
		<!-- </div><br> -->
	</div><br>

	<div class="text-center mt-4 login-container" style="font-family: 'Roboto Condensed', sans-serif;">
		<span class="h2 font-weight-bold">LOGIN</span>

		<!-- <sub>Please input your email and password</sub> -->
		<br>

		<form id="loginForm">
	  		<div class="form-group">
			    <label for="exampleInputEmail1" style="float:left">Email</label>
			    <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter email">
		 	</div>
		  	
		  	<div class="form-group">
		    	<label for="exampleInputPassword1"style="float:left">Password</label>
		    	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
		  	</div>

		  	<!-- <canvas id="captcha" style="background-color: white;height: 45px;"></canvas>

  	  		<div class="form-group mt-2">
  			    <label for="exampleInputEmail1">Enter Captcha above</label>
  			    <input type="text" class="form-control" name="captcha" aria-describedby="emailHelp" placeholder="Enter Captcha above">
  		 	</div> -->

		  	<div class="text-center bg-dark text-danger mb-3" id="errorReporter"></div>

		  	<button id="submit_login_btn" type="button" data-toggle="modal" data-target="#sliderCaptchaModal" class="btn btn-success col-md-12">Login</button>

		  	<br>
		  	
		  	<span>
		  		<button id="signUpBtn" class="btn btn-link text-primary" href="#signUp"><u>Not yet a member? Click here</u></button>
		  	</span>
		</form>
	</div>
</div>

<!-- sliderCaptchaModal -->
<div class="modal fade" id="sliderCaptchaModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content" style="background-color:transparent; border:none;">
		    <div id="captcha"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
	var referalCode = getUrlParameter('referalCode')

	if (getLocalStorageByKey('currentUser')!=null) {
		console.log(currentUser);
		if(currentUser.isPro == 0){
			window.location.replace("homeView");
		}
		else {
			window.location.replace("homeViewPro");
		}
		
	}else{
		console.log("no active user")
	}

	if (referalCode != false) {
		var res = ajaxLoadPage('quickLoadPage',{'pagename':'signUpPage'});

		$("#container").empty();
		$("#container").append(res);
	}	

	var captcha = sliderCaptcha({
		id: 'captcha',
		width: 280,
		height: 155,
		sliderL: 42,
		sliderR: 9,
		offset: 5,
		loadingText: 'Loading...',
		failedText: 'Try again',
		barText: 'Slide right to fill',
		repeatIcon: 'fa fa-redo',
		onSuccess: function () {
			$("#sliderCaptchaModal").css("display", 'none')
			$(".modal-backdrop").css("display", 'none')
			console.log("captcha slider success");

			$("#loginForm").submit();
		},
		onFail: function () {
			// captcha.reset();
		},
		onRefresh: function () {
			// captcha.reset();
		}
	});


	// $.validator.addMethod("captchaCheck",function(value, element) {
	// 		return value==captchaRight;
	// 	},
	// 	"Captcha value does not match"
	// );

	$("#loginForm").validate({
	  	errorClass: 'is-invalid',
	  	rules: {
			emailAddress: "required",
			password: "required",
	  	},
	  	submitHandler: function(form){
	  		captcha.reset();

		    var data = $('#loginForm').serializeArray();
	    	data.push({"name":'ip','value':getIpAddress()["ip"]});

		    var loginRes = ajaxShortLink('checkLoginCredentials',data);
		    
	  		if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {
	  		  $('#errorReporter').text("Wrong Credentials.");
	  		}else if(loginRes['wrongFlag'] == 3){
	  		  $('#errorReporter').html("Account Blocked.");
	  		}else if(loginRes['wrongFlag'] == 0){
	  			setLocalStorageByKey('currentUser',JSON.stringify(loginRes['data']));

  				if(loginRes.data.isPro == 0){
					window.location.replace("homeView");
				}
				else {
					window.location.replace("homeViewPro");
				}

	  		}
	  	}
	});

	$("#signUpBtn").on("click",function(){
		var res = ajaxLoadPage('quickLoadPage',{'pagename':'signUpPage'});

		$("#container").empty();
		$("#container").append(res);

	});

	
			
	// submit_login_btn
	$("#submit_login_btn").on("click",function(){
		// binance slider validation
		// if success continue to validate
		// validation 
		// $("#loginForm").submit();
		captcha.reset();
	});

</script>