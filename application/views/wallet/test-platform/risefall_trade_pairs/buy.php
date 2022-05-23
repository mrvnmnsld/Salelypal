<style type="text/css">
    .modal-footer{
        display: none;
    }
</style>

<div class="pagetitle text-center text-primary">
  <h4>Opening Position</h4>
</div>

<hr>

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
    <div class="text-center">
        <span>Availble Amount:</span>
        <span id="available_amount_container"></span>
    </div>

    <div class="text-center">
        <span>Availble Gas:</span>
        <span id="available_gas_container"></span>
    </div>
</small>

<hr>

<div class="mt-3">
    <button class="btn btn-success btn-block" id="buy_rise_submit_btn">Submit Position</button>
    <button class="btn btn-danger btn-block" id="close_btn">Cancel</button>
</div>

<script type="text/javascript">
    $("#available_amount_container").html(parseFloat(balanceUsdt).toFixed(2)+" USDT");

    var gasSupply = getGasSupplyTestPlatform('trx');
    $("#available_gas_container").html(parseFloat(gasSupply.amount).toFixed(2)+' '+gasSupply.gasTokenName);

    $("#close_btn").on("click",function(){
        bootbox.hideAll();
    })

    $("#buy_rise_submit_btn").on("click",function(){
        var riskOptionVal = $('input[name="risk_option_radio"]:checked').val().split('/');
       var availableAmount = float2DecimalPoints($("#available_amount_container").text().split(' ')[0])
       var buyType = 'rise';
       var currentPrice = tokenPriceBinanceLastPrice;
       var amountInput = $('#amount_input_container').val();
       var timer = riskOptionVal[0];
       var income = riskOptionVal[1];
       var date = getEpochCurrentTime13Digit()
       var timeStamp = formatDateObject(unixTimeToDate13CharNonFormated(date+(timer*1000)))
       var isGasEnough = 0;

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

       if(amountInput!=""&&amountInput<=availableAmount&&isGasEnough==1){
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
           $.alert("Please Input Enough USDT to be Staked & make sure GAS(trx) is enough");
       }
    })

   
</script>