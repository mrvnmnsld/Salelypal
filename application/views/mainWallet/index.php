<style type="text/css">
  .is-invalid{
    text-align:center;
  }
</style>
<div id="innerContainer" style="display:none" class="card">.
      <div class="card-body">
        <div class="pagetitle">
          <h1>Main Wallet</h1>
          <sub class="fw-bold">Viewing of Main Wallet Settings</sub>
        </div>
        <hr>

        <div  class="form-group">
          <form id="withdraw_deposit_form">
            <div style="padding: 20px;">

              <label class="fw-bold">Please Select Token</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text text fa fa-btc" aria-hidden="true"></span>
                </div>
                <select id="token_select" name="token_select" class="js-example-basic-single form-control" data-live-search="true">
                    <optgroup id="erc20_tokens_container" label="Ethereum Mainet"></optgroup>
                    <optgroup id="bsc_tokens_container" label="Binance Smart Chain"></optgroup>
                    <optgroup id="tron_tokens_container" label="Tron Mainet"></optgroup>
                </select>
              </div>

              <div> 
                <label class="fw-bold">Token Name:</label>
                <span class="align-middle" id="token"></span>
              </div>

              <div> 
                <label class="fw-bold">Network:</label>
                <span class="align-middle" id="network"></span>
              </div>

              <div> 
                <label class="fw-bold">Available Balance:</label>
                <span class="align-middle" id="balance"></span>
              </div>

              <hr>

              <div class="d-flex">
                <button type="button" class="btn btn-success flex-fill ml-2 btn-sm" id="deposit_btn">Deposit</button>
                <button type="button" class="btn btn-primary flex-fill ml-2 btn-sm" id="withdraw_btn">Withdraw</button>
              </div>

            </div>
          </form>
        </div>
      </div>
</div>


<script type="text/javascript">
  $("#loading").css('display','none')
  $("#innerContainer").css('display','block')
  $("#footer").toggle();

  var selectedData;

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

  $('#token_select').selectpicker({
      style: 'border',
      size: 8,
      showSubtext :true
  });

  setTimeout(function(){
    $("#token_select").change();
  },1000)


  $("#token_select").on('change', function(){
    var tokenInfoWithdraw = $(this).val().split("_");
    var tokenNameContainer = tokenInfoWithdraw[0];
    var networkNameContainer = tokenInfoWithdraw[1];
    var smartAddressContainer = tokenInfoWithdraw[2];
    var coingeckoTokenIdContainer = tokenInfoWithdraw[3];
    var descriptionContainer = tokenInfoWithdraw[4];
    var tokenIndex = $(this).prop('selectedIndex');
    var selectedTokenInfo = allTokens[tokenIndex];  
    var availBalance;

    function balanceDisplay(){
      $('#balance').text(parseFloat(availBalance).toFixed(selectedTokenInfo.decimal)); 
    }

    function walletDetailsDisplay(){
      $('#token').text(tokenNameContainer); 
      $('#network').text(networkNameContainer.toUpperCase());
      // $("#amount").rules( "remove", "min max" );
      // $( "#amount" ).rules( "add", {
      // min: 5
      // });
    }

    function walletDetailsConsolelog(){
      console.log('------------------------------------');
      console.log('USER SELECTED');
      console.log('Selected network :' + tokenNameContainer );
      console.log('Selected token: ' + networkNameContainer);
      console.log('Balance: ' + availBalance);
      console.log('------------------------------------');
    }

    if (networkNameContainer == 'trx'||networkNameContainer == 'trc20') {
        if (tokenNameContainer.toUpperCase() === 'trx'.toUpperCase()) {
            availBalance = ajaxShortLink('mainWallet/getTronBalance',{
            'trc20Address' : 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS'
          })['balance'];

          balanceDisplay();
          walletDetailsConsolelog();
          walletDetailsDisplay();

        }else{
            availBalance = ajaxShortLink('mainWallet/getTRC20Balance',{
            'contractaddress':smartAddressContainer,
            'trc20Address' : 'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS'
          })['balance'];

          balanceDisplay();
          walletDetailsConsolelog();
          walletDetailsDisplay();
        } 

        selectedNetworkGlobal = networkNameContainer;
    }else if(networkNameContainer =='bsc'){
        if(tokenNameContainer.toUpperCase() === 'bnb'.toUpperCase()){
            availBalance = ajaxShortLink('mainWallet/getBinancecoinBalance',{
            'bsc_wallet' : '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312'
          })['balance'];
          balanceDisplay();
          walletDetailsConsolelog();
          walletDetailsDisplay();
        }else{
            availBalance = ajaxShortLink('mainWallet/getBscTokenBalance',{
            'contractaddress' : smartAddressContainer,
            'bsc_wallet' : '0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312'
          })['balance'];
          balanceDisplay();
          walletDetailsConsolelog();
          walletDetailsDisplay();
        }

        selectedNetworkGlobal = networkNameContainer;
    }else if(networkNameContainer =='erc20'){

        if(tokenNameContainer.toUpperCase() === 'eth'.toUpperCase()){
            availBalance = ajaxShortLink('mainWallet/getEthereumBalance',{
            'erc20_address' : '0xaccef84f39a21ce8f04e9ca31c215359af0ad030'
          })['balance'];
          balanceDisplay();
          walletDetailsConsolelog();
          walletDetailsDisplay();
        }else{
            availBalance = ajaxShortLink('mainWallet/getErc20TokenBalance',{
            'contractaddress' : smartAddressContainer,
            'erc20_address' : '0xaccef84f39a21ce8f04e9ca31c215359af0ad030'
          })['balance'];
          balanceDisplay();
          walletDetailsConsolelog();
          walletDetailsDisplay();
        }

        selectedNetworkGlobal = networkNameContainer;
    }

    selectedData = {
      "network":networkNameContainer,
      "description":descriptionContainer,
      "balance":availBalance
    }

    
  });
   
  $("#deposit_btn").on('click',function(){
    // console.log(selectedData);
    if ($("#token_select").val()=="") {
      $.alert("Select Token First!")
    }else{
      bootbox.alert({
        message: ajaxLoadPage('quickLoadPage',{'pagename':'mainWallet/deposit'}),
        size: 'large',
        centerVertical: true,
        closeButton: false
      });
    }   
  });

  $("#withdraw_btn").on('click',function(){
    // console.log(selectedData);
    if ($("#token_select").val()=="") {
      $.alert("Select Token First!")
    }else{
      bootbox.alert({
        message: ajaxLoadPage('quickLoadPage',{'pagename':'mainWallet/withdraw'}),
        size: 'large',
        centerVertical: true,
        closeButton: false
      });
    }   
  });



</script>

