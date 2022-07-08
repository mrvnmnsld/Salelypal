<?php
    // Start a session.
    session_start();

    // Include the IconCaptcha classes.
    require('assets/src/captcha-session.class.php');
    require('assets/src/captcha.class.php');

    use IconCaptcha\IconCaptcha;

    // Set the IconCaptcha options.
    IconCaptcha::options([
        'iconPath' => '../../assets/icons/', // required, change path according to your installation.
        'token' => false,
        'messages' => [
            'wrong_icon' => 'You\'ve selected the wrong image.',
            'no_selection' => 'No image has been selected.',
            'empty_form' => 'You\'ve not submitted any form.',
            'invalid_id' => 'The captcha ID was invalid.',
            'form_token' => 'The form token was invalid.'
        ],
        'image' => [
            'amount' => [ // min & max can be 5 - 8
                'min' => 5,
                'max' => 5
            ],
            'rotate' => false,
            'flip' => [
                'horizontally' => false,
                'vertically' => false,
            ],
            'border' => false
        ],
        'attempts' => [
            'amount' => 5,
            'timeout' => 60 // seconds.
        ],
    ]);
    
    // If the form has been submitted, validate the captcha.
    if(!empty($_POST)) {
        if(IconCaptcha::validateSubmission($_POST)) {
            echo "test";
        } else {
            echo "test";
        }
    }

    // echo dirname(__FILE__) . '../../assets/icons/';

