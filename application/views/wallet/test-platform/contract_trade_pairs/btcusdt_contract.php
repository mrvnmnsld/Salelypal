<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<style type="text/css">
    table{
        overflow-x:auto;
    }

    .btn-group-vertical>.btn.active, .btn-group-vertical>.btn:active, .btn-group-vertical>.btn:focus, .btn-group>.btn.active, .btn-group>.btn:active, .btn-group>.btn:focus {
        z-index: 0;
    }
</style>
<!-- 
<div class="text-danger p-2" id="testNotes">
    <b>Testing Mode:</b>
    <br>
    USDT Won/lose wont be sent until testing mode is turned on.
    To reset available amount, go to home and redirect to this page again.
    <br><br>
    Other USDT Token Pair will be added once testing mode is completed
</div> -->

<div id="innerContainer" class="p-2">
    <div>
        <span id="token_pair_name_container" class="text-muted h5 d-none">ETH/USDT</span>
    </div>

    <label>Select Trade Pair:</label><br>

    <select id="token_pair_select">
        <option>ETH/USDT</option>
        <option selected>BTC/USDT</option>
        <option>XRP/USDT</option>
        <option>BNB/USDT</option>
        <option>DOGE/USDT</option>
        <option>TRX/USDT</option>
    </select>

    <div id="changeContainer">
        <span class="h5" id="token_pair_value_container"></span>

        <small id="token_pair_value_percentage_container"></small>
    </div>
    
    <small >24 Hour change</small>

    <div class="tradingview-widget-container">
      <div id="tradingview" style="height: 300px;"></div>
    </div>

    <div class="btn-group btn-group-toggle d-flex justify-content-center mt-2" data-toggle="buttons">
      <label class="btn btn-secondary active">
        <input type="radio" name="risk_option_radio" value="1Min" id="1Min" autocomplete="off"> 1 Minute <br>
        <small style="font-size: 12px;">5% Change</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="3Min" id="3Min" autocomplete="off"> 3 Minutes <br>
        <small style="font-size: 12px;">10% Change</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="5Min" id="5Min" autocomplete="off"> 5 Minutes <br>
        <small style="font-size: 12px;">15% Change</small>
      </label>

      <label class="btn btn-primary" id="customRisk_btn">
        <input type="radio" name="risk_option_radio" value="customRisk" id="customRisk" autocomplete="off"> Custom Risk <br> 
        <span><small>Click to Input</small></span>
      </label>
    </div>

    <div class="mt-3 headers">
        <div class="h4 text-dark text-center">Risks Options</div>
    </div class="text-success">

    <div class="mt-2">
        <!-- <div class="h5 text-dark">Risks Taken</div> -->

        <div>
            <span>Value Predicted(LONG):</span>
            <span id="risk_value_predicted_long">Please select risk option</span>
        </div>

        <div>
            <span>Value Predicted(SHORT):</span>
            <span id="risk_value_predicted_short">Please select risk option</span>
        </div>

        <div>
            <span>Timestamp Trigger:</span>
            <span id="risk_timestamp_predicted">Please select risk option</span>
        </div>
    </div>

    <div class="d-flex mt-1 flex-basis: fit-content;">
        <div>
            <label class="mt-1">Amount:</label>
        </div>

        <div style="flex-basis: 100%;">
            <input type="number" class="ml-1 form-control form-control-sm" id="amount_input_container">
        </div>      
    </div>

    <small >
        <div class="text-center text-success">
            <span>Availble Amount:</span>
            <span id="available_amount_container">20 USDT</span>
        </div>
    </small>

    <div class="d-flex justify-content-center mt-2">
        <button class="btn btn-success col-md" id="buy_long_btn">
            <img style="width:25px;" src="assets/imgs/icons/growth-graph.png">
            Buy Long
        </button>

        <button class="btn btn-danger col-md ml-1" id="buy_short_btn">
            <img style="width:25px;" src="assets/imgs/icons/graph.png">
            Buy Short
        </button>
    </div>
</div>


<hr class="bg-dark">
<div class="mt-3 headers">
    <div class="h4 text-dark text-center">Positions</div>
</div class="text-success">

