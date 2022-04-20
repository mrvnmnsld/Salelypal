
<h2 class="text-center">FAQ</h2>
<div id="faqContainer" class="text-dark"></div>

<hr>

<h2 class="text-center">Terms</h2>
<div id="termsContainer" class="text-dark"></div>

<p class="text-center text-dark mt-3 h4">Need to ask something specific? Email us at <a href = "mailto: kang.151513@gmail.com">kang.151513@gmail.com</a></p>

<script type="text/javascript">
  var faq = ajaxShortLink('getAllFaq');
  for (var i = 0; i < faq.length; i++) {
    $('#faqContainer').append(
      '<div class="card m-1 mt-3">'+
        '<div class="card-header font-weight-bold">'+
          faq[i].question+
        '</div>'+
        '<div class="card-body">'+
          '<p class="card-text">'+faq[i].answer+'</p>'+
        '</div>'+
      '</div>'
    );
  }

  var terms = ajaxShortLink('getAllTerms');
  for (var i = 0; i < terms.length; i++) {
    $('#termsContainer').append(
      '<div class="card m-1 mt-3">'+
        '<div class="card-body">'+
          '<p class="card-text">'+terms[i].terms_details+'</p>'+
        '</div>'+
      '</div>'
    );
  }
</script>

