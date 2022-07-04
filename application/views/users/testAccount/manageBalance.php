<style type="text/css">
  .modal-footer{
    display: none;
  }
  label.is-invalid{
    text-align: center;
    color: red;
  }
  .form-control { /* seems working on other ui bugs, no changes on current ui screens */
    height: 2.7em; 
  }
  .modal-content{
    background: transparent;
    border: 0;
  }
  #pagetitle_background{
    background: #293038;
    color: white;
    padding: 15px;
    border-radius: 20px 20px 0px 0px;
    box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
  }
  #main_modal_container{
    background-color: #F2F4F4;
    border-radius:0px 0px 20px 20px;
    box-shadow: 10px 15px 25px rgba(0, 0, 0, .8);
    padding: 20px;
  }
</style>

<div id="pagetitle_background" class="text-center">
  <label class="h2 mt-2 fw-bold">Manage Balance</label>
</div>

<div id="main_modal_container">

  <form id="update_manage_form">

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

      <div class="row mt-1">
        <div class="col-md-4 pl-3"><b>Token Name:</b></div>  
        <div class="col-md" id="token"></div>  
      </div>

      <div class="row mt-1">
        <div class="col-md-4 pl-3"><b>Network:</b></div> 
        <div class="col-md" id="network"></div>  
      </div>

      <div class="row mt-1">
        <div class="col-md-4 pl-3"><b>Available Balance:</b></div> 
        <input class="col-md" id="balance_input">
      </div>

      <hr>

      <div class="d-flex flex-row-reverse">
        <button type="button" class="btn btn-danger mr-1" id="back_manage_btn">Close</button>
        <button type="button" class="btn btn-success mr-1" id="update_balance_btn">Update</button>
      </div>

  </form>

</div>


<script type="text/javascript">

  var selectedData;
  var globalSmartAddressContainer;
  var globalAvailBalance;  

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

    // globalSmartAddressContainer = smartAddressContainer;
    // globalAvailBalance = availBalance;

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
      "description":selectedTokenInfo.description,
      "balance":availBalance
    }

    $("#balance_input").val(availBalance);

    console.log(smartAddressContainer,availBalance,)
  });

  $("#update_balance_btn").on("click",function(){
    $("#update_manage_form").submit();
  });

  $("#update_manage_form").validate({
      errorClass: 'is-invalid',
      rules: {
      
      },
      submitHandler: function(form){
        var data = $('#update_manage_form').serializeArray();
          data.push({
            "name":"userID",
            "value":selectedData["userID"]
          });

        var res = ajaxShortLink('admin/updateManageBalance',data);

        console.log(data,res);

        // if(res == true){
        //   $.toast({
        //       heading: 'Success!!!',
        //       text: 'Balance Successfully Updated',
        //       icon: 'success',
        //   })

        //   bootbox.hideAll();
        //   loadDatatable('admin/getTestAccount');
        // }else{
        //   $.toast({
        //       heading: 'Error!!!',
        //       text: 'System Error, Please Contact System Admin',
        //       icon: 'error',
        //   })
        // }

      }
  });

  $("#back_manage_btn").on('click', function(){
    $(".bootbox")[1].remove();
    $(".modal-backdrop")[1].remove();
  });



</script>

