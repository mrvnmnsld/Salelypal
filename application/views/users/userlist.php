<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>User (Client) List</h1>
      <sub class="fw-bold">Clients who signed up</sub>
    </div>

    <br>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th></th>
                <th>ID</th>
                <!-- <th>Email</th> -->
                <th>Name</th>
                <th>Last login Date</th>
                <th>Last login IP Address</th>
                <th>Verified</th>
                <th>Blocked</th>
                <th>Referred User ID</th>
                <th>Refer Type</th>
                <th>Date Joined</th>

            </tr>
        </thead>
    </table>

  </div>
</div>

<script type="text/javascript">
	var consulatationArray = [];

	$(document).ready(function() {
		loadDatatable('admin/getAllUsers');
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
	            },
	        ],
			data: callDataViaURLVal,
			columns: [
				{ data:''},
				{ data:'userID'},
				{ data:'fullname'},
				{ data:'lastLoginDate'},
				{ data:'ip_lastLogin'},
				{ data:'verified'},
				{ data:'isBlocked'},
				{ data:'referred_user_id'},
				{ data:'referType'},
				{ data:'timestamp'},
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
			],"createdRow": function( row, data, dataIndex){
				if (data['isBlocked'] == 1) {
					$(row).find("td:eq(6)").addClass('text-danger').text("Yes");
				}else{
					$(row).find("td:eq(6)").addClass('text-success').text("No");
				}

				if (data['lastLoginDate'] == null) {
					$(row).find("td:eq(3)").addClass('text-warning').text("No data available");
					$(row).find("td:eq(4)").addClass('text-warning').text("No data available");
				}


				if (data['verified'] == 0) {
					if(data['FaceImagePath'] != null && data['IDImagePath'] != null) {
						$(row).find("td:eq(5)").addClass('text-warning').text("Pending");
					}else if((data['FaceImagePath'] == null || data['IDImagePath'] == null) && (data['FaceImagePath'] == null && data['IDImagePath'] == null)){
						$(row).find("td:eq(5)").addClass('text-danger').text("Incomplete");
					}
				}else{
					$(row).find("td:eq(5)").addClass('text-success').text("Yes");

				}
      },
			"autoWidth": false,
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
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'users/userlist/userView'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>
