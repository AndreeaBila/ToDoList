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
        if(count === 0){
            $('.listTasks').append('<div class="text-center defaultMsg"><h3>Start adding items to this list</h3></div>');
        }
    });

    //listen for the add new item button click event on enter
    $('.addNewTaskForm').keydown(function(e) {
        if (e.keyCode == 13) {
            $('.addNewTaskForm .addNew').click();
        }
    });
});