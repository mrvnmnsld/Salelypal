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
                <th>ID #</th>
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

	$('#tableContainer').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainer').DataTable().row($(this)).data();
		
  	bootbox.alert({
  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'agent/updateAgent'}),
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
				{ data:'id'},
				{ data:'fullname'},
				{ data:'username'},
				{ data:'country'},
				{ data:'createdBy'},
      ],
      order: [[0, 'desc']],
      autoWidth: false,
		});
	}
</script>