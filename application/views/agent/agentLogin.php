<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
  *{
    font-family: Poppins, sans-serif;
  }
  body{
    margin: 0;
    padding: 0;
    background: linear-gradient(120deg,#2980b9, #8e44ad) !important;
    overflow: hidden;
  }
  .center{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      background: white;
      border-radius: 10px;
      box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
      border: 2px solid #5426de;
  }
  .center h2{
      color: #5426de;
      text-align: center;
      padding: 20px 0 20px 0;
      border-bottom: 2px solid #5426de;
      font-weight: bold;
  }
  .center form{
      padding: 0 40px;
      box-sizing: border-box;
  }
  form .txt_field{
      position: relative;
      border-bottom: 2px solid #adadad;
      margin: 30px 0;
  }
  .txt_field input{
      width: 100%;
      padding: 0 5px;
      height: 40px;
      font-size: 16px;
      border: none;
      background: none;
      outline: none;
  }
  .txt_field label{
      position: absolute;
      top: 50%;
      left: 5px;
      color: #adadad;
      transform: translateY(-50%);
      font-size: 16px;
      pointer-events: none;
      transition: .5s;
      font-weight: bold;
      letter-spacing: 2px;
  }
  .txt_field span::before{
      content: '';
      position: absolute;
      top: 40px;
      left: 0;
      width: 0%;
      height: 2px;
      background: #5426de;
      transition: .5s;
  }
  .txt_field input:focus ~ label,
  .txt_field input:valid ~ label{
      top: -5px;
      color: #5426de;
  }
  .txt_field input:focus ~ span::before,
  .txt_field input:valid ~ span::before{
      width: 100%;
  }
  button{
      width: 100%;
      height: 50px;
      border: 1px solid;
      background: #5426de;
      font-size: 18px;
      color: #e9f4fb;
      font-weight: 700;
      cursor: pointer;
      letter-spacing: 5px;
      outline: none;
  }
  button:hover{
      border-color: #5426de;
      transition: .5s;
  }
  .switch_login{
      margin: 30px 0;
      text-align: center;
      font-size: 16px;
  }
  .switch_login a{
      color: #5426de;
      text-decoration: none;
  }
  .switch_login a:hover{
      color: #5426de;
      text-decoration: underline;
  }
  .img_center{
    margin-top: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    height: 90px;
    width: 320px;
  }
  p{
    color: #5426de;
    font-weight: bold;
    margin-top: 50px !important;
  }
  .is-invalid{
    color: red;
  }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link rel="icon" type="image/png" href="assets/imgs/safetypal_logo.png"/>
  <title>SafetyPal - Agent Login</title>
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

<body>

  <div class="center">
      <img src="assets/imgs/logo_safetypal.png" class="img_center">
      <h2>AGENT LOGIN</h2>
      <div id="errorReporter" class="text-center h5 animate__animated animate__shakeX" style="display:none"></div>
      <form id="loginForm" method="post">
          <div class="txt_field">
              <input type="text" name="username" required>
              <span></span>
              <label>Username</label>
          </div>
          <div class="txt_field">
              <input type="password" name="password" required>
              <span></span>
              <label>Password</label>
          </div>
          <button>LOGIN</button>
          <div class="switch_login">
             <a href="admin-login">Click here for Admin login</a>
             <p>© SafetyPal 2022</p>
          </div>
      </form>
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
          var loginRes = ajaxShortLink('agent/checkLoginCredentials',data);

          console.log(loginRes);

          if (loginRes['wrongFlag'] != 0) {
            $('#errorReporter').css("display","block");
            $('#errorReporter').css("color","red");

            if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {
              $('#errorReporter').text("Wrong Credentials.");
            }else if(loginRes['wrongFlag'] == 3){
              $('#errorReporter').html("Account frozen!");
            }
          }else{
            ('#errorReporter').text("Successfully logged in. Please wait");
            $('#errorReporter').css("color","white");
            window.location.replace("admin-dashboard");
          }
        
        }
    });

    // $("#switchAdminLogin").on("click",function(){
	
    //   window.location.replace("admin-login");

    // });

  </script>

</body>

</html>