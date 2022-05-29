<style type="text/css">
    .disabledDiv{
        background-color: rgba(0, 0, 0, 0.75);
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 10000;
    }

    .disabledDiv h1{
        font-weight: bold;
        text-align: center;
        margin-top: 15%;
        color: white;
    }

    #paypal-button-container{
        position: relative;
    }

    .dataTables_length{
        display: none;
    }

    
</style>

<div id="innerContainer" class="p-3">
    <div id="success_container" class="text-center" style="display: none;">
        <i style="font-size:150px" class="fa fa-check-circle-o text-success" aria-hidden="true"></i><br>
        <span style="font-size:30px" class="text-success">Success!</span>
        <br>

        <span>Payment Successful!</span>

        <div class="text-left" style="font-size:17px">
            <div><b>Token: </b><span id="token_container">000000</span></div>
            <div><b>Token Value: </b><span id="token_amount_container">000000</span></div>
            <div><b>Amount Bought: </b><span id="amount_bought_container">000000</span></div>
            <div><b>Amount Paid: </b><span id="amount_paid_container">000000</span></div>
            <div><b>Timestamp: </b><span id="timestamp_container">000000</span></div>
            <div><b>Reference ID: </b><span id="reference_id_container">000000</span></div>
        </div>

        <br>

        <span class="text-success">NOTE:<br> Please wait for the coin to be transfered it should reflect in a few minutes.<br>If coin haven't been receive in few hours please contact admin and send us the transaction's reference ID.</span>
        
        <br>
        <hr>

        <button type="button" class="btn btn-block btn-danger" id="closeBtn_buyCrypto">Close</button>
    </div>

    <form id="mainForm" style="display: ;">
        <div class="text-center">
            <b>*Instructions:</b> 
            To buy crypto please select which token to buy then confirm the price (Price should be confirmed every 5 seconds to preview the convertion rate of the token), then hit paypal or debit card after confirming the the payment please wait for a few minutes to transfer the coin purchased to your account
        </div>

        <div class="form-group">
            <label>Please select token</label>
            <select id="token_select" name="token_select" class="js-example-basic-single form-control" data-live-search="true">
                <optgroup id="erc20_tokens_container" label="Ethereum Mainet"></optgroup>
                <optgroup id="bsc_tokens_container" label="Binance Smart Chain"></optgroup>
                <optgroup id="tron_tokens_container" label="Tron Mainet"></optgroup>
            </select>
        </div>

        <div class="form-group">
            <label>Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" autocomplete="off">
        </div>

        <button type="submit" class="btn btn-success btn-block" id="confirmBtn">Confirm Pricing</button>
        <div class="text-danger font-weight-bold text-center animate__animated animate__shakeX" id="errorReporter_buyCrypto"></div>

        <small>Note: Confirm price every 5 seconds to proceed to payment</small>

        <br>

        <div id="update_price_container" style="display:none">
            <div>
                <b>Current Token Price:</b>
                <span id="tokenPrice_container">____</span>
            </div>

            <div>
                <b>Total Amount:</b>
                <span id="totalAmount_container">____</span>
            </div>
        </div>

        <div id="paypal-button-container" class="p-2 pt-4">
            <!-- <div class="disabledDiv"><h2>Confirm price again</h2></div> -->
        </div>
    </form>
</div>


<style type="text/css">
    table.dataTable td, table.dataTable th{
      font-size: 0.8em;
    }

    .dataTables_paginate {
        float: ;
    }
    .dataTables_filter {
        float: left;
        display: none;
    }
    .dataTables_length {
        float:left;
    }
    .dataTables_info {
        float:;
    }
</style>

<div class="p-1 m-2 mb-2 text-dark bg-light rounded">
    <div class="text-center">
        <h4>Purchase History</h4>
    </div>

    <table id="tableContainer" class="table table-sm" style="width: 98%!important;">  
        <thead>
            <tr>
                <th>Token</th>
                <!-- <th>Value</th> -->
                <th width="10%">Amount</th>
                <th>Date</th>
            </tr>
        </thead>
    </table>

    <button id="purchaseAppeals_inner_btn" class="btn btn-link btn-block mt-2">Purchase Appeals</button>
</div>


