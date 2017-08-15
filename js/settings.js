$(function() {
    //this code will run only when the entire document has been loaded
    //close every alert by default
    $('.alert').hide();
    //check if the user closes an alert and hide it
    $('.close').click(function() {
        $(this).parent().hide(500);
    });

    $('#btnLogIn_Out').click(function() {
        //delete cookie
        document.cookie = "LoggedIn=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/php;";
        //redirect the user to the login page
        location.href = 'index';
        //the session will then be destroyed on the index page
    });

    //check if the user has pressed the enter key
    $('.settings').keydown(function(e) {
        if (e.keyCode == 13) {
            $("#saveChanges").click();
        }
    })

    //variable needed to save information about the user from the database
    var userInfo;
    //get the user information from the database
    $.ajaxSetup({ async: false });
    $.getJSON("../php/getUserInfo.php", function(data) {
        userInfo = data;
    });
    $.ajaxSetup({ async: false });
    //populate the form with user data
    $('#settingsName').val(userInfo.userName);
    $('#settingsEmail').val(userInfo.email);
    $('#settingsDob').val(userInfo.birth);

    //when the user click on save changes submit the data to the database
    $("#saveChanges").click(function() {
        var formData = $('.settings').serialize();
        //verify if the two passwords match
        if ($('#settingsPassword').val() === $('#settingsRePassword').val()) {
            //check if the new username is unique
            $.getJSON("../php/checkUsername.php?username=" + $("#settingsName").val(), function(response) {
                if (response == 0 || $("#settingsName").val() == userInfo.userName) {
                    //send data to the database
                    $.ajax({
                        data: formData,
                        type: "post",
                        url: "../php/changeUserInfo.php",
                        success: function(data) {
                            $('#signup_successAlert').show(500);
                        },
                        error: function(data) {
                            alert("An error has occured");
                        }
                    })
                } else {
                    $('#signup_generalAlert').show(500);
                }
            });
        } else {
            $("#signup_passwordAlert").show(500);
        }
    })
})