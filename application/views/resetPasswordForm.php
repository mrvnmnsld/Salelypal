
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="light" />
	<title>SafelyPal - Client Login</title>
	<link rel="icon" type="image/png" href="../assets/imgs/safetypal_logo.png"/>
</head>

<!-- libraries needed -->
	
	<script src="../assets/js/common.js"></script>
	<script src="../assets/js/rolldate.min.js"></script>
	<script src="../assets/js/admin/common.js"></script>


	<link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/simple-sidebar.css" rel="stylesheet">

	<link href="../assets/lib/DataTables/datatables.css" rel="stylesheet">
	<link href="../assets/lib/DataTables/datatables.min.css" rel="stylesheet">
	<link href="../assets/lib/DataTables/datatables.min.css" rel="stylesheet">
	<link href="../assets/lib/DataTables/buttons.dataTables.min.css" rel="stylesheet">

	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="../assets/lib/DataTables/datatables.js"></script>
	<script src="../assets/lib/DataTables/datatables.min.js"></script>
	<script src="../assets/lib/DataTables/dataTables.responsive.min.js"></script>
	<script src="../assets/lib/DataTables/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>


	<script src="../assets/lib/js-toast-master/toast.min.js"></script>

	<script src="../assets/lib/Chart.js/Chart.bundle.js"></script>

	<script src="../assets/vendor/bootbox/bootbox.min.js"></script>

	<script src="../assets/vendor/jquery-confirm/confirm.js"></script>
	<link href="../assets/vendor/jquery-confirm/confirm.css" rel="stylesheet">

	<link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://use.fontawesome.com/568e202d1f.js"></script>

	<link href="../assets/vendor/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
	<script src="../assets/vendor/bootstrap-select/dist/js/bootstrap-select.js"></script>

	<script src="../assets/vendor/jquery/jquery.validate.min.js"></script>

	<script src="../assets/vendor/jquery-toast-plugin-master/src/jquery.toast.js"></script>
	<link href="../assets/vendor/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">

	<script src="../assets/vendor/qrCode/qrcode.js"></script>

	<!-- NEW -->

		<link href="https://cdn.bootcss.com/font-awesome/5.7.2/css/all.min.css">
		<script src="../assets/vendors/slidercaptcha/longbow.slidercaptcha.js"></script>
		<!-- <script src="../assets/lib/IconCaptcha-PHP/assets/icon-captcha.min.js"></script> -->

		<!-- <link href="../assets/lib/IconCaptcha-PHP/assets/css/icon-captcha.min.css" rel="stylesheet" type="text/css"> -->
		<!-- <script src="../assets/lib/IconCaptcha-PHP/assets/js/icon-captcha.min.js" type="text/javascript"></script> -->

		<link href="../assets/css/icon-captcha.min.css" rel="stylesheet" type="text/css">
		<script src="../assets/js/icon-captcha.min.js" type="text/javascript"></script>

		<link rel="stylesheet" type="text/css" href="../assets/vendors/slidercaptcha/slidercaptcha.css"/>
	

	<!-- NEW -->

<!-- libraries needed -->

