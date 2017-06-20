//hide the forms before the user clicks learn more button
//must happen as fast as possible
$('#loginForm').hide();
$('#signupForm').hide();
$(".alert").hide();

//this area will run only after the entire page was loaded
$(document).ready(function() {
    $('#learnMore').click(function() {
        $('#loginForm').show(500);
        $('#learnMore').hide();
        $('html').css({ "min-height": "55%", "height": "55%" });
        $('body').css({ "min-height": "55%", "height": "55%" });
        $('.jumbotron').css({ "min-height": "55%", "height": "55%" });
    });

    $('#loginCreateAccount').click(function() {
        $('#loginForm').hide(500);
        $('#signupForm').show(500);
    });

    $('#signupBackToLogin').click(function() {
        $('#loginForm').show(500);
        $('#signupForm').hide(500);
    });

    //if the close button for any alert is clicekd then close that alert
    $('.close').click(function() {
        $(this).parent().hide(500);
    });
});


//function needed to send the data to the server and perfom the signup action
function verifySignUp() {
    //verify if the two passwords match
    if ($('#signupPassword').val() == $('#signupRePassword').val()) {
        //verify if the username is already in use
        var usr = $('#signupUsername').val();
        var result = true;
        var userName = {
            username: usr
        };
        jQuery.ajaxSetup({ async: false });
        $.ajax({
            data: userName,
            type: "get",
            url: "../php/checkUsername.php",
            success: function(response) {
                if (response == "success") {
                    return true;
                } else {
                    result = false;
                    $('#signup_generalAlert').fadeIn(700);
                    return false;
                }
            },
            error: function(response) {
                alert("Oops! It seems that an error has occured. Please come back later!");
            }
        });
        jQuery.ajaxSetup({ async: true });
        return result;
    } else {
        $('#signup_passwordAlert').fadeIn(700);
        return false;
    }
}

//function needed to send the data to the server and perfom the login action
//jQuery evetn neede for when the submit button is pressed
$('#loginSubmit').click(function() {
    var user = $('#loginForm').serialize();
    $.ajax({
        data: user,
        type: "post",
        url: "logIn.php",
        success: function(response) {
            if (response == "success") {
                location.href = "main.php";
            } else {
                $('#login_generalAlert').fadeIn(700);
            }
        },
        error: function(response) {
            alert("An error has occured! Please try again later.");
        }
    });
});