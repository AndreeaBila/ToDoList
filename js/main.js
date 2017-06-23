$(function() {
    var clicks = 0;
    $('[data-toggle="tooltip"]').tooltip();
    $('.checkBtn').on('click', function() {
        var listID = $(this).parent().parent().attr('id');
        if ($(this).parent().hasClass("checked")) {
            $(this).parent().removeClass("checked");
            $('.progress').attr('aria-valuenow', '50');
            $('.progress').css({ "width": "50%" });
            $('.progress').text("50% Complete");
        } else {
            $(this).parent().addClass("checked");
            $('.progress').attr('aria-valuenow', '100');
            $('.progress').css({ "width": "100%" });
            $('.progress').text("100% Complete");
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