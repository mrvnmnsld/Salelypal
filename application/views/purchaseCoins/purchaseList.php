<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Puchase List</h1>
      <sub>List of all purchased made in our platform powered by paypal</sub>
    </div>

    <table id="tableContainer" class="table table-hover table-striped" style="width:100%">
    	<thead>
            <tr>
                <th>ID</th>
                <th>Token</th>
                <th>Value</th>
                <th>Amount</th>
                <th>Paid(USD)</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Date</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	$(document).ready(function() {
		loadDatatable('userWallet/getAllPurchase');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			dom: 'Bfrtip',
	        buttons: [
	            'copyHtml5',
	            {
                    extend: 'excelHtml5',
	                title: 'data_export'
	            },
	            {
                    extend: 'csvHtml5',
	                title: 'data_export'
	            },
	            {
	                extend: 'pdfHtml5',
	                title: 'data_export'
	            }
	        ],
			data: callDataViaURLVal,
			columns: [
				{ data:'id'},
				{ data:'token'},
				{ data:'tokenValue'},
				{ data:'amountBought'},
				{ data:'amountPaid'},
				{ data:'email'},
				{ data:'fullname'},
				{ data:'dateCreated'},
	      	],"createdRow": function( row, data, dataIndex){
				if (data['isBlocked'] == 1) {
					console.log($(row).addClass('bg-danger text-light'));
				}
      		},autoWidth: false
		});
	}
</script>