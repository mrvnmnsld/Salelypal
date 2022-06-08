<style type="text/css">
	.cardboxes{
		box-shadow: 3px 3px 3px 3px rgb(0 0 0 / 29%);
		background-color: rgb(0, 0, 0, 0%)!important;
		color: black;
	}

	.flex-even{
		flex: 1 1 auto;
	}

	input[type=radio] {
	    visibility:hidden;
	}

	label {
	    cursor: pointer;
	}

	input:checked + label {
	    /*background: red;*/
	    background: #343a40;
	    color: white;
	}

	.btn-outline-dark{
		font-size: .7em;
	}
</style>

<div id="daysBtn_container" class="container text-center my-5" style="display:block;"></div>

<div id="daily_mining_token_containers" style="display:none;">
    <button onclick="goback_btn()" class="btn btn-dark" id="backbtn_container">
        <i class="fa fa-arrow-left fa-lg" style="" aria-hidden="true"></i> 
        Go back
    </button>  

    <div id="days_token_container" class="p-3">
        
    </div>
</div>


<script> 

	var getDaysSettings = ajaxShortLink('mining/daily/getAddDays');
	console.log(getDaysSettings);

	for(var i = 0;i<getDaysSettings.length;i++){

		// console.log(getDaysSettings[i].id);

        var getPurchasableLimit = ajaxShortLink('mining/daily/getPurchasableLimit',{
				'day': getDaysSettings[i].id
        });

        console.log(getPurchasableLimit);

        var ratioLimit =(getPurchasableLimit.totalBalance/getPurchasableLimit.totalLimit)*100;
        var isRatioEnough = "";

        if(ratioLimit>=100){
        	isRatioEnough = "disabled"
        }

		$('#daysBtn_container').append(
			'<div class="card p-2 mt-2 bg-light rounded shadow-lg">'+
				'<div class="card-body" style="padding: 1px!important">'+	
					'<div class="d-flex justify-content-around">'+
						'<div class="flex-even text-left h3 font-weight-bold text-dark">'+
							+getDaysSettings[i].days+' Days'+
						'</div>'+

						'<div class="flex-even text-right font-weight-bold text-success">APY: '+
							getDaysSettings[i].apy+'%'+
						'</div>'+
					'</div>'+

					'<div class="text-muted text-left" style="font-size:.7em">'+
						'Mining annualize rate of return'+
					'</div>'+

					'<hr class="w-100">'+

					'<div class="m-2 text-left">'+
						'<b>Purchasable Limit: </b><span id="'+getDaysSettings[i].id+'_days_purchasable_limit_container">'+getPurchasableLimit.totalBalance+'/'+getPurchasableLimit.totalLimit+'</span>'+
					'</div>'+

					'<div class="mx-2">'+
						'<div class="progress">'+
							'<div class="progress-bar" id="'+getDaysSettings[i].id+'_days_progress_bar" style="width: '+ratioLimit.toFixed(2)+'%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+ratioLimit.toFixed(2)+'%</div>'+
						'</div>'+
					'</div>'+

					'<div class="m-2">'+
						'<button id="'+getDaysSettings[i].id+'_days_btn" apyC="'+getDaysSettings[i].apy+'" daysId="'+getDaysSettings[i].id+'" type="button" class="btn btn-warning btn-block btn-sm" style="min-width:12em;">'+
						'Participate now!</button>'+
					'</div>'+
				'</div>'+
			'</div>'
		);
	    
	    $('#'+getDaysSettings[i].id+'_days_btn').on('click',function(){

	        var getDayTokens = ajaxShortLink('mining/daily/getDayTokens',{
					'day': $(this).attr('daysId')
	        });

	        // console.log('TOKENS of daysId: '+$(this).attr('daysId'),getDayTokens);
	        
	        $('#daysBtn_container').fadeOut('fast',function(){
       	 		$('#daily_mining_token_containers').fadeIn();
	        });

	        $("#days_token_container").empty()

	        for(var x = 0;x<getDayTokens.length;x++){

	            var tokenInformation = ajaxShortLink('main/getTokenInfoViaID',{
	                    'tokenID': getDayTokens[x].token_id
	            });

                var getTokenBalanceLimit = ajaxShortLink('mining/daily/getTokenBalanceLimit',{
    				'day': $(this).attr('daysId'),
    				'mining_id': getDayTokens[x].id,
                });

                var ratioLimit =(getTokenBalanceLimit.totalBalance/getTokenBalanceLimit.totalLimit)*100;
                var isRatioEnough = '';

                if(ratioLimit>=100){
                	isRatioEnough = "disabled"
                }

                console.log(getTokenBalanceLimit);

	            var token_name_combo = tokenInformation.tokenName+' ('+tokenInformation.network.toUpperCase()+')';

	            $("#days_token_container").append(
	                '<div id="'+tokenInformation.tokenName+'_container" class="card shadow-lg rounded p-2 mb-3">'+
						'<div class="d-flex justify-content-around">'+
							'<div class="flex-even text-left h4 text-success">'+
								'<img '+
									'style="width: 35px;"'+
									'src="'+tokenInformation.tokenImage+'"'+
								'> '+
								token_name_combo+
							'</div>'+
						'</div>'+

						'<div class="m-2 text-left">'+
							'<b>Purchasable Limit: </b><span>'+getTokenBalanceLimit.totalBalance+'/'+getTokenBalanceLimit.totalLimit+'</span>'+
						'</div>'+

						'<div class="mx-2">'+
							'<div class="progress">'+
								'<div class="progress-bar" style="width: '+ratioLimit.toFixed(2)+'%;" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'+ratioLimit.toFixed(2)+'%</div>'+
							'</div>'+
						'</div>'+

						'<div class="m-2">'+
							"<button type='button' class='btn btn-warning btn-block' "+isRatioEnough+" "+isRatioEnough+" onClick='"+
								'openEntryForm("'+tokenInformation.smartAddress+'","'+getDayTokens[x].id+'","'+token_name_combo+'","'+tokenInformation.network+'","'+tokenInformation.tokenName+'","'+'","'+$(this).attr('apy')+'","'+$(this).attr('days')+'")'+
							"'>Mine Now!</button>"+
						'</div>'+
					'</div>'
	            );
	        }


	    });
	}

	function openEntryForm(smartAddress,mining_id,token_name_combo,networkName,tokenName,apy,cycleSelected){	
		selectedData = {
			'cycleSelected':cycleSelected,
			'smartAddress':smartAddress,
			'mining_id':mining_id,
			'token_name_combo':token_name_combo,
			'networkName':networkName,
			'tokenName':tokenName,
			'apy':apy,
		}

		console.log(selectedData);

		bootbox.alert({
		    message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/daily_income/saveEntry'}),
		    size: 'large',
		    centerVertical: true,
		    closeButton: false
		});
	}

	function goback_btn(){

        $('#daysBtn_container').fadeIn('fast',function(){
   	 		$('#daily_mining_token_containers').fadeOut();
        });
	}

</script>