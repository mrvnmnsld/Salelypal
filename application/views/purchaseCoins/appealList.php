<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Appeal List</h1>
      <sub class="fw-bold">List Appeal/Error in 'Buy Crypto'</sub>
    </div>

    <hr>

    <div class="text-primary">*NOTE: Click row to view</div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>Reference ID</th>
                <th>Token</th>
                <th>Value</th>
                <th>Amount</th>
                <th>Paid(USD)</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Date Submited</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		loadDatatable('userWallet/getAllAppeals');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
	});

	$('#tableContainer').on('click', 'tbody tr', function () {
	  selectedData = $('#tableContainer').DataTable().row($(this)).data();

	  bootbox.alert({
	      message: ajaxLoadPage('quickLoadPage',{'pagename':'purchaseCoins/viewAppeal'}),
	      size: 'large',
	      centerVertical: true,
	      closeButton: false
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
				{ data:'referenceID'},
				{ data:'token'},
				{ data:'tokenValue'},
				{ data:'amountBought'},
				{ data:'amountPaid'},
				{ data:'email'},
				{ data:'fullname'},
				{ data:'date'},
      	],"createdRow": function( row, data, dataIndex){
					if (data['status'] == 0) {
						$(row).addClass('bg-success text-light');
					}
    		},autoWidth: false,
    		 "order": [[ 7, "desc" ]]
		});

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	}
</script>