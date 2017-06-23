$(function() {
    var clicks = 0;
    $('[data-toggle="tooltip"]').tooltip();
    $('.checkBtn').on('click', function() {
        var listID = $(this).parent().attr('id');
        if ($(this).parent().hasClass("checked")) {
            $(this).parent().removeClass("checked");
            $('.list' + listID).attr('aria-valuenow', '50');
            $('.list' + listID).css({ "width": "50%" });
            $('.list' + listID).text("50% Complete");
        } else {
            $(this).parent().addClass("checked");
            $('.list' + listID).attr('aria-valuenow', '100');
            $('.list' + listID).css({ "width": "100%" });
            $('.list' + listID).text("100% Complete");
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