?>
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
		<!-- <script src="assets/lib/IconCaptcha-PHP/assets/icon-captcha.min.js"></script> -->

		<!-- <link href="assets/lib/IconCaptcha-PHP/assets/css/icon-captcha.min.css" rel="stylesheet" type="text/css"> -->
		<!-- <script src="assets/lib/IconCaptcha-PHP/assets/js/icon-captcha.min.js" type="text/javascript"></script> -->

		<link href="assets/css/icon-captcha.min.css" rel="stylesheet" type="text/css">
		<script src="assets/js/icon-captcha.min.js" type="text/javascript"></script>

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
  <div class="container" style="display:none;">
    <div class="forms">

      <div class="form login">
        <span class="title">SafetyPal</span>

        <form id="loginForm">
          <div id="emailInput" class="input-field">
            <input id="emailAddress" name="emailAddress" type="email" placeholder="Enter your email">
            <i class="fa fa-envelope-o icon"></i>
						<i id="emailSwitchID" from="mobileSwitch" class="fa fa-exchange switchUserInput"></i>
          </div>

		  		<div id="mobileInput" class="input-field" style="display:none;">
            <input id="mobileNumber" name="mobileNumber" type="text" placeholder="Enter mobile number">
            <i class="fa fa-mobile icon"></i>
						<i id="mobileSwitchID" from="emailSwitch" class="fa fa-exchange switchUserInput"></i>
          </div>

          <div class="input-field">
            <input id="password" name="password" type="password" class="password" autocomplete="chrome-off" placeholder="Enter your password">
            <i class="fa fa-lock icon"></i>
            <i class="fa fa-eye-slash showHidePw"></i>
          </div>

  				<div class="iconcaptcha-holder mt-3" data-theme="light"></div>

          <div id="errorReporter" class="text-danger text-center mt-4 font-weight-bold"></div>

          <div class="input-field button">
            <button id="submit_login_btn" class="login-signup-btn" type="button">LOGIN</button>
          </div>
        </form>

        <div class="login-signup">
          <span class="text">Not a member?
            <a href="#" class="text signup-link">Sign up now</a>
          </span>
        </div>
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
        					<option value="" selected disabled>Please Select...</option>
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
            <input type="text" name="referalLink" placeholder="Enter referral link">
            <i class="fa fa-handshake-o icon"></i>
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

		$('.iconcaptcha-holder').iconCaptcha({
    	general: {
          validationPath: 'assets/src/captcha-request.php', // required, change path according to your installation.
          // fontFamily: 'Poppins',
          credits: 'hide',
      },
      messages: {
        initialization: {
            verify: 'Click to Verify',
            loading: 'Loading captcha...'
        }
      }
    });

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
		  signUp = document.querySelector(".signup-link"),
		  login = document.querySelector(".login-link");

		if (isOnline==true) {
	  	if (getLocalStorageByKey('currentUser')!=null) {
	  		if (currentUser.verified==0) {
		  			window.location.replace("homeViewNotVerified");
	  		}else{
		  		if(currentUser.isPro == 0){
		  			window.location.replace("homeView");
		  		}else {
	  				window.location.replace("homeViewPro");
		  		}	
	  		}
	  		
	  	}else{
	  		$('.container').toggle();
	  		if (referalCode != false) {
	  			setTimeout(function(){

	  				$("input[name='referalLink']").val(window.location.href);
	  				signUp.click();

  					$.toast({
  				    text: 'Successfully Added Referal Code',
  				    showHideTransition: 'slide',
  				    allowToastClose: false,
  				    hideAfter: 5000,
  				    stack: 5,
  				    position: 'bottom-center',
  				    textAlign: 'center',
  				    loader: true,
  				    loaderBg: '#9EC600'
  					})
	  			},100)
	  		}
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

			$('#country_select').append(
				'<option value="'+countryCodes[i].name+'">'+countryCodes[i].name+'</option>'
			);
		}

		$('#countryCode_select').selectpicker({
			style: '',
      size: 8,
      width: 87,
      // showSubtext :true,
      liveSearch: true
	  });

		$('#country_select').selectpicker({
			style: '',
      size: 8,
      width: 150,
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
  		$('#errorReporter').text("");

	  	if ($('.iconcaptcha-holder').text().includes("Verification complete")) {
	  		container.classList.add("active");
	  	}else{
	  		$('#errorReporter').text("Complete Verification First");
	  	}
	  });

	  login.addEventListener("click",()=>{
	  	container.classList.remove("active");
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
			
			$('#mobileSwitchID').on('click',function(){
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
				var ipAddress = '';

				try {
				  ipAddress = getIpAddress()["ip"];
				}
				catch(err) {
					ipAddress = "Cant Fetch Network Error";
				}

				var data = $('#loginForm').serializeArray();
				data.push({"name":'ip','value':ipAddress});
				var loginRes = ajaxShortLink('checkLoginCredentials',data);

				console.log(loginRes);

				if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {
					$('#errorReporter').text("Wrong Credentials.");
				}else if(loginRes['wrongFlag'] == 3){
					$('#errorReporter').html("Account Blocked.");
				}else if(loginRes['wrongFlag'] == 4){
					$("#submit_login_btn").empty().append(
						'<span class="spinner-border" role="status">'+
							'<span class="sr-only">Loading...</span>'+
						'</span>'+
						"&nbsp Success Login"
					).attr('disabled',true);

					setLocalStorageByKey('currentUser',JSON.stringify(loginRes['data']));

					window.location.replace("homeViewNotVerified");

					// $('#errorReporter').html("Account not yet verified. Please wait while we process your verification");
				}else if(loginRes['wrongFlag'] == 0){

					$('#errorReporter').text("");


					$("#submit_login_btn").empty().append(
						'<span class="spinner-border" role="status">'+
							'<span class="sr-only">Loading...</span>'+
						'</span>'+
						"&nbsp Success Login"
					).attr('disabled',true);

					setLocalStorageByKey('currentUser',JSON.stringify(loginRes['data']));

					if(loginRes.data.isPro == 0){
						window.location.replace("homeView");
					}else {
						window.location.replace("homeViewPro");
					}

				}
			}
		});
			
		$("#submit_login_btn").on("click",function(){
			if ($('.iconcaptcha-holder').text().includes("Verification complete")) {
				$('#errorReporter').text("");

				if ($("#loginForm").valid()) {
					$('#errorReporter').text("");
					$("#loginForm").submit();

					console.log("valid");
				}else{
					$('#errorReporter').text("Please Fill The Form");

					console.log("invalid");
				}
			}else{
				$('#errorReporter').text("Complete Verification First");
			}
			
		});

		$("#signup_btn").on("click",function(){
			if ($("#signUpForm").valid()) {
				$("#signUpForm").toggle()
				$("#otp_container").toggle()
			}else{
				$("#signup_btn").empty().append(
				    'SIGN UP'
				).removeAttr('disabled');
			}
		});

		$(".otp_selector_btn").on("click",function(){
			otpType = $(this).attr("data-otp-type")
			$(".otp_selector_btn").attr("disabled",true)
			$("#otp_selector").append()

			$("#otp_selector").append(
				'<div id="otp_sending_container">'+
					'<span class="spinner-border mt-3 align-bottom" role="status">'+
					  '<span class="sr-only">Loading...</span>'+
					'</span>'+
					"&nbsp Sending OTP Please wait..."+
				'</div>'
			);

			var otpRes;

			setTimeout(function(){
				console.log(`generateOTP: ${generatedOtp}`);

				if (otpType=="email") {
					otpRes = ajaxShortLink('main/sendOTPViaEmail',{
						'email':$("#signUpForm input[name='email']").val(),
						'otp':generatedOtp,
					});
					$('#otp-chose').text('Email Address '+$("#signUpForm input[name='email']").val());
				}else{
					otpRes = ajaxShortLink('main/sendOTP',{
						'mobileNumber':$('#countryCode_select').val()+$('#signUpForm input[name="mobileNumber"]').val(),
						'otp':generatedOtp,
					});
					$('#otp-chose').text('Mobile '+$('#countryCode_select').val()+$('#signUpForm input[name="mobileNumber"]').val());
				}

				$("#otp_selector").toggle()
				$("#otp_verifier").toggle()
			},1000)
		});

		$("#signup_back_btn").on("click",function(){
			$("#signUpForm").toggle()
			$("#otp_selector").toggle()
			$("#otp_container").toggle()
			$("#otp_verifier").toggle()

			$(".otp_selector_btn").attr("disabled",false);
			$("#otp_sending_container").remove();

			$("#signup_btn").empty().append(
			    'SIGN UP'
			).removeAttr('disabled');
		});

		$("#verify_otp_btn").on("click",function(){
			var otpInput = [];

			$('#otp_container input').each(function(){
				otpInput.push($(this).val())
			});

			if (otpInput.join("")==generatedOtp) {
				$("#errorReporter_otp").text("")
				$("#verify_otp_btn").empty().append(
				    '<span class="spinner-border" role="status">'+
				      '<span class="sr-only">Loading...</span>'+
				    '</span>'+
				    "&nbsp Submiting..."
				).attr('disabled',true);

				setTimeout(function(){
					$("#signUpForm").submit();
				},1000);
			}else{
				$("#errorReporter_otp").text("Captcha Doesn't Match")
			}
		});

		$("#resend_otp_btn").on("click",function(){
			$(".otp_selector_btn").attr("disabled",false);
			$("#otp_sending_container").remove();
			$("#otp_selector").toggle();
			$("#otp_verifier").toggle();
		});

		$("#verify_kyc_btn").on("click", function(){
			$("#thankYou").toggle();
			$("#verify_kyc_container").toggle();
		})

		jQuery.validator.addMethod("checkEmailAvailability", function(value, element) {
		    return (ajaxShortLinkNoParse("checkEmailAvailability",{'email':value}))
		}, "Email already taken");

		jQuery.validator.addMethod("checkMobileAvailability", function(value, element) {
		    return (ajaxShortLinkNoParse("checkMobileAvailability",{'mobileNumber':$('#countryCode_select').val()+value}))
		}, "Mobile number already taken");

		jQuery.validator.addMethod("checkPasswordConfirm", function(value, element) {
			if (value == $("#signUpForm input[name='password']").val()) {
				return true
			}else{
				return false
			}
		}, "Password Doesn't Match");

		jQuery.validator.addMethod("checkIfReferalLinkIsValid", function(value, element) {
			try {
			  var innerReferalLink = value;
			  var innerReferalLink = innerReferalLink.split("?");
			  var innerReferalLink = innerReferalLink[1].split("&");

			  var innerReferalCode=innerReferalLink[1].split('=')[1]
			  var innerReferType=innerReferalLink[0].split('=')[1]

			  if(innerReferalLink[1].split('=')[0]!="idNum"||innerReferalLink[0].split('=')[0]!="referType"){
			  	return false;
			  }else{
			  	var res = ajaxShortLinkNoParse("checkIfReferalLinkIsValid",{
			  		'referalCode':innerReferalCode,
			  		'referType':innerReferType
			  	})

			  	if(res == 'true'){
		  			return true;
			  	}else{
		  			return false;
			  	}
			  }
			}
			catch(err) {
		  	return false;
			}
			
		}, "Referal Link is Invalid");

		$("#signUpForm").validate({
		  	errorClass: 'is-invalid text-danger',
		  	rules: {
					fullName: "required",
					birthdate: "required",
					referalLink: {
						checkIfReferalLinkIsValid:true,
						required:true,
					},
					mobileNumber: {
						checkMobileAvailability:true,
						required:true,
						minlength: 7
					},
					email: {
						required:true,
						checkEmailAvailability:true
					},
					password: {
						required:true,
						minlength: 6
					},
					confirm_password:{
						checkPasswordConfirm:true,
						required:true
					}
		  	},
		  	errorPlacement: function(error, element) {
		  	  element.parent("div").after(error);
		  	},
		  	submitHandler: function(form){
			    var data = $('#signUpForm').serializeArray();

			    var referalLink = data[6].value;
			    var referalLink = referalLink.split("?");
			    var referalLink = referalLink[1].split("&");

			    referalCode=referalLink[1].split('=')[1]
			    referType=referalLink[0].split('=')[1]

	  			data.push({
	  				'name':'referalCode',
	  				'value':referalCode
	  			})

	  			data.push({
	  				'name':'referType',
	  				'value':referType
	  			})
	  	
			    console.log(data);

			    $("#fullName_kyc").val($("input[name='fullName']").val());

			    var res = ajaxShortLink("saveSignUpForm",data);
					currentUserID = res;
			    console.log(res);

			    if(res!=false){
			    	$("#signup_btn").empty().append(
			    	    'SIGN UP'
			    	).removeAttr('disabled');

			    	$("#otp_container").toggle()
			    	$("#thankYou").toggle();

			    }else{
			    	alert("error in signing up: please contact system admin !errorCode 3322!");
			    }

		  	}
		});

		// kyc
			$("#faceUpload_btn").on("click",function(){
			    $.confirm({
			    columnClass: 'col-md-6',
			    title: "Face Upload",
			    content: 'You want to Upload photo or Take photo?',
			    buttons: {
		        uploadPhoto:{
	            text: 'Upload Photo',
	            btnClass: 'btn-blue', 
	            isHidden: false,
	            isDisabled: false,
	            action: function(uploadPhoto){
	                $('#faceUpload').click();
	            }
		        },
		        takePhoto: {
	            text: 'Take Photo', // text for button
	            btnClass: 'btn-blue', // class for the button
	            isHidden: false, // initially not hidden
	            isDisabled: false, // initially not disabled
	            action: function(takePhoto){
                if(typeof isCordovaAndroid != 'undefined'){
                  console.log("hi");

                  bootbox.alert({
                      message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture'}),
                      size: 'large',
                      centerVertical: true,
                      closeButton: false
                  });
                }else{
                  if (mobileAndTabletCheck()) {
                    $.confirm({
                        theme: 'dark',
                        title: 'Not Available!',
                        content: 'This Feature Is only available in Android & Desktop View, Please Download APK or Access your account in your desktop browser',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                  }else{
                    bootbox.alert({
                        message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture'}),
                        size: 'large',
                        centerVertical: true,
                        closeButton: false
                    });
                  }
                }
	            }
		        },
		        cancel:{
	            text: 'Cancel', // text for button
	            btnClass: 'btn-danger', // class for the button
	            isHidden: false, // initially not hidden
	            isDisabled: false, // initially not disabled
	            action: function(cancel){

            	}
		        },
		    	}
		    });
			});

			$("#IDUpload_btn").on("click", function(){
			    // $('#IDUpload').click();
			    $.confirm({
		        columnClass: 'col-md-6',
		        title: "ID Upload",
		        content: 'You want to Upload photo or Take photo?',
		        buttons: {
	            uploadPhoto:{
	                text: 'Upload Photo', // text for button
	                btnClass: 'btn-blue', // class for the button
	                isHidden: false, // initially not hidden
	                isDisabled: false, // initially not disabled
	                action: function(uploadPhoto){
	                    $('#IDUpload').click();
	                }
	            },
	            takePhoto: {
		            text: 'Take Photo', // text for button
		            btnClass: 'btn-blue', // class for the button
		            isHidden: false, // initially not hidden
		            isDisabled: false, // initially not disabled
		            action: function(takePhoto){
	                if(typeof isCordovaAndroid != 'undefined'){
                    console.log("hi");

                    bootbox.alert({
                        message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture_id'}),
                        size: 'large',
                        centerVertical: true,
                        closeButton: false
                    });
	                }else{
                    if (mobileAndTabletCheck()) {
                      $.confirm({
                        theme: 'dark',
                        title: 'Not Available!',
                        content: 'This Feature Is only available in Android & Desktop View, Please Download APK or Access your account in your desktop browser',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                      });
                    }else{
                      bootbox.alert({
                        message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/verifyKYC/cameraCapture_id'}),
                        size: 'large',
                        centerVertical: true,
                        closeButton: false
                      });
                    }
	                }
		            }
	        		},
	            cancel:{
                text: 'Cancel', // text for button
		            btnClass: 'btn-danger', // class for the button
		            isHidden: false, // initially not hidden
		            isDisabled: false, // initially not disabled
		            action: function(cancel){
		                // longhand method to define a button
		                // provides more features
		            }
	            },
		        }
			    });
			});
		// kyc

	  $('#faceUpload').change(function(){
			$.confirm({
			    title: 'KYC - Face upload',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to upload image?',
			    buttons: {
			        confirm: function () {
			        	var fileContainer = document.getElementById('faceUpload');
			        	        // Check if any file is selected.
			        	if (fileContainer.files.length > 0) {
		        	    for (var x = 0; x <= fileContainer.files.length - 1; x++) {
	        	        var file = fileContainer.files.item(x).size;
	        	        var fileSize = Math.round((file / 1024));
	        	        // The size of the file.
	        	        console.log(fileSize);
	        	        if (fileSize >= 4096) {
	        	            $.confirm({
	        	            	theme: 'dark',
	        	                title: 'Error!',
	        	                content: 'File too Big, please select a file less than 4mb',
	        	                typeAnimated: true,
	        	                buttons: {
	        	                    close: function () {
	        	                    }
	        	                }
	        	            });
	        	        }else{
	        	        	continueUpload();
	        	        }
		        	    }
			        	}

			        	function continueUpload(){
				        	var imageUploadFormData = new FormData();

				        	imageUploadFormData.append(currentUserID+"_faceImage", $('#faceUpload')[0].files[0],currentUserID+"_faceImage");
									imageUploadFormData.append('userID', currentUserID);

									$("#faceUpload_btn").empty().append(
										'<div style="font-size:12px;font-weight:100">'+
									   	'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
								   	 	' Uploading'+
					  				'</div>'
									).attr('disabled',true);

									var res;

									setTimeout(function(){
					     			res = JSON.parse(backendHandleFormData('saveFaceImageKyc',imageUploadFormData));

						     		$("#faceUpload_btn").empty().append(
						     			'<span><i id="faceCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>'+
						     			'<span class="">Face</span>'
						     		).removeAttr('disabled');

						     		console.log(res);

		    						if (res.error==0) {
		    							face_upload = 1;
		    							checkupload();

		        			    $.toast({
		        			        heading: '<h6>Face Image Uploaded</h6>',
		        			        text: 'Successfull!',
		        			        showHideTransition: 'slide',
		        			        icon: 'success',
		        			        position: 'bottom-center'
		        			    })
		    						}else{
		    							$.toast({
		    							    heading: '<h6>Error In uploading. Please check if network is strong and contact system admin</h6>',
		    							    text: 'Successfull!',
		    							    showHideTransition: 'slide',
		    							    icon: 'success',
		    							    position: 'bottom-center'
		    							})
		    						}
									},2000)
			        	}


				     		
			        },cancel: function () {
			        	
			        },
			    }
			});
		});

		$('#IDUpload').change(function(){
			$.confirm({
			    title: 'KYC - ID upload',
			    columnClass: 'col-md-6 col-md-offset-6',
			    content: 'Are you sure you want to upload image?',
			    buttons: {
		        confirm: function () {

	        	var fileContainer = document.getElementById('IDUpload');
	        	        // Check if any file is selected.
	        	if (fileContainer.files.length > 0) {
        	    for (var x = 0; x <= fileContainer.files.length - 1; x++) {
      	        var file = fileContainer.files.item(x).size;
      	        var fileSize = Math.round((file / 1024));
      	        // The size of the file.
      	        console.log(fileSize);
      	        if (fileSize >= 4096) {
      	            $.confirm({
      	            	theme: 'dark',
      	                title: 'Error!',
      	                content: 'File too Big, please select a file less than 4mb',
      	                typeAnimated: true,
      	                buttons: {
      	                    close: function () {
      	                    }
      	                }
      	            });
      	        }else{
      	        	continueUpload();
      	        }
        	    }
	        	}

	        	function continueUpload(){
		        	var imageUploadFormData = new FormData();

							imageUploadFormData.append(currentUserID+"_IDImage", $('#IDUpload')[0].files[0],currentUserID+"_IDImage");
							imageUploadFormData.append('userID', currentUserID);

							$("#IDUpload_btn").empty().append(
	   						'<div style="font-size:12px;font-weigt:100">'+
	   					   	'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+
	   				   	 	' Uploading'+
	   	  				'</div>'
							).attr('disabled',true);

							var res;

							setTimeout(function(){
			     			var res = JSON.parse(backendHandleFormData('saveIDImageKyc',imageUploadFormData));
									console.log(res);

					     		$("#IDUpload_btn").empty().append(
					     			'<span><i id="IDCheckUpload_kyc" class="fa fa-picture-o fa-inverse"></i></span>'+
					     			'<span  class="">ID</span>'
					     		).removeAttr('disabled');

									if (res.error==0) {
										id_upload = 1;
										checkupload();

			    			    $.toast({
			    			        heading: '<h6>ID Image Uploaded</h6>',
			    			        text: 'Successfull!',
			    			        showHideTransition: 'slide',
			    			        icon: 'success',
			    			        position: 'bottom-center'
			    			    })
									}else{
										$.toast({
										    heading: '<h6>Error In uploading. Please check if network is strong and contact system admin</h6>',
										    text: 'Successfull!',
										    showHideTransition: 'slide',
										    icon: 'success',
										    position: 'bottom-center'
										})
									}
							},2000)
	        	}

			        },cancel: function () {
			        	
			        },
			    }
			});
		});

    if($('#fullName_kyc').val()!=null){
    	$('#name_checkedi').addClass('checked_upload');
      $('#name_checkedt').addClass('checked_upload');
    }else{
    	$('#name_checkedi').removeClass('checked_upload');
      $('#name_checkedt').removeClass('checked_upload');
    }

		$('input[name="birthday"]').change(function(){
		    var res = ajaxShortLink("saveBirthday",{
		    	"birthday":$(this).val(),
		    	"userID":currentUserID,
		    });

		    if(res==false){
		    	$.alert("Error in Uploading Birthdate, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
		    }

		});

		$('#fullName_kyc').change(function(){
		    var res = ajaxShortLink("saveName",{
		    	"fullname":$(this).val(),
		    	"userID":currentUserID,
		    });

		    if(res==false){
		    	$.alert("Error in Uploading name, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
		    }
		});

		$('#country_select').change(function(){
			console.log($(this).val());
		    var res = ajaxShortLink("saveCountry",{
		    	"country":$(this).val(),
		    	"userID":currentUserID,
		    });

		    if(res==false){
		    	$.alert("Error in Uploading name, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
		    }

		    if($('#country_select').val()!=null){
		    	$('#country_checkedi').addClass('checked_upload');
          $('#country_checkedt').addClass('checked_upload');
		    }else{
		    	$('#country_checkedi').removeClass('checked_upload');
          $('#country_checkedt').removeClass('checked_upload');
		    }
		});

		function checkupload(){
        if  (id_upload == 1){
            $('#id_checkedi').addClass('checked_upload');
            $('#id_checkedt').addClass('checked_upload');
            $('#instruction_kyc').html("\
            <span>Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors</span>\
            ")
        }else if(face_upload == 1){
            $('#instruction_kyc').html("\
            <span>Ensure that face is centered and visible when capturing the photo to avoid facial recognition errors</span>\
            ")
            $('#face_checkedi').addClass('checked_upload');
            $('#face_checkedt').addClass('checked_upload');
        }

        if(face_upload !=0 && id_upload != 0){
            $('#instruction_kyc').html("\
            <span style='color:black;' class='main-color-text'> Face and ID uploaded successfull! you can also retake photo.</span>\
            ")
        }
    }

		new Rolldate({
		    el: '#birthday',
		    format: 'YYYY-MM-DD',
		    beginYear: 1940,
		    endYear: 2100,
		    lang:{
		        title:'Select date',
		        cancel: 'Cancel',
		        confirm: 'Confirm',
		        year: '',
		        month: '',
		        day:  ''
		    },
		    confirm: function(date) {
		        setTimeout(function(){
		           console.log($("#birthday").val(),currentUserID);

		           var res = ajaxShortLink("saveBirthday",{
		               "birthday":$("#birthday").val(),
		               "userID":currentUserID,
		           });

		           
		           if(res==false){
		               $.alert("Error in Uploading Birthdate, please contact system admin.<hr><div><b class='text-center'> ErrorCode:521</b></div>");
		           } 

	   		  if($('#birthday').val()!=''){
			    	$('#bday_checkedi').addClass('checked_upload');
	          $('#bday_checkedt').addClass('checked_upload');
			    }else{
			    	$('#bday_checkedi').removeClass('checked_upload');
	          $('#bday_checkedt').removeClass('checked_upload');
			    }
			    
		       },300)
		        
		    },
		    // init: function(){
		    //     body.style.overflow = "hidden";
		    // },confirm: function(date) {
		    //     body.style.overflow = "auto";
		    // },cancel: function(date) {
		    //     body.style.overflow = "auto";
		    // }
		})


	</script>
</body>
</html>

<!-- ARLLLLLL