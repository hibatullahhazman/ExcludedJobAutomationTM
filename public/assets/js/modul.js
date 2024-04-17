/*var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})*/


$(document).on('click', '.show_user_details', function (e) {
  let tooltips = $(this).data('tooltips');

  $('.tooltips').html(tooltips);

});