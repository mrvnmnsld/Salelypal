<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Data Tables</h1>
      <sub>Data table testing</sub>
    </div>

    <div class="d-flex">
    	<button class="btn btn-success mb-2" id="addNewUser_btn"><i class="bi bi-plus"></i> Add New User</button>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th>ID #</th>
                <th>Fullname</th>
                <th>Email</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {
		loadDatatable('getUsers');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	});

	$('#addNewUser_btn').on('click', function () {
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'test/testGrp1/addNewUser'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	});

	$('#tableContainer').on('click', 'tbody tr', function () {
		selectedData = $('#tableContainer').DataTable().row($(this)).data();
		
  	bootbox.alert({
  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'test/testGrp1/updateUser'}),
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
				{ data:'userID'},
				{ data:'fullname'},
				{ data:'email'},
      ],
      order: [[0, 'desc']],
      autoWidth: false,
		});
	}
</script>