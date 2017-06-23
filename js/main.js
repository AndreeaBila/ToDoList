$(function() {
    var clicks = 0;
    $('[data-toggle="tooltip"]').tooltip();

    // $('.checkBtn').on('click', function() {
    //     if (clicks % 2 == 0) {
    //         $(this).parent().css({ "border": "3px solid #5cb85c", "border-radius": "5px" });
    //         $(this).css({ "color": "#5cb85c" });
    //     } else {
    //         $(this).parent().css({ "border": "none" });
    //         $(this).css({ "color": "#333333"});
    //     }
    //     clicks++;
    // });

    $('.checkBtn').on('click', function() {
        if( $(this).parent().hasClass("checked")) {
            $(this).parent().removeClass("checked");
            $('.progress-bar').attr('aria-valuenow', '50');
            $('.progress-bar').css({"width":"50%"});
            $('.progress-bar').text("50% Complete");
        } else 
            $(this).parent().addClass("checked");
            $('.progress-bar').attr('aria-valuenow', '100');
            $('.progress-bar').css({"width":"100%"});
            $('.progress-bar').text("100% Complete");
    });

    //function needed for the log out action
    $('#btnLogIn_Out').click(function() {
        //delete cookie
        document.cookie = "LoggedIn=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/WebDev/ToDoList/php;";
        //redirect the user to the login page
        location.href = 'index.php';
        //the session will then be destroyed on the index page
    });

    //this code will fetch all the lists for the given user from the database using an asynchronous call
    $.getJSON('../php/getLists.php', function(response) {

    });

});