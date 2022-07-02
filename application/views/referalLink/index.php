<div id="innerContainer" style="display:none" class="card"><br>
	<div class="p-4">
		<div class="pagetitle">
	      	<h1>REFERRAL LINK</h1>
	    </div>

		<hr>

		<section class="section dashboard">

			<div class="row">
			
				<div class="col-md-6">

					<div class="card info-card sales-card">
						<div class="card-body">
							<h5 class="card-title fw-bold">Link this url to post and get rewards for every users invited</h5>
							<div class="d-flex align-items-center">
							  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
							    <i class="fa fa-files-o"></i>
							  </div>
							    <div class="input-group w-145 ml-2">
								  <input type="text" id="copyLink" class="form-control" placeholder="Link" aria-label="Link" aria-describedby="button-addon2" readonly>
								  <button class="btn btn-outline-secondary" type="button" id="copyLink_btn">Copy Link</button>		  
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#loading").toggle();
		$("#footer").toggle();
		$("#innerContainer").toggle();      

		$(".dt-button").each(function( index ) {
		  $(this).removeClass();
		  $(this).addClass('btn btn-primary');
		});

		var getUrl = window.location;
		var baseUrl = getUrl.protocol + "//" + getUrl.host;
		var urlLink = baseUrl+"/referalLink?referType=agent&idNum="+currentUser.id+"&referBy="+currentUser.username;

		$("#copyLink").val(urlLink)
	});


	$("#copyLink_btn").on("click",function(){
		$("#copyLink").select();
		document.execCommand("copy");
		document.getSelection().removeAllRanges();

		$.toast({
		    heading: '<h6>Copied your Address</h6>',
		    text: 'You can now paste your address',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-center'
		})
	});
</script>      
