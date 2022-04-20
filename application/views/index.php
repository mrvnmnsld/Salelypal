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
			<span class="h3 font-weight-bold">Welcome to Security Wallet</span><br>
			<small>Where your tokens are safe!</small>

			<!-- <sub>Please input your email and password</sub> -->
			<br>

			<form id="loginForm">
		  		<div class="form-group">
				    <label for="exampleInputEmail1" class="font-weight-bold">Email</label>
				    <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter email">
			 	</div>
			  	
			  	<div class="form-group">
			    	<label for="exampleInputPassword1" class="font-weight-bold">Password</label>
			    	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
			  	</div>

			  	<canvas id="captcha" style="background-color: white;height: 45px;"></canvas>

	  	  		<div class="form-group mt-2">
	  			    <label for="exampleInputEmail1" class="font-weight-bold">Enter Captcha above</label>
	  			    <input type="text" class="form-control" name="captcha" aria-describedby="emailHelp" placeholder="Enter Captcha above">
	  		 	</div>

			  	<div class="text-center bg-dark text-danger mb-3" id="errorReporter"></div>

			  	<button type="submit" class="btn btn-success col-md-12">Login</button>

			  	<br>
			  	
			  	<span>
			  		<button id="signUpBtn" class="btn btn-link text-primary" href="#signUp">Not yet a member? Click here</button>
			  	</span>
			</form>
		</div>
	</div>

	<div class="separator">
		<div class="text-light text-center mt-5 bg-dark footer">
			©2022 All Rights Reserved by Security Wallet<br>
			<!-- <a class="btn btn-link text-light" id="adminLogin" href="#"><u>Admin Login for desktop</u></a> -->
		</div>
	</div>

	<script>
		var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
		var referalCode = getUrlParameter('referalCode')
		var captchaRight = '';

		$(document).ready(function() {
			getImgValiCode();
			captchaRight = rightCode.toUpperCase();
			console.log('init:' + captchaRight);
			function getImgValiCode () {
			  let showNum = [];
			  let canvasWinth = 150;
			  let canvasHeight = 30;
			  let canvas = document.getElementById('captcha');
			  let context = canvas.getContext('2d');
			  canvas.width = canvasWinth;
			  canvas.height = canvasHeight;
			  let sCode = 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,0,1,2,3,4,5,6,7,8,9';
			  let saCode = sCode.split(',');
			  let saCodeLen = saCode.length;
			  for (let i = 0; i <= 3; i++) {
			    let sIndex = Math.floor(Math.random()*saCodeLen);
			    let sDeg = (Math.random()*30*Math.PI) / 180;
			    let cTxt = saCode[sIndex];
			    showNum[i] = cTxt;
			    let x = 10 + i*20;
			    let y = 20 + Math.random()*8;
			    context.font = 'bold 23px 微软雅黑';
			    context.translate(x, y);
			    context.rotate(sDeg);

			    context.fillStyle = randomColor();
			    context.fillText(cTxt, 0, 0);

			    context.rotate(-sDeg);
			    context.translate(-x, -y);
			  }
			  for (let i = 0; i <= 5; i++) {
			    context.strokeStyle = randomColor();
			    context.beginPath();
			    context.moveTo(
			      Math.random() * canvasWinth,
			      Math.random() * canvasHeight
			    );
			    context.lineTo(
			      Math.random() * canvasWinth,
			      Math.random() * canvasHeight
			    );
			    context.stroke();
			  }
			  for (let i = 0; i < 30; i++) {
			    context.strokeStyle = randomColor();
			    context.beginPath();
			    let x = Math.random() * canvasWinth;
			    let y = Math.random() * canvasHeight;
			    context.moveTo(x,y);
			    context.lineTo(x+1, y+1);
			    context.stroke();
			  }
			  rightCode = showNum.join('');
			}

			function randomColor () {
			  let r = Math.floor(Math.random()*256);
			  let g = Math.floor(Math.random()*256);
			  let b = Math.floor(Math.random()*256);
			  return 'rgb(' + r + ',' + g + ',' + b + ')';
			}
		});

		if (getLocalStorageByKey('currentUser')!=null) {
			console.log(currentUser);
			window.location.replace("homeView");

			$.toast({
			    heading: '<h6>Successful referal</h6>',
			    text: 'You can now sign up using the referal link you clicked',
			    showHideTransition: 'slide',
			    icon: 'success',
			    position: 'bottom-center'
			})
		}else{
			console.log("no active user")
		}


		if (referalCode != false) {
			var res = ajaxLoadPage('quickLoadPage',{'pagename':'signUpPage'});

			$("#container").empty();
			$("#container").append(res);
		}	

		$.validator.addMethod("captchaCheck",function(value, element) {
				return value==captchaRight;
			},
			"Captcha value does not match"
		);

		$("#loginForm").validate({
		  	errorClass: 'is-invalid',
		  	rules: {
				emailAddress: "required",
				password: "required",
				captcha: {
					required: true,
					captchaCheck: true
				}
		  	},
		  	submitHandler: function(form){
			    var data = $('#loginForm').serializeArray();
    	    	data.push({"name":'ip','value':getIpAddress()["ip"]});

			    var loginRes = ajaxShortLink('checkLoginCredentials',data);

		  		if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {
		  		  $('#errorReporter').text("Wrong Credentials.");
		  		}else if(loginRes['wrongFlag'] == 3){
		  		  $('#errorReporter').html("Account Blocked.");
		  		}else if(loginRes['wrongFlag'] == 0){
		  			setLocalStorageByKey('currentUser',JSON.stringify(loginRes['data']));
		  			window.location.replace("homeView");
		  		}
		  	}
		});

		$("#signUpBtn").on("click",function(){
			var res = ajaxLoadPage('quickLoadPage',{'pagename':'signUpPage'});

			$("#container").empty();
			$("#container").append(res);

		});

		$("#adminLogin").on("click",function(){
			window.location.href = 'adminLogin';

		});
	</script>
</body>
</html>