<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>User (Client) List</h1>
      <sub>Clients who signed up</sub>
    </div>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
            <tr>
                <th></th>
                <th>ID</th>
                <!-- <th>Email</th> -->
                <th>Name</th>
                <th>Last login Date</th>
                <th>Last login IP Address</th>
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
					$(row).addClass('bg-danger text-light');
				}

				if (data['lastLoginDate'] == null) {
					// $(row[0]+":eq("+dataIndex+")").addClass('bg-danger text-light');
					// console.log(row+":eq("+dataIndex+")");
					// $(row).find("td:eq(4)");
					$(row).find("td:eq(3)").addClass('text-warning').text("No data available");
				}

				if (data['ip_lastLogin'] == null) {
					$(row).find("td:eq(4)").addClass('text-warning').text("No data available");
				}
	        },
			"autoWidth": false,
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
