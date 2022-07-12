<!-- <div id="innerContainer" style="display:none" class="card">
  <div class="card-body">
    <div class="card-body">
      <div class="pagetitle">
        <h1>Admin User List</h1>
        <sub>List of all admin users</sub>
      </div>
    </div>
    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addNewAdmin"><i class="bi bi-plus"></i> Add Admin User</button>
    </div>

    <table id="tableContainer" class="table table-hover table-striped" style="width:100%">
    	<thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Username</th>
                <th>Usertype</th>
                <th>Date Created</th>
            </tr>
        </thead>
    </table>
  </div>
</div> -->

<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Contract/Double or Nothing</h1>
      <sub class="fw-bold">List of Contract positions</sub>
    </div>

    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="refresh_btn">
    		<i class="fa fa-refresh" aria-hidden="true"></i> 
    		Refresh list
    	</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th></th>
				<th>Username</th>
				<th>Status</th>
				<th>Type</th>
				<th>Current Price</th>
				<th>Amount</th>
				<th>Token</th>
				<!-- <th>Owner</th> -->
            </tr>
        </thead>
    </table>
  </div>
</div>

<script type="text/javascript">
	var consulatationArray = [];

	$(document).ready(function() {
		loadDatatable('test-account/future/getAllContractPositions');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
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
				{ 
					"class":"details-control",
					"orderable":false,
					"data":null,
					"defaultContent":
						 '<button type="button" class="btn btn-primary" onClick="viewThis(this)">View</button>',
					'width':'1%'
        		},
				{ data:'username'},
				{ data:'status'},
				{ data:'positionType'},
				{ data:'currentPrice'},
				{ data:'amount'},
				{ data:'tradePair'},
				// { data:'email'},
  		],"createdRow": function( row, data, dataIndex){
				if (data['status'] == 'WIN') {
					$(row).addClass('text-success');
				}else if(data['status'] == 'LOSE'){
					$(row).addClass('text-danger');
				}else if(data['status'] == 'PENDING'){
					$(row).addClass('text-warning');
				}

				if (data['income'] == '30') {
					$(row).find('td:nth-child(4)').text("30/30")
				}else if(data['income'] == '50'){
					$(row).find('td:nth-child(4)').text("60/50")
				}else if(data['income'] == '70'){
					$(row).find('td:nth-child(4)').text("120/70")

				}else if(data['income'] == '90'){
					$(row).find('td:nth-child(4)').text("180/90")

				}
      		},autoWidth: false
		});

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	}

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'testAccountBetting/contract/viewContractPosition'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false,
		    backdrop: 'static',
        keyboard: false
		});
	}

	$("#refresh_btn").on('click', function(){
		loadDatatable('test-account/future/getAllContractPositions');
	});
</script>
