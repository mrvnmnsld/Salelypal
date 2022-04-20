<!-- Author: Marvin Monsalud -->
<!-- Startdate: Dec 16 2021 -->
<!-- Email: marvin.monsalud.mm@gmail.com -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[LOCAL TEST]TRON - Grow more, Invest now!</title>

	<link rel="icon" type="image/png" href="assets/imgs/logo_main_no_text.png"/>
</head>

<!-- libraries needed -->
	
	<script src="assets/js/common.js"></script>
	<script src="assets/js/admin/common.js"></script>


	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	
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

	<script src="https://www.paypal.com/sdk/js?client-id=Ae1RO9QQfdAmJZrIxgXzcETFNsdWxQj7LBAx8XCbA8JJ4mnwgyWvq9q7A5fVn_5m9NP9kQ3c2XwACrhr&disable-funding=credit,paylater"></script>
	

<!-- libraries needed -->

<!-- custom libraries -->
	<script src="assets/js/common.js"></script>
	<script src="assets/js/admin/common.js"></script>
<!-- custom libraries -->

<!-- font -->
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');

		@font-face {
		  font-family: tron;
		  src: url('assets/fonts/tron.ttf')  format('truetype');
		}

		@font-face {
		  font-family:Agelast;
		  src: url('assets/fonts/Agelast.otf');
		}

	</style>
<!-- font -->

<style type="text/css">

	body{
		background-color: white;
		background-image: url('assets/imgs/bg-2.jpg');
		background-repeat:no-repeat;
		background-size:cover;
		background-attachment: fixed;
		/*color: white;*/
		font-family: 'Roboto Condensed', sans-serif;
		font-size: 16px!important;
	}

	.h4{
		font-weight: bold;
		color: white;
	}

	.navbarFixed {
		/*-webkit-box-shadow: inset 0px 5px 20px 3px rgb(0 0 0 / 52%);*/
		background-color: white;
		/*background-color: #1C81D3;*/
		overflow: hidden;
		position: fixed;
		bottom: 0;
		z-index: 3;
		/*width: 100%;*/
	}

	.navbarFixed a {
	  float: left;
	  display: block;
	  color: black;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	  font-size: 13px;
	  width: 20%;
	  font-weight: /*bold*/;
	  font-family: 'Roboto Condensed', sans-serif;
	}

	.navbarFixed a img{
	  /*filter: invert(100%) sepia(0%) saturate(0%) hue-rotate(208deg) brightness(106%) contrast(102%);  */
	  width: 70%;
	}

	.navbarFixed a.active {
	  color: black;
	  padding-bottom: 3px;
	  border-bottom: 3px solid red;
	}

	.cardboxes{
		color: white;
		/*background-color: rgb(28, 129, 211, 60%);*/
		background-color: rgb(0, 0, 0, 50%);
		/*rgb(0 0 0 / 52%)*/
		 border-radius: 10px; 
		font-family: 'Roboto Condensed', sans-serif;
		box-shadow: 3px 4px 3px 1px rgb(0 0 0 / 29%);
		-webkit-box-shadow: 3px 4px 3px 1px rgb(0 0 0 / 29%);
		letter-spacing: 1px;
		/*border: 1px solid rgb(0 0 0 / 50%);*/
	}

	.circle{
	    border-radius: 50%;
	    width: 60px;
	    height: 60px;
	    background-color: white;
  	}

  	/*.carousel-inner > .carousel-item > img {
  	  width:100%;
  	  height:250px;
  	}*/


  	.flex-container {
  	    display: flex;
  	}

  	.flex-child {
  	    flex: 1;
  	    margin-left: 3%;
  	    padding: 8px;
  	}  

  	.center {
		margin: auto;
		width: 50%;
		padding: 10px;
  	}

  	.modal-content{
  		/*background-color: #/*3c3c3c*/;*/
  	}

  	.modal-header{
  		border-bottom: 0px solid #dee2e6!important;
		background-color: rgb(0 0 0 / 79%);
	  	color: white;
  	}

  	.modal-header .bootbox-close-button{
	  	color: white;
  	}

  	.text-primary-custom{
  		color: #1C81D3;
  	}

  	.float1{
  		position: fixed;
  		/*width: 55px;*/
  		/*height: 50px;*/
  		left: 2%;
  		bottom: 11%;
  		/*background-color: white;*/
  		/*color: #6e090e;*/
  		/*border-radius: 100%;*/
  		/*text-align: center;*/
  		/*box-shadow: 0px 1px 11px 3px #2b2b2b;*/
  		z-index: 4;
  		/*padding-bottom: 15px;*/
  	}


  	.icon,a.icon{
  		font-size: 42px;
  		color: red;
  		background-color: white;
	    box-shadow: 0px 1px 11px 3px #2b2b2b;
	    border-radius: 50%;
	    padding: 3px;
	    padding-bottom: 0px;
	    padding-top: 0px;
  	}

  	.floatBlog{
  		position:fixed;
  		/*width:40px;*/
  		/*height:40px;*/
  		top:15px;
  		right:15px;
  		z-index: 1;
  		/*background-color:white;*/
  	}

  	.btn.dropdown-toggle{
  		height: calc(1.5em + 0.75rem + 2px);
  	    padding: 0.375rem 0.75rem;
  	    font-size: 1rem;
  	    font-weight: 400;
  	    line-height: 1.5;
  	    color: #495057;
  	    background-color: #fff;
  	    background-clip: padding-box;
  	    border: 1px solid #ced4da;
  	    border-radius: 0.25rem;
  	}


