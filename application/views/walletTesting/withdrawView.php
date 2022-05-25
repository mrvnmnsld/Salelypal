<style type="text/css">
  .modal-footer{
    display: none;
  }

  .error{
    color: red;
  }
</style>

<h1>WITHDRAW</h1>
  <div id="main_modal_container">
    <form id="withdraw_form">
      <div class="mb-3">
        <label class="form-label">Receivers Address</label>
        <input type="text" name="toAddress" class="form-control" id="toAddress" value="TCyRBGnjMSLsPos5RJxVfC7fjcWk1vaUqS">
      </div>
      <div class="mb-3">
        <label class="form-label">Amount</label>
        <input type="number" name="amount" class="form-control" id="amount" value="0.005">
      </div>
      <div class="mb-3">
        <label class="form-label">Private Key</label>
        <input type="text" name="privateKey" class="form-control" id="privateKey" value="ff5b8a1134c4f3ddf3665676a736734eb3a5093716cb6e078bb7a509c39c4493">
      </div>
    </form>

    <div class="float-right">
      <button type="submit" form="withdraw_form" class="btn btn-success" id="save_btn">Send</button>
      <button type="button" class="btn btn-danger close_btn">Cancel</button>
    </div>
  </div>
  
  <div id="sec_modal_container" style="display:none">
    <label>Success!!!</label>
    <div>
      Sent To:
      <span id="toContainer"></span>
    </div>

    <div>
      Amount:
      <span id="amountContainer"></span>
    </div>

    <div>
      Transaction Code:
      <span id="txIDcontainer"></span>
    </div>
    <a href="" target="_blank" id="newTab">Click here to view progress in explorer</a>

    <div class="float-right">
      <button type="button" class="btn btn-danger close_btn">Cancel</button>
    </div>
  </div>

<script type="text/javascript">
  // console.log($("form"))

  $("#withdraw_form").validate({
      errorClass: 'is-invalid',
      rules: {
        toAddress: "required",
        amount: "required",
        privateKey: "required",
      },
      submitHandler: function(form){
        var data = $('#withdraw_form').serializeArray();
        console.log(data);


        var res = ajaxShortLink('../walletTesting/sendTron',data);

        console.log(data,res);

        if (res.ok == true) {
          $('#sec_modal_container').css('display','block');
          $('#main_modal_container').css('display','none');
          $('#newTab').attr('href','https://tronscan.org/#/transaction/'+ res.txid);

          $('#toContainer').text(res.to);
          $('#amountContainer').text(res.amount);
          $('#txIDcontainer').text(res.txid);

          var res = ajaxShortLink('../walletTesting/getTronBalance',{
            'address': walletDetails.address
          });

          $('#trx_balance_container').text(res.balance);
        }else{
          alert('Error in Sending Crypto!');
        }

      }
  });

  $(".close_btn").on("click", function(){
    bootbox.hideAll();
  });
</script>