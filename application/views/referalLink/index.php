<div id="innerContainer" style="display:none" class="card"><br>
	<div class="p-4">
		<div class="pagetitle">
	      	<h1>REFERAL LINK</h1>
  			<sub class="fw-bold">Link this url to post and get rewards for every users invited</sub>
	    </div>
		
		<div class="input-group mb-5 w-100">
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
		var urlLink = baseUrl+"/referalLink?referType=agent&idNum="+currentUser.id+"&referBy="+currentUser.username;

		$("#copyLink").val(urlLink)
	});


	$("#copyLink_btn").on("click",function(){
		var copiedLink = $("#copyLink").val()
		navigator.clipboard.writeText(copiedLink);
	});

</script>