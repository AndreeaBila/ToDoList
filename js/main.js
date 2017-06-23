$(function() {
    var clicks = 0;
    $('[data-toggle="tooltip"]').tooltip();
    $('.checkBtn').on('click', function() {
        var listID = $(this).parents().attr('id');
        alert(listID);
        if ($(this).parent().hasClass("checked")) {
            $(this).parent().removeClass("checked");
            $('.progress-bar').attr('aria-valuenow', '50');
            $('.progress-bar').css({ "width": "50%" });
            $('.progress-bar').text("50% Complete");
        } else {
            $(this).parent().addClass("checked");
            $('.progress-bar').attr('aria-valuenow', '100');
            $('.progress-bar').css({ "width": "100%" });
            $('.progress-bar').text("100% Complete");
        }
    });

    //function needed for the log out action
    $('#btnLogIn_Out').click(function() {
        //delete cookie
        document.cookie = "LoggedIn=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/WebDev/ToDoList/php;";
        //redirect the user to the login page
        location.href = 'index.php';
        //the session will then be destroyed on the index page
    });
});