<div>
    <ul class="nav nav-tabs nav-fill">
      <li class="nav-item">
        <a class="nav-link text-dark active font-weight-bold" aria-current="page" data-toggle="tab" href="#pending_tab_btn">Pending</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark font-weight-bold" data-toggle="tab" href="#history_tab_btn">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark font-weight-bold" data-toggle="tab" href="#instructions_tab_btn">Instructions</a>
      </li>
    </ul>

    <div class="tab-content">
        <div id="pending_tab_btn" class="tab-pane active">
          <table class="table" style="font-size: 15px;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Risk & Closing</th>
                <th scope="col">Amount</th>
                <th scope="col">Type</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody id="positions_container">
              <tr class="text-center text-danger" id="no_position_flag_container">
                  <td colspan="5"><b>No positions opened</b></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="history_tab_btn" class="tab-pane fade">
          <table class="table" style="font-size: 13px;">
            <thead>
              <tr>
                <th scope="col">Risk Taken</th>
                <th scope="col">Amount</th>
                <th scope="col">Resolved Price</th>
                <th scope="col">Difference</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody id="positions_closed_container">
              <tr class="text-center text-danger" id="no_history_position_flag_container">
                  <td colspan="5"><b>No positions opened</b></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div id="instructions_tab_btn" class="tab-pane fade p-2">
          <span>
              1. Select token value prediction.<br>
              2. Select Time limit of prediction.<br>
              3. Input amount to be staked.<br>
              4. Wait for time prediction.<br>
              5. Check history if won or lost.<br>
              <br>

              <!-- *Additional<br>
              If the prediction is right but the token staked was not sent please report it as an appeal and wait for our admins to review what happened to your trade transaction -->
          </span>

          <!-- <br> -->
          <!-- <br> -->

          <div class="h6">FAQ:</div>
          <span>
              <b>1. How are the token predicted value being computed?</b><br>
              Your value predicted will check the timestamp of that minute's CLOSED value(based on binance OHLC data)

              <br>

              <b>2. Are my staked tokens will be liquidated if i lost, how about if i won?</b><br>
              The staked amount will be doubled if you have predicted the right amount but if you lose all your staked USDT will be liquidated. It's a high risk high reward kind of predictions
          </span>
        </div>
      </div>
</div>

