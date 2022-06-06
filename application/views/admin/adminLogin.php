<style type="text/css">
.is-invalid{
  text-align: center;
}
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Security Wallet - Admin Login</title>
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

<!-- <style>
  *{
    box-sizing: border-box;
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
    font-family: 'Lato', sans-serif;
    font-weight: 300;
    background: linear-gradient(to left bottom, #e9e9e9, #ebebeb, #d6d6d6, #b1b1b1, #505050);
  }
  #login_form_container{
    filter: blur(0.4px);
    width: 430px;
    height: 700px;
    padding: 60px 35px 35px 35px;
    border-radius: 10px;
    /*background: radial-gradient(circle, #555555, #535353, #505050, #4e4e4e, #4c4c4c);*/
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
  }
  #sub-title{
    text-align: center;
    font-size: 15px;
    padding-top: 7px;
    letter-spacing: 3px;
    text-transform: uppercase;
    font-weight: bold;
  }
  .input-field{
    
  }
  .fields input{
    width: 100%;
    border: none;
    outline: none;
    background: none;
    font-size: 18px;
    color: white;
    padding: 10px 10px 10px 5px;
  }
</style> -->


<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/imgs/logo_main.png" alt="">
                  <span class="d-none d-lg-block text-dark h2">Security Wallet Admin</span>
                </a>
              </div>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" id="loginForm">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername">
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div id="errorReporter" class="text-center h5 text-danger animate__animated animate__shakeX" style="display:none"></div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <span class="text-center">
                      <button id="switchAgentLogin" class="btn btn-link text-primary" href="#switchAgentLogin"><u>click here for agent login</u></button>
                    </span>
                  </form>

                  <div class="credits">
                    © Security Wallet 2022
                  </div>

                </div>
              </div>

              

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <!-- <div id="login_form_container">
    <img src="assets/imgs/ezpayex_logo.png">
    <div id="title">Security Wallet Admin</div>
    <div id="sub-title">Ezpayex</div>

    <div class="input-field"> 
      <i class="fa fa-user"></i>
      <input type="text" placeholder="Username">     
    </div>

    <div class="input-field"> 
      <i class="fa fa-lock"></i>
      <input type="password" placeholder="Password">     
    </div>

    <button id="signin-button">LOGIN</button>
  </div> -->
  

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
        submitHandler: function(form){
          var data = $('#loginForm').serializeArray();
          var loginRes = ajaxShortLink('admin/checkLoginCredentials',data);

          console.log(loginRes);

          if (loginRes['wrongFlag'] != 0) {
            $('#errorReporter').toggle();

            if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {
              $('#errorReporter').text("Wrong Credentials.");
            }else if(loginRes['wrongFlag'] == 3){
              $('#errorReporter').html("Account frozen!");
            }
          }else{
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