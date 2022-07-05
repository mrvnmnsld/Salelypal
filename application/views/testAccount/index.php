<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="light" />
	<title>SafetyPal - Client Login</title>
	<link rel="icon" type="image/png" href="assets/imgs/safetypal_logo.png"/>
</head>

<!-- libraries needed -->
	
	<script src="assets/js/common.js"></script>
	<script src="assets/js/rolldate.min.js"></script>
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


	<style>
			.jq-toast-single {
		  		font-size: 16px;
			}

			/*@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');*/
			@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
	 		 *{
		      margin: 0;
		      padding: 0;
		      box-sizing: border-box;
		      font-family: 'Poppins', sans-serif;
	      }

	      body{
		      height: 100vh;
		      display: flex;
		      align-items: center;
		      justify-content: center;
		      background: linear-gradient(-135deg, #a10396, #4158d0);
		      /*background-color: #5426de;*/
	      }

	      .container:not(.jc-bs3-container){
		      position: relative;
		      max-width: 430px;
		      background: #fff;
		      box-shadow: rgba(0, 0, 0, 0.5) 0px 19px 38px, rgba(0, 0, 0, 0.30) 0px 15px 12px;
		      overflow: hidden;
		      background-color: red;
		      padding-top: 15px;
		      padding-bottom: 15px;
		      background: linear-gradient(135deg, #a10396, #4158d0);
	      }

	      .container .forms{
		      display: flex;
		      align-items: center;
		      height: 400px;
		      width: 200%;
		      transition: height 0.2s ease;
	      }

	      .container .form{
		      width: 50%;
		      padding: 45px;
		      background-color: #fff;
		      transition: margin-left 0.18s ease;
	      }

	      .container.active .login{
		      margin-left: -50%;
		      opacity: 0;
		      transition: margin-left 0.18s ease, opacity 0.15s ease;
	      }

	      .container .signup{
		      opacity: 0;
		      transition: opacity 0.09s ease;
	      }

	      .container.active .signup{
		      opacity: 1;
		      transition: opacity 0.2s ease;
	      }

	      .container.active .forms{
	      	height: auto;
	      }

	      .container .form .title{
		      position: relative;
		      font-size: 27px;
		      font-weight: 600;
		      color: #5426de;
	      }

	      .form .title::before{
		      content: '';
		      position: absolute;
		      left: 0;
		      bottom: 0;
		      height: 3px;
		      width: 30px;
		      background-color: #5426de;
	      }

	      .form .input-field{
		      position: relative;
		      height: 50px;
		      width: 100%;
		      margin-top: 20px;
	      }

	      .input-field input:not(.form-control){
		      position: absolute;
		      height: 100%;
		      width: 100%;
		      padding: 0 35px;
		      border: none;
		      outline: none;
		      font-size: 16px;
		      border-bottom: 2px solid #ccc;
		      border-top: 2px solid transparent;
		      transition: all 0.2s ease;
	      }

	      .input-field input:is(:focus){
	      	border-bottom-color: #5426de;
	      }

	      .input-field i{
		      position: absolute;
		      top: 50%;
		      transform: translateY(-50%);
		      color: #999;
		      font-size: 20px;
	      }

	      .input-field input:is(:focus) ~ i{
	      	color: #5426de;
	      }
	      
	      .input-field i.icon{
	      	left: 0;
	      }

	      .mobileNumber input{
	      	position: absolute;
		      height: 100%;
		      width: 88%;
		      padding: 0 25px;
		      border: none;
		      outline: none;
		      font-size: 16px;
		      border-bottom: 2px solid #ccc;
		      border-top: 2px solid transparent;
		      transition: all 0.2s ease;
	      }

	      .mobileNumber input:is(:focus){
	      	border-bottom-color: #5426de;
	      }

	      /*.mobileNumber i{
		      position: absolute;
		      top: 50%;
		      transform: translateY(-50%);
		      color: #999;
		      font-size: 20px;
	      }

	      .mobileNumber input:is(:focus) ~ i{
	      	color: #5426de;
	      }

	      .mobileNumber i.icon{
	      	left: 10;
	      }*/

	      .input-field i.showHidePw{
		      right: 0;
		      cursor: pointer;
		      padding: 10px;
	      }

		  	.input-field i.switchUserInput{
					right: 0;
					cursor: pointer;
					padding: 10px;
	      }

	      .form .text{
		      color: #333;
		      font-size: 14px;
	      }

	      .form a.text{
		      color: #5426de;
		      text-decoration: none;
	      }

	      .form a:hover{
	      	text-decoration: underline;
	      }

	      .login-signup-btn{
		      width: 100%;
		      height: 100%;
		      border: none;
		      color: #fff;
		      font-size: 20px;
		      font-weight: 1000;
		      letter-spacing: 2px;
		      background-color: #5426de;
		      cursor: pointer;
		      transition: all 0.3s ease;
	      }

	      .login-signup-btn:hover{
	      	background-color: #9e68e8;
	      }

	      button:disabled,
	      button[disabled]{
	        border: 1px solid #ac7eeb;
	        background-color: #ac7eeb;
	      }

	      .form .login-signup{
		      margin-top: 30px;
		      text-align: center;
	      }

	      /* Chrome, Safari, Edge, Opera */
	      input::-webkit-outer-spin-button,
	      input::-webkit-inner-spin-button {
	        -webkit-appearance: none;
	        margin: 0;
	      }

	      /* Firefox */
	      input[type=number] {
	        -moz-appearance: textfield;
	      }

	      /*kyc*/
	      	#title_kyc{
	      		/* font-size: 3rem; */
	      		/* font-weight: bold; */
	      		/* text-align:center; */
	      		position: relative;
	      		font-size: 35px;
	      		font-weight: 600;
	      		color: #5426de;
	      	}
	      	
	      	#title_kyc:before{
	      		content: '';
	      		position: absolute;
	      		left: 0;
	      		bottom: 0;
	      		height: 3px;
	      		width: 30px;
	      		background-color: #5426de;
	      	}

	      	#subtitle_kyc {
	      		font-size:1rem;
	      		position: relative;
	      		/* line-height:2; */
	      	}

	      	#subtitle_kyc:before {
	      		display: inline-block;
	      		content: "";
	      		height: 1px;
	      		background: #939ba2!important;
	      		position: absolute;
	      		width: 170%;
	      		top: 50%;
	      		margin-left: 120px;
	      	}

	      	.icon_kyc{
	      		font-size:1rem!important;
	      		color:#5426de!important;
	      	}

	      	#instruction_kyc{
	      		font-size:1rem;
	      		text-align: justify;
	      		font-weight: 150;
	      		color: #939ba2!important;
	      		/* color:#5426de!important; */
	      	}

	      	.font2rem{
	      		font-size:2rem;
	      	}

	      	.font1rem{
	      		font-size:1rem!important;
	      	}

	      	.upload_button{
	      		width: 100%;
	      		height: 50px;
	      		border: none;
	      		color: #fff;
	      		font-size: 1rem;
	      		font-weight: 900;
	      		letter-spacing: 3px;
	      		background-color: #5426de;
	      		cursor: pointer;
	      		transition: all 0.3s ease;
	      		margin-top:10px;
	      		border-radius: 0.25rem;
	      	}

	      	.upload_button:hover{
	      		background-color: #9e68e8;
	      	}

	      	.check_upload{
	      		color:green;
	      	}
	      /*kyc*/

	      /*otp*/
      		#otp_container input{
      		  display:inline-block;
      		  width:2.5rem;
      		  height:2.5rem;
      		  text-align:center;
      		}
	      /*otp*/

	      .is-invalid[for="mobileNumber"] {
	        margin-left: 15px;
	      }
	      .bootstrap-select > select.mobile-device:focus + .dropdown-toggle, .bootstrap-select .dropdown-toggle:focus{
	      	box-shadow: none;
	      	outline: none !important;
	      }
	</style>



