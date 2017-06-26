$(function() {
    //hide all the alerts
    $('.alert').hide();
    $('.close').click(function() {
        $(this).parent().hide(500);
    });
    //function needed to display information about the check button
    $('[data-toggle="tooltip"]').tooltip();
    //function needed to save a file as completed
    $('.checkBtn').on('click', function() {
        //get the list id of the list that is being marked as completed
        var listID = $(this).parent().parent().attr('id');
        var listObject = {
            listID: listID.replace('list', ''),
            status: 0
        };
        if ($(this).parent().hasClass("checked")) {
            //get the value of the hidden input
            var actualCompletition = $('input#' + listID).val();
            if (actualCompletition < 100) {
                //mark the list as uncomplete by removing the checked class
                $(this).parent().removeClass("checked");
                $('#' + listID + ' .progress-bar').attr('aria-valuenow', actualCompletition);
                $('#' + listID + ' .progress-bar').css({ "width": actualCompletition + "%" });
                $('#' + listID + ' .progress-bar').text(actualCompletition + "% Complete");
                listObject.status = 0;
            }
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

    //function need to chekc if any of the lists is being deleted
    $('.deleteBtn').click(function() {
        var deletedList = {
            listID: $(this).parent().parent().attr('id')
        };
        $('#btnConfirmDelete').click(function() {
            //create an ajax call to delete the list from the database and alos from the main page
            $('div#' + deletedList.listID).remove(); //delete the list from the actual page
            deletedList.listID = deletedList.listID.replace('list', '');
            $.ajax({
                data: deletedList,
                url: '../php/deleteList.php',
                type: 'get'
            });
        });
        $('#btnCancelDelete').click(function() {
            location.reload();
        });
    });
    //function needed when the user creates a new list
    $('#btnCreateList').click(function() {
        //first of all check if the user has filled every detail
        var listInfo = {
            listName: $('#newListName').val(),
            listDetails: $('#listDetails').val(),
            listDeadline: $('#listDeadline').val()
        };
        if (listInfo.listName == '' || listInfo.listDetails == '' || listInfo.listDeadline == '') {
            $('#createListAlert').show(500);
        } else {
            var duplicate = false;
            //get every list from the database and ckec their names
            $.getJSON('../php/getListNames.php', function(listArray) {
                listArray.forEach(function(element) {
                    if (element == listInfo.listName) {
                        duplicate = true;
                    }
                }, this);
                if (duplicate) {
                    $('#createListAlert').show(500);
                } else {
                    //send the list information to the database
                    $.ajax({
                        data: listInfo,
                        url: '../php/createNewList.php',
                        type: 'get',
                        success: function(response) {
                            //navigate the user to the page of the list
                            location.href = "list.php?listID=" + response;
                        },
                        error: function(response) {
                            alert('An error has occured!');
                        }
                    });
                }
            });
        }
    });

    //create an event listener to check if the eneter key is pressed for creaeting a new list
    $('#createListForm').keydown(function(e) {
        if (e.keyCode == 13) {
            $('#btnCreateList').click();
        }
    });

    $('.editBtn').click(function() {
        var listID = $(this).parent().parent().attr('id');
        listID = listID.replace('list', '');
        location.href = "list.php?listID=" + listID;
    });

    //when the user clicks a list rediret him to the list's current page
    //create a new button on the list page to redirect the user to the list's page
    // $('.listSquare').click(function() {
    //     console.log($(this).attr('class'));
    //     var listID = $(this).parent().attr('id');
    //     listID = listID.replace('list', '');
    //     //location.href = "list.php?listID=" + listID;
    // });
});