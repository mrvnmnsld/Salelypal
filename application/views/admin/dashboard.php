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

  <link rel="icon" type="image/png" href="assets/imgs/safetypal_logo.png"/>
  <title>SafelyPal Dashboard</title>
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

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
      .apexcharts-toolbar{
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
        <img src="assets/imgs/safetypal_logo.png" alt="">
        <span class="d-none d-lg-block" style="font-size: 21px;font-family: 'Poppins', sans-serif;">SafelyPal <span id="userTypeTitle" style="text-transform: capitalize;font-family: 'Poppins', sans-serif;"></span></span>
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

            <!-- <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li> -->

            <li>
              <a class="dropdown-item d-flex bd-highlight">

                <div class="align-middle">
                  <i class="bi bi-translate"></i>
                </div>

                <div class="form-group w-100 align-middle">
                    <select id="language_selector" class="form-control form-control-sm">
                      <option value="">Select language...</option>
                      <option class="notranslate" value="en">English</option>
                      <option value="zh-CN">Chinese (Simplified)</option>
                      <option value="zh-TW">Chinese (Traditional)</option>
                      <option class="notranslate" value="ceb">Cebuano</option>
                      <option class="notranslate" value="ja">Japanese</option>
                    </select>
                </div>
                
              </a>
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#" onclick="settings_mdl()">
                <i class="bi bi-gear"></i>
                <span>Settings</span>
              </a>
            </li>

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

    <div id="dashboard">

      <div class="pagetitle">
        <h1>Dashboard</h1>
      </div><!-- End Page Title -->

      <section class="section dashboard m-2">
        <div class="col-md-12 p-0">
            <div class="row ">
                <div class="col-xl-3 col-lg-6">
                    <div class="card1 l-bg-blue-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-medium"><i class="fas fa-users"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title1 mb-0">Number of Clients</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 id="total_number_of_clients" class="d-flex align-items-center mb-0">
                                        0
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>Person</span>
                                </div>
                            </div>
                            <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card1 l-bg-green-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title1 mb-0">Total Sales</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 id="total_amount_paid" class="d-flex align-items-center mb-0">
                                        0
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>Money</span>
                                </div>
                            </div>
                            <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card1 l-bg-orange-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-headset"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title1 mb-0">Number of Agents</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 id="total_number_of_agents" class="d-flex align-items-center mb-0">
                                        0
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>Person</span>
                                </div>
                            </div>
                            <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card1 l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-calendar-day"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title1 mb-0">Updated as of</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 id="date_today" class="d-flex align-items-center mb-0">
                                        0
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>Date</span>
                                </div>
                            </div>
                            <!-- <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="col-md-12">
          <div class="row">
            <div class="card1 col-12">
              <div class="text-center m-3">
                <h2 class="fw-bold" style="color:#012970">BAR GRAPH</h2>
              </div>
              <div id="chart" style="max-width: 100%;"></div>
            </div>
          </div>
        </div>  
        <!-- End Chart -->

        <!-- Widget -->
        <div class="col-md-12">
          <div class="row">
            <div class="card col-12 p-4 align-items-center">
               <h2 class="fw-bold" style="color:#012970">CRYPTO CURRENCIES</h2>
               <div id="currency_container"></div>
            </div>
          </div>
        </div>
        <!-- End Widget -->

        <!-- Ranking -->
        <div id="innerContainer" class="card"><br>
          <div class="card-body">
            <div class="pagetitle">
              <h1>Agent Ranking Table</h1>
              <sub class="fw-bold">Agents with the highest invites</sub>
            </div>

            <hr>

            <table id="table" class="table table-hover" style="width:100%">
              <thead>
                    <tr> 
                        <th>Rank</th>
                        <th>Agent Name</th>
                        <th>Direct Invites</th>
                        <th>Downline</th>
                        <th>Date Joined</th>
                    </tr>
                </thead>
            </table>
          </div>
        </div>
        <!-- End Ranking -->
      </section>
      
    </div><!-- end_dashboard -->

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
  <script type="text/javascript">

    $(document).ready(function() {
      loadRankingTable('agent/getRanking');
    });

    function loadRankingTable(url,data){
      var callDataViaURLVal = ajaxShortLink(url,data);
      $('#table').DataTable().destroy();

      $('#table').DataTable({
        data: callDataViaURLVal,
        columns: [
          {},
          { data:'username'},
          { data:'totalDirectPaidInUSD'},
          { data:'totalIndirectPaidInUSD'},
          { data:'dateJoined'},
        ],
        "columnDefs": [{
          "targets": 0,
          "width": "5%",
          "data": 'username',
          "orderable": false,
          // "sortable": false
        }],
        // "order": [[1, 'asc']],
        "ordering": false,
        "autoWidth": false,
      });

      $('#table').DataTable().on('order.dt search.dt', function () {
        let i = 1;

        $('#table').DataTable().cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
        this.data(i++);
        });
      }).draw();
    }

    // var currentUserLanguage = {
    //     'lang':"/en/zh-TW"
    // }

    function setCookie(key, value, expiry) {
      var expires = new Date();
      expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
      document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
      document.cookie = key + '=' + value + ';expires=' + expires.toUTCString(); //local
      document.cookie = key + '=' + value + ';expires=' + expires.toUTCString()+";domain=www.testingcenter.xyz"; //live
      document.cookie = key + '=' + value + ';expires=' + expires.toUTCString()+";domain=.testingcenter.xyz"; //live
      document.cookie = key + '=' + value + ';expires=' + expires.toUTCString()+";domain=testingcenter.xyz"; //live
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

  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
<!-- google translate -->

<script type="text/javascript">
  var currentUser = JSON.parse('<?php echo json_encode($_SESSION['currentUser'])?>');
  console.log(currentUser, "hello");

  //User Type text UI
  $('#userNameLogged').text(capitalizeFirstLetter(currentUser.username));
  $('#userNameLoggedInner').text(capitalizeFirstLetter(currentUser.username));

  if (currentUser.userType == 'superAdmin'){
    $('#userType').text('Super Admin');
    $('#userTypeTitle').text('- Admin');
  }else{
    $('#userType').text();
    $('#userTypeTitle').text(' - '+currentUser.userType);
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

  // async function dnonetoggle(id1,id2){
  //   await $('#'+id1).toggleClass('dnone')
  //   return $('#'+id2).toggleClass('dnone')
  // }

  function settings_mdl(){
    bootbox.alert({
      message: ajaxLoadPage('quickLoadPage',{'pagename':'admin/settings'}),
      size: 'large',
      centerVertical: true,
      closeButton: false
    });
  }

  var d = new Date();
  var year = d.getFullYear();
  var  months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  var monthName=months[d.getMonth()];
  var today = (monthName) + " " + d.getDate() + ", " + d.getFullYear();

  var getAllClients = ajaxShortLink("admin/getAllUsers",{
    'userID' : currentUser.id
  });

  var getAllAgents = ajaxShortLink("agent/getAgent",{
    'id' : currentUser.id
  });

  var getPurchase = ajaxShortLink("userWallet/getAllPurchase",{
    'userID' : currentUser.id,
  });

  console.log(year) 

  var totalAmountPaid = 0;

  for (i=0; i < getPurchase.length; i++){  
    totalAmountPaid = totalAmountPaid+parseFloat(getPurchase[i].amountPaid);
    // console.log(parseFloat(getPurchase[i].amountPaid))
  }

  var numberOfDays = getDaysDateV2(6);

  var loadSalesGraphData = ajaxShortLink("admin/loadSalesGraphData",{
    'numberOfDays':JSON.stringify(numberOfDays)
  });

  // console.log(loadSalesGraphData);

  // here is chart
  var options = {
       series: [{
       name: 'Sales Per Day',
       data: loadSalesGraphData
      }],
       chart: {
       height: 350,
       type: 'bar',
     },
     plotOptions: {
       bar: {
         borderRadius: 10,
         dataLabels: {
           position: 'top', // top, center, bottom
         },
       }
     },
     dataLabels: {
       enabled: true,
       formatter: function (val) {
         return "$" + val + " USD";
       },
       offsetY: -20,
       style: {
         fontSize: '12px',
         colors: ["#012970"]
       }
     },
     
     xaxis: {
       categories: numberOfDays,
       position: 'top',
       axisBorder: {
         show: false
       },
       axisTicks: {
         show: false
       },
       crosshairs: {
         fill: {
           type: 'gradient',
           gradient: {
             colorFrom: '#D8E3F0',
             colorTo: '#BED1E6',
             stops: [0, 100],
             opacityFrom: 0.4,
             opacityTo: 0.5,
           }
         }
       },
       tooltip: {
         enabled: true,
       }
     },
     yaxis: {
       axisBorder: {
         show: false
       },
       axisTicks: {
         show: false,
       },
       labels: {
         show: false,
       }
     },
     title: {
       text: 'Total Daily Sales for 7 days, ' + year,
       floating: true,
       offsetY: 330,
       align: 'center',
       style: {
         color: '#012970'
       }
     }
   };

   var chart = new ApexCharts(document.querySelector("#chart"), options);
   chart.render();
  
  $('#date_today').text(today)
  $('#total_number_of_clients').text(getAllClients.length)
  $('#total_amount_paid').text("$"+parseFloat(totalAmountPaid).toFixed(2)+ " USD")
  $('#total_number_of_agents').text(getAllAgents.length)

  // console.log(getAllClients,'hello')
</script>

<script type="text/javascript">
  baseUrl = "https://widgets.cryptocompare.com/";
  var scripts = document.getElementsByTagName("script");
  var embedder = $("#currency_container")[0];

  (function (){
    var appName = encodeURIComponent(window.location.hostname);
    if(appName==""){appName="local";}
    var s = document.createElement("script");
    s.type = "text/javascript";
    s.async = true;
    var theUrl = baseUrl+'serve/v2/coin/header?fsyms=BTC,ETH,TRX,BNB,DOGE&tsyms=BTC,USD';
    s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
    embedder.parentNode.appendChild(s);
  })();
</script>

</html>
<?php 
}
?>

