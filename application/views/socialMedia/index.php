<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Social Media Data Table</h1>
      <sub class="fw-bold">List of Social Media</sub>
    </div>
    <hr>

    <div class="d-flex">
    	<!-- <button class="btn btn-success mb-2" id="add_socmed_btn"><i class="bi bi-plus"></i> Add New Social Media</button> -->
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID #</th>
                <th>Name</th>
                <th>Link</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	
	$(document).ready(function() {
		loadDatatable('admin/getAllSocmed');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
	});

	// $('#add_socmed_btn').on('click', function () {
	//   	bootbox.alert({
	//   	    message: ajaxLoadPage('quickLoadPage',{'pagename':'socialMedia/addNewSocmed'}),
	//   	    size: 'large',
	//   	    centerVertical: true,
	//   	    closeButton: false
	//   	});
	// });

	function loadDatatable(url,data){
		var callDataViaURLVal = ajaxShortLink(url,data);
		$('#tableContainer').DataTable().destroy();

		$('#tableContainer').DataTable({
			data: callDataViaURLVal,
			columns: [
				{ data:'id'},
				{ data:'name'},
				{ data:'link'},
      		],"createdRow": function( row, data, dataIndex){
				if (data['isShown'] == 1) {
					$(row).addClass('bg-success text-light');
				}
			}, order: [[0, 'desc']],
	      	autoWidth: false,
		});

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	}

	// function viewThis(element){
	// 	var table = $('#tableContainer').DataTable();
	// 	selectedData = table.row($(element).closest('tr')).data();

	// 	bootbox.alert({
	// 	    message: ajaxLoadPage('quickLoadPage',{'pagename':'socialMedia/updateSocmed'}),
	// 	    size: 'large',
	// 	    centerVertical: true,
	// 	    closeButton: false
	// 	});
	// }

	$('#tableContainer').on('click', 'tbody tr', function () {
	  selectedData = $('#tableContainer').DataTable().row($(this)).data();

	  bootbox.alert({
	      message: ajaxLoadPage('quickLoadPage',{'pagename':'socialMedia/updateSocmed'}),
	      size: 'large',
	      centerVertical: true,
	      closeButton: false
	  });
	});
</script>