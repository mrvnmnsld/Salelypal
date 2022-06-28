<style>
	@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');
  *{
    font-family: 'Poppins', sans-serif;
  }
	.first-container{
		background: #293038;
		color: white;
		padding: 15px;
		border-radius: 20px 20px 0px 0px;
		/*box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);*/
		text-align: center;
	}
	.second-container{
		background-color: #F2F4F4;
		border-radius:0px 0px 20px 20px;
		/*box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);*/
		border: 1px solid;
	}
	.container{
		border-bottom: none !important;
		border-left: none !important;
		padding: 15px;
	}
	.container1{
		border-bottom: none !important;
		border-right: none !important;
		padding: 15px;
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

    <div class="first-container row">
	    <div class="col h2">Direct Invites</div>
			<div class="col h2">Indirect Invites</div>
    </div>

    <div class="second-container row text-center">

	    <div class="container col-sm-6" style="border: 1px solid">
	      <div class="row">
					<div class="col-sm-3 fw-bold text-left">Total Paid in USD:</div>
					<div id="total_direct_paid_container" class="col-sm text-left">0</div>
				</div>

				<div class="row">
					<div class="col-sm-3 fw-bold text-left">Total invites:</div>
					<div id="total_invited_container" class="col-sm text-left">0</div>
				</div>

				<div class="row">
					<div class="col-sm-3 fw-bold text-left">Yearly invites:</div>
					<div id="yearly_invited_container" class="col-sm text-left">0</div>
				</div>

				<div class="row">
					<div class="col-sm-3 fw-bold text-left">Monthly invites:</div>
					<div id="monthly_invited_container" class="col-sm text-left">0</div>
				</div>
	    </div>

	    <div class="container1 col-sm-6" style="border: 1px solid">

				<div class="row">
						<div class="col-sm-4 fw-bold text-left">Total Indirect Invites:</div>
						<div id="total_indirect_invites_container" class="col-sm-8 text-left">0</div>
				</div>

				<div class="row">
					<div class="col-sm-4 fw-bold text-left">Total Indirect Paid in USD:</div>
					<div id="total_indirect_paid_container" class="col-sm-8 text-left">0</div>
		    </div>

			</div>

		</div>

    <br>

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