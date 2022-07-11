<div class="p-2">
	<div id="widget_container"></div>
</div>

<div class="p-2">
	<div>
		<span class="font-weight-bold">Circulating Supply: </span>
		<span id="circulating_supply_container">Circulating Supply: </span>
	</div>

	<div>
		<span class="font-weight-bold">Total Volume: </span>
		<span id="total_volume_container"></span>
	</div>

	<div>
		<span class="font-weight-bold">Market Cap: </span>
		<span id="market_cap_container"></span>
	</div>

	<hr>

	<span class="font-weight-bold">Description: </span>
	<div id="description_container"></div>



	<!-- <div>
		<span class="font-weight-bold">Total Supply: </span>
		<span id="total_supply_container"></span>
	</div> -->
</div>


<script type="text/javascript">

	// token graph
			baseUrl = "https://widgets.cryptocompare.com/";
			var scripts = document.getElementsByTagName("script");
			var embedder = $("#widget_container")[0];
			var cccTheme = {"General":{"background":"rgb(0, 0, 0, 50%)","borderColor":"#","borderRadius":"4px 4px 4px 4px"},"Header":{"background":"#","color":"#FFF"},"Followers":{"background":"#f7931a","color":"#FFF","borderColor":"#e0bd93","counterBorderColor":"#fdab48","counterColor":"#f5d7b2"},"Data":{"priceColor":"#FFF","infoLabelColor":"#CCC","infoValueColor":"#CCC"},"Chart":{"fillColor":"rgba(86,202,158,0.5)","borderColor":"#56ca9e"},"Trend":{"colorUp":"#00ff00"},"Conversion":{"background":"#000","color":"#999"}};

			(function (){
			var appName = encodeURIComponent(window.location.hostname);
			if(appName==""){appName="local";}
			var s = document.createElement("script");
			s.type = "text/javascript";
			s.async = true;
			var theUrl = baseUrl+'serve/v1/coin/chart?fsym='+clickContainer['tokenName']+'&tsym=USD';
			s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
			embedder.append(s)
			})();

			// setTimeout(function(){
			// 	console.log('hide');
			// 	$("a[title='TRX Price and market cap']").removeAttr("target");
			// 	$("a[title='TRX Price and market cap']").removeAttr("href");
			// 	$("a[href='https://www.cryptocompare.com/coins/trx/overview']").removeAttr("href");
			// 	$("a[href='https://www.cryptocompare.com/coins/trx/overview']").removeAttr("target");
			// }, 3000)	
	// token graph

	var coingeckoInfo = ajaxShortLink('userWallet/getTokenDifference',{'tokenName':clickContainer.coingeckoTokenId});

	console.log(coingeckoInfo);

	$("#description_container").html(coingeckoInfo.description.en.split(',')[0]+coingeckoInfo.description.en.split(',')[1])
	$("#circulating_supply_container").html("$"+numberWithCommas(parseInt(coingeckoInfo.market_data.circulating_supply)));
	$("#total_volume_container").html("$"+numberWithCommas(parseInt(coingeckoInfo.market_data.total_volume.usd)));
	$("#market_cap_container").html("$"+numberWithCommas(parseInt(coingeckoInfo.market_data.market_cap.usd))+" "+coingeckoInfo.symbol.toUpperCase());

	// $("#total_supply_container").html(numberWithCommas(parseInt(coingeckoInfo.market_data.total_supply))+coingeckoInfo.symbol.toUpperCase());



	function backPage(){
    	$.when(closeNav()).then(function() {
    		$('#topNavBar').toggle();
      		$("#container").fadeOut(animtionSpeed, function() {
    		  	$("#loadSpinner").fadeIn(animtionSpeed,function(){
    	  			$("#container").empty();
    	  			$("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/viewTokenInfo'}));

    		  		$("#loadSpinner").fadeOut(animtionSpeed,function(){
    		  			$('#topNavBar').toggle();
    		  			$("#container").fadeIn(animtionSpeed);
    		  		});
    	    	});
    	  	});
    	});
	}
</script>