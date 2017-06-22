$(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $('.checkBtn').on('click', function() {
        $(this).parent().css({ "border": "3px solid #5cb85c", "border-radius": "5px" });
        $(this).css({ "color": "#5cb85c" });
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