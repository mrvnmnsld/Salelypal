<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Daily Income Mining Entries</h1>
      <sub>View & Manipulate Mining entries</sub>
    </div>

    <!-- <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addToken_btn"><i class="bi bi-plus"></i> Add Token to Mine</button>
    </div> -->

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Balance</th>
                <th>Total Claim</th>
                <th>Lock Period</th>
                <th>Start</th>
                <th>End</th>
                <th>Token Name</th>
                <th>User Email</th>
                <th>APY</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		loadDatatable('mining/daily/getAllDailyEntries');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

	$('#tableContainer').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainer').DataTable().row($(this)).data();
		
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'mining/daily/editEntry'}),
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
				{ data:'status'},
				{ data:'balance'},
				{ data:'claimAmount'},
				{ data:'lock_period'},
				{ data:'date_created'},
				{ data:'date_release'},
				{ data:'tokenNameCombo'},
				{ data:'email'},
				{ data:'apy'},
  			],"createdRow": function(row, data, dataIndex){
  				if(data.status == 'claimed'){
  					// $(row).find('td:nth-child(2)').addClass('text-success');
  					$(row).addClass('bg-success text-light');
  				}
			},autoWidth: false,
		});
	}
</script>