<!-- custom libraries -->
	<script src="../assets/js/common.js"></script>
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
	      /*background-color: red;*/
	      padding-top: 15px;
	      padding-bottom: 15px;
	      /*background: linear-gradient(135deg, #a10396, #4158d0);*/
      }

      .container .forms{
	      display: flex;
	      align-items: center;
	      height: 450px;
	      width: 200%;
	      transition: height 0.2s ease;
      }

      .container .form{
	      width: 50%;
	      padding: 25px;
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
	      padding: 0 0px;
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
		        color:rgba(0, 0, 0, 0.5);
		    }
		    .checked_upload{
		        color:green!important;
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
  <div class="container" style="display:;">
    <div class="forms">

      <div class="form login">
        <span class="title">SafelyPal Account Recovery</span>

        <form id="loginForm">

          <div class="input-field">
            <input id="password_new" name="password" type="password" class="password" autocomplete="chrome-off" placeholder="Enter your new password">
          </div>

          <div class="input-field">
            <input id="password_confirm" name="password" type="password" class="password" autocomplete="chrome-off" placeholder="Confirm your new password">
          </div>

          <div id="errorReporter" class="text-center"></div>

          <div class="input-field button">
            <button id="submit_login_btn" class="login-signup-btn" type="button">SUBMIT NEW PASSWORD
            </button>
          </div>
        </form>

      </div>

      <div class="form signup">
				<form id="signUpForm" style="display:">
				  <span class="title">Register</span>

          <div class="input-field">
            <input type="text" name="fullName" placeholder="Enter your Fullname">
            <i class="fa fa-user-circle-o icon"></i>
          </div>

          <div class="input-field">
            <input type="email" name="email" placeholder="Enter your email">
            <i class="fa fa-envelope-o icon"></i>
          </div>

          <div class="row mt-4">
          	<div class="col-3">
          		<div class="country-code" style="border-bottom: 2px solid #ccc; width: 90px;">
        				<select id="countryCode_select" name="countryCode">
        					<option value="" selected disabled>+00</option>
        				</select>
        			</div>
          	</div>
          	<div class="col-9 mobileNumber">
		            <input type="number" name="mobileNumber" placeholder="Enter Mobile Number">
          	</div>
          </div>

          <div class="input-field">
            <input type="password" name="password" class="password" placeholder="Create password">
            <i class="fa fa-lock icon"></i>
          </div>

          <div class="input-field">
            <input type="password" name="confirm_password" class="password" placeholder="Confirm password">
            <i class="fa fa-lock icon"></i>
            <i class="fa fa-eye-slash showHidePw"></i>
          </div>

          <div class="input-field">
            <input type="text" name="referalLink" placeholder="Enter Username or Email of referal">
            <i class="fa fa-handshake-o icon"></i>
          </div> 

          <div class="form-group form-check mt-4">
				    <input type="checkbox" class="form-check-input" name="termsCondition">
				    <label class="form-check-label">I accept the <u><a href="#" onclick='termsCondition()'>Terms and Conditions</a></u></label>
				  </div>

          <div class="input-field button">
            <button type="button" class="login-signup-btn" id="signup_btn">SIGN UP</button>
          </div>

					<div class="login-signup">
						<span class="text">Already have an account?
							<a href="#" class="text login-link">Sign in now</a>
						</span>
        	</div>
				</form>

				<div class="text-center" style="display:none;" id="otp_container">
					<div id="otp_selector" class="text-center otp-selector" style="display:">
						<span class="h3">Please select where to send your OTP</span>
						<br>
						<br>
						<div class="row">
							<button id="otp_email_btn" class="btn col-5 otp_selector_btn login-signup-btn" data-otp-type="email" style="font-size: 16px;">Send via Email</button>
							<div class="col-2"></div>
							<button id="otp_mobile_btn" class="btn col-5 otp_selector_btn login-signup-btn" data-otp-type="mobile" style="font-size: 16px;">
								Send via Mobile
							</button>
						</div>
					</div>

					<div id="otp_verifier" style="display:none">
						<div class="h4 text-success font-weight-bold" id="otp_prompt">
							We have sent the OTP!
						</div>

						<div class="prompt">
							Enter the code generated sent to <b><span id="otp-chose"></span></b> below to proceed with signup!<br>
						</div>



						<form action="" class="mt-5">
						  <input class="otp" type="number" oninput='digitValidate(this)' onkeyup='tabChange(1)' maxlength=1 >
						  <input class="otp" type="number" oninput='digitValidate(this)' onkeyup='tabChange(2)' maxlength=1 >
						  <input class="otp" type="number" oninput='digitValidate(this)' onkeyup='tabChange(3)' maxlength=1 >
						  <input class="otp" type="number" oninput='digitValidate(this)'onkeyup='tabChange(4)' maxlength=1 >
						  <input class="otp" type="number" oninput='digitValidate(this)'onkeyup='tabChange(5)' maxlength=1 >
						  <input class="otp" type="number" oninput='digitValidate(this)' maxlength=1 >
						</form>

						<hr class="mt-4">

						<div id="errorReporter_otp" class="text-danger text-center font-weight-bold"></div>

						<button id="verify_otp_btn" class='login-signup-btn btn btn-primary btn-block mt-4 customBtn'>Verify OTP</button>
						
						<div style="font-size: 14px;">
							Note: Check spam messages.
						</div>

						<div style="font-size: 14px;">
							Haven't Received OTP?<a href="#" id="resend_otp_btn"> Click here to resend</a><br><br>
							Need to edit your email/mobile number?<a href="#" id="signup_back_btn">Click here to edit!</a>
						</div>

					</div>

					<script type="text/javascript">
						let digitValidate = function(ele){
						  console.log(ele.value);
						  ele.value = ele.value.replace(/[^0-9]/g,'');
						}

						let tabChange = function(val){
						    let ele = document.querySelectorAll('#otp_container input');
						    if(ele[val-1].value != ''){
						      ele[val].focus()
						    }else if(ele[val-1].value == ''){
						      ele[val-2].focus()
						    }   
						 }
					</script>
				</div>

        <div class="text-center thank-you" style="display:none;" id="thankYou">
        	<span class="h3">
        		Signing up successfully! 
        	</span>

        	<div>
        		Please verify a selfie image and an ID picture to activate account
        	</div>

        	<br>

        	<div class="d-flex mb-2">
        		<button class="flex-fill btn btn-success" id="verify_kyc_btn">Verify Now</button>
        	</div>
        	<div class="d-flex">
        		<button class="flex-fill btn btn-primary" onclick='login.click()'>Proceed to Login</button>
        	</div>
        </div>

        <div class="" style="display:none;" id="verify_kyc_container">
        	<div id="title_kyc" class="mb-4 main-color-text"><span class="">Verification</span></div>
        	<div class="pb-1"><span class="text-muted text-left" id="subtitle_kyc">Upload photo</span></div>

        	<div id="instruction_kyc" class="text-start pt-3">
        	    <span>
        	        Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors
        	    </span>
        	</div>

        	<div class="row pt-2">
        	    <div class="col-6">
        	        <button id="faceUpload_btn" class="upload_button face_upload_btn" type="button">
        	            <span><i id="faceCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>
        	            <span  class="">Face</span>
        	        </button>

        	        <input class="form-control d-none" type="file" name="faceUpload" id="faceUpload" accept="image/png, image/gif, image/jpeg" >
        	    </div>
        	    <div class="col-6">
        	        <button id="IDUpload_btn" class="upload_button id_upload_btn" type="button">
        	            <span><i id="IDCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>
        	            <span  class="">ID</span>
        	        </button>
        	        <input class="form-control d-none" type="file" name="IDUpload" id="IDUpload" accept="image/png, image/gif, image/jpeg" >
        	    </div>
        	</div>

        	<div class="py-3">
        	    <div class="row">
        	        <div class="col-6" >
        	            <span class="main-color-text">Country</span><br>
        	            <select id="country_select" name="country_select">
        	            	<option value="" selected disabled>Please Select...</option>
        	            </select>
        	        </div>
        	        <div class="col-6">
        	            <span class="main-color-text">Birthday</span>
        	            <input readonly class="form-control" type="text" id="birthday" placeholder="Click to select date">
        	        </div>
        	    </div>

        	</div>
        	<div class="pb-3">
        	    <span class="main-color-text">Full Name</span>
        	    <input class="form-control" type="text" id="fullName_kyc" placeholder="Enter Full Name">
        	</div>
        	<hr>

        	<div id="verify_status_container" class="check_upload text-start borderstatuscontainer">
            <i id="id_checkedi" class='fa fa-check check_upload ' aria-hidden='true'></i><span id="id_checkedt" class='check_upload'> ID uploaded</span><br>
            <i id="face_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="face_checkedt" class='check_upload'> Face uploaded</span><br>
            <i id="bday_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="bday_checkedt" class='check_upload'> Birthday</span><br>
            <i id="name_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="name_checkedt" class='check_upload'> Full name</span><br>
            <i id="country_checkedi" class='fa fa-check check_upload' aria-hidden='true'></i><span id="country_checkedt" class='check_upload'> Country</span><br>
        	</div>

        	<div id="noteslist_kyc" class="m-2"> 
        	    <div class="text-left main-color-text py-2" style="font-size: 1.5rem;"><b>Important Notes</b></div>
        	    <div class="row justify-content-around px-3">
        	        <div class="col p-0">
        	            <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Don't use photo filter</span><br>
        	            <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing make up</span>
        	        </div>
        	        <div class="col text-start">
        	            <i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing glasses</span><br>
      	             	<i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> Avoid wearing hats</span>
      	             	<i class="fa fa-caret-right icon_kyc" aria-hidden="true"></i><span> You can still proceed with the verification later</span>
        	        </div>
        	    </div>
        	</div>

        	<div class="d-flex">
        		<button class="flex-fill btn btn-primary" onclick='login.click()'>Back to login</button>
        	</div>
        </div>

      </div>
    </div>
  </div>


	<script type="text/javascript">
		const queryString = window.location.search;
		const urlParams = new URLSearchParams(queryString);
		var emailRecovery = urlParams.get('email')

		console.log(emailRecovery);

		if (emailRecovery==""||emailRecovery==null) {
			window.location.href = "../index";
		}

		$("#submit_login_btn").on("click",function(){

			var newPassword = $("#password_new").val();
			var confirmPassword = $("#password_confirm").val();
			var proceed = 0;

			$("#errorReporter").removeClass("text-danger");
			$("#errorReporter").removeClass("text-success");

			console.log(newPassword.length == 6)

			if (newPassword.length < 6) {

				$("#errorReporter").addClass("text-danger");
				$("#errorReporter").text("Password must be at least 6 characters");
			}else{
				if (newPassword==confirmPassword) {
					$("#errorReporter").addClass("text-success");
					$("#errorReporter").text("You can now login with your new password! Redirecting you to login page...");

					var res = ajaxShortLinkNoParse("../accountRecovery/resetPassword",{
						'email':emailRecovery,
						'new_password':newPassword
					})

					console.log(res);

					setTimeout(function(){
						window.location.href = "../index";
					},3000)
					
				}else{
					$("#errorReporter").addClass("text-danger");
					$("#errorReporter").text("Password must match");
				}
			}

			
		})


	</script>
</body>
</html>

<!-- ARLLLLLL