<script>
    $(document).ready(function() {
        loadDatatable('test-platform/getUserPurchase',{'userID':15});

        $('#token_select').selectpicker({
            style: 'border',
            size: 8,
            showSubtext :true
        });
    });

    $('#purchaseAppeals_inner_btn').on('click',function(){
        clearTimeout(tokenLoadTimer);
        $("#tittle_container").text('Purchase Appeals');
        $.when(closeNav()).then(function() {
            $('#topNavBar').toggle();
            $('#bottomNavBar').toggle();
            $("#container").fadeOut(animtionSpeed, function() {
                $("#loadSpinner").fadeIn(animtionSpeed,function(){
                    $("#container").empty();
                    $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/purchaseAppeals'}));

                    $("#loadSpinner").fadeOut(animtionSpeed,function(){
                        $('#topNavBar').toggle();
                        $('#bottomNavBar').toggle();
                        $("#container").fadeIn(animtionSpeed);
                    });
                });
            });
        });
    });     


    function loadDatatable(url,data){
        var callDataViaURLVal = ajaxShortLink(url,data);
        $('#tableContainer').DataTable().destroy();

        $('#tableContainer').DataTable({
            data: callDataViaURLVal,
            columns: [
                { data:'token'},
                // { data:'tokenValue'},
                { data:'amountBought'},
                {
                    "mData": "dateCreated",
                    "mRender": function (data, type, row) {
                        return data;
                    }
                }
            ],
            "autoWidth": true,
            "order": [[ 2, "desc" ]]
        });
    }

    var availBalance;
    var minAmount = 0.02;
    var allTokens = ajaxShortLink('userWallet/getAllTokensV2');

    for (var i = 0; i < allTokens.length; i++) {
        if(allTokens[i].networkName=="erc20"){
            $("#erc20_tokens_container").append(
                '<option data-subtext="'+allTokens[i].networkName+'" value="'+allTokens[i].tokenName+'_'+allTokens[i].networkName+'_'+allTokens[i].smartAddress+'_'+allTokens[i].coingeckoTokenId+'_'+allTokens[i].id+'">'+
                    allTokens[i].tokenName+' ('+allTokens[i].description+')'+
                '</option>'
            );
        }

        if(allTokens[i].networkName=="bsc"){
            $("#bsc_tokens_container").append(
                '<option data data-subtext="'+allTokens[i].networkName+'" value="'+allTokens[i].tokenName+'_'+allTokens[i].networkName+'_'+allTokens[i].smartAddress+'_'+allTokens[i].coingeckoTokenId+'_'+allTokens[i].id+'">'+
                    allTokens[i].tokenName+' ('+allTokens[i].description+')'+
                '</option>'
            );
        }

        if(allTokens[i].networkName=="trx"||allTokens[i].networkName=="trc20"){
            $("#tron_tokens_container").append(
                '<option data-subtext="'+allTokens[i].networkName+'" value="'+allTokens[i].tokenName+'_'+allTokens[i].networkName+'_'+allTokens[i].smartAddress+'_'+allTokens[i].coingeckoTokenId+'_'+allTokens[i].id+'">'+
                    allTokens[i].tokenName+' ('+allTokens[i].description+')'+
                '</option>'
            );
        }
    }
    console.log(allTokens);

    $("#errorReporter_buyCrypto").toggle();
    $("#paypal-button-container").toggle();

    $("#token_select").on('change', function(){
        var tokenInfoWithdraw = $(this).val().split("_");

        var found = tokensSelected.find(e => e.id === tokenInfoWithdraw[4]);

        if (found==undefined&&tokenInfoWithdraw!='') {
        	$.confirm({
        	    title: 'Something is up!',
        	    content: 'This token is not currently added to your wallet, do you wish to list this in your managed tokens?',
        	    buttons: {
        	    	yes: {
        	    	    text: 'Yes',
        	    	    btnClass: 'btn-success',
        	    	    action: function(){
        	    			var res = ajaxShortLink("userWallet/updateTokenManagementV2",{
	        	        		'userID':15,
	        	        		'tokenID':tokenInfoWithdraw[4]
	        	        	});

	        	        	console.log(res);
        	    	    }
        	    	},
        	        no: {
        	            text: 'No',
        	            btnClass: 'btn-danger',
        	            action: function(){
        	        		$("#token_select").val('');

        	            }
        	        }
        	    }
        	});
        }
    });

    $("#closeBtn_buyCrypto").on('click',function(){
        backButton();
    });

    $("#mainForm").validate({
        errorClass: 'is-invalid text-danger',
        rules:{
            token_select: "required",
            amount: {
                required: true,
                min:0.001
            }
        },
        submitHandler: function(form){
            var token_select = $("#token_select").val().split("_");;
            var tokenMarketInfo = ajaxShortLink('userWallet/getTokenDifference',{'tokenName':token_select[3]});
            var tokenValue = tokenMarketInfo.market_data.current_price.usd;

            var amountTotal = parseFloat($("#amount").val());

            var isAmountEnough = true;
            var userWalletAddress ;

            // if (token_select[1] === 'trc20' || token_select[1] === 'trx') {
            //     userWalletAddress = currentUser["trc20_wallet"];
            // }else if(token_select[1] === 'bsc'){
            //     userWalletAddress = currentUser["bsc_wallet"];        
            // }else if(token_select[1] === 'erc20'){
            //     userWalletAddress = currentUser["erc20_wallet"];        
            // }

            console.log(tokenValue,availBalance,amountTotal,tokenValue,userWalletAddress);

            var amountTotalToBePaid = parseFloat((tokenValue*amountTotal).toFixed(2));

            $("#tokenPrice_container").text(tokenValue);
            $("#totalAmount_container").text("$"+numberWithCommas(amountTotalToBePaid));

            $("#paypal-button-container").empty();

            if(isAmountEnough==true){
                $('#confirmBtn').attr('disabled',true);
                $("#errorReporter_buyCrypto").text("")
                $("#errorReporter_buyCrypto").css("display",'none');
                $("#paypal-button-container").css("display",'block');
                $("#update_price_container").css("display",'block');
                

                paypal.Buttons({
                    env: 'sandbox', // sandbox | production
                    // Specify the style of the button
                    style: {
                        label: 'pay',
                        size:  'small',    // small | medium | large | responsive
                        shape: 'pill',     // pill | rect
                        color: 'blue'      // gold | blue | silver | black
                    },
                    createOrder: function(data, actions){
                        clearInterval(confirmPriceTimer);
                        console.log(data, actions)

                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: amountTotalToBePaid
                                }
                            }],
                            "application_context" : { 
                                 "shipping_preference":"NO_SHIPPING"
                            }
                        })
                    },
                    onApprove: function(data, actions){
                        console.log('Data :' + data);
                        console.log('Action : '+actions);
                        return actions.order.capture().then(function(details){

                            if(details['status'] == 'COMPLETED'){
                                console.log(details);
                                // console.log("SEND TOKEN FROM MAIN TO USER")
                                $("#success_container").toggle();
                                $("#mainForm").toggle();
                                $(".bootbox-close-button").toggle()

                                $("#amount_bought_container").text(amountTotal);
                                $("#amount_paid_container").text(amountTotalToBePaid);
                                $("#token_container").text(token_select[0]);
                                $("#token_amount_container").text(tokenValue);

                                $("#timestamp_container").text(getTimeDate());
                                $("#reference_id_container").text(details['id']);

                                var buyCryptoResponse = postShortLink("test-platform/buyCrypto",{
                                    'userID':15,
                                    'referenceID':details['id'],
                                    'amountPaid':amountTotalToBePaid,
                                    'token':token_select[0],
                                    'tokenValue':tokenValue,
                                    'userWalletAddress':userWalletAddress,
                                    'amountBought':amountTotal,
                                    'tokenArray':token_select,
                                });

                                pushNewNotif("Bought Crypto(TESTING)","Tokens successfully bought, post an appeal if tokens haven't been received",15)

                                loadDatatable('test-platform/getUserPurchase',{'userID':15});

                                console.log(buyCryptoResponse);
                            }
                        })
                    },
                    onCancel: function(data, actions) {
                        clearInterval(confirmPriceTimer);

                        console.log(data, actions)
                        var confirmPriceTimer = setTimeout(function() {
                            $("#paypal-button-container").append('<div class="disabledDiv"><h1>Confirm price again</h2></div>');
                            $('#confirmBtn').attr('disabled',false);

                        }, 5000);
                    }
                }).render('#paypal-button-container');

                var confirmPriceTimer = setTimeout(function() {
                    $("#paypal-button-container").append('<div class="disabledDiv"><h1>Confirm price again</h2></div>');
                    $('#confirmBtn').attr('disabled',false);
                }, 5000);
            }else{
                $("#errorReporter_buyCrypto").css('display','block');
                $("#errorReporter_buyCrypto").text("Error: 3663. Please Try Again Later")
            }
        }
    });

</script>