<div id="container">
	<div class="h2 text-center" style="margin-top: 6vh;font-family: 'Roboto Condensed', sans-serif;">
		<!-- <div class="circle" style="margin: auto"> -->
			<img style="margin-top: 10%;width:30%;" src="assets/imgs/logo_main.png">
		<!-- </div><br> -->
	</div><br>

	<div class="text-center mt-4 login-container" style="font-family: 'Roboto Condensed', sans-serif;">
		<span class="h2 font-weight-bold">Login</span>

		<!-- <sub>Please input your email and password</sub> -->
		<br>

		<form id="loginForm">
	  		<div class="form-group">
			    <label for="exampleInputEmail1">Email</label>
			    <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-describedby="emailHelp" placeholder="Enter email">
		 	</div>
		  	
		  	<div class="form-group">
		    	<label for="exampleInputPassword1">Password</label>
		    	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
		  	</div>

		  	<canvas id="captcha" style="background-color: white;height: 45px;"></canvas>

  	  		<div class="form-group mt-2">
  			    <label for="exampleInputEmail1">Enter Captcha above</label>
  			    <input type="text" class="form-control" name="captcha" aria-describedby="emailHelp" placeholder="Enter Captcha above">
  		 	</div>

		  	<div class="text-center bg-dark text-danger mb-3" id="errorReporter"></div>

		  	<button type="submit" class="btn btn-success col-md-12">Login</button>

		  	<br>
		  	
		  	<span>
		  		<button id="signUpBtn" class="btn btn-link text-primary" href="#signUp"><u>Not yet a member? Click here</u></button>
		  	</span>
		</form>
	</div>
</div>

<script type="text/javascript">
	var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
	var referalCode = getUrlParameter('referalCode')

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