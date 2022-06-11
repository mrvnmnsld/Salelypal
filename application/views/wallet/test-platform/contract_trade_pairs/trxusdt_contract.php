<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
<style type="text/css">
    table{
        overflow-x:auto;
    }

    .btn-group-vertical>.btn.active, .btn-group-vertical>.btn:active, .btn-group-vertical>.btn:focus, .btn-group>.btn.active, .btn-group>.btn:active, .btn-group>.btn:focus {
        z-index: 0;
    }

    /*.bootstrap-select.btn-group .dropdown-menu li a:hover {
         color: whitesmoke !important;
         background: #bf5279 !important;
     }*/

     .btn .dropdown-toggle .btn-light{
        color: whitesmoke !important;
        background: #bf5279 !important;
     }

     .nav .nav-tabs .nav-fill{
        
     }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link {
        background-color: rgba(0, 0, 0, .10);
    }

    .make_me_dark{
        background-color: rgba(0, 0, 0, .05);
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

<div id="innerContainer">
    <div class="text-light p-1" style="background-color:#131722">

        <div class="p-2 text-light">
            <label>Select Token Pair: </label>
            <select id="token_pair_select" style="background-color:#131722!important;color: white;" class="p-2 form-control">
                <option>BTC/USDT</option>
                <option >ETH/USDT</option>
                <option>XRP/USDT</option>
                <option>BNB/USDT</option>
                <option >DOGE/USDT</option>
                <option selected>TRX/USDT</option>
            </select>

            <div id="changeContainer">
                <span class="h5" id="token_pair_value_container"></span>

                <small id="token_pair_value_percentage_container"></small>
                <small>24 Hour change</small>
            </div>
        </div>

        <div class="tradingview-widget-container">
          <div id="tradingview" style="height: 400px;"></div>
        </div>

        <div class="d-flex justify-content-center pt-1 mb-2 mt-2">
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
</div>

<div>
    <ul class="nav nav-tabs nav-fill">
      <li class="nav-item">
        <a class="nav-link text-dark font-weight-bold active" aria-current="page" data-toggle="tab" href="#history_tab_btn">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark font-weight-bold" data-toggle="tab" href="#instructions_tab_btn">Instructions</a>
      </li>
    </ul>

    <div class="tab-content">
        <div id="history_tab_btn" class="tab-pane active">
          <table class="table" style="font-size: 13px;width: 100%;" cellpadding="5">
            <thead>
              <tr>
                <th scope="col">Risk Taken</th>
                <th scope="col">Amount</th>
                <th scope="col">Resolved Price</th>
                <th scope="col">Difference</th>
                <!-- <th scope="col">Status</th> -->
              </tr>
            </thead>
            <tbody id="positions_closed_container">
              <tr class="text-center text-danger" id="no_history_position_flag_container">
                  <td colspan="5"><b>No positions opened</b></td>
              </tr>
            </tbody>
          </table>

          <div class="text-center">
              Showing 5 latest history<br>
              <!-- <button class="btn btn-link" id="viewMore_history_btn">View More</button> -->
          </div>
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
        'tokenPairID':'TRXUSDT',
        'tokenPairDescription':'TRX/USDT'
    };

    //setChart
        setTimeout(function() {
            if($("#tradingview").length == 1){
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
            }

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
            // continuous

        }, 2000);
    //setChart

    var customRiskArray = [];

    //callBackEnd
        reloadPositions()
    //callBackEnd

    // buy

        $("#buy_long_btn").on("click", function(){
            bootbox.alert({
                message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/contract_trade_pairs/buy_long'}),
                size: 'large',
                centerVertical: true,
                closeButton: false
            });
        });

        $("#buy_short_btn").on("click", function(){
            bootbox.alert({
                message: ajaxLoadPage('quickLoadPage',{'pagename':'wallet/test-platform/contract_trade_pairs/buy_short'}),
                size: 'large',
                centerVertical: true,
                closeButton: false
            });
        });
    // buy

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

        addBreadCrumbs('wallet/test-platform/contract_trade_pairs/'+location)
        
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

    function reloadPositions(){
        // closed

            $("#positions_closed_container").empty();

            var positionsClosed = ajaxShortLink(
                "userWallet/future/getClosedPositions",
                {
                    'userID':15,
                    'tradePair':tokenPairArray.tokenPairDescription
                }
            );

            positionsClosed = positionsClosed.slice(0,5)

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
                            // '<td class="">'+positionsClosed[i].status+' </td>'+
                        '</tr>'
                    );  
                }        
            }   
        // closed
    }
</script>
