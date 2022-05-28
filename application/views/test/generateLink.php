<div id="innerContainer" style="display:none" class="card">
	<div class="p-4">
		<div class="pagetitle">
	      <h1>GENERATE REFERAL LINK</h1>
	    </div>
		
		<div class="input-group mb-5 w-50 p-3">
		  <button class="btn btn-success " id="generate_btn"></i>Generate</button>
		  <input type="text" id="copyLink" class="form-control" placeholder="Link" aria-label="Link" aria-describedby="button-addon2" disabled>
		  <button class="btn btn-outline-secondary" type="button" id="copyLink_btn">Copy Link</button>		  
		</div>
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
		var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
		var urlLink = baseUrl+"/refer?type=agent&code="+currentUser.username;


		$("#copyLink").val(urlLink)



	});


	$("#copyLink_btn").on("click",function(){
		var copiedLink = $("#copyLink").val()
		navigator.clipboard.writeText(copiedLink);
	});

</script>