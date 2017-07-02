$(document).ready(function() {
    $('.checkCircle').on('click', function() {
        if ($(this).parent().hasClass("checked")) {
            $(this).parent().removeClass("checked");
        } else {
            $('.checkCircle').removeClass("fa-circle-o");
            $('.checkCircle').addClass("fa-check-circle-o");
            $('.checkCircle').css({ "color": "#5cb85c" });
        }
    });

    //to delete the list
    $('.listComponent .addNew').click(function() {
        var item = { itemID: $(this).parent().attr('id') };
        $(this).parent().remove();
        //send async message to database to delete the item 
        $.ajax({
            data: item,
            url: '../php/deleteItem.php',
            type: 'post'
        });
    });
});