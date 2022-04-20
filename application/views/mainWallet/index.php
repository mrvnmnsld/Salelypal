<div id="innerContainer" style="display:none" class="card">.
  <div class="card-body">
    <div class="pagetitle">
      <h1>Main Wallet</h1>
      <sub>Viewing of main wallet settings</sub>
    </div>

    <table id="tableContainer" class="table table-hover table-striped datatable" style="width:100%">
      <thead>
            <tr>
                <th>Options test</th>
                <th>Token</th>
                <th>Network</th>
                <th>Balance</th>
            </tr>
        </thead>
    </table>
  </div>
</div>

<script type="text/javascript">
  var totalInUsd;
  $(document).ready(function() {
    $.when(loadBalances(),).then(loadDatatable);
  });

  function loadBalances(){
    var tokensSelected = ajaxShortLink('userWallet/getAllTokensV2');
    var balance = [];

    for (var i = 0; i < tokensSelected.length; i++) {
      var balanceInner;

      if (tokensSelected[i].networkName == 'trx'||tokensSelected[i].networkName == 'trc20') {
        if (tokensSelected[i].tokenName.toUpperCase() === 'trx'.toUpperCase()) {
          balanceInner = ajaxShortLink('userWallet/getTronBalance',{'trc20Address':'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS'})['balance'];            
        }else{
          balanceInner = ajaxShortLink('userWallet/getTRC20Balance',{
            'trc20Address':'TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS',
            'contractaddress':tokensSelected[i].smartAddress,
          })['balance'];
        }
      }else if(tokensSelected[i].networkName =='bsc'){
        if(tokensSelected[i].tokenName.toUpperCase() === 'bnb'.toUpperCase()){
          balanceInner = ajaxShortLink('userWallet/getBinancecoinBalance',{'bsc_wallet':'0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312'})['balance'];
        }else{
          balanceInner = ajaxShortLink('userWallet/getBscTokenBalance',{
            'bsc_wallet':'0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312',
            'contractaddress':tokensSelected[i].smartAddress
          })['balance'];
        }
      }else if(tokensSelected[i].networkName =='erc20'){
        if(tokensSelected[i].tokenName.toUpperCase() === 'eth'.toUpperCase()){
          balanceInner = ajaxShortLink('userWallet/getEthereumBalance',{
           'erc20_address':'0xaccef84f39a21ce8f04e9ca31c215359af0ad030',
          })['balance'];
        }else{
          balanceInner = ajaxShortLink('userWallet/getErc20TokenBalance',{
            'erc20_address':'0xc81441e9529f6c94b4cf9a3de5ddeb16ffbda312',
            'contractaddress':tokensSelected[i].smartAddress
          })['balance'];
        }
        
      }

      // var differenceResponse = ajaxShortLink('userWallet/getTokenDifference',{'tokenName':tokensSelected[i].tokenName}).Data.Data;
      // var valueNow = ajaxShortLink('userWallet/getTokenValue',{'tokenName':tokensSelected[i].tokenName}).USD;

      balance.push(
        {
          'description':tokensSelected[i].description,
          'network':tokensSelected[i].networkName,
          'smartAddress':tokensSelected[i].smartAddress,
          'balance':balanceInner,
          'tokenName':tokensSelected[i].tokenName,
        }
      )


      // console.log(balanceInner);
    }

    return balance;
  }

  function loadDatatable(balanceArray){
    $('#tableContainer').DataTable().destroy();

    $('#tableContainer').DataTable({
      data: balanceArray,
      columns: [
        { 
          "class":"details-control",
          "orderable":false,
          "data":null,
          // 'width':'1%',
          "defaultContent":
             '<button type="button" class="btn btn-success rounded btn-sm" onClick="deposit(this)">Deposit</button>&nbsp;'+
             '<button type="button" class="btn btn-primary rounded btn-sm" onClick="withdraw(this)">Withdraw</button>',
        },
        { data:'description'},
        { data:'network'},
        { data:'balance'},
      ],"createdRow": function( row, data, dataIndex){
          if (data['isBlocked'] == 1) {
            console.log($(row).addClass('bg-danger text-light'));
          }
      },
      "autoWidth": true,
    });

    $("#loading").css('display','none')
    $("#innerContainer").css('display','block')
    $("#footer").toggle();
  }

  function deposit(element){
    var table = $('#tableContainer').DataTable();
    selectedData = table.row($(element).closest('tr')).data();

    bootbox.alert({
        message: ajaxLoadPage('quickLoadPage',{'pagename':'mainWallet/deposit'}),
        size: 'large',
        centerVertical: true,
        closeButton: false
    });
  }

  function withdraw(element){
    var table = $('#tableContainer').DataTable();
    selectedData = table.row($(element).closest('tr')).data();

    bootbox.alert({
        message: ajaxLoadPage('quickLoadPage',{'pagename':'mainWallet/withdraw'}),
        size: 'large',
        centerVertical: true,
        closeButton: false
    });
  }
</script>