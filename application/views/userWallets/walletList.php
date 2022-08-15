<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>User Wallets</h1>
      <sub class="fw-bold">Viewing of Main Wallet Settings</sub>
    </div>

    <hr>

    <table id="tableContainer" class="table table-hover table-striped datatable" style="width:100%">
      <thead>
            <tr>
                <th width="10"></th>
                <th>User ID</th>
                <th>Total USD</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Last Login</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script type="text/javascript">

	var selectedData;

	$(document).ready(function() {
		loadDatatable('userWallet/loadUserWallets')
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();		 
	});

	function loadDatatable(url){
		var dataRes = ajaxShortLink(url);
		console.log(dataRes);

		$('#tableContainer').DataTable().destroy();

		var dt = $('#tableContainer').DataTable({
			data: dataRes,
			columns: [
				{ 
					"class":"details-control",
					"orderable":false,
					"data":null,
					'width':'5%',
					"defaultContent":
						 '<button type="button" class="btn btn-success rounded btn-sm" onClick="viewThis(this)">View</button>&nbsp;'
				},
				{ data:'userID'},
				{ data:'lastAllTokenValue'},
				{ data:'fullname'},
				{ data:'email'},
				{ data:'lastLoginDate'},
			],
			"order": [[1, 'asc']],
			"createdRow": function( row, data, dataIndex){
				console.log(data['lastLoginDate']);
				if (data['lastLoginDate'] == null) {
					$(row).find("td:eq(5)").text("No data");
				}

				if (data['lastUpdatedTokenValue'] != null) {
					$(row).find("td:eq(2)").html(data.lastAllTokenValue+" "+data.lastTokenCurrency.toUpperCase());
				}else{
					$(row).find("td:eq(2)").html("Not Updated");
				}

				if (data['isBlocked'] == 1) {
					$(row).addClass('bg-danger text-light');
				}
      },
	    autoWidth: false
		});
	}

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		selectedData = table.row($(element).closest('tr')).data();

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'userWallets/userListWalletView'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>
