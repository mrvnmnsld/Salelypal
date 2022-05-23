<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<style type="text/css">
    table{
        overflow-x:auto;
    }

    .btn-group-vertical>.btn.active, .btn-group-vertical>.btn:active, .btn-group-vertical>.btn:focus, .btn-group>.btn.active, .btn-group>.btn:active, .btn-group>.btn:focus {
        z-index: 0;
    }
</style>

<!-- <div class="text-danger p-2" id="testNotes">
    <b>Testing Mode:</b>
    <br>
    USDT Won/lose wont be sent until testing mode is turned on.
    To reset available amount, go to home and redirect to this page again.
    <br><br>
    Other USDT Token Pair will be added once testing mode is completed
</div>
 -->

<div id="innerContainer" class="p-2">
    <div>
        <span id="token_pair_name_container" class="text-muted h5 d-none">ETH/USDT</span>
    </div>

    <label>Select Trade Pair:</label><br>

    <select id="token_pair_select">
        <option>ETH/USDT</option>
        <option>BTC/USDT</option>
        <option selected>XRP/USDT</option>
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
        <input type="radio" name="risk_option_radio" value="30/30" autocomplete="off" checked="checked"> 30 Sec <br>
        <small style="font-size: 12px;">30% Income</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="60/50" autocomplete="off"> 60 Sec <br>
        <small style="font-size: 12px;">50% Income</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="120/70" autocomplete="off"> 120 Sec <br>
        <small style="font-size: 12px;">70% Income</small>
      </label>

      <label class="btn btn-secondary">
        <input type="radio" name="risk_option_radio" value="180/90" autocomplete="off"> 180 Sec <br>
        <small style="font-size: 12px;">90% Income</small>
      </label>
    </div>

    <div class="d-flex mt-1 flex-basis: fit-content;">
        <div>
            <label class="mt-1">Amount:</label>
        </div>

        <div style="flex-basis: 100%;">
            <input type="number" class="ml-1 form-control form-control-sm" id="amount_input_container">
        </div>      
    </div>

    <small>
        <div class="text-center text-success">
            <span>Availble Amount:</span>
            <span id="available_amount_container"></span>
        </div>
    </small>

    <div class="d-flex justify-content-center mt-2">
        <button class="btn btn-success col-md" id="buy_rise_btn">
            <img style="width:25px;" src="assets/imgs/icons/growth-graph.png">
            Buy Rise
        </button>

        <button class="btn btn-danger col-md ml-1" id="buy_fall_btn">
            <img style="width:25px;" src="assets/imgs/icons/graph.png">
            Buy Fall
        </button>
    </div>
</div>

<hr style="width:90%;" class="bg-dark">

<div class="mt-3 headers">
    <div class="h4 text-dark text-center">Positions</div>
</div class="text-success">

