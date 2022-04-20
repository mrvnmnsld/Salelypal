<link href="assets/lib/DataTables/datatables.css" rel="stylesheet">
<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
<link href="assets/lib/DataTables/datatables.min.css" rel="stylesheet">
<link href="assets/lib/DataTables/buttons.dataTables.min.css" rel="stylesheet">
<script src="assets/lib/DataTables/datatables.js"></script>
<script src="assets/lib/DataTables/datatables.min.js"></script>
<script src="assets/lib/DataTables/dataTables.responsive.min.js"></script>

<style type="text/css">
	button:focus { outline-style: none; }

	.box {
	  float: left;
	  height: 20px;
	  width: 20px;
	  margin-bottom: 15px;
	  border: 1px solid black;
	  clear: both;
	}

	.alert1{
		background-color: #FFC04C;
	}

	.alert2{
		background-color: #00b300;
	}

</style>

<table id="tableContainer" class="table table-hover" width="100%">
	<thead>
        <tr>
            <th>Name</th>
            <th>Date Joined</th>
            <th>VIP Plan</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
	var consulatationArray = [];

	$(document).ready(function() {
		loadDatatable('getAllSuccessfulReferals',{'userID':currentUser["userID"]});
	});

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			data: callDataViaURLVal,
			columns: [
				{ data:'fullname'},
				{ data:'timestamp'},
				{ data:'vip_id'},
	        ],"autoWidth": true
		});
	}
</script>
