$(function() {

  $('[data-toggle="tooltip"]').tooltip();

  $('.checkBtn').on('click', function() {
    $(this).parent().css({"border":"3px solid #5cb85c", "border-radius":"5px"});
    $(this).css({"color":"#5cb85c"});
  });

});