

<span class="text-bolder font-md">
	Invites
</span>

<div id="container_invites" class="text-bold main-color-text py-2">
	
</div>

<script type="text/javascript">
	for (var i = 0; i < invites.length; i++) {
		$("#container_invites").append((i+1)+") "+invites[i].email+"<br>");
	}
</script>