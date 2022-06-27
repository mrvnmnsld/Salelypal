<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link rel="icon" type="image/png" href="assets/imgs/ezpayex_logo.png"/>
  <title>SafetyPal - Admin Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon"> -->
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor-admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor-admin/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor-admin/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor-admin/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor-admin/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor-admin/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor-admin/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css-admin/style.css" rel="stylesheet">

  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
  *{
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  body{
    margin: 0;
    height: 100vh;
    width: 100vw;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 300;
    background: linear-gradient(to left bottom, #e9e9e9, #ebebeb, #d6d6d6, #b1b1b1, #505050);
  }
  #login_form_container{
    text-align: center;
    filter: blur(0.4px);
    width: 430px;
    height: 700px;
    padding: 60px 35px 35px 35px;
    border-radius: 10px;
    /*background: radial-gradient(circle, #555555, #535353, #505050, #4e4e4e, #4c4c4c);*/
    background: #293038;
    box-shadow: 
    /*bottom shadow*/
    0px 20px 20px rgba(0,0,0,0.2),
    0px 5px 10px rgba(0,0,0,0.2),
    /*long bottom shadow*/
    0px 70px 50px rgba(0,0,0,0.4),
    /*right shadow*/
    30px 50px 50px rgba(0,0,0,0.2),
    /*left shadow*/
    -30px 50px 50px rgba(0,0,0,0.2),
    /*right inset*/
    inset 20px 0px 60px rgba(0,0,0,0.1),
    /*left inset*/
    inset -20px 0px 60px rgba(0,0,0,0.1);
  }
  img{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto;
    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
  }
  #title{
    text-align: center;
    font-size: 28px;
    padding-top: 24px;
    letter-spacing: 0.5px;
    color: white;
    font-weight: bold;
  }
  #sub-title{
    text-align: center;
    font-size: 15px;
    padding-top: 7px;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-weight: bold;
    color: white;
    margin-bottom: 50px;
  }
  .input-field{
    width: 100%;
    height: 50px;
    background: rgb(232, 240, 254);
    margin: 10px 0;
    padding: 10px;
    border: 2px solid #293038;
    border-radius: 50px;
    display: flex;
    align-items: center;
  }
  .input-field i {
    flex: 1;
    text-align: center;
    color: #666;
    font-size: 23px;
    margin-top: 3px;
  }
  .input-field input{
    flex: 5;
    background: none;
    border: none;
    outline: none;
    width: 100%;
    font-size: 18px;
    font-weight: 600;
    color: #444;
  }
  .credits{
    margin-top: 50px;
    text-align: center;
    color: white;
  }
  button{
    width: 100%;
    height: 50px;
    transition: all .5s ease;
    color: #fff;
    border: 2px solid white;
    border-radius: 20px !important;
    margin-top: 20px !important;
    text-align: center;
    font-weight: 600;
    background-color : transparent;
    padding: 10px;
    outline: none;
    letter-spacing: 5px;
  }
  button:hover {
      color: #001F3F;
      background-color: #fff;
  }
  .is-invalid{
    color: red;
  }
</style>


<body>
  <div id="login_form_container">
    <img src="assets/imgs/logo_safetypal_bottom_text.png" class="">
    <div id="title">Admin Login</div>
    <div id="sub-title">SafetyPal</div>

    <form id="loginForm">

      <div id="errorReporter" class="text-center h5 animate__animated animate__shakeX" style="display:none"></div>

      <div class="input-field"> 
        <i class="fa fa-user"></i>
        <input type="text" name="username" placeholder="Username">     
      </div>

      <div class="input-field"> 
        <i class="fa fa-lock"></i>
        <input type="password" name="password" placeholder="Password">     
      </div>

      <button>LOGIN</button>

    </form>

    <br>

    <div>
      <a href="agent-login">Click here for Agent login</a>
    </div>

    

    <div class="credits">
      <p>© SafetyPal 2022</p>
    </div>

  </div>
  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <script src="assets/vendor-admin/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor-admin/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor-admin/chart.js/chart.min.js"></script>
  <script src="assets/vendor-admin/echarts/echarts.min.js"></script>
  <script src="assets/vendor-admin/quill/quill.min.js"></script>
  <script src="assets/vendor-admin/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor-admin/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor-admin/php-email-form/validate.js"></script>

  <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendors/nprogress/nprogress.css" rel="stylesheet">
  <link href="assets/vendors/animate.css/animate.min.css" rel="stylesheet">
  <!-- <link href="assets/build/css/custom.min.css" rel="stylesheet"> -->

  <script src="assets/vendor/jquery/jquery.min.js"></script>    
  <script src="assets/vendor/jquery/jquery.validate.min.js"></script>

  <script src="assets/js/common.js"></script>

  <script src="assets/vendor/bootbox/bootbox.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    $("#loginForm").validate({
        errorClass: 'is-invalid',
        rules: {
            username: "required",
            password: "required",
        },
        errorPlacement: function(error, element) {
          element.parent("div").after(error);
        },
        submitHandler: function(form){
          var data = $('#loginForm').serializeArray();
          var loginRes = ajaxShortLink('admin/checkLoginCredentials',data);

          console.log(data);

          if (loginRes['wrongFlag'] != 0) {
            $('#errorReporter').toggle();
            // $('#errorReporter').css("display","block");
            $('#errorReporter').css("color","red");


            if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {
              $('#errorReporter').text("Wrong Credentials.");
            }else if(loginRes['wrongFlag'] == 3){
              $('#errorReporter').html("Account frozen!");
            }
          }else{
            $('#errorReporter').text("Successfully logged in. Please wait");
            $('#errorReporter').css("color","white");
            window.location.replace("admin-dashboard");
          }
        
        }
    });

    $("#switchAgentLogin").on("click",function(){
	
      window.location.replace("agent-login");

	});

  </script>

</body>

</html>