<!-- TradingView Widget BEGIN -->
<script type="text/javascript">

    var pendingPositionChecker;
    var tokenPriceInterval;
    var tokenPriceBinanceLastPrice;

    var totalAmountPending = 0;
    var tokenPairArray = {
        'tokenPairID':'BTCUSDT',
        'tokenPairDescription':'BTC/USDT'
    };
    //setChart
        setTimeout(function() {
            new TradingView.widget({
                "autosize": true,
                // "symbol": "BINANCE:ETHUSDT",
                "symbol": tokenPairArray.tokenPairID,
                "interval": "1",
                "timezone": Intl.DateTimeFormat().resolvedOptions().timeZone,
                "theme": "dark",
                "style": "1",
                "locale": "en",
                "toolbar_bg": "#f1f3f6",
                "enable_publishing": false,
                "save_image": false,
                "container_id": "tradingview"
            });

            // continuous
                tokenPriceInterval = setInterval(function() {
                    tokenPriceBinanceLastPrice = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).lastPrice).toFixed(2);
                    var ethPriceBinancePriceChangePercent = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).priceChangePercent).toFixed(2);
                    var signContainer;

                    if(ethPriceBinancePriceChangePercent.includes("-")){
                        $("#changeContainer").removeClass('text-success');
                        $("#changeContainer").addClass('text-danger');
                        signContainer = "";

                    }else{
                        $("#changeContainer").addClass('text-success');
                        $("#changeContainer").removeClass('text-danger');
                        signContainer = "+";
                    }

                    $("#token_pair_value_container").html(tokenPriceBinanceLastPrice);
                    $("#token_pair_value_percentage_container").html(signContainer+ethPriceBinancePriceChangePercent);
                }, 1000);

                pendingPositionChecker = setInterval(function() {

                    var checkSet = ajaxShortLink('userWallet/future/getFuturePositionSet',{
                        'userID':currentUser.userID,
                    });

                    console.log(checkSet);

                    if(checkSet.length>=1){
                        var statusClass;
                        // console.log(checkSet);

                        for (var i = 0; i < checkSet.length; i++) {
                            var futureDetails = ajaxShortLink('userWallet/future/getFuturePositionDetailsByID',{
                                'id':checkSet[i].id
                            })

                            if(futureDetails.status == "WIN"){
                                var newIncome = (futureDetails.amount*2).toFixed(2);

                                statusClass = 'text-success';
                                pushNewNotif("Position Won!(TESTING)","You have won "+newIncome+" USDT",15)

                                $.toast({
                                    heading: '<h6>WON!</h6>',
                                    text: 'You have won '+newIncome+' USDT',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    position: 'bottom-center'
                                })

                                balanceUsdt = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
                                    // 'trc20Address':currentUser['trc20_wallet'],
                                    'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
                                })['balance'];

                                $("#available_amount_container").html(parseFloat(balanceUsdt).toFixed(2)+" USDT");
                            }else{
                                statusClass = 'text-danger';
                                $.toast({
                                    heading: '<h6>LOST!</h6>',
                                    text: 'You have lost '+futureDetails.amount+' USDT',
                                    showHideTransition: 'slide',
                                    icon: 'error',

                                    position: 'bottom-center'
                                })
                            }
            
                            reloadPositions()
                        }
                    }else{
                        positionsOpened = ajaxShortLink(
                            "userWallet/future/getPendingPositions",
                            {
                                'userID':15,
                                'status':"PENDING",
                                'tradePair':tokenPairArray.tokenPairDescription
                            }
                        );

                        for (var i = 0; i < positionsOpened.length; i++) {
                            var timeNow = Date.parse(getTimeDateNonFormated());
                            var positionOpenedTimeStamp = Date.parse(positionsOpened[i].timeStamp);
                            var riskPrice = positionsOpened[i].riskPrice;


                            // console.log(positionOpenedTimeStamp,timeNow);

                            if(timeNow>=positionOpenedTimeStamp){
                                var ohlcTimeStamp = ajaxShortLinkNoParse("https://api.binance.com/api/v3/klines?symbol="+tokenPairArray.tokenPairID+"&interval=1m&limit=1&startTime="+(positionOpenedTimeStamp-60000)+"&endTime="+Date.parse(getTimeDateNonFormated()));
                                var closeTokenValue = ohlcTimeStamp[0][4];
                                var status = '';
                                var statusClass = "";
                                var balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                                if(riskPrice==closeTokenValue){
                                    status = "WIN";
                                    statusClass = 'text-success';
                                    $.toast({
                                        heading: '<h6>WON!</h6>',
                                        text: 'You have won '+positionsOpened[i].amount+' USDT',
                                        showHideTransition: 'slide',
                                        icon: 'success',
                                        position: 'bottom-center'
                                    })

                                    ajaxShortLink('test-platform/future/winPosition',{
                                        'amountStaked':positionsOpened[i].amount,
                                        'amountUsdt':balanceUsdtInner,
                                    });

                                    pushNewNotif("Position Won!(TESTING)","You have won "+positionsOpened[i].amount+" USDT")

                                    addToAmountAvailable(parseFloat(positionsOpened[i].amount)*2)
                                }else{
                                    status = "LOSE";
                                    statusClass = 'text-danger';
                                    $.toast({
                                        heading: '<h6>LOST!</h6>',
                                        text: 'You have lost '+positionsOpened[i].amount+' USDT',
                                        showHideTransition: 'slide',
                                        icon: 'error',
                                        position: 'bottom-center'
                                    })
                                }

                                console.log("Remove Index #"+i,positionsOpened[i]);

                                ajaxShortLink("userWallet/future/resolvePosition",{
                                    'id':positionsOpened[i].id,
                                    'resolvedPrice':closeTokenValue,
                                    'status':status,
                                });

                                reloadPositions()
                            }
                        }
                    }

                    

                    console.log("No logs")
                }, 5000)
            // continuous

        }, 2000);
    //setChart

    var customRiskArray = [];

    //callBackEnd
        var balanceUsdt = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
            // 'trc20Address':currentUser['trc20_wallet'],
            'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
        })['balance'];

        $("#available_amount_container").html(parseFloat(balanceUsdt).toFixed(2)+" USDT");

        var gasSupply = getGasSupplyTestPlatform('trx');
        $("#available_gas_container").html(parseFloat(gasSupply.amount).toFixed(2)+' '+gasSupply.gasTokenName);

        reloadPositions()
    //callBackEnd

    // buy
        $("#buy_short_btn").on("click", function(){
            var amount = $("#amount_input_container").val();
            var riskPrice = $("#risk_value_predicted_short").text();
            var timeStamp = $("#risk_timestamp_predicted").text();
            var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
            var isGasEnough = 0;

            if($("#risk_value_predicted_short").text()=="Please select risk option"||$("#amount_input_container").val()==""){
                $.alert("Please Select Amount and Risks first");
            }else{
                if(Date.parse(timeStamp)<=Date.parse(getTimeDateNonFormated())){
                    $.alert("Please Change your predicted time.");
                }else{
                    // test-platform
                        gasSupply = getGasSupplyTestPlatform('trx')

                        if(parseFloat(gasSupply.amount) >= parseFloat(gasSupply.amount-5)){
                            isGasEnough = 1;

                            var minusGasFee = ajaxShortLink("test-platform/minusBalance",{
                                'tokenName':'trx',
                                'smartAddress':null,
                                'newAmount':parseFloat(gasSupply.amount)-5,
                            })

                            gasSupply = getGasSupplyTestPlatform('trx')

                            $("#available_gas_container").html(parseFloat(gasSupply.amount).toFixed(2)+' '+gasSupply.gasTokenName);
                        }
                    // test-platform

                    if($("#amount_input_container").val()<=availableAmount&&isGasEnough==1){
                        $.confirm({
                            title: 'Buy Short?',
                            content: 'Are you sure you want to proceed with these risks?',
                            buttons: {
                                confirm: function () {
                                    var res = ajaxShortLink("userWallet/future/savePosition",{
                                        'currentPrice':tokenPriceBinanceLastPrice,
                                        'positionType':'short',
                                        'riskPrice':riskPrice,
                                        'timeStamp':timeStamp,
                                        'amount':amount,
                                        'userID':15,
                                        'status':'PENDING',
                                        'tradePair':tokenPairArray.tokenPairDescription,
                                    });

                                    balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                                    ajaxShortLink('test-platform/future/openPosition',{
                                        'amountStaked':amount,
                                        'totalAvailAmount':balanceUsdtInner,
                                    });

                                    minusToAmountAvailable(amount)

                                    $.toast({
                                        heading: '<h6>Success</h6>',
                                        text: 'Position Opened',
                                        showHideTransition: 'slide',
                                        icon: 'success',
                                        position: 'bottom-center'
                                    })
                                    
                                    console.log(res);

                                    reloadPositions()
                                },
                                cancel: function () {

                                },
                            }
                        });
                    }else{
                        $.alert("Please Input Enough USDT to be Staked & make sure GAS(trx) is enough");
                    }
                }
               
            }
        });

        $("#buy_long_btn").on("click", function(){
            var amount = $("#amount_input_container").val();
            var riskPrice = $("#risk_value_predicted_long").text();
            var timeStamp = $("#risk_timestamp_predicted").text();
            var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

            if($("#risk_value_predicted_long").text()=="Please select risk option"||$("#amount_input_container").val()==""){
                $.alert("Please Select Amount and Risks first");
            }else{
                if(Date.parse(timeStamp)<=Date.parse(getTimeDateNonFormated())){
                    $.alert("Please Change your predicted time.");
                }else{
                    // test-platform
                        gasSupply = getGasSupplyTestPlatform('trx')

                        if(parseFloat(gasSupply.amount) >= parseFloat(gasSupply.amount-5)){
                            isGasEnough = 1;
                        }
                    // test-platform

                    if($("#amount_input_container").val()<=availableAmount&&isGasEnough==1){
                        $.confirm({
                            title: 'Buy Long?',
                            content: 'Are you sure you want to proceed with these risks?',
                            buttons: {
                                confirm: function () {

                                    // test-platform
                                        var minusGasFee = ajaxShortLink("test-platform/minusBalance",{
                                            'tokenName':'trx',
                                            'smartAddress':null,
                                            'newAmount':parseFloat(gasSupply.amount)-5,
                                        })

                                        gasSupply = getGasSupplyTestPlatform('trx')

                                        $("#available_gas_container").html(parseFloat(gasSupply.amount).toFixed(2)+' '+gasSupply.gasTokenName);
                                    // test-platform

                                    var res = ajaxShortLink("userWallet/future/savePosition",{
                                        'currentPrice':tokenPriceBinanceLastPrice,
                                        'positionType':'long',
                                        'riskPrice':riskPrice,
                                        'timeStamp':timeStamp,
                                        'amount':amount,
                                        'userID':15,
                                        'status':'PENDING',
                                        'tradePair':tokenPairArray.tokenPairDescription,
                                    });


                                    balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                                    ajaxShortLink('test-platform/future/openPosition',{
                                        'amountStaked':amount,
                                        'totalAvailAmount':balanceUsdtInner,
                                    });

                                    minusToAmountAvailable(amount)

                                    $.toast({
                                        heading: '<h6>Success</h6>',
                                        text: 'Position Opened',
                                        showHideTransition: 'slide',
                                        icon: 'success',
                                        position: 'bottom-center'
                                    })

                                    console.log(res);
                                    reloadPositions()

                                },
                                cancel: function () {

                                },
                            }
                        });
                    }else{
                        $.alert("Please Input Enough USDT to be Staked & make sure GAS(trx) is enough");
                    }
                }  
            }
        });
    // buy

    $("#customRisk_btn").on("click", function(){
        bootbox.alert({
            message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/future/customRisk'}),
            size: 'large',
            centerVertical: true,
            closeButton: false
        });
    });

    $('input[name="risk_option_radio"]').change(function(){
        var riskTaken = $(this).val();

        if(riskTaken=="1Min"){
            var ethPriceBinance = parseFloat(tokenPriceBinanceLastPrice);
            var risk_timestamp_predicted = addMinutes(getTimeDateNonFormated(), 1);

            $("#risk_value_predicted_long").text(parseFloat(ethPriceBinance+(ethPriceBinance*0.05)).toFixed(2));
            $("#risk_value_predicted_short").text(parseFloat(ethPriceBinance-(ethPriceBinance*0.05)).toFixed(2));
            $("#risk_timestamp_predicted").text(formatDateObject(risk_timestamp_predicted).replace(/,/g, ''));
        }else if(riskTaken=="3Min"){
            var ethPriceBinance = parseFloat(tokenPriceBinanceLastPrice);
            var risk_timestamp_predicted = addMinutes(getTimeDateNonFormated(), 3);

            $("#risk_value_predicted_long").text(parseFloat(ethPriceBinance+(ethPriceBinance*0.10)).toFixed(2));
            $("#risk_value_predicted_short").text(parseFloat(ethPriceBinance-(ethPriceBinance*0.10)).toFixed(2));
            $("#risk_timestamp_predicted").text(formatDateObject(risk_timestamp_predicted).replace(/,/g, ''));
        }else if(riskTaken=="5Min"){
            var ethPriceBinance = parseFloat(tokenPriceBinanceLastPrice);
            var risk_timestamp_predicted = addMinutes(getTimeDateNonFormated(), 5);

            $("#risk_value_predicted_long").text(parseFloat(ethPriceBinance+(ethPriceBinance*0.15)).toFixed(2));
            $("#risk_value_predicted_short").text(parseFloat(ethPriceBinance-(ethPriceBinance*0.15)).toFixed(2));
            $("#risk_timestamp_predicted").text(formatDateObject(risk_timestamp_predicted).replace(/,/g, ''));
        }
    });

    $('#token_pair_select').selectpicker({search : true});

    $('#token_pair_select').change(function(){
        var selectedPair = $(this).val();
        var location;

        if(selectedPair=='BTC/USDT'){
            location = 'btcusdt_contract';
        }

        if(selectedPair=='ETH/USDT'){
            location = 'ethusdt_contract';
        }

        if(selectedPair=='XRP/USDT'){
            location = 'xrpusdt_contract';
        }

        if(selectedPair=='BNB/USDT'){
            location = 'bnbusdt_contract';
        }

        if(selectedPair=='DOGE/USDT'){
            location = 'dogeusdt_contract';
        }

        if(selectedPair=='TRX/USDT'){
            location = 'trxusdt_contract';
        }

        clearInterval(tokenPriceInterval);
        clearInterval(pendingPositionChecker);


        $.when(closeNav()).then(function() {
            $('#topNavBar').toggle();
            $("#container").fadeOut(animtionSpeed, function() {
                $("#loadSpinner").fadeIn(animtionSpeed,function(){
                    $("#container").empty();
                    $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/contract_trade_pairs/'+location}));

                    console.log('wallet/test-platform/contract_trade_pairs/'+location);

                    setTimeout(function(){
                        $("#loadSpinner").fadeOut(animtionSpeed,function(){
                            $('#topNavBar').toggle();
                            $("#container").fadeIn(animtionSpeed);
                        });
                    }, 2000);
                    
                });
            });
        });
    });

    function cancelPosition(id,element,amount){
        var res = ajaxPostLink('userWallet/future/cancelPosition',{
            'id':id
        });

        addToAmountAvailable(amount)

        $(element).parent('td').parent('tr').remove();

        if ($("#positions_container tr").length == 0) {
            $("#positions_container").append(
                '<tr class="text-center text-danger" id="no_position_flag_container">'+
                   '<td colspan="5"><b>No positions opened</b></td>'+
                '</tr>'
            ); 
        }

        $.toast({
            heading: '<h6>Success</h6>',
            text: 'Canceled Position',
            showHideTransition: 'slide',
            icon: 'success',
            position: 'bottom-center'
        })
    }

    function minusToAmountAvailable(amountToMinus){
        balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        amountToMinus = float2DecimalPoints(amountToMinus)
        console.log(typeof balanceUsdtInner, balanceUsdtInner);
        console.log(typeof amountToMinus, amountToMinus);

        var newAmountAvail = balanceUsdtInner-amountToMinus;

        console.log(typeof newAmountAvail, newAmountAvail);

        $("#available_amount_container").html(newAmountAvail+" USDT");
    }

    function addToAmountAvailable(amountToAdd){
        balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        amountToAdd = float2DecimalPoints(amountToAdd)
        console.log(typeof balanceUsdtInner, balanceUsdtInner);
        // console.log(typeof amountToMinus, amountToMinus);

        var newAmountAvail = balanceUsdtInner+amountToAdd;

        // console.log(typeof newAmountAvail, newAmountAvail);

        $("#available_amount_container").html(newAmountAvail+" USDT");
    }

    function reloadPositions(){
        $("#positions_container").empty();

        // pendings
            positionsOpened = ajaxShortLink(
                "userWallet/future/getPendingPositions",
                {
                    'userID':15,
                    'status':"PENDING",
                    'tradePair':tokenPairArray.tokenPairDescription
                }
            );


            console.log(positionsOpened.length,positionsOpened);

            if(positionsOpened.length==0){
                if ($("#positions_container tr").length == 0) {
                    $("#positions_container").append(
                        '<tr class="text-center text-danger" id="no_position_flag_container">'+
                           '<td colspan="5"><b>No positions opened</b></td>'+
                        '</tr>'
                    ); 
                }
            }else{
                for (var i = 0; i < positionsOpened.length; i++) {
                    $("#positions_container").append(
                        '<tr>'+
                            '<td class="font-weight-bold">'+(i+1)+'. </td>'+
                            '<td>'+positionsOpened[i].riskPrice+' @<span data-countdown="'+positionsOpened[i].timeStamp+'"></span></td>'+
                            '<td>'+positionsOpened[i].amount+'</td>'+
                            '<td>'+positionsOpened[i].positionType+'</td>'+
                            '<td><button onclick="cancelPosition('+positionsOpened[i].id+',this,'+positionsOpened[i].amount+')" class="btn btn-danger btn-sm">X</button></td>'+
                        '</tr>'
                    );  
                }  

                $('[data-countdown]').each(function() {
                  var $this = $(this), finalDate = $(this).data('countdown');
                  $this.countdown(finalDate, function(event) {
                    $this.html(event.strftime('%H:%M:%S'));
                  });
                });
            }
        // pendings

        // closed
            var positionsClosed = ajaxShortLink(
                "userWallet/future/getClosedPositions",
                {
                    'userID':15,
                    'tradePair':tokenPairArray.tokenPairDescription
                }
            );

            if (positionsClosed.length>=1) {
                $("#positions_closed_container").empty();

                for (var i = 0; i < positionsClosed.length; i++) {
                    if(positionsClosed[i].status=="WIN"){
                        statusClass = 'text-success';
                    }else{
                        statusClass = 'text-danger';
                    }

                    $("#positions_closed_container").append(
                        '<tr class="'+statusClass+'">'+
                            '<td class="">'+positionsClosed[i].riskPrice+'</td>'+
                            '<td class="">'+positionsClosed[i].amount+'</td>'+
                            '<td class="">'+parseFloat(positionsClosed[i].resolvedPrice).toFixed(2)+'</td>'+
                            '<td class="">'+(positionsClosed[i].resolvedPrice-positionsClosed[i].riskPrice).toFixed(2)+'</td>'+
                            '<td class="">'+positionsClosed[i].status+' </td>'+
                        '</tr>'
                    );  
                }        
            }   
        // closed

        

    }

    

    
</script>
