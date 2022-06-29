<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
  *{
    font-family: 'Poppins', sans-serif;
  }
</style>


<div id="innerContainer" style="display:none" class="card"><br>
  <div class="card-body">
		<div class="pagetitle">
      	<h1>Invitation List</h1>
  			<sub class="fw-bold">List of all your invited users</sub>
    </div>

    <hr>
    <br>

		<section class="section dashboard">

			<div class="col h2">Direct Invites</div> 

			<div class="row">
			
				<div class="col-md-3">
					<div class="card info-card sales-card">
						<div class="card-body">
							<h5 class="card-title">Total Paid in USD <span>| Today</span></h5>
							<div class="d-flex align-items-center">
							  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
							    <i class="fa fa-usd"></i>
							  </div>
							  <div class="ps-3">
							    <h6 id="total_direct_paid_container">0</h6>
							    <span class="text-primary small pt-1 fw-bold">Money</span>
							  </div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="card info-card revenue-card">
					<div class="card-body">
						<h5 class="card-title">Total Invites <span>| Over All</span></h5>
						<div class="d-flex align-items-center">
						  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
						    <i class="fa fa-user-o"></i>
						  </div>
						  <div class="ps-3">
						    <h6 id="total_invited_container">0</h6>
						    <span class="text-success small pt-1 fw-bold">Person</span>
						  </div>
						</div>
					</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="card info-card customers-card">
						<div class="card-body">
							<h5 class="card-title">Total Invites <span>| Monthly</span></h5>
							<div class="d-flex align-items-center">
							  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
							    <i class="bi bi-people"></i>
							  </div>
							  <div class="ps-3">
							    <h6 id="monthly_invited_container">0</h6>
							    <span class="text-danger small pt-1 fw-bold">Person</span>
							  </div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="card info-card customers-card">
						<div class="card-body">
							<h5 class="card-title">Total Invites <span>| Yearly</span></h5>
							<div class="d-flex align-items-center">
							  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
							    <i class="bi bi-people"></i>
							  </div>
							  <div class="ps-3">
							    <h6 id="yearly_invited_container">0</h6>
							    <span class="text-danger small pt-1 fw-bold">Person</span>
							  </div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="col h2">Indirect Invites</div>

			<div class="row">

				<div class="col-md-6">
					<div class="card info-card revenue-card">
						<div class="card-body">
							<h5 class="card-title">Total Indirect Invites <span>| Over All</span></h5>
							<div class="d-flex align-items-center">
							  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
							    <i class="fa fa-user-o"></i>
							  </div>
							  <div class="ps-3">
							    <h6 id="total_indirect_invites_container">0</h6>
							    <span class="text-success small pt-1 fw-bold">Person</span>
							  </div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="card info-card sales-card">
					<div class="card-body">
						<h5 class="card-title">Total Indirect Paid in USD <span>| Over All</span></h5>
						<div class="d-flex align-items-center">
						  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
						    <i class="fa fa-usd"></i>
						  </div>
						  <div class="ps-3">
						    <h6 id="total_indirect_paid_container">0</h6>
						    <span class="text-primary small pt-1 fw-bold">Money</span>
						  </div>
						</div>
					</div>
					</div>
				</div>

			</div>

		</section>

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

		$('#tableContainer').on('click', 'tbody tr', function () {
		  selectedData = $('#tableContainer').DataTable().row($(this)).data();
		  console.log(selectedData)

			// $("#loading").toggle();
			// $("#footer").toggle();

	  	bootbox.alert({
	  	    message: ajaxLoadPage('quickLoadPage',{'pagename':'invitationList/viewUserInfo'}),
	  	    size: 'large',
	  	    centerVertical: true,
	  	    closeButton: false
	  	});
		  
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
		$('#total_indirect_paid_container').text(parseFloat(callDataViaURLVal[4]).toFixed(2)+" USD");
		$('#total_direct_paid_container').text(callDataViaURLVal[5]+" USD");
		$("#total_indirect_invites_container").text(parseInt(callDataViaURLVal[1])+parseInt(callDataViaURLVal[2])+parseInt(callDataViaURLVal[3]))
		
		// console.log( table.rows().count());
	}
</script>