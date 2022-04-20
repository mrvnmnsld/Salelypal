<div class="text-primary font-weight-bold">Enjoy more available tasks and get more top up points for more successful referals.</div>

<br>

<div>Share your affiliate link with friends, family, and accuaintances. When your referee uses your affiliate link to register, the referal code will be automatically applied</div>

<br>

<div class="input-group mb-3">
	<input type="text" class="form-control" id="referalLinkContainer" aria-describedby="emailHelp" placeholder="">


	<div class="input-group-prepend">
  		<button class="btn btn-primary" id="copyLink" style="border-top-right-radius: 5px 5px;border-bottom-right-radius: 5px 5px;" type="button">Copy link</button>
	</div>
</div>

<script type="text/javascript">
	$('#referalLinkContainer').val(window.location.origin+"?referalCode="+currentUser["userID"]);

	$('#copyLink').on('click',function(){
		var $temp = $("<input>");
		$(".modal-content").append($temp);
		$temp.val(window.location.origin+"?referalCode="+currentUser["userID"]).select();
		document.execCommand("copy");
		$temp.remove();

		$.toast({
		    heading: '<h6>Copied your referal link</h6>',
		    text: 'You can now paste you referal link to get more points!',
		    showHideTransition: 'slide',
		    icon: 'success',
		    position: 'bottom-center'
		})
	})
</script>