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
  .btn-faq {
    appearance: button;
    background-color: #4D4AE8;
    background-image: linear-gradient(180deg, rgba(255, 255, 255, .15), rgba(255, 255, 255, 0));
    border: 1px solid #4D4AE8;
    border-radius: 1rem;
    box-shadow: rgba(255, 255, 255, 0.15) 0 1px 0 inset,rgba(46, 54, 80, 0.075) 0 1px 1px;
    box-sizing: border-box;
    color: #FFFFFF;
    cursor: pointer;
    display: inline-block;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.5;
    margin: 0;
    padding: .5rem 1rem;
    text-align: center;
    text-transform: none;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    width: 100%;
  }
  .btn-faq:focus:not(:focus-visible),
  .btn-faq:focus {
    outline: 0;
  }
  .btn-faq:hover {
    background-color: #3733E5;
    border-color: #3733E5;
  }
  .btn-faq:focus {
    background-color: #413FC5;
    border-color: #3E3BBA;
    box-shadow: rgba(255, 255, 255, 0.15) 0 1px 0 inset, rgba(46, 54, 80, 0.075) 0 1px 1px, rgba(104, 101, 235, 0.5) 0 0 0 .2rem;
  }
  .btn-faq:active {
    background-color: #3E3BBA;
    background-image: none;
    border-color: #3A38AE;
    box-shadow: rgba(46, 54, 80, 0.125) 0 3px 5px inset;
  }
  .btn-faq:active:focus {
    box-shadow: rgba(46, 54, 80, 0.125) 0 3px 5px inset, rgba(104, 101, 235, 0.5) 0 0 0 .2rem;
  }
  .btn-faq:disabled {
    background-image: none;
    box-shadow: none;
    opacity: .65;
    pointer-events: none;
  }
</style>

<div class="text-center">
  <label class="h3 mt-2 fw-bold">FAQ/Help Center</label>
</div>

<hr>

<div id="main-container">
  <div id="faq-container"></div>
</div>

<hr>

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
          '<div class="card">'+
            '<div class="card-header" id="headingOne'+getFaqAns[i].id+'">'+
              '<h2 class="mb-0">'+
                '<button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne'+getFaqAns[i].id+'" aria-expanded="true" aria-controls="collapseOne'+getFaqAns[i].id+'">'+
                  getFaqAns[i].faq+
                '</button>'+
              '</h2>'+
            '</div>'+

            '<div id="collapseOne'+getFaqAns[i].id+'" class="collapse" aria-labelledby="headingOne'+getFaqAns[i].id+'" data-parent="#accordionExample">'+
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