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

	.btn-secondary {
		margin-left: 3px!important;
	}

</style>

<div class="h2 text-center">Search History</div>

<form id="mainForm">
	<div class="form-group">
		<label class="font-weight-bold">Network:</label>
		<select class="form-control" name="network_form">
			<option value="">Select network...</option>
			<option value="tron">Tron/TRC20</option>
			<option value="bsc">BSC/Bep-20</option>
		</select>
	</div>

	<div class="form-group">
		<label class="font-weight-bold">Date:</label>
		<input type="date" class="form-control" name="date_form" placeholder="">
	</div>

	<button class="btn btn-block btn-primary" type="submit">Search</button>
</form>
<br>

<div class="">NOTE: Click row to view transaction details in network scan website</div>

<table class="table table-striped table-bordered table-sm p-3" style="width: 100%;" id="tableContainer">
  <thead>
    <tr>
      <th scope="col">Amount</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
</table>

<script type="text/javascript">
	var pageLimit = 10;
	var pageEnd = 0;

	function loadDatatable(data){
		var dataOutput = new Array();
		console.log(dataOutput);

		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			data: dataOutput,
			columns: [
				{ data:'amount'},
				{ data:'result'},
				{ data:'timestamp'},
      ],
      "autoWidth": true,
      "bPaginate": false,
      "bLengthChange": false,
      "bInfo": false,
      "bFilter": false
		});
	}

	$('#tableContainer tbody').on('click','tr',function(){
	    var data = $('#tableContainer').DataTable().row(this).data();
	    console.log(data);

	    // window.open('https://tronscan.org/#/transaction/'+data['txid'], '_blank').focus();
	});

	$("#mainForm").validate({
  	errorClass: 'is-invalid text-danger',
  	rules:{
			network_form: "required",
			date_form: "required"
		},
  	submitHandler: function(form){
  		var data = $('#mainForm').serializeArray();
  		console.log(data);
  		var searchedTransactions;

  		if (data[0].value=="tron") {
  			console.log(new Date(data[1].value).getTime());
  			// https://apilist.tronscan.org/api/transaction?sort=-timestamp&count=true&limit=20&start=0&address=TZHibxZsFo5WJLokAgaZQUKAjkynrmoP2G&start_timestamp=1643846400000&end_timestamp=1643932800000

  			// just add 86,400,000 on  new date
  		}
		}
	});
</script>
