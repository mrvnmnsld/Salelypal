// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
 	closeModal();
  }
}

async function openModal(url,data){
  modal.style.display = "block";
  var callPageViaURLVal = callPageViaURL(url,data);// assets/attendance/common.js
  // console.log(callPageViaURLVal);

  $('#modalContentContainer').empty();
  $('#modalContentContainer').append(callPageViaURLVal);
}

function closeModal(){
  $('#modalContentContainer').empty();
  modal.style.display = "none";
}