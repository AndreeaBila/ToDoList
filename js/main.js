$(function() {

  $('[data-toggle="tooltip"]').tooltip();

  $('#checkBtn1').on('click', function() {
    $('#listSquare1').css({"border":"3px solid #5cb85c", "border-radius":"5px"});
    $('#checkBtn1').css({"color":"#5cb85c"});
  });

});