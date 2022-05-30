<!-- Author: Marvin Monsalud -->
<!-- Startdate: Dec 16 2021 -->
<!-- Email: marvin.monsalud.mm@gmail.com -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Security Wallet - Client Login</title>
	<link rel="icon" type="image/png" href="assets/imgs/logo_main_no_text.png"/>
</head>

<!-- libraries needed -->
	
	<script src="assets/js/common.js"></script>
	<script src="assets/js/admin/common.js"></script>


	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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

	<!-- NEW -->

	<link href="https://cdn.bootcss.com/font-awesome/5.7.2/css/all.min.css">
	<script src="assets/vendors/slidercaptcha/longbow.slidercaptcha.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/vendors/slidercaptcha/slidercaptcha.css"/>

	<!-- NEW -->

<!-- libraries needed -->

<!-- custom libraries -->
	<script src="assets/js/common.js"></script>
<!-- custom libraries -->

<!-- font -->
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');
	</style>
<!-- font -->

<style type="text/css">

	body{
		background-color: white;
		background-image: url('assets/imgs/bg-2.jpg');
		background-repeat:no-repeat;
		background-size:cover;
		background-size: 100% 110%;
		/*background-size: auto;*/
		background-attachment: fixed;
		/*color: white;*/
		font-family: 'Roboto Condensed', sans-serif;
	}

	.navbarFixed {
	  background-color: #3c3c3c;
	  overflow: hidden;
	  position: fixed;
	  bottom: 0;
	  /*width: 100%;*/
	}

	.navbarFixed a {
	  float: left;
	  display: block;
	  color: #f2f2f2;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	  font-size: 13px;
	  width: 20%;
	  font-weight: bold;
	  font-family: 'Roboto Condensed', sans-serif;
	}

	.navbarFixed a img{
	  filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(208deg) brightness(106%) contrast(102%);  
	  width: 50%;
	}

	.navbarFixed a.active {
	  color: white;
	  padding-bottom: 3px;
	  border-bottom: 3px solid white;
	}

	.cardboxes{
		background-color: #1C81D3;
		border-radius: 10px;
	}

	.footer {
		/*background-color: #cdcdcd;*/
		/*height: 180px;*/
		text-align: center;
		padding-top: 10px;
		width: 100%;
		position:fixed;
		left: 0px;
		bottom: 0px;
	  	font-family: 'Roboto Condensed', sans-serif;
	}

	/*login*/
		.login-container{
			width: 90%;
			margin-left: 5%;
			padding: 20px;
			background-color: rgba(0,0,0,0.3);
		}

		.circle{
		    border-radius: 50%;
		    width: 150px;
		    height: 150px;
		    background-color: white;
	  	}

		label.is-invalid{
			color: red;
		}


	/*login*/
</style>

<body>
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
</body>
</html>