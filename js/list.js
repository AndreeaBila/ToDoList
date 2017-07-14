$(document).ready(function() {
    $('.checkCircle').on('click', function() {
        //get the id of the item that has been selected
        var item = {
            itemID: $(this).parent().attr('id'),
            status: false
        };
        if ($(this).parent().hasClass("taskAchieved")) {
            $(this).parent().removeClass("taskAchieved");
            $(this).removeClass("fa-check-circle-o");
            $(this).addClass("fa-circle-o");
            item.status = false;
        } else {
            $(this).parent().addClass("taskAchieved")
            $(this).removeClass("fa-circle-o");
            $(this).addClass("fa-check-circle-o");
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
});