<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Regular Mining Settings</h1>
      <sub>Configure Tokens listings in regular mining</sub>
    </div>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addToken_btn"><i class="bi bi-plus"></i> Add Token to Mine</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID #</th>
                <th>Token Name</th>
                <th>Network</th>
                <th>APY</th>
                <th>Cycles</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		
		loadDatatable('getRegularMiningSettings');
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
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'mining/regular/addNewToken'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});

	

	$('#tableContainer').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainer').DataTable().row($(this)).data();
		
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'mining/regular/editToken'}),
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
				{ data:'apy'},
				{ data:'cycle_day'},
      		],"createdRow": function( row, data, dataIndex){
    		},autoWidth: false,
		});
	}
</script>