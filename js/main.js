$(function() {
    //check if any of the lists has a status of completed and call the check function
    checkIfStatusComplete();

    //function needed to display information about the check button
    $('[data-toggle="tooltip"]').tooltip();
    //function needed to save a file as completed
    $('.checkBtn').on('click', function() {
        //get the list id of the list that is being marked as completed
        var listID = $(this).parent().parent().attr('id');
        var listObject = {
            listID: listID.substr(listID.length - 1),
            status: 0
        };
        if ($(this).parent().hasClass("checked")) {
            //mark the list as uncomplete by removing the checked class
            $(this).parent().removeClass("checked");
            $('#' + listID + ' .progress-bar').attr('aria-valuenow', '50');
            $('#' + listID + ' .progress-bar').css({ "width": "50%" });
            $('#' + listID + ' .progress-bar').text("50% Complete");
            listObject.status = 0;
        } else {
            //mark the list as complete by adding the checked class
            $(this).parent().addClass("checked");
            $('#' + listID + ' .progress-bar').attr('aria-valuenow', '100');
            $('#' + listID + ' .progress-bar').css({ "width": "100%" });
            $('#' + listID + ' .progress-bar').text("100% Complete");
            listObject.status = 1;
        }
        //ajax call to reset the staus of the current list in the database
        $.ajax({
            data: listObject,
            url: "../php/setListStatus.php",
            type: "get"
        });
    });

    //function needed for the log out action
    $('#btnLogIn_Out').click(function() {
        //delete cookie
        document.cookie = "LoggedIn=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/WebDev/ToDoList/php;";
        //redirect the user to the login page
        location.href = 'index.php';
        //the session will then be destroyed on the index page
    });

    function checkIfStatusComplete() {
        console.log($('#listArray').val());
    }
});