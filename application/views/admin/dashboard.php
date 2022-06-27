  <?php 
session_start();
// echo json_encode($_SESSION['currentUser']);

if (!isset($_SESSION["currentUser"])) {
	header("Location:  admin-login");
}else{
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <link rel="icon" type="image/png" href="assets/imgs/ezpayex_logo.png"/>
  <title>SafetyPal Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- imported -->
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/568e202d1f.js"></script>

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
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
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

    <!-- <script src="assets/vendor/jquery.facedetection-master/dist/jquery.facedetection.min.js"></script> -->
    <!-- <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script> -->
    <!-- <script src="assets/vendor/ethereumjs/index.js"></script> -->
    
  <!-- imported -->

  <!-- Vendor JS Files -->
    <script src="assets/vendor-admin/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor-admin/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor-admin/chart.js/chart.min.js"></script>
    <script src="assets/vendor-admin/echarts/echarts.min.js"></script>
    <script src="assets/vendor-admin/quill/quill.min.js"></script>
    <script src="assets/vendor-admin/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor-admin/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor-admin/php-email-form/validate.js"></script>
    
  <!-- Vendor JS Files -->

  <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon"> -->
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
  <!-- Favicons -->

  <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Google Fonts -->

  <!-- Vendor CSS Files -->
    <link href="assets/vendor-admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor-admin/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor-admin/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor-admin/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor-admin/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor-admin/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor-admin/simple-datatables/style.css" rel="stylesheet">
  <!-- Vendor CSS Files -->

  <!-- Template Main CSS File -->
    <link href="assets/css-admin/style.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <style type="text/css">
     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
      *{
        font-family: 'Poppins', sans-serif;
      }

    /*google translate*/
      .goog-te-banner-frame.skiptranslate, .goog-te-gadget-icon {
         display: none !important;
      }

      body {
         top: 0px !important;
      }

      .goog-tooltip {
         display: none !important;
      }

      .goog-tooltip:hover {
         display: none !important;
      }

      .goog-text-highlight {
         background-color: transparent !important;
         border: none !important;
         box-shadow: none !important;
      }

      #google_translate_element{
          display: none !important;
      }

      #goog-gt-tt{
        display: none !important;
      }
  </style>
</head>

<body>
  <div style="min-width: 100%;min-height: 100%;background-color: rgb(0 0 0 / 0.75);z-index: 999999999;position: absolute; display: none;" id="loading">
      <div style="position: absolute;top:20%;left:45%;z-index: 9999;width: 250px;height: 250px;">
        <div class="spinner-border text-center text-light" id="spinner" role="status" style="width: 250px;height: 250px;">
        </div>

        <div class="text-center h3 mt-1 text-light fw-bold" style="width:100%" id="loading_text">Loading...</div>

      </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="admin-dashboard" class="logo d-flex align-items-center">
        <img src="assets/imgs/ezpayex_logo.png" alt="" style="border-radius:50%">
        <span class="d-none d-lg-block" style="font-size: 21px;font-family: 'Poppins', sans-serif;">SafetyPal <span id="userTypeTitle" style="text-transform: capitalize;font-family: 'Poppins', sans-serif;"></span></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span id="userNameLogged" class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6 id="userNameLoggedInner">Admin</h6>
              <span id="userType">Admin User</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>

            <!-- <li>
              <a class="dropdown-item d-flex bd-highlight">

                <div class="align-middle">
                  <i class="bi bi-translate"></i>
                </div>

                <div class="form-group w-100 align-middle">
                    <select id="language_selector" class="form-control form-control-sm">
                        <option value="">Select language...</option>
                        <option value="en">English</option>
                        <option value="zh-CN">Chinese (Simplified)</option>
                        <option value="zh-TW">Chinese (Traditional)</option>
                        <option value="ceb">Cebuano</option>
                        <option value="ja">Japanese</option>
                    </select>
                </div>

              </a>
            </li> -->

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" onclick="logMeOut()">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Sales <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>145</h6>
                      <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Revenue <span>| This Month</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>$3,264</h6>
                      <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Customers <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>1244</h6>
                      <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                        <td>$64</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2147</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                        <td>$47</td>
                        <td><span class="badge bg-warning">Pending</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2049</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                        <td>$147</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                        <td>$67</td>
                        <td><span class="badge bg-danger">Rejected</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2644</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                        <td>$165</td>
                        <td><span class="badge bg-success">Approved</span></td>
                      </tr>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->
          </div>
        </div><!-- End Left side columns -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Security Wallet</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">Curious Computer</a>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Template Main JS File -->
    <script src="assets/js-admin/main.js"></script>
  <!-- Template Main JS File -->
</body>

