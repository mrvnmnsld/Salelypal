<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap%27');

  .modal-footer{
    display: none;
  }
  #main-container{
    width: 100%; 
    height: 500px; 
    overflow-y: scroll;
  }
  #close_btn{
    background-color: #5426de;
    color: white;
  }
  label{
    color: #5426de;
  }
</style>

<div class="text-center">
  <label class="h3 mt-2 fw-bold main-color-text">FAQ</label>
</div>

<br>

<div id="main-container">
  <div id="faq-container"></div>
</div>

<br>

<div class="d-flex flex-row-reverse">
  <button type="button" class="btn mr-1" id="close_btn">Close</button>
</div>

<script>

  var getFaqAns = ajaxShortLink("admin/loadFAQ");

  // console.log(getFaqAns)

  for (var i = 0; i < getFaqAns.length; i++) {
    if (getFaqAns[i]) {
      $("#faq-container").append(
        '<div class="accordion" id="accordionExample">'+
          '<div class="card main-card-ui">'+
            '<div class="card-header" id="headingOne'+getFaqAns[i].id+'">'+
              '<h2 class="mb-0">'+
                '<button class="btn btn-block text-left main-color-text" type="button" data-toggle="collapse" data-target="#collapseOne'+getFaqAns[i].id+'" aria-expanded="true" aria-controls="collapseOne'+getFaqAns[i].id+'">'+
                  getFaqAns[i].faq+
                '</button>'+
              '</h2>'+
            '</div>'+

            '<div id="collapseOne'+getFaqAns[i].id+'" class="collapse main-color-text" aria-labelledby="headingOne'+getFaqAns[i].id+'" data-parent="#accordionExample">'+
              '<div class="card-body">'+
                getFaqAns[i].answer+
              '</div>'+
            '</div>'+
          '</div>'+
        '</div>'
      );
    }
  }

  $("#close_btn").on("click", function(){
    bootbox.hideAll();
  });
</script>