<div class="card p-2 mt-2 rounded shadow-lg main-card-ui m-2 text-center">
	<h4>Invite friends to earn USDT!</h4>

	<div class="input-group mb-3">
	  <input type="text" class="form-control" id="referal_link_container" readonly>

	  <div class="input-group-append">
	    <button class="btn btn-success" type="button" id="copyLink_btn">Copy</button>
	  </div>
	</div>	
</div>

<div class="card p-2 mt-2 rounded shadow-lg main-card-ui m-2">
	<h4 class="text-center">Top Crypto News</h4>

	<div id="news_container"></div>

	<div id="newsLoading">
		<h3>
			<div class="spinner-grow main-color-text" role="status">
			  <span class="sr-only">Loading Latest News...</span>
			</div>

			Loading Latest News...
		</h3>
	</div>

	<script type="text/javascript">
		var getUrl = window.location;
		var baseUrl = getUrl.protocol + "//" + getUrl.host;
		var urlLink = baseUrl+"/referalLink?referType=user&idNum="+currentUser.userID+"&referBy="+currentUser.email;

		$("#referal_link_container").val(urlLink);

		$("#copyLink_btn").on("click",function(){
			// var copiedLink = $("#referal_link_container").val()
			// navigator.clipboard.writeText(copiedLink);

			$("#referal_link_container").select();
			document.execCommand("copy");
			document.getSelection().removeAllRanges();

			$.toast({
			    text: 'Successfully Copied the Link',
		        showHideTransition: 'slide',
		        allowToastClose: false,
		        hideAfter: 5000,
		        stack: 5,
		        position: 'bottom-center',
		        textAlign: 'center',
		        loader: true,
		        loaderBg: '#9EC600'
			})
		});

		baseUrl = "https://widgets.cryptocompare.com/";
		var scripts = document.getElementsByTagName("script");
		var embedder = $("#news_container")[0];

		(function (){
			var appName = encodeURIComponent(window.location.hostname);
			if(appName==""){appName="local";}
			var s = document.createElement("script");
			s.type = "text/javascript";
			s.async = true;
			var theUrl = baseUrl+'serve/v1/coin/feed?fsym=TRX&tsym=USD&feedType=cryptoglobe';
			s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
			
			embedder.append(s)
			$("#newsLoading").toggle();
		})();

		setTimeout(function(){
			var containerATag = $("#news_container a")[1];
			$(containerATag).remove();

			$("#news_container a").attr("href",'#');
			$("#news_container a").attr("target",'');
		},1000)
	</script>
</div>