<!-- google translate -->
  <!-- <script type="text/javascript">
      // var currentUserLanguage = {
      //     'lang':"/en/zh-TW"
      // }

      function setCookie(key, value, expiry) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
      }

      function googleTranslateElementInit() {
          // setCookie('googtrans', currentUserLanguage.lang,1);
          new google.translate.TranslateElement({
              pageLanguage: 'en',
              // includedLanguages: 'en,zh-CN,zh-TW',
              // layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
              autoDisplay: true
          }, 'google_translate_element');
      }

      $("#language_selector").on('change',function(){
        if ($(this).val()!="") {
          var lang = "/en/"+$(this).val()
          setCookie('googtrans',lang ,1);
          location.reload();
        }
      })
  </script>

  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script> -->
<!-- google translate -->

<script type="text/javascript">
  var currentUser = JSON.parse('<?php echo json_encode($_SESSION['currentUser'])?>');
  console.log(currentUser, "hello");

  //User Type text UI
  $('#userNameLogged').text(capitalizeFirstLetter(currentUser.username));
  $('#userNameLoggedInner').text(capitalizeFirstLetter(currentUser.username));

  if (currentUser.userType == 'superAdmin'){
    $('#userType').text('Super Admin');
    $('#userTypeTitle').text('Admin');
  }else{
    $('#userType').text();
    // $('#userTypeTitle').text(currentUser.userType);
  }
  
  //User Type text UI

  jQuery.ajax({
      url: 'getUserTypePriv',
      data: {
        'userType' : currentUser['userType'],
      },
      type: "POST",
      success: function(response) {
        var priviledges = JSON.parse(response);
        // console.log(priviledges);
        setPriviNavbar(priviledges);
      },
      error: function(error) {
          console.log('Error:', error);
      }
  });

  function setPriviNavbar(priviArray){
      var systems = [];
      var groups = [];

      if (priviArray.length != 0) {
        for (var i = 0; i < priviArray.length; i++) {
          if (priviArray[i].type == "SYS") {
            systems.push(priviArray[i]);
          }

          if (priviArray[i].type == "GRP") {
            groups.push(priviArray[i]);
          }
        }

        for (var i = 0; i < systems.length; i++) {
          var containerGroups = [];
          for (var x = 0; x < groups.length; x++) {
            if (groups[x].typeParent == systems[i].descCode){
              containerGroups.push(groups[x]);
            }
          }
          if (containerGroups.length == 0) {
            $('#sidebar-nav').append(
              '<li class="nav-item" onclick="loadPage(&apos;'+systems[i].descCode+'/index&apos;)">'+
                '<a class="nav-link collapsed" href="#">'+
                  '<span>'+systems[i].desc+'</span>'+
                '</a>'+
               '</li>'
            );
          }else{
            $('#sidebar-nav').append(
              '<li class="nav-item" id="'+systems[i].descCode+'">'+
                '<a class="nav-link collapsed" data-bs-target="#'+systems[i].descCode+'-nav" data-bs-toggle="collapse" href="#">'+
                  '</i><span>'+systems[i].desc+'</span><i class="bi bi-chevron-down ms-auto"></i>'+
                '</a>'+

                '<ul id="'+systems[i].descCode+'-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav"></ul>'+
              '</li>'
            );

            for (var x = 0; x < containerGroups.length; x++) {

              $('#'+systems[i].descCode+'-nav').append(
                '<li onclick="loadPage(&apos;'+systems[i].descCode+'/'+containerGroups[x].descCode+'&apos;)">'+
                  '<a href="#" id="'+containerGroups[x].descCode+'">'+
                    '<i class="bi bi-circle"></i><span>'+containerGroups[x].desc+'</span>'+
                  '</a>'+
                '</li>'
              );
            }
          }

          systems[i]["groups"] = containerGroups;
        }
      }else{
        $('#sidebar-wrapper').append('<center><div class="alert alert-danger m-2" role="alert"><b>ALERT:</b><br>No Systems Available<br>Please, Conctact Admin</div></center>')
        $('#sidebar-wrapper').append('<center><div class="alert alert-danger m-2" role="alert">Call or visit the admin</div></center>')
      }
  }

  function loadPage(request){
    $("#loading").toggle();
    $("#footer").toggle();
    $('#main').empty();
    $('#main').append(ajaxLoadPage('quickLoadPage',{'pagename':request}));  
  }

  function logMeOut(){
    jQuery.ajax({
        url: "adminLogout",
        type: "POST",
        success: function(response) {
          location.href = 'admin-login';
        },
        error: function(error) {
            console.log('Error:', error);
        }
    });
  }
</script>
</html>
<?php 
}
?>

