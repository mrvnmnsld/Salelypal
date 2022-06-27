<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
		<div class="pagetitle">
      	<h1>Invitation List</h1>
  			<sub class="fw-bold">List of all your invited users</sub>
    </div>

    <hr>

    <div class="h2 text-center">Direct Invites</div>

    <div class="row">
    	<div class="text-center h5 col-3">
    		Total Paid in USD:
    		<div class="text-success">
    			<span id="total_direct_paid_container">0</span>
    		</div>
    	</div>

    	<div class="text-center h5 col-3">
    		Total invites:
    		<div class="text-success">
    			<span id="total_invited_container">0</span>
    		</div>
    	</div>

    	<div class="text-center h5 col-3">
    		Yearly invites:
    		<div class="text-success">
    			<span id="yearly_invited_container">0</span>
    		</div>
    	</div>

    	<div class="text-center h5 col-3">
    		Monthly invites:
    		<div class="text-success">
    			<span id="monthly_invited_container">0</span>
    		</div>
    	</div>
    </div>

    <br>

    <div class="h2 text-center">Indirect Invites</div>

    <div class="row">
  	  <div class="text-center h5 col-6">
  	  	Total Indirect Invites:
  			<span id="total_indirect_invites_container" class="text-success">0</span>
  	  </div>

	    <div class="text-center h5 col-6">
	    	Total Indirect Paid in USD:
	  		<span id="total_indirect_paid_container" class="text-success">0</span>
	    </div>
    </div>

    <br>

    <div class="row">
    	<div class="text-center h5 col-4">
    		First Degree:
    		<div class="text-success">
    			<span id="1st_invited_container">0</span>
    		</div>
    	</div>

    	<div class="text-center h5 col-4">
    		Second Degree:
    		<div class="text-success">
    			<span id="2nd_invited_container">0</span>
    		</div>
    	</div>

    	<div class="text-center h5 col-4">
    		Third Degree:
    		<div class="text-success">
    			<span id="3rd_invited_container">0</span>
    		</div>
    	</div>
    </div>

    <hr>

    <table id="tableContainer" class="table table-hover" style="width:100%">
    	<thead>
          <tr>
            <th>ID #</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Total USD Paid</th>
            <th>Date Joined</th>
          </tr>
      </thead>
    </table>
  </div>
</div>

<script>
	var selectedData = [];
	$(document).ready(function() {

		loadDatatable('agent/getAgentInvites',{
			'agentID' : currentUser.id
		});

		var d = new Date();
		var month = String(d.getMonth() + 1).padStart(2, '0');
		var year = d.getFullYear();

		var getMonthlyInvites = ajaxShortLink("agent/getMonthlyInvites",{
			'agentID':currentUser.id,
			'monthYear':year+"-"+month
		});

		var getYearlyInvites = ajaxShortLink("agent/getYearlyInvites",{
			'agentID':currentUser.id,
			'year':year
		});

		$('#yearly_invited_container').text(getYearlyInvites.length);
		$('#monthly_invited_container').text(getMonthlyInvites.length);

		// console.log(month,year,getMonthlyInvites,getYearlyInvites);

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
		console.log(callDataViaURLVal);

		$('#tableContainer').DataTable({
			data: callDataViaURLVal[0],
			columns: [
				{ data:'userID'},
				{ data:'fullname'},
				{ data:'email'},
				{ data:'totalPaidInUSD'},
				{ data:'timestamp'},
			],
			order: [[0, 'desc']],
			autoWidth: false,
			"columnDefs": [
		    { "width": "8%", "targets": 0 },
		    { "width": "20%", "targets": 1 },
		    { "width": "20%", "targets": 2 },
		  ]
		});

		var table = $('#tableContainer').DataTable();
		$('#total_invited_container').text(table.rows().count());
		$('#1st_invited_container').text(callDataViaURLVal[1]);
		$('#2nd_invited_container').text(callDataViaURLVal[2]);
		$('#3rd_invited_container').text(callDataViaURLVal[3]);
		$('#total_indirect_paid_container').text(callDataViaURLVal[4]+" USD");
		$('#total_direct_paid_container').text(callDataViaURLVal[5]+" USD");
		$("#total_indirect_invites_container").text(parseInt(callDataViaURLVal[1])+parseInt(callDataViaURLVal[2])+parseInt(callDataViaURLVal[3]))
		
		
		// console.log( table.rows().count());
	}
</script>