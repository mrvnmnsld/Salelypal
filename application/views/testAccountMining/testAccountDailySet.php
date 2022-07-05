<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Daily Income Mining Settings</h1>
      <sub class="fw-bold">Configure Tokens listings in daily income mining</sub>
    </div>

    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addToken_btn"><i class="bi bi-plus"></i> Add Token to Mine</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID #</th>
                <th>Token Name</th>
                <th>Network</th>
                <th>Cycles ID</th>
                <th>Purchasable Limit</th>
                <th>Minimum Entry</th>
                <th>Date Created</th>
            </tr>
        </thead>
    </table>
  </div>

  <div class="card-body">
  	<div class="pagetitle">
      <h1>Add Cycle Day</h1>
      <!-- <sub class="fw-bold">Configure Tokens listings in daily income mining</sub> -->
    </div>

    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="add_day_btn"><i class="bi bi-plus"></i> Add Days</button>
    </div>

    <table id="tableContainerDay" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID #</th>
                <th>Days</th>
                <th>APY</th>
                <th>Date Created</th>
            </tr>
        </thead>
    </table>
  </div>
</div>




<script>
	var selectedData = [];
	$(document).ready(function() {
		
		loadDatatable('test-account/daily/getDailySettings');
		loadDatatable2('test-account/daily/getAddDays');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

	$('#addToken_btn').on('click', function () {
  	bootbox.alert({
  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccountMining/daily/addNewToken'}),
  	    size: 'large',
  	    centerVertical: true,
  	    closeButton: false
  	});
	});

	$('#add_day_btn').on('click', function () {
  	bootbox.alert({
  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccountMining/daily/addDays'}),
  	    size: 'large',
  	    centerVertical: true,
  	    closeButton: false
  	});
	});


	$('#tableContainer').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainer').DataTable().row($(this)).data();
		
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccountMining/daily/editToken'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});

		$('#tableContainerDay').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainerDay').DataTable().row($(this)).data();
		
  	bootbox.alert({
  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccountMining/daily/editDays'}),
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
				{ data:'tokenName'},
				{ data:'network'},
				{ data:'cycle_day'},
				{ data:'purchasable_limit'},
				{ data:'minimum_entry'},
				{ data:'date_created'},

      		],"createdRow": function( row, data, dataIndex){

    		},
    		order: [[0, 'desc']],
    		autoWidth: false,
		});
	}

	function loadDatatable2(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainerDay').DataTable().destroy();

		$('#tableContainerDay').DataTable({
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
				{ data:'days'},
				{ data:'apy'},
				{ data:'dateCreated'},

      		],"createdRow": function( row, data, dataIndex){

    		},
    		order: [[0, 'desc']],
    		autoWidth: false,
		});
	}

</script>