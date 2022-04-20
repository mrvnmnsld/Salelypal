<link href="assets/lib/DataTables/datatables.css" rel="stylesheet">
<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
<link href="assets/lib/DataTables/buttons.dataTables.min.css" rel="stylesheet">
<script src="assets/lib/DataTables/datatables.js"></script>
<script src="assets/lib/DataTables/datatables.min.js"></script>
<script src="assets/lib/DataTables/dataTables.responsive.min.js"></script>

<style type="text/css">
	table.dataTable td, table.dataTable th{
	  font-size: 0.8em;
	}

	.dataTables_paginate {
	    float: ;
	}
	.dataTables_filter {
	    float: left;
	    display: none;
	}
	.dataTables_length {
	    float:left;
	}
	.dataTables_info {
	    float:;
	}

</style>

<div class="p-2 cardboxes m-2">
	<div class="text-center">Powered by PayPal</div>

	<table id="tableContainer" class="table table-hover table-striped text-light" style="width: 98%!important;">  
		<thead>
	        <tr>
	            <th>Token</th>
	            <!-- <th>Value</th> -->
	            <th>Amount</th>
	            <th>Date</th>
	        </tr>
	    </thead>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		loadDatatable('wallet/getUserPurchase',{'userID':currentUser['userID']});
	});

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			data: callDataViaURLVal,
			columns: [
				{ data:'token'},
				// { data:'tokenValue'},
				{ data:'amountBought'},
				{
	                "mData": "dateCreated",
	                "mRender": function (data, type, row) {
	                    return data;
	                }
	            }
	        ],
	        "autoWidth": true,
	        "order": [[ 2, "desc" ]]
		});
	}

	$("#backButton").on("click", function(){
		$("#container").fadeOut(animtionSpeed, function() {
			$("#loadSpinner").fadeIn(animtionSpeed,function(){
				$("#container").empty();

				$("#container").append(
					ajaxLoadPage('quickLoadPage',{'pagename':'wallet/index'})
				);

				$("#loadSpinner").fadeOut(animtionSpeed,function(){
					$("#container").fadeIn(animtionSpeed);
				});
		  	});
		});
	})