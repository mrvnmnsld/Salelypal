<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Transaction List</h1>
      <sub class="fw-bold">List view for all withdrawal transaction made by users</sub>
    </div>

    <hr>

    <div class="text-warning mb-2">*Note: To view deposits, please navigate to <u>User Wallets <i class="bi bi-arrow-right"></i> Click User <i class="bi bi-arrow-right"></i> View all transaction button </u></div>

    <table id="tableContainer" class="table table-hover table-striped datatable" style="width:100%">
      <thead>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Network</th>
                <th>Token</th>
                <th>Amount</th>
                <th>To</th>
                <th>Timestamp</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script type="text/javascript">

	var SelectedtransactionDetails;

	$(document).ready(function() {
		loadDatatable('userWallet/loadAllWithdrawal');
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
				{ data:'id'},
				{ data:'fullname'},
				{ data:'email'},
				{ data:'network'},
				{ data:'token'},
				{ data:'amount'},
				{ data:'toAddress'},
				{ data:'timestamp'}
			],
			"order": [[1, 'asc']],
		    autoWidth: false
		});
	}

	function viewThis(element){
		var table = $('#tableContainer').DataTable();
		SelectedtransactionDetails = table.row($(element).closest('tr')).data();

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'userWallets/viewTransaction'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}
</script>
