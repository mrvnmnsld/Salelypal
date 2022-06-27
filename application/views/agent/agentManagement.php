<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Agent Data Table</h1>
      <sub class="fw-bold">List of Agents</sub>
    </div>
    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addAgent_btn"><i class="bi bi-plus"></i> Add New Agent</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
            		<th></th>
                <th>ID #</th>
                <th>Email</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Country</th>
                <th>Created By</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		loadDatatable('agent/getAgent');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

	$('#addAgent_btn').on('click', function () {
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'agent/addNewAgent'}),
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
				{ data:'id'},
				{ data:'email'},
				{ data:'fullname'},
				{ data:'username'},
				{ data:'country'},
				{ data:'createdBy'},
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
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'agent/agentView'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>