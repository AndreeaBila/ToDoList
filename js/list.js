$(document).ready(function() {
  $('.checkCircle').on('click', function() {
    if ($(this).parent().hasClass("checked")) {
      $(this).parent().removeClass("checked");
    } else {
        $('.checkCircle').removeClass("fa-circle-o");
        $('.checkCircle').addClass("fa-check-circle-o");
        $('.checkCircle').css({"color":"#5cb85c"});
      }
  });
});