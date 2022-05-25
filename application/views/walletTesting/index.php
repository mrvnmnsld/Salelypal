<!DOCTYPE html>
<html>
<head>
	<!-- libraries needed -->
		
		<script src="../assets/js/common.js"></script>
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

	<!-- libraries needed -->

	<!-- custom libraries -->
		<script src="../assets/js/common.js"></script>
	<!-- custom libraries -->
</head>
<body>

<h2>TEST PAGE</h2>
	

	<div>
		Trc20 Address: 
		<span id="wallet_address_container"></span>
		Balance: 
		<span id="trx_balance_container"></span>

		<div>
			<button id="deposit_btn" type="submit" class="btn btn-primary">Deposit</button>
    		<button id="withdraw_btn" type="submit" class="btn btn-primary">Withdraw</button>
		</div>
		
	</div>
  
    
  

<script type="text/javascript">
	var walletDetails = {
		"ok":true,
		"privatekey":"ff5b8a1134c4f3ddf3665676a736734eb3a5093716cb6e078bb7a509c39c4493",
		"address":"TVi4BkKdcPxcdjkcMfxY5NfUZ2F3krU4C6",
		"hexaddress":"41d884ead1c5d07a59dd8540f84fcb4d730bed9815"
	}

	$("#wallet_address_container").text(walletDetails.address);

	// console.log(walletDetails);
  // console.log($("form"))


  	var res = ajaxShortLink('../walletTesting/getTronBalance',{
  		'address': walletDetails.address
  	});

	console.log(res.balance);

	$('#trx_balance_container').text(res.balance);


  $('#deposit_btn').on('click', function () {
	  	bootbox.alert({
	  	    message: ajaxLoadPage('../walletTesting/deposit'),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});

  $('#withdraw_btn').on('click', function () {
	  	bootbox.alert({
	  	    message: ajaxLoadPage('../walletTesting/withdraw'),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});
</script>

</body>
</html>

