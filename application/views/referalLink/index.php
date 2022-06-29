<div id="innerContainer" style="display:none" class="card">
	<div class="p-4">
		<div class="pagetitle">
	      	<h1>REFERAL LINK</h1>
  			<sub class="fw-bold">Link this url to post and get rewards for every users invited</sub>
	    </div>

	    <hr>
		
		<div class="input-group mb-5 w-100">
		  <input type="text" id="copyLink" class="form-control" placeholder="Link" aria-label="Link" aria-describedby="button-addon2" readonly>
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

	$("#copy_tron_btn").on('click',function(){
		
	});

</script>