$(document).ready(function() {
    //make sure every alert disappears by default
    $('.alert').hide();
    //if the alert close button is clicked close the alert
    $('.close').click(function() {
        $(this).parent().hide(300);
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('.checkItemBtn').on('click', function() {
        //get the id of the item that has been selected
        var item = {
            itemID: $(this).parent().attr('id'),
            status: false
        };
        if ($(this).parent().hasClass("taskAchieved")) {
            $(this).parent().removeClass("taskAchieved");
            $(this).removeClass("btn-success");
            $(this).addClass("btnUnchecked");
            item.status = false;
        } else {
            $(this).parent().addClass("taskAchieved");
            $(this).addClass("btn-success");
            $(this).removeClass("btnUnchecked");
            item.status = true;
        }
        $.ajax({
            data: item,
            url: '../php/changeItemStatus.php',
            type: 'get'
        });
    });

    //to delete the item
    $('.listComponent .addNew').click(function() {
        var item = { itemID: $(this).parent().attr('id') };
        var count = $(this).parent().siblings().length;
        $(this).parent().remove();
        //send async message to database to delete the item 
        $.ajax({
            data: item,
            url: '../php/deleteItem.php',
            type: 'post'
        });
        if (count === 0) {
            $('.listTasks').append('<div class="text-center defaultMsg"><h3>Start adding items to this list</h3></div>');
        }
    });

    //listen for the add new item button click event on enter
    $('.addNewTaskForm').keydown(function(e) {
        if (e.keyCode == 13) {
            $('.addNewTaskForm .addNew').click();
        }
    });

    //drop the list
    //function need to chekc if any of the lists is being deleted
    $('#btnConfirmDelete').click(function() {
        //get the id of the list that is being deleted
        var listID = location.href.split('=')[1];
        var list = {
            listID: listID
        };
        //send async message to delete the liist
        $.ajax({
            async: false,
            data: list,
            type: 'get',
            url: '../php/deleteList.php'
        });
        location.href = "main";
    });

    //function needed for the log out action
    $('#btnLogIn_Out').click(function() {
        //delete cookie
        document.cookie = "LoggedIn=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/WebDev/ToDoList/php;";
        //redirect the user to the login page
        location.href = 'index';
        //the session will then be destroyed on the index page
    });

    //check if the user tries to open the change list dialog box
    $('.editListBtn').click(function() {
        //get the information about the list from the page and populate the form with it
        var list = {
            title: $('.leftHead h2').text().replace('Edit This List', ''),
            description: $('.listDescription').text(),
            deadline: $('#deadline').text()
        };
        $('#listName').val(list.title);
        $('#listDetails').val(list.description);
        $('#listDeadline').val(list.deadline);
    });
    //check if the user is submitting the change of the list
    $('#btnChangeList').click(function() {
        //verify that every detail has been completed
        if ($("#listName").val() == "" || $("#listDetails").val() == "" || $('#listDeadline').val() == "") {
            $('.alert').show(300);
        } else {
            //verify that the list name is unique
            //get the list name entered by the user and the id of the list that he is changeing
            var list = {
                listTitle: $("#listName").val(),
                listDetails: $("#listDetails").val(),
                listDeadline: $("#listDeadline").val(),
                listID: /listID=([^&]+)/.exec(location.href)[1]
            };
            //send the data to the server and verify if the list is unique
            $.ajax({
                data: list,
                url: "../php/changeList.php",
                type: "post",
                success: function(response) {
                    if (response == "error") {
                        $('.alert').show(300);
                    } else {
                        location.reload();
                    }
                },
                error: function(response) {
                    alert("Oops! It appears we have encountered an error");
                }
            });
        }
    });

    //check if the change item has been pressed
    $('.listComponent .btn-primary').click(function() {
        //get the id of the item that is being changed
        var itemID = $(this).parent().attr('id');
        $('#changedItemID').val(itemID);
        //get the item data
        var selectedText = $(this).parent().children().first().next().text();
        var selectedImportance = $(this).parent().children().first().next().attr("class");
        $('#changeTask').val(selectedText);
        switch (selectedImportance) {
            case "placeholderImportance":
                $('#changeImportanceSelector').val("placeholder");
                break;
            case "lowImportance":
                $('#changeImportanceSelector').val("low");
                break;
            case "moderateImportance":
                $('#changeImportanceSelector').val("moderate");
                break;
            case "highImportance":
                $('#changeImportanceSelector').val("high");
                break;
        }
    });

    $('#btnChangeItem').click(function() {
        var data = $('#changeItemForm').serialize();
        $.ajax({
            data: data,
            url: "../php/changeItem.php",
            type: "post",
            success: function() {
                location.reload();
            },
            error: function() {
                alert("An error has occured");
            }
        });
    });
});