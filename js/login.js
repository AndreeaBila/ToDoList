$('#loginForm').hide();
$('#signupForm').hide();

$('#learnMore').click(function() {
  $('#loginForm').show(500); 
  $('#learnMore').hide();
  $('html').css({"min-height":"55%", "height":"55%"});
  $('body').css({"min-height":"55%", "height":"55%"});
  $('.jumbotron').css({"min-height":"55%", "height":"55%"});
});

$('#loginCreateAccount').click(function() {
  $('#loginForm').hide(500);
  $('#signupForm').show(500);
});

$('#signupBackToLogin').click(function() {
  $('#loginForm').show(500);
  $('#signupForm').hide(500);
});