<div>
    <ul class="nav nav-tabs nav-fill">
      <li class="nav-item">
        <a class="nav-link text-dark active" aria-current="page" data-toggle="tab" href="#pending_tab_btn">Pending</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" data-toggle="tab" href="#history_tab_btn">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" data-toggle="tab" href="#instructions_tab_btn">Instructions</a>
      </li>
    </ul>

    <div class="tab-content">
        <div id="pending_tab_btn" class="tab-pane active">
          <table class="table" style="font-size: 13px;">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Resolve Time</th>
                <th scope="col">Amount</th>
                <th scope="col">Price</th>
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
          <table class="table" style="font-size: 11.5px;">
            <thead>
              <tr>
                <th scope="col">Type
                </th>
                <th scope="col">Resolve Time</th>
                <th scope="col">Amount</th>
                <th scope="col">Price/Resolved</th>
                <!-- <th scope="col"></th> -->
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
    var tokenPriceBinanceLastPrice;
    var totalAmountPending = 0;
    var tokenPairArray = {
        'tokenPairID':'XRPUSDT',
        'tokenPairDescription':'XRP/USDT'
    };

    var pendingPositionChecker;
    var tokenPriceInterval;

    $('#token_pair_select').selectpicker({search : true});

    $('#token_pair_select').change(function(){
        var selectedPair = $(this).val();
        var location;

        if(selectedPair=='BTC/USDT'){
            location = 'btcusdt_risefall';
        }

        if(selectedPair=='ETH/USDT'){
            location = 'ethusdt_risefall';
        }

        if(selectedPair=='XRP/USDT'){
            location = 'xrpusdt_risefall';
        }

        if(selectedPair=='BNB/USDT'){
            location = 'bnbusdt_risefall';
        }

        if(selectedPair=='DOGE/USDT'){
            location = 'dogeusdt_risefall';
        }

        if(selectedPair=='TRX/USDT'){
            location = 'trxusdt_risefall';
        }

        clearInterval(tokenPriceInterval);
        clearInterval(pendingPositionChecker);

        $.when(closeNav()).then(function() {
            $('#topNavBar').toggle();
            $("#container").fadeOut(animtionSpeed, function() {
                $("#loadSpinner").fadeIn(animtionSpeed,function(){
                    $("#container").empty();
                    $("#container").append(ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/risefall_trade_pairs/'+location}));

                    console.log('wallet/test-platform/risefall_trade_pairs/'+location);

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

    setTimeout(function() {
        new TradingView.widget({
            "autosize": true,
            "symbol": "BINANCE:"+tokenPairArray.tokenPairID,
            // "symbol": "BINANCE:BTCUSDT",
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

        //continous
            tokenPriceInterval = setInterval(function() {
                tokenPriceBinanceLastPrice = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).lastPrice).toFixed(4);
                var tokenPriceBinancePriceChangePercent = parseFloat(ajaxShortLinkNoParse("https://api.binance.com/api/v3/ticker/24hr?symbol="+tokenPairArray.tokenPairID).priceChangePercent).toFixed(4);
                var signContainer;

                if(tokenPriceBinancePriceChangePercent.includes("-")){
                    $("#changeContainer").removeClass('text-success');
                    $("#changeContainer").addClass('text-danger');
                    signContainer = "";

                }else{
                    $("#changeContainer").addClass('text-success');
                    $("#changeContainer").removeClass('text-danger');
                    signContainer = "+";
                }

                $("#token_pair_value_container").html(tokenPriceBinanceLastPrice);
                $("#token_pair_value_percentage_container").html(signContainer+tokenPriceBinancePriceChangePercent);
            }, 1000);

            pendingPositionChecker = setInterval(function() {
                if(checkSet.length>=1){
                    console.log(checkSet);

                    for (var i = 0; i < checkSet.length; i++) {
                        var newIncome;
                        var statusClass;
                        var timing;

                        if(checkSet[i].status == "WIN"){
                            newIncome = ((checkSet[i].income/100)*checkSet[i].amount).toFixed(4);
                            statusClass = 'text-success';

                            $.toast({
                                heading: '<h6>WON!</h6>',
                                text: 'You have won '+newIncome+' USDT',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'bottom-center'
                            })

                            pushNewNotif("Position Won!(TESTING)","You have won "+newIncome+" USDT",15)

                            // test-platform
                                balanceUsdt = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
                                    // 'trc20Address':currentUser['trc20_wallet'],
                                    'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
                                })['balance'];

                                $("#available_amount_container").html(parseFloat(balanceUsdt).toFixed(4)+" USDT");
                            // test-platform

                            //this is to show new balance once resolved
                        }else if(checkSet[i].status == "LOSE"){
                            statusClass = 'text-danger';

                            $.toast({
                                heading: '<h6>LOST!</h6>',
                                text: 'You have lost '+positionsOpened[i].amount+' USDT',
                                showHideTransition: 'slide',
                                icon: 'error',
                                position: 'bottom-center'
                            })
                        }

                        innerPositionsOpened = ajaxShortLink(
                            "userWallet/future/getPendingRiseFallPositions",
                            {
                                'userID':15,
                                'tradePair':tokenPairArray.tokenPairDescription,
                            }
                        );  

                        reloadPositions()
                    }
                }else{
                    positionsOpened = ajaxShortLink(
                        "userWallet/future/getPendingRiseFallPositions",
                        {
                            'userID':15,
                            'tradePair':tokenPairArray.tokenPairDescription,
                        }
                    );
                    
                    for (var i = 0; i < positionsOpened.length; i++) {
                        var timeNow = Date.parse(getTimeDateNonFormated());
                        var positionOpenedTimeStamp = Date.parse(positionsOpened[i].timeStamp);
                        var currentPrice = positionsOpened[i].currentPrice;
                        var buyType = positionsOpened[i].buyType;
                        var statusClass = "";

                        if(timeNow>=positionOpenedTimeStamp){
                            var checkSet = ajaxShortLink('userWallet/risefall/getPositionSet',{
                                'userID':currentUser.userID,
                            });

                            
                            var ohlcTimeStamp = ajaxShortLinkNoParse("https://api.binance.com/api/v3/klines?symbol="+tokenPairArray.tokenPairID+"&interval=1m&limit=1&startTime="+(positionOpenedTimeStamp-60000)+"&endTime="+Date.parse(getTimeDateNonFormated()));
                            var closeTokenValue = ohlcTimeStamp[0][4];
                            var status = '';
                            var newIncome = ((positionsOpened[i].income/100)*positionsOpened[i].amount).toFixed(4);
                            var balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                            console.log(currentPrice,closeTokenValue);

                            if(buyType=='rise'){
                                console.log();
                                if (parseFloat(currentPrice)<parseFloat(closeTokenValue)) {
                                    status = "WIN";
                                    statusClass = 'text-success';

                                    $.toast({
                                        heading: '<h6>WON!</h6>',
                                        text: 'You have won '+newIncome+' USDT',
                                        showHideTransition: 'slide',
                                        icon: 'success',
                                        position: 'bottom-center'
                                    })

                                    ajaxShortLink('test-platform/risefall/winPosition',{
                                        'newIncome':newIncome,
                                        'amountStaked':positionsOpened[i].amount,
                                        'amountUsdt':balanceUsdtInner,
                                    });

                                    addToAmountAvailable(parseFloat(newIncome)+parseFloat(positionsOpened[i].amount))

                                    pushNewNotif("Position Won!(TESTING)","You have won "+newIncome+" USDT",15)
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
                            }else if (buyType=='fall'){
                                if (parseFloat(currentPrice)>parseFloat(closeTokenValue)) {
                                    status = "WIN";
                                    statusClass = 'text-success';

                                    $.toast({
                                        heading: '<h6>WON!</h6>',
                                        text: 'You have won '+newIncome+' USDT',
                                        showHideTransition: 'slide',
                                        icon: 'success',
                                        position: 'bottom-center'
                                    })

                                    // test-platform
                                        ajaxShortLink('test-platform/risefall/winPosition',{
                                            'newIncome':newIncome,
                                            'amountStaked':positionsOpened[i].amount,
                                            'amountUsdt':balanceUsdtInner,
                                        });
                                    // test-platform

                                    addToAmountAvailable(parseFloat(newIncome)+parseFloat(positionsOpened[i].amount))

                                    pushNewNotif("Position Won!(TESTING)","You have won "+newIncome+" USDT",15)    
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
                            }

                            // resolve here
                                ajaxShortLink("userWallet/future/resolveRiseFallPosition",{
                                    'id':positionsOpened[i].id,
                                    'resolvedPrice':closeTokenValue,
                                    'status':status,
                                });

                                reloadPositions()
                            // resolve here                    
                        }
                    }
                }
            }, 5000);
        //continous
    }, 2000);

    //callBackEnd
        balanceUsdt = ajaxShortLink('test-platform/getTokenBalanceBySmartAddress',{
            // 'trc20Address':currentUser['trc20_wallet'],
            'contractaddress':'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
        })['balance'];

        $("#available_amount_container").html(parseFloat(balanceUsdt).toFixed(4)+" USDT");

        reloadPositions();
    //callBackEnd

    //buy
        $("#buy_rise_btn").on("click", function(){
            var riskOptionVal = $('input[name="risk_option_radio"]:checked').val().split('/');
            var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
            var buyType = 'rise';
            var currentPrice = tokenPriceBinanceLastPrice;
            var amountInput = $('#amount_input_container').val();
            var timer = riskOptionVal[0];
            var income = riskOptionVal[1];
            var date = getEpochCurrentTime13Digit()
            var timeStamp = formatDateObject(unixTimeToDate13CharNonFormated(date+(timer*1000)))

            if(amountInput!=""&&amountInput<=availableAmount){
                $.confirm({
                    title: 'Buy Rise?',
                    content: 'Are you sure you want to proceed with these risks?',
                    buttons: {
                        confirm: function () {
                            var res = ajaxShortLink("userWallet/future/saveRiseFallPosition",{
                                'currentPrice':currentPrice,
                                'buyType':buyType,
                                'income':income,
                                'timeStamp':timeStamp,
                                'amount':amountInput,
                                'userID':15,
                                'status':'PENDING',
                                'tradePair':tokenPairArray.tokenPairDescription,
                            });

                            balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                            ajaxShortLink('test-platform/risefall/openPosition',{
                                'amountStaked':amountInput,
                                'totalAvailAmount':balanceUsdtInner,
                            });

                            minusToAmountAvailable(amountInput)

                            $.toast({
                                heading: '<h6>Success</h6>',
                                text: 'Position Opened',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'bottom-center'
                            })

                            reloadPositions();
                            
                            console.log(res);
                        },
                        cancel: function () {

                        },
                    }
                });

                // console.log(amountInput,buyType,timer,income,currentPrice,timeStamp);
            }else{
                $.alert("Please Input Enough USDT to be Staked");
            }
        });

        $("#buy_fall_btn").on("click", function(){
            var riskOptionVal = $('input[name="risk_option_radio"]:checked').val().split('/');
            var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
            var buyType = 'fall';
            var currentPrice = tokenPriceBinanceLastPrice;
            var amountInput = $('#amount_input_container').val();
            var timer = riskOptionVal[0];
            var income = riskOptionVal[1];
            var date = getEpochCurrentTime13Digit()
            var timeStamp = formatDateObject(unixTimeToDate13CharNonFormated(date+(timer*1000)))

            if(amountInput!=""&&amountInput<=availableAmount){
                $.confirm({
                    title: 'Buy Fall?',
                    content: 'Are you sure you want to proceed with these risks?',
                    buttons: {
                        confirm: function () {
                            var res = ajaxShortLink("userWallet/future/saveRiseFallPosition",{
                                'currentPrice':currentPrice,
                                'buyType':buyType,
                                'income':income,
                                'timeStamp':timeStamp,
                                'amount':amountInput,
                                'userID':15,
                                'status':'PENDING',
                                'tradePair':tokenPairArray.tokenPairDescription
                            });

                            balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])

                            ajaxShortLink('test-platform/risefall/openPosition',{
                                'amountStaked':amountInput,
                                'totalAvailAmount':balanceUsdtInner,
                            });

                            minusToAmountAvailable(amountInput)

                            $.toast({
                                heading: '<h6>Success</h6>',
                                text: 'Position Opened',
                                showHideTransition: 'slide',
                                icon: 'success',
                                position: 'bottom-center'
                            })

                            reloadPositions();

                            console.log(res);
                        },
                        cancel: function () {

                        },
                    }
                });

                // console.log(amountInput,buyType,timer,income,currentPrice,timeStamp);
            }else{
                $.alert("Please Input Enough USDT to be Staked");
            }
        });
    //buy

    function minusToAmountAvailable(amountToMinus){
        balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        amountToMinus = float2DecimalPoints(amountToMinus)
        // console.log(typeof balanceUsdtInner, balanceUsdtInner);
        // console.log(typeof amountToMinus, amountToMinus);

        var newAmountAvail = balanceUsdtInner-amountToMinus;

        // console.log(typeof newAmountAvail, newAmountAvail);

        $("#available_amount_container").html(newAmountAvail+" USDT");
    }

    function addToAmountAvailable(amountToAdd){
        balanceUsdtInner = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
        amountToAdd = float2DecimalPoints(amountToAdd)
        // console.log(typeof balanceUsdtInner, balanceUsdtInner);
        // console.log(typeof amountToMinus, amountToMinus);

        var newAmountAvail = balanceUsdtInner+amountToAdd;

        // console.log(typeof newAmountAvail, newAmountAvail);

        $("#available_amount_container").html(newAmountAvail+" USDT");
    }

    function cancelPosition(id,element,amount){
        var res = ajaxPostLink('userWallet/future/cancelRiseFallPosition',{
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

    function reloadPositions(){
        var timing = '';
        
        $("#positions_container").empty();
        $("#no_history_position_flag_container").empty();

        // pendings
            var innerPositionsOpened = ajaxShortLink(
                "userWallet/future/getPendingRiseFallPositions",
                {
                    'userID':15,
                    'tradePair':tokenPairArray.tokenPairDescription,
                }
            );

            if (innerPositionsOpened.length == 0) {
                $("#positions_container").append(
                    '<tr class="text-center text-danger" id="no_position_flag_container">'+
                       '<td colspan="5"><b>No positions opened</b></td>'+
                    '</tr>'
                ); 
            }else{
                console.log('HERE');

                for (var x = 0; x < innerPositionsOpened.length; x++) {
                    $("#positions_container").append(
                        '<tr>'+
                            '<td class="font-weight-bold">'+($('#positions_container tr').length+1)+'. </td>'+
                            '<td>'+innerPositionsOpened[x].buyType+' @ '+timing+'</td>'+
                            '<td data-countdown="'+innerPositionsOpened[x].timeStamp+'"></td>'+
                            '<td>'+innerPositionsOpened[x].amount+'</td>'+
                            '<td>'+parseFloat(innerPositionsOpened[x].currentPrice).toFixed(2)+'</td>'+
                            '<td><button onclick="cancelPosition('+innerPositionsOpened[x].id+',this,'+innerPositionsOpened[x].amount+')" class="btn btn-danger btn-sm">X</button></td>'+
                        '</tr>'
                    );
                } 
            }

            $('[data-countdown]').each(function() {
              var $this = $(this), finalDate = $(this).data('countdown');
              $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%H:%M:%S'));
              });
            });
        // pendings

        // closed
            var closedPositions = ajaxShortLink(
                "userWallet/future/getClosedRiseFallPositions",
                {
                    'userID':15,
                    'tradePair':tokenPairArray.tokenPairDescription,
                }
            );

            closedPositions.slice(0,10)

            if (closedPositions.length == 0) {
                $("#no_history_position_flag_container").append(
                    '<tr class="text-center text-danger" id="no_history_position_flag_container">'+
                       '<td colspan="5"><b>No positions opened</b></td>'+
                    '</tr>'
                ); 
            }else{
                for (var x = 0; x < closedPositions.length; x++) {
                    var statusClass;

                    if (closedPositions[x].income == 30) {
                        timing = '30/30'
                    }else if(closedPositions[x].income == 50){
                        timing = '60/50'
                    }else if(closedPositions[x].income == 70){
                        timing = '120/70'
                    }else if(closedPositions[x].income == 90){
                        timing = '180/90'
                    }

                    if (closedPositions[x].status == "WIN") {
                        statusClass = 'text-success'
                    }else{
                        statusClass = 'text-danger'
                    }

                    $("#positions_closed_container").prepend(
                        '<tr class="'+statusClass+'">'+
                            '<td class="">'+closedPositions[x].buyType.toUpperCase()+'</td>'+
                            '<td class="">'+closedPositions[x].timeStamp+'</td>'+
                            '<td class="text-center">'+closedPositions[x].amount+'</td>'+
                            '<td class="">'+parseFloat(closedPositions[x].currentPrice).toFixed(2)+'/'+parseFloat(closedPositions[x].resolvedPrice).toFixed(2)+'</td>'+
                            // '<td class="">'+parseFloat(closedPositions[x].resolvedPrice).toFixed(2)+'</td>'+
                            '<td class="">'+closedPositions[x].status+' </td>'+
                        '</tr>'
                    ); 
                } 


            } 
        // closed
    }
</script>
