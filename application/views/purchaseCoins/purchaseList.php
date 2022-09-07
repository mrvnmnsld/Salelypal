<style type="text/css">
	.Legend-colorBox {
	    width: 1rem;
	    height: 1rem;
	    display: inline-block;
	    border:1px solid black;
	}
	li{
		list-style: none;
	}
	ul{
		padding-left: 0!important;
	}
</style>
<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
    <div class="pagetitle">
      <h1>Purchase List</h1>
      <sub class="fw-bold">List of all purchased made in our platform powered by paypal</sub>
    </div>

    <div class="pt-4">
    	<span class="text-start fw-bold">Legends:</span>
			<ul class="Legend ">
			  <li class="Legend-item">
			    <span class="Legend-colorBox" style="background-color: green;">
			    </span>
			    <span class="Legend-label">
			      Released
			    </span>
			  </li>
			    <li class="Legend-item">
			    <span class="Legend-colorBox" style="background-color: transparent;">
			    </span>
			    <span class="Legend-label">
			      For releasing
			    </span>
			  </li>
			</ul>
    </div>

    <hr>

    <table id="tableContainer" class="table" style="width:100%">
    	<thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Token</th>
                <th>Value</th>
                <th>Amount</th>
                <th>Paid(USD)</th>
                <th>Email</th>
                <th>Date</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script>
	$(document).ready(function() {
		loadDatatable('userWallet/getAllPurchase');
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();
	});

	$('#tableContainer').on('click', 'tbody tr', function () {
	  selectedData = $('#tableContainer').DataTable().row($(this)).data();

	  if(selectedData.isWise == 1){
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'purchaseCoins/viewPurchaseWise'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	  }else{
	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'purchaseCoins/viewPurchase'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
	  }

	  
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
				{ data:'id'},
				{ data:'fullname'},
				{ data:'token'},
				{ data:'tokenValue'},
				{ data:'amountBought'},
				{ data:'amountPaid'},
				{ data:'email'},
				{ data:'dateCreated'},
  		],"createdRow": function( row, data, dataIndex){
					if (data['isReleased'] == 1) {
						$(row).addClass('bg-success text-light');
					}
    		},autoWidth: false,
    	order:[["0",'desc']]
		});
		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});
	}
</script>