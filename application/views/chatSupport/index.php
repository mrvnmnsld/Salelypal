<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Chat Support</h1>
      <sub class="fw-bold">Assist Clients via chat support</sub>
    </div>

    <hr>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="refresh_btn"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh List</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>Ticket Number#</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Date Created</th>
                <th>Status</th>
                <th>AssignedTo</th>
            </tr>
        </thead>
    </table>
  </div>

</div>

<script type="text/javascript">
	var selectedArray = [];

	$(document).ready(function() {
		loadDatatable('admin/getAllChatSupport');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$('#tableContainer').on('click', 'tbody tr', function () {
			selectedData = $('#tableContainer').DataTable().row($(this)).data();
			console.log(selectedData);
			
			if (selectedData!=undefined) {
				bootbox.dialog({
					onEscape: false,
				    message: ajaxLoadPage('quickLoadPage',{'pagename':'chatSupport/openChatSupport'}),
				    size: 'large',
				    centerVertical: true,
				    closeButton: false,
				});
			}
		  	
		});

		$('#refresh_btn').on('click', function () {
		  	loadDatatable('admin/getAllChatSupport');
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
				{ data:'email'},
				{ data:'dateCreated'},
				{ data:'status'},
				{ data:'username'},
  			],
			autoWidth: false,
			"createdRow": function( row, data, dataIndex){
				if (data['status'] == "OPEN" && data['adminID'] == null) {
					$(row).addClass('bg-warning').find("td:eq(5)").text("No Assignment").addClass("text-danger")
				}

				if (data['status'] == "CLOSED" && data['adminID'] != currentUser.id) {
					$(row).addClass('d-none')
				}

				if (data['adminID'] != currentUser.id && data['adminID'] != null) {
					$(row).addClass('d-none')
				}
    	},order: [[0,"desc"]]
		});

		$(".dt-button").each(function( index ) {
	  		$(this).removeClass();
	  		$(this).addClass('btn btn-primary');
		});
	}
</script>
