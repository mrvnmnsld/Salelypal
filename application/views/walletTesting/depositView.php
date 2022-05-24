<style type="text/css">
  .modal-footer{
    display: none;
  }

  .error{
    color: red;
  }
  #qrcode img{
    /*border: solid 1px;*/
    outline: 2px solid black;
      outline-offset: 5px;
  }
</style>

<h1>SCAN QR CODE</h1>

<hr>

    <div class="thumbnail d-flex justify-content-center m-3 pt-3 pb-3 img-thumbnail">
      <div id="qrcode"></div>
    </div>
    

    <div class="float-right">
      <button type="button" class="btn btn-danger" id="close_btn">Close</button>
    </div>
    
<script type="text/javascript">
  // console.log($("form"))

  new QRCode($("#qrcode")[0],walletDetails.address);

  $("#close_btn").on("click", function(){
    bootbox.hideAll();
  });

</script>