</style>

<body>
	<div id="loadSpinner" class="text-center text-danger" style="margin-top: 30vh;">
	  	<div class="spinner-border" role="status" style="width: 5rem; height: 5rem;">
	    	<span class="sr-only"></span>
	  	</div><br>
		<span class="font-weight-bold mt-2" style="font-size: 50px;">Loading...</span>
	</div>

	<div class="float1">
		<a class="icon" target="_blank" id="telegram_container"><i class="fa fa-telegram text-danger" aria-hidden="true"></i></a>
		<!-- <a class="icon ml-4 text-dark" href="mailto: kang.151513@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i></a> -->
	</div>

	<a class="btn btn-outline-danger text-danger floatBlog" id="blogsBtn" href="#" target="_blank">Blogs</a>

	<div class="navbarFixed row">
		<a href="#" id="nav_home" class="col-sm active">
			<img src="assets/imgs/navicon/home.png">
			<br>HOME
		</a>

		<a href="#" id="nav_tasks" class="col-sm">
			<img src="assets/imgs/navicon/clipboard.png">
			<br>TASKS
		</a>

		<a href="#" id="nav_vip" class="col-sm">
			<img src="assets/imgs/navicon/vip.png">
			<br>VIP
		</a>

		<a href="#" id="nav_profit" class="col-sm">
			<img src="assets/imgs/navicon/profit.png">
			<br>PROFIT
		</a>

		<a href="#" id="nav_profile" class="col-sm">
			<img src="assets/imgs/navicon/user.png">
			<br>ACCOUNT
		</a>
	</div>

	<div id="container" class=" mb-5">

	</div>		

	<script type="text/javascript">
		var animtionSpeed = 250;
		$('#loadSpinner').toggle();
		// console.log("asdasd");

		var currentUser = JSON.parse(getLocalStorageByKey('currentUser'));
		var links = ajaxShortLink(
			url='admin/getAllLinks'
		);

		var telegramLink = links[0];
		var blogsLink = links[1];

		$('#telegram_container').attr('href',telegramLink.link);

		console.log(telegramLink,blogsLink);

		if (getLocalStorageByKey('currentUser')!=null) {
			$("#container").empty();
			$("#container").append(
				ajaxLoadPage("navhome")
			);		
		}else{
			console.log("no active user");
			window.location.replace("index");
		}

		$("#blogsBtn").on('click', function(){
			console.log(blogsLink['link']);
			window.open(blogsLink['link'], '_blank');
		});

		$("#nav_home").on("click",function(){
			$("#container").fadeOut(animtionSpeed, function() {
				$("#container").empty();

				$("#container").append(
					ajaxLoadPage("navhome")
				);

				$("#container").fadeIn(animtionSpeed);
		  	});

			$(".navbarFixed a").each(function(){
				$(this).removeClass("active");;
			});

			$(this).addClass("active");
		});

		$("#nav_tasks").on("click",function(){
			$("#container").fadeOut(animtionSpeed, function() {
				$("#container").empty();

				$("#container").append(
					ajaxLoadPage("navtask")
				);

				$("#container").fadeIn(animtionSpeed);
		  	});

			$(".navbarFixed a").each(function(){
				$(this).removeClass("active");;
			});

			$(this).addClass("active");
		});

		$("#nav_vip").on("click",function(){
			$("#container").fadeOut(animtionSpeed, function() {
				$("#container").empty();

				$("#container").append(
					ajaxLoadPage("navvip")
				);

				$("#container").fadeIn(animtionSpeed);
		  	});

			$(".navbarFixed a").each(function(){
				$(this).removeClass("active");;
			});

			$(this).addClass("active");
		});

		$("#nav_profit").on("click",function(){
			$("#container").fadeOut(animtionSpeed, function() {
				$("#container").empty();

				$("#container").append(
					ajaxLoadPage("navprofit")
				);

				$("#container").fadeIn(animtionSpeed);
		  	});

			$(".navbarFixed a").each(function(){
				$(this).removeClass("active");;
			});

			$(this).addClass("active");
		});

		$("#nav_profile").on("click",function(){
			$("#container").fadeOut(animtionSpeed, function() {
				$("#container").empty();

				$("#container").append(
					ajaxLoadPage("navprofile")
				);

				$("#container").fadeIn(animtionSpeed);
		  	});

			$(".navbarFixed a").each(function(){
				$(this).removeClass("active");
			});

			$(this).addClass("active");
		});
	</script>
</body>
</html>