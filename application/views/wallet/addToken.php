<style type="text/css">
	.material-switch > input[type="checkbox"] {
	    display: none;   
	}

	.material-switch > label {
	    cursor: pointer;
	    height: 0px;
	    position: relative; 
	    width: 40px;  
	}

	.material-switch > label::before {
	    background: rgb(0, 0, 0);
	    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
	    border-radius: 8px;
	    content: '';
	    height: 16px;
	    margin-top: -8px;
	    position:absolute;
	    opacity: 0.3;
	    transition: all 0.4s ease-in-out;
	    width: 40px;
	}
	.material-switch > label::after {
	    background: rgb(255, 255, 255);
	    border-radius: 16px;
	    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
	    content: '';
	    height: 24px;
	    left: -4px;
	    margin-top: -8px;
	    position: absolute;
	    top: -4px;
	    transition: all 0.3s ease-in-out;
	    width: 24px;
	}
	.material-switch > input[type="checkbox"]:checked + label::before {
	    background: inherit;
	    opacity: 0.5;
	}
	.material-switch > input[type="checkbox"]:checked + label::after {
	    background: inherit;
	    left: 20px;
	}

	input[type="checkbox"]:disabled {
	  background: white!important;
	}
</style>

<div class="m-1">
	<div class="text-center mb-2 text-muted">*Note: Toggle which tokens to add to your wallet</div>

    <ul class="list-group" id="token_container">
    	
    </ul>

    <!-- <button class="btn col-md btn-link" id="add_custom_btn">Dont See Your Token? Add Custom Token</button> -->

    <div class="d-flex justify-content-center">
    	<button class="btn col-md btn-success m-1" id="save_token_mngmt_btn">Save</button>
    	<!-- <button class="btn col-md btn-danger m-1" onclick="backButton()">Cancel</button> -->
    </div>

</div>

<script type="text/javascript">
	var tokens = ajaxShortLink('getAllTokens');
	var tokensSelected = ajaxShortLink('userWallet/getAllSelectedTokens',{'userID':currentUser['userID']});
	tokensSelected = tokensSelected[0].tokenIDSelected.split(",");

	for (var i = 0; i < tokens.length; i++) {
		var isSelected = '';

		if (tokensSelected.includes(String(tokens[i].id))) {
			isSelected = 'checked';
		}

		// console.log(String(tokens[i].id),tokensSelected,tokensSelected.includes(String(tokens[i].id)));

		$("#token_container").append(
		  	'<li class="d-flex justify-content-between">'+
		  		'<div class="p-2">'+
		  			'<img class="img-thumbnail " src="'+tokens[i].tokenImage+'" style="width:40px;height: 40px; border:1px;">'+
		  		'</div>'+

		  		'<div class="p-2 mt-2">'+tokens[i].description+" ("+tokens[i].network.toUpperCase()+")"+'</div>'+

		  		'<div class="ml-auto mt-2 p-2 material-switch pull-right">'+
		  	  	   	'<input id="'+tokens[i].id+'" name="someSwitchOption001" type="checkbox" '+isSelected+'/>'+
	  	  	    	'<label for="'+tokens[i].id+'" class="label-default secondary-color-bg"></label>'+
		  		'</div>'+
		  	'</li>'
		);
	}

	$("#save_token_mngmt_btn").on("click", function(){
		var container={};
		container.checked=[];
		container.unchecked=[];

		$("input:checkbox").each(function(){
		    var $this = $(this);

		    if($this.is(":checked")){
		        container.checked.push($this.attr("id"));
		    }else{
		        container.unchecked.push($this.attr("id"));
		    }
		});

		if (container.checked.length ==0) {
			$.confirm({
			    theme: 'dark',
			    title: 'Error!',
			    content: 'Please Add At Least 1 token/coin',
			    typeAnimated: true,
			    buttons: {
			        close: function () {
			        }
			    }
			});
		}else{
			var res = ajaxShortLink("userWallet/updateTokenManagement",{'tokenIDSelected':container.checked.toString(),'userID':currentUser['userID']})
			tokensSelected = ajaxShortLink('userWallet/getAllSelectedTokensVer2',{'userID':currentUser.userID});

			$("#top_back_btn").click();

			$("#tokenContainer").empty();
			$("#totalInUsdContainer").text("Loading...");
			$("#addToken_btn").attr("disabled",'true');
			$("#refresh_btn").attr("disabled",'true');

			
			totalInUsd = 0;
			loadSystem();

			setTimeout(function(){
				var i = 0;

				function myLoop() {
				  	tokenLoadTimer = setTimeout(function() {
					    if (i < tokensSelected.length) {
					    	coinIds.push(tokensSelected[i].coingeckoTokenId);
					    	// coinIds
							loadTokenInfo(tokensSelected[i]);
							myLoop();
					    }else{
					  		$("#totalInUsdContainer").html(numberWithCommas(totalInUsd.toFixed(2)));
					  		$("#totalInUsdContainer").append(" "+displayCurrency.toUpperCase());
					  		
					  		$('#visible_btn').toggle();
					  		$('#refresh_btn').removeAttr("disabled");
					  		$('#addToken_btn').removeAttr("disabled");


					  		// chart PNL
						  		$("#pnl_loading").toggle();
						  		$("#pnl_main").toggle();


				  				var yValues = ajaxShortLink("userWallet/getToken24HourChange",{
					  				"coinIds":coinIds.toString()
					  			})
				  				var xValues = getDaysDate(6);

				  				const average = yValues.reduce((a, b) => a + b, 0) / yValues.length;

				  				console.log(yValues);
				  				console.log(average);

				  				$("#yesterdayPnl").text(parseFloat(yValues[yValues.length-1]).toFixed(2)+"% Change");
				  				$("#allDaysPnl").text(average.toFixed(2)+"% Change");

				  				new Chart("pnl_chart_container", {
				  				  	type: "line",
				  				  	data: {
				  				    	labels: xValues,
				  			    		datasets: [{
				  						      // backgroundColor: "rgba(0,0,0,1.0)",
				  						      fill: false,
				  						      label: false,
				  						      borderColor: "#94abef",
				  						      data: yValues
				  					    }]
				  					},
				  				  	options:{
				  				  		responsive: true,
			  				        	legend: {
			  				          		position: 'top',
			  				          		display: false
			  				        	},
			  				        	title: {
			  			          			display: false,
			  			          			// text: 'Chart.js Line Chart'
			  				       	 	},
				  		      		    tooltips: {
				  		      		        callbacks: {
				  		      		           label: function(tooltipItem) {
				  		      		                  return tooltipItem.yLabel;
				  		      		           }
				  		      		        }
				  		      		    }
				  				  	}
				  				});

				  				var xValues = tokenNames;
				  				var yValues = tokenBalance;


				  				var barColors = getRandomColorIteration(xValues.length);

				  				new Chart("assets_chart_container", {
				  				  	type: "pie",
				  				  	data: {
					  				    labels: xValues,
					  				    datasets: [{
					  				      	backgroundColor: barColors,
				  				      		data: yValues
					  				    }]
				  				  	},
				  				  	options: {
					  				    title: {
				  				      		display: false,
				  				      		// text: "World Wide Wine Production 2018"
					  				    },
					  				    legend: {
				  				      		display: true
					  				    }
				  				  }
				  				});

					  		// chart PNL

							console.timeEnd('loadTimer');
					    }

				    	i++;
				  	}, 500)
				}

				myLoop();
			}, 1000);		

			$.toast({
			    heading: '<h6>Success!</h6>',
			    text: 'Successfully added all changes!',
			    showHideTransition: 'slide',
			    icon: 'success',
			    position: 'bottom-left'
			})
		}

		
	});

	$("#add_custom_btn").on("click", function(){
		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/addToken/addCustomToken'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	});

	

	console.log(tokensSelected);
</script>
