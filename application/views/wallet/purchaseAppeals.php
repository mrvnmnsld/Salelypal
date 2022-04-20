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

<div class="p-1 cardboxes m-2">
	<div class="text-center h4 p-3">Appeal List:</div>

	<table id="tableContainer" class="table table-hover table-striped text-light" style="width: 100%!important;">  
		<thead>
	        <tr>
	            <th>Token</th>
	            <th>Reference</th>
	            <th>Date Submitted</th>
	        </tr>
	    </thead>
	</table>
</div>

<div class="p-1 cardboxes m-2">
	<div class="text-center h4 p-3">Options:</div>
	<button class="btn btn-primary btn-block col-md-12" onclick="postAnAppeal()">Post an appeal</button>
</div>

<script type="text/javascript">
	var datatableRows = [];
	
	$(document).ready(function() {
		loadDatatable('userWallet/getMyAppeals',{'userID':currentUser['userID']});
	});

	$('#tableContainer').on('click', 'tbody tr', function () {
	  selectedData = $('#tableContainer').DataTable().row($(this)).data();

	  bootbox.alert({
	      message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/appeal/viewAppeal'}),
	      size: 'large',
	      centerVertical: true,
	      closeButton: false
	  });
	});

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		datatableRows = callDataViaURLVal;
		// console.log(callDataViaURLVal);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			data: callDataViaURLVal,
			columns: [
				{ data:'token'},
				{ data:'referenceID'},
				{ data:'date'},
	        ],
	        "autoWidth": true,
	        "createdRow": function( row, data, dataIndex){
				if (data['status'] == 1) {
					$(row).addClass('bg-success text-light');
				}
    		}
		});
	}

	function postAnAppeal(url,data){
		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/appeal/postAnAppeal'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>