<body>
  <div class="container" style="display:none;">
    <div class="forms">

      <div class="form login">
        <span class="title">SafetyPal</span>

        <form id="loginForm">
          <div id="emailInput" class="input-field">
            <input id="username" name="username" type="texrt" placeholder="Enter your username">
            <i class="fa fa-envelope-o icon"></i>
          </div>

          <div class="input-field">
            <input id="password" name="password" type="password" class="password" autocomplete="chrome-off" placeholder="Enter your password">
            <i class="fa fa-lock icon"></i>
            <i class="fa fa-eye-slash showHidePw"></i>
          </div>

          <div id="errorReporter" class="text-danger text-center mt-4"></div>

          <div class="input-field button">
            <button id="submit_login_btn" class="login-signup-btn" data-toggle="modal" data-target="#sliderCaptchaModal" type="button">LOGIN</button>
          </div>
        </form>

        <div class="login-signup">
          <span class="text">Not a member?
            <a href="#" class="text signup-link">Sign up now</a>
          </span>
        </div>
      </div>
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
  <!-- sliderCaptchaModal -->


	<script type="text/javascript">
		var otpType = '';
		var generatedOtp = generateOTP();
		var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
		var referalCode = getUrlParameter('idNum')
		var referType = getUrlParameter('referType')
		var face_upload=0;
		var id_upload=0;
		var currentUserID;
		var isOnline = navigator.onLine;

		const container = document.querySelector(".container"),
		  pwShowHide = document.querySelectorAll(".showHidePw"),
		  pwFields = document.querySelectorAll(".password"),
		  signUp = document.querySelector(".signup-link")

		if (isOnline==true) {
	  	if (getLocalStorageByKey('currentUser')!=null) {
		  			window.location.replace("test-account-wallet");
	  	}else{
	  		$(".container").toggle();
	  		console.log("no active user")
	  	}
	  }else{
	  	$.dialog({
		    title: 'No Connection Available! ',
		    content: 'Please connect to the internet to use SafetyPal',
		    closeIcon: false,
        theme: 'supervan',
		    icon: 'fa fa-warning',
		    type: 'red',
			});
	  }

		console.log(generatedOtp,referalCode);

		var countryCodes = loadJsonViaURL("assets/json/countryCodes.json");

		for (var i = 0; i < countryCodes.length; i++) {
			$('#countryCode_select').append(
				'<option data-subtext="'+countryCodes[i].name+" ("+countryCodes[i].code+')" value="'+countryCodes[i].dial_code+'">'+countryCodes[i].dial_code+'</option>'
			);
		}

		$('#countryCode_select').selectpicker({
			style: '',
      size: 8,
      width: 87,
      // showSubtext :true,
      liveSearch: true
	  });

		
	  pwShowHide.forEach(eyeIcon => {
	  	eyeIcon.addEventListener("click",()=>{
	  		pwFields.forEach(pwField => {
	  			if(pwField.type === "password"){
	  				pwField.type = "text";

	  				pwShowHide.forEach(icon =>{
	  					icon.classList.replace("fa-eye-slash","fa-eye");
	  				})
	  			}else{
	  				pwField.type = "password";

	  				pwShowHide.forEach(icon =>{
	  					icon.classList.replace("fa-eye","fa-eye-slash");
	  				})
	  			}
	  		})
	  	})
	  })

	  signUp.addEventListener("click",()=>{
	  	container.classList.add("active");
	  });


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
				// console.log("captcha slider success");

				$("#loginForm").submit();
			},
			onFail: function () {
				// captcha.reset();
			},
			onRefresh: function () {
				// captcha.reset();
			}
		});

		//userinput_switch
			var isEmailInput = true;
			var isMobileInput = false;

			function switchInput(data){
				console.log('switch button clicked');

				$('#mobileNumber').val('');
				$('#emailAddress').val('');
				$('#emailInput').toggle();
				$('#mobileInput').toggle();
				
				emailAddress

				if(data == 'emailSwitch'){
					console.log('email chosen');
					// loginType = 'email';
					isEmailInput = true;
					isMobileInput = false;
				}else{
					console.log('mobile chosen');
					// loginType = 'mobile';
					isEmailInput = false;
					isMobileInput = true;
				}
			}

			$('#emailSwitchID').on('click',function(){
				switchInput($(this).attr('from'));
			});
		//userinput_switch

		$("#loginForm").validate({
			errorClass: 'is-invalid',
			rules: {
				emailAddress : {
					required : isEmailInput,
				},
				mobileNumber : {
					required : isMobileInput,
				},
				password: "required",
			},
			submitHandler: function(form){
				captcha.reset();

				var data = $('#loginForm').serializeArray();
				data.push({"name":'ip','value':getIpAddress()["ip"]});
				var loginRes = ajaxShortLink('test-account/checkLoginCredentials',data);

				console.log(loginRes);

				if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {

					$('#errorReporter').text("Wrong Credentials.");

				}else if(loginRes['wrongFlag'] == 0){

					$('#errorReporter').text("");
					$("#submit_login_btn").empty().append(
						'<span class="spinner-border" role="status">'+
							'<span class="sr-only">Loading...</span>'+
						'</span>'+
						"&nbsp Success Login"
					).attr('disabled',true);

					setLocalStorageByKey('currentUser',JSON.stringify(loginRes['data']));

					window.location.replace("test-account-wallet");

				}
			}
		});
			
		$("#submit_login_btn").on("click",function(){
			captcha.reset();
		});

	</script>
</body>
</html>

<!-- ARLLLLLL