<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Test Account Data Table</h1>
      <sub class="fw-bold">List of Test Accounts</sub>
    </div>
    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="add_btn"><i class="bi bi-plus"></i> Add Test Account</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
            		<th></th>
                <th>User ID</th>
                <th>Username</th>
                <th>Date Created</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		loadDatatable('testAccount/getTestAccount');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

	$('#add_btn').on('click', function () {
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'users/testAccount/addAccount'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			data: callDataViaURLVal,
			columns: [
				{ data:''},
				{ data:'userID'},
				{ data:'username'},
				{ data:'dateCreated'},
      ],
      "columnDefs": [
				{
					"targets": 0,
					"width": "1%",
	            	"data": null,
		            "defaultContent": '<button type="button" class="close edit" onClick="viewThis(this)"><i class="fa fa-eye" aria-hidden="true"></i></button>',
	                "orderable": false,
	                "sortable": false
		        }
			],
      order: [[0, 'desc']],
      autoWidth: false,
		});
	}

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'users/testAccount/accountView'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>