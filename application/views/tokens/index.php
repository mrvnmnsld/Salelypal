<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Token Listings</h1>
      <sub class="fw-bold">Configure Tokens listed in our platform</sub>
    </div>

    <hr>

    <div class="text-primary">*NOTE: Click row to view. Adding tokens should have correct parameters or else error will pop up on user side of the wallet</div>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addToken_btn"><i class="bi bi-plus"></i> Add Token</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>Token Icon</th>
                <th>Token Name</th>
                <th>Token Symbol</th>
                <th>Description</th>
                <th>Network</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		
		loadDatatable('getAllTokens');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
	});

	$('#addToken_btn').on('click', function () {
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'tokens/addNewToken'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});

	

	$('#tableContainer').on('click', 'tbody tr', function () {
	  selectedData = $('#tableContainer').DataTable().row($(this)).data();
	  console.log(selectedData.tokenName)
	  if(selectedData.tokenName.toUpperCase()=="trx".toUpperCase()||selectedData.tokenName.toUpperCase()=="bnb".toUpperCase()||selectedData.tokenName.toUpperCase()=="eth".toUpperCase()){
	  	$.toast({
	  	    heading: '<h6>Cant Edit Base Tokens</h6>',
	  	    text: 'Base tokens are uneditable',
	  	    showHideTransition: 'slide',
	  	    icon: 'error',
	  	    position: 'bottom-left'
	  	})
	  }else{
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'tokens/viewTokenInfo'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	  }
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
				{ data:'tokenImage',render: function (data, type, row, meta) {
	            	return '<img src="' + data + '" height="50" width="50"/>';
	      		}},
				{ data:'description'},
				{ data:'tokenName'},
				{ data:'description'},
				{ data:'network'},
      		],"createdRow": function( row, data, dataIndex){

    		},autoWidth: false,
		});

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	}
</script>