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

<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Admin User List</h1>
      <sub>List of all admin users</sub>
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
</div>

<script type="text/javascript">
	var consulatationArray = [];

	$(document).ready(function() {
		loadDatatable('admin/getAllAdmin');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
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
				{ 
					"class":"details-control",
					"orderable":false,
					"data":null,
					"defaultContent":
						 '<button type="button" class="close edit" onClick="viewThis(this)"><i class="fa fa-eye" aria-hidden="true"></i></button>',
					'width':'1%'
        },
				{ data:'id'},
				{ data:'username'},
				{ data:'userType'},
				{ data:'dateCreated'},
      ],"createdRow": function( row, data, dataIndex){
				if (data['isBlocked'] == 1) {
					console.log($(row).addClass('bg-danger text-light'));
				}
      },autoWidth: false
			// "autoWidth": true,
		});
	}

	$("#addNewAdmin").on('click', function(){
		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'users/adminList/addNewAdmin'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	})

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'users/adminList/adminUserView'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>
