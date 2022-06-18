<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Security Wallet - Agent Login</title>
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
    font-family:'Montserrat', sans-serif;
    text-transform: uppercase;
    text-align: center;
    line-height: 1;
    font-size: 17px;
    font-weight: 600;
    background-color : transparent;
    padding: 10px;
    outline: none;
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
  <!-- <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/imgs/logo_main.png" alt="">
                  <span class="d-none d-lg-block text-dark h2">Security Wallet Agent</span>
                </a>
              </div>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Welcome Agent</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" id="loginForm">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
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
                      <button id="switchAdminLogin" class="btn btn-link text-primary" href="#switchAdminLogin"><u>click here for admin login</u></button>
                    </span>
                  </form>

                </div>
              </div>

              <div class="credits">
                © Security Wallet 2022
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main> -->

  <div id="login_form_container">
    <img src="assets/imgs/ezpayex_logo.png">
    <div id="title">Agent Login</div>
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
      <a href="admin-login">Click here for Admin login</a>
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
        submitHandler: function(form){
          var data = $('#loginForm').serializeArray();
          var loginRes = ajaxShortLink('agent/checkLoginCredentials',data);

          console.log(loginRes);

          if (loginRes['wrongFlag'] != 0) {
            $('#errorReporter').toggle();

            if (loginRes['wrongFlag'] == 2 || loginRes['wrongFlag'] == 1) {
              $('#errorReporter').text("Wrong Credentials.");
            }

          }else{
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