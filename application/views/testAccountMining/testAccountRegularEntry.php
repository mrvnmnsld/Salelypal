<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Regular Mining Entries</h1>
      <sub class="fw-bold">View & Manipulate Mining entries</sub>
    </div>

    <hr>

    <!-- <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addToken_btn"><i class="bi bi-plus"></i> Add Token to Mine</button>
    </div> -->

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Status</th>
                <th>Balance</th>
                <th>Claim Amount</th>
                <th>Lock Period</th>
                <th>Entry</th>
                <th>Release</th>
                <th>Token Name</th>
                <!-- <th>User Email</th> -->
                <th>APY</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		loadDatatable('test-account/getAllRegularMiningEntries');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		
	});

	$('#tableContainer').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainer').DataTable().row($(this)).data();
		
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccountMining/regular/editEntry'}),
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
				{ data:'id'},
				{ data:'username'},
				{ data:'status'},
				{ data:'balance'},
				{ data:'claimAmount'},
				{ data:'lock_period'},
				{ data:'date_created'},
				{ data:'date_release'},
				{ data:'tokenNameCombo'},
				// { data:'email'},
				{ data:'apy'},
  			],"createdRow": function(row, data, dataIndex){
  				if(data.status == 'claimed'){
  					// $(row).find('td:nth-child(2)').addClass('text-success');
  					$(row).addClass('bg-success text-light');
  				}
			},autoWidth: false,
			order: [[0, 'desc']]
		});

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	}
</script>