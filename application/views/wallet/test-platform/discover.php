	<style type="text/css">
		.font-sm{
			font-size: 1rem!important;
		}
		.font-xsm{
			font-size: .9rem!important;
		}
		.font-md{
			font-size: 1.3rem!important;
		}
		.font-lg{
			font-size: 1.4rem!important;
		}
		.font-xlg{
			font-size: 2rem!important;
		}
		.text-semibold{
			font-weight: 400;
		}
		.text-bold{
			font-weight: bold;
		}
		.text-bolder{
			font-weight: bolder;
		}
		.cardshad{
			box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px!important;
		}
		.cardshad1{
			box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
		}
		#instruction_invites{
			line-height: 1;
		}
    	.icon_kyc{
	        font-size:1rem!important;
	        color:#5426de!important;
    	}
    	.line1{
    		line-height: 1;
    	}
	</style>

<div class="card px-1 py-2 rounded shadow-lg main-card-ui m-2 cardshad">
	<div class="card px-2 pt-4 mt-2 rounded shadow-lg main-card-ui m-2 cardshad1">
		<span class="main-color-text text-start text-bold font-lg">Invite friends and earn USDT</span>
		<span class="font-xsm text-muted text-start pb-1 text-bold line1 display-4">Copy the link and send it to your friends </span> 

		<div class="input-group mb-1">
		  <input type="text" class="form-control" id="referal_link_container" readonly>

		  <div class="input-group-append">
		    <button class="btn secondary-color-bg" style="color:white;" type="button" id="copyLink_btn">Copy</button>
		  </div>
		</div>

		<div id="total_invites" class="main-color-text text-start">
			<span class="font-sm main-color-text text-bolder display-4">TOTAL INVITES </span> 
			<span class="main-color-text text-bolder font-md" id="total_invites_container"></span>
			
			<button class="btn btn-link" id="view_invites_btn">
				<spam class="font-sm text-semibold text-muted" style="text-decoration: underline;">
					view
				</spam>
			</button>
		</div>
	</div>
	<div class="card p-2 mb-2 rounded shadow-lg main-card-ui mx-2 cardshad1">
		<div class="main-color-text text-start">
			<div id="instruction_invites" class=" pt-4 pb-2 ">
				<span class=" font-md text-bold">
					Share the link to earn rewards!
				</span>

				 <div id="noteslist_invite" class="m-2"> 
			        <div class="text-start px-3">
			          <i class="fa fa-caret-right icon_kyc " aria-hidden="true"></i><span class="text-start main-color-text font-sm"> Invite 1 to get 5% reward!</span>
			        </div>
			        <div class="text-start px-3">
			          <i class="fa fa-caret-right icon_kyc " aria-hidden="true"></i><span class="text-start main-color-text font-sm"> Invite 2 to get 6% reward!</span>
			        </div>
			        <div class="text-start px-3">
			          <i class="fa fa-caret-right icon_kyc " aria-hidden="true"></i><span class="text-start main-color-text font-sm"> Invite 5 to get 10% reward!</span>
			        </div>
			    </div>
			</div>
			
		</div>
	</div>
</div>





<div class="card px-2 pt-5 pb-4 mt-2 rounded shadow-lg main-card-ui m-2 cardshad">
	<h4 class="text-center mb-3 font-xlg text-bold">Top Crypto News</h4>

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

		var invites = ajaxShortLink("userWallet/getAllInvitesByUID",{
			'userID':currentUser.userID
		});

		$("#view_invites_btn").click(function(){
			bootbox.alert({
			    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/invitesList'}),
			    size: 'large',
			    centerVertical: true,
			    closeButton: false
			});
		});

		$("#total_invites_container").text(